<?php
/**
* @version 			SEBLOD 3.x More ~ $Id: index.php sebastienheraud $
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

require_once __DIR__.'/config.php';
$cck	=	CCK_Rendering::getInstance( $this->template );
if ( $cck->initialize() === false ) { return; }

$map_id				=	$cck->id.'_map';
$map_width			=	$cck->getStyleParam( 'map_width', '600px' );
$map_height			=	$cck->getStyleParam( 'map_height', '375px' );
$map_country        =   substr( JFactory::getLanguage()->getTag(), 0, 2 );
$map_lang			=	strtolower(substr( JFactory::getLanguage()->getTag(), -2, 2 ));
$map_lang_tag       =   JFactory::getLanguage()->getTag();
$map_zoom		    =	(int)$cck->getStyleParam( 'map_zoom', 1 );
$map_autozoom       =   (int)$cck->getStyleParam( 'map_autozoom', 0 );
$scheme				=	JUri::getInstance()->getScheme();

$infowindow			=	$cck->getFields( 'infowindow', '', false );
$locations			=	$cck->getFields( 'location', '', false );
$multiple			=	( count( $infowindow ) > 1 ) ? true : false;

$clustering         =   (int)$cck->getStyleParam( 'map_marker_clustering', '0' );
$clustering_zoom    =   (int)$cck->getStyleParam( 'map_marker_clustering_maxzoom', '15' );
$map_iw_event       =   $cck->getStyleParam( 'map_infowindow_openevent', 'click' );
$items				=	$cck->getItems();

// Set
$class				=	trim( $cck->id_class );
$isMore				=	$cck->isLoadingMore();
if ( $cck->isGoingToLoadMore() ) {
	$class			.=	' cck-loading-more';
}
$class				=	trim( $class );
$class				=	( $class ) ? ' class="'.$class.'"' : '';

$map_tile_server      =  'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
$map_tile_attribution =  '<a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>';

if($map_lang_tag === 'fr-FR' ){

    $map_tile_server      =  'https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png';
    $map_tile_attribution =  '&copy; Openstreetmap France | &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

}else if($map_lang_tag === 'de-CH' ){

    $map_tile_server      =  'https://tile.osm.ch/switzerland/{z}/{x}/{y}.png';
    $map_tile_attribution =  '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

}else if($map_country === 'de' ){

    $map_tile_server      =  'https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png';
    $map_tile_attribution =  '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

}

?>
<?php if (!$isMore): ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
  integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
  crossorigin=""></script>

<link rel="stylesheet" href="<?php echo JUri::root( true ).$cck->base.'/templates/'.$cck->template.'/js/markercluster/MarkerCluster.css'; ?>"/>
<link rel="stylesheet" href="<?php echo JUri::root( true ).$cck->base.'/templates/'.$cck->template.'/js/markercluster/MarkerCluster.Default.css'; ?>"/>
<script src="<?php echo JUri::root( true ).$cck->base.'/templates/'.$cck->template.'/js/markercluster/leaflet.markercluster-src.js'; ?>"></script>

<?php

if (count($items)) {

	$lat_longs = array();
    $markers = array();

	$osm_latitude		=	$cck->getFields( 'latitude', '', false );
	$osm_f_latitude		=	$osm_latitude[0];
	$osm_longitude		=	$cck->getFields( 'longitude', '', false );
	$osm_f_longitude	=	$osm_longitude[0];

    $osm_marker      =   $cck->getFields( 'markericon', '', false );
    $osm_f_marker    =   isset($osm_marker[0]) ? $osm_marker[0] : null;

 	foreach ($items as $pk => $item){

		$html		=	'';
		$osm_lat		=	$item->getValue( $osm_f_latitude );
		$osm_lat		=	( $osm_lat != '' ) ? $osm_lat : 0;
		$osm_lng		=	$item->getValue( $osm_f_longitude );
		$osm_lng		=	( $osm_lng != '' ) ? $osm_lng : 0;

        $osm_marker     =  '';

        if($osm_f_marker !== null ){
            $osm_marker_selected = $item->getValue( $osm_f_marker );
            $osm_marker          = (string) ($osm_marker_selected != '' ) ? $osm_marker_selected : '';
        }

		if ( $osm_lat == 0 && $osm_lng == 0 ) {
			continue;
		}

		if(!isset($lat_longs['la_'.str_replace(array('-', '.'), '_', $osm_lat).'_lo_'.str_replace(array('-', '.'), '_', $osm_lng).''])){

            $lat_longs['la_'.str_replace(array('-', '.'), '_', $osm_lat).'_lo_'.str_replace(array('-', '.'), '_', $osm_lng).'']['latitude'] = $osm_lat;

            $lat_longs['la_'.str_replace(array('-', '.'), '_', $osm_lat).'_lo_'.str_replace(array('-', '.'), '_', $osm_lng).'']['longitude'] = $osm_lng;

            $lat_longs['la_'.str_replace(array('-', '.'), '_', $osm_lat).'_lo_'.str_replace(array('-', '.'), '_', $osm_lng).'']['addresses'] = array();
        }

		$address = '';

		foreach ( $infowindow as $iw ) {
			$content	=	$item->renderField( $iw );
			if ( $content != '' ) {

				if ( $item->getMarkup( $iw ) != 'none' && ( $multiple || $item->getMarkup_Class( $iw ) ) ) {
					$address	.=	'<div class="cck-clrfix'.$item->getMarkup_Class( $iw ).'">'.$content.'</div>';
				} else {
					$address	.=	$content;
				}
			}
		}

		// array_push($lat_longs['la_'.str_replace(array('-', '.'), '_', $osm_lat).'_lo_'.str_replace(array('-', '.'), '_', $osm_lng).'']['addresses'], $address );

        $marker = array();
        $marker['latitude'] = $osm_lat;
        $marker['longitude'] = $osm_lng;
        $marker['marker'] = $osm_marker;
        $marker['addresses'][] = $address;

        array_push($markers, $marker );

 	}
}

?>

<div id="<?php echo $cck->id; ?>"<?php echo $class; ?>>
	<div id="<?php echo 'map'.$map_id;?>" style="width:<?php echo $map_width; ?>; height:<?php echo $map_height; ?>;"></div>
</div>

<script type="text/javascript">

   var map<?php echo $map_id; ?>       = new L.Map('map<?php echo $map_id; ?>', {});
    map<?php echo $map_id; ?>.attributionControl.setPrefix('');

    var defaultCoordinates<?php echo $map_id; ?>     = new L.LatLng(<?php echo $cck->getStyleParam( 'map_lat', '48.856614' ); ?>, <?php echo $cck->getStyleParam( 'map_lng', '2.3522219000000177' ); ?>);

    <?php if ($map_autozoom): ?>
    var <?php echo $map_id; ?>MarkerArray = [];
    <?php endif;?>

    <?php if ($clustering): ?>
    var <?php echo $map_id; ?>ClusterGroup = new L.MarkerClusterGroup({ disableClusteringAtZoom: <?php echo (int) $clustering_zoom; ?> });
    <?php endif;?>

    var LeafIcon = L.Icon.extend({
        options: {
            iconSize: [28, 28],
        }
    });

    var baselayer<?php echo $map_id; ?> = new L.TileLayer(
        '<?php echo trim($map_tile_server); ?>',
        {
            noWrap: false,
            attribution: '<?php echo trim($map_tile_attribution); ?>'
        }
        );

    // set map view
    map<?php echo $map_id; ?>
    .setView(defaultCoordinates<?php echo $map_id; ?>, <?php echo $map_zoom; ?>)
    .addLayer(baselayer<?php echo $map_id; ?>);

	<?php foreach ($markers as $key => $latlong): ?>
        <?php if (isset($latlong['latitude']) && isset($latlong['longitude']) && count($latlong['addresses'])): ?>

    var co_<?php echo $map_id; ?>_<?php echo $key; ?>  = new L.LatLng(<?php echo $latlong['latitude']; ?>, <?php echo $latlong['longitude']; ?>);

    <?php if (isset($latlong['marker']) && strlen(trim($latlong['marker'])) ): ?>

    var locIcon_<?php echo $key; ?> = new LeafIcon({iconUrl: '<?php echo trim($latlong['marker']); ?>'});

   	var ma_<?php echo $map_id; ?>_<?php echo $key; ?> = new L.Marker(co_<?php echo $map_id; ?>_<?php echo $key; ?>, {icon: locIcon_<?php echo $key; ?>});
    <?php else: ?>
    var ma_<?php echo $map_id; ?>_<?php echo $key; ?> = new L.Marker(co_<?php echo $map_id; ?>_<?php echo $key; ?>);
    <?php endif;?>

    <?php if ($map_autozoom): ?>
    <?php echo $map_id; ?>MarkerArray.push(ma_<?php echo $map_id; ?>_<?php echo $key; ?>);
    <?php endif;?>

    <?php if ($map_iw_event == 'mouseover' ): ?>
            ma_<?php echo $map_id; ?>_<?php echo $key; ?>
            .bindTooltip('<?php echo '<table><tr><td>'.implode('</td><td>',$latlong['addresses']).'</td></tr></table>'; ?>')
            .openTooltip();
    <?php else: ?>
            ma_<?php echo $map_id; ?>_<?php echo $key; ?>
            .bindPopup('<?php echo '<table><tr><td>'.implode('</td><td>',$latlong['addresses']).'</td></tr></table>'; ?>')
            .openPopup();
    <?php endif;?>

            <?php if ($clustering): ?>
                <?php echo $map_id; ?>ClusterGroup.addLayer(ma_<?php echo $map_id; ?>_<?php echo $key; ?>);
            <?php else: ?>
            map<?php echo $map_id; ?>.addLayer(ma_<?php echo $map_id; ?>_<?php echo $key; ?>);
            <?php endif;?>

        <?php endif;?>
    <?php endforeach;?>

    <?php if ($map_autozoom): ?>
    var <?php echo $map_id; ?>Group = L.featureGroup(<?php echo $map_id; ?>MarkerArray);
    map<?php echo $map_id; ?>.fitBounds(<?php echo $map_id; ?>Group.getBounds());
    <?php endif;?>

    <?php if ($clustering): ?>
    map<?php echo $map_id; ?>.addLayer(<?php echo $map_id; ?>ClusterGroup);
    <?php endif;?>


</script>

<?php endif;?>