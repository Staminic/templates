<?php
/**
* @version             SEBLOD 3.x More ~ $Id: index.php jonbuckner $
* @package            SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url                http://www.seblod.com
* @editor            Octopoos - www.octopoos.com
* @copyright        Copyright (C) 2013 SEBLOD. All Rights Reserved.
* @license             GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

// -- Initialize
require_once dirname(__FILE__).'/config.php';

$cck    								=    	CCK_Rendering::getInstance( $this->template );

if ( $cck->initialize() === false )
	{ return; }

// -- Prepare
$attributes                         	=		$cck->item_attributes ? ' '.$cck->item_attributes : ''; // Global => Custom Attr. per item
$class                              	=		trim( $cck->getStyleParam( 'class', '' ) ); // Seblod Default Options => Class (CSS)
$custom_attr                        	=		trim( $cck->getStyleParam( 'attributes', '' ) ); // Seblod Default Options => Custom Attributes
$custom_attr                        	=		$custom_attr ? ' '.$custom_attr : '';
$display_mode 							= 		(int) $cck->getStyleParam( 'list_display', '0' ); // 0 => Normal, // 1 => Advanced (Item View) // 2 => Intermediate (List View + Positions)
$id_class                           	=		$cck->id_class;  // Global => Wrap Class (CSS)
$fieldnamesBefore                       =		$cck->getFields( 'before', '', false );
$fieldnamesAbove                        =		$cck->getFields( 'above', '', false );
$fieldnamesOpen                       	=		$cck->getFields( 'open', '', false );
$fieldnamesElement                     	=		$cck->getFields( 'element', '', false );
$fieldnamesClose                        =		$cck->getFields( 'close', '', false );
$fieldnamesHidden                       =		$cck->getFields( 'hidden', '', false );
$fieldnamesBelow                        =		$cck->getFields( 'below', '', false );
$fieldnamesAfter                        =		$cck->getFields( 'after', '', false );
$fieldnamesModal                        =		$cck->getFields( 'modal', '', false );
$multiple                           	=		( count( $fieldnamesElement ) > 1 ) ? true : false;
$items                              	=		$cck->getItems();
$count                              	=		count( $items );
$auto_clean		=	(int)$cck->getStyleParam( 'auto_clean', 0 );

if ( $auto_clean == 2 ) {
	$isRaw		=	1;
} else {
	$isRaw		=	( $count == 1 ) ? $auto_clean : 0;
}


// 
$htmlAbove                        	=		''; // for position 'above'
$htmlBelow                        	=		''; // for position 'below'
$htmlBefore                        	=		''; // for position 'before'
$htmlAfter                          	=		''; // for position 'after'
$htmlElement                        	=		''; // for each Element
$htmlModal                          	=		''; // for each Modal - not outer
$htmlHidden                         	=		''; // for each Hidden
$html                               	=		''; // for all items


// -- Attributes Options
$attributesParent                   	=		$cck->getStyleParam( 'attributes_parent');
$attributesChild                   		=		$cck->getStyleParam( 'attributes_child');

// -- Modal Settings
// modal framework (0:none, bs: Twitter Bootstrap, zf: Zurb Foundation, yu: YooTheme UIKit, x: Blank or generis, for custom use)
$modalFramework                     	=		$cck->getStyleParam( 'modal_framework');
// modal version (0:none, 1-9)
$modalVersion                       	=		(int) $cck->getStyleParam( 'modal_version');
// modal_uk_modal_body, keep it as before .uk-modal-dialog.uk-modal-body, or .uk-modal-dialog .uk-modal-body, or .uk-modal-dialog
$modalUkModalBody 						=		(int) $cck->getStyleParam( 'modal_uk_modal_body');
// unique name for modal, this becomes $modalIdentifier which is then the same as Slicked Minima
$modalIdentifierName                	=		$cck->getStyleParam( 'modal_identifier');
// extra classes for modal, this is convenient for uikit users
$modalClassesParent 					=		$cck->getStyleParam( 'modal_classesParent');
// label for modal
$modalAriaLabelledBy                	=		$cck->getStyleParam( 'modal_ariaLabelledBy') == '' ? '' : 'aria-labelledby="'.$cck->getStyleParam( 'modal_ariaLabelledBy').'"';
// hidden, true or false
$modalAriaHidden                    	=		(int) $cck->getStyleParam( 'modal_ariaHidden') === 0 ? '' : ($cck->getStyleParam( 'modal_ariaHidden') === 1 ? 'aria-hidden="true" ' : 'aria-hidden="false" ');
// Modal Index - used to make each item have unique modal attribute
$mI = 1;


// -- Slicked List

/*Slick Css*/
$cssFileLoad                   			=		(int) $cck->getStyleParam( 'css_fileLoad' );
$cssFileLoadLocation           			=		JURI::base( true ).'/templates/'.$this->template.'/css/slick.css';
$cssThemeFileLoad              			=		(int) $cck->getStyleParam( 'css_themeFileLoad' );
$cssThemeFileLoadLocation      			=		JURI::base( true ).'/templates/'.$this->template.'/css/slick-theme.css';
$cssSlickIdentifier 					=		$cck->getStyleParam( 'css_slickIdentifier' );
$cssClassesParent 						=		trim( $cck->getStyleParam( 'css_classesParent' ));
$cssClassesChild 						=		trim( $cck->getStyleParam( 'css_classesChild' ));
$outputElementType             			=		$cck->getStyleParam( 'output_elementType' );
if (strpos($outputElementType, '_') !== false) 
{
	$tags			=	explode( '_', $outputElementType );
	$outputElementParent = $tags[0];
	$outputElementsChild = $tags[1];

} else {
	switch ($outputElementType) 
	{
		case '0':
			$outputElementParent           			=		'div';
			$outputElementsChild           			=		'div';
			break;
		case '1':
			$outputElementParent           			=		'ul';
			$outputElementsChild           			=		'li';
			break;
		case '2':
			$outputElementParent           			=		'ol';
			$outputElementsChild           			=		'li';
			break;
		
		default:
			$outputElementParent           			=		'div';
			$outputElementsChild           			=		'div';
			break;
	}
}

// Set
$isMore                             	=		$cck->isLoadingMore();
if ( $cck->isGoingToLoadMore() )
{
    $class                          	=		trim( $class.' '.'cck-loading-more' );
}
$class                              	=		str_replace( '$total', $count, $class );


/*Slick JS*/
$jsFileLoad 							=		(int) $cck->getStyleParam( 'js_fileLoad' );
$jsFileLoadLocation 					=		JURI::base( true ).'/templates/'.$this->template.'/js/slick.min.js';
$jsApply 								=		(int) $cck->getStyleParam( 'js_apply' );
$jsCustomApply 							=		(int) $cck->getStyleParam( 'js_customApply' );
$jsCustom 								=		$jsCustomApply === 0 ? '' : $cck->getStyleParam( 'slick_jsCustom' );
$jsApplyStart 							=		'jQuery(document).ready(function(){jQuery(\'.'.$cssSlickIdentifier.'\').slick({'."\n"; // double quotes required for it to work
$jsApplySettings 						=		'';
$jsApplyEnd 							=		'});'."\n".'});';
$jsOutput 								=		'';


/*Slick JS Settings Helper*/
$jsResponsive1                   		=		(($cck->getStyleParam( 'js_responsive1Enable') == '0') || (($cck->getStyleParam( 'slick_responsive1Bp' ) == '') || ($cck->getStyleParam( 'slick_responsive1Settings' ) == ''))) ? '' : '{breakpoint: '.$cck->getStyleParam( 'slick_responsive1Bp' ).', settings: {'.$cck->getStyleParam( 'slick_responsive1Settings' ).'}},';
$jsResponsive2                   		=		(($cck->getStyleParam( 'js_responsive2Enable') == '0') || (($cck->getStyleParam( 'slick_responsive2Bp' ) == '') || ($cck->getStyleParam( 'slick_responsive2Settings' ) == ''))) ? '' : '{breakpoint: '.$cck->getStyleParam( 'slick_responsive2Bp' ).', settings: {'.$cck->getStyleParam( 'slick_responsive2Settings' ).'}},';
$jsResponsive3                   		=		(($cck->getStyleParam( 'js_responsive3Enable') == '0') || (($cck->getStyleParam( 'slick_responsive3Bp' ) == '') || ($cck->getStyleParam( 'slick_responsive3Settings' ) == ''))) ? '' : '{breakpoint: '.$cck->getStyleParam( 'slick_responsive3Bp' ).', settings: {'.$cck->getStyleParam( 'slick_responsive3Settings' ).'}},';
$jsResponsive4                   		=		(($cck->getStyleParam( 'js_responsive4Enable') == '0') || (($cck->getStyleParam( 'slick_responsive4Bp' ) == '') || ($cck->getStyleParam( 'slick_responsive4Settings' ) == ''))) ? '' : '{breakpoint: '.$cck->getStyleParam( 'slick_responsive4Bp' ).', settings: {'.$cck->getStyleParam( 'slick_responsive4Settings' ).'}},';
$jsResponsive5                   		=		(($cck->getStyleParam( 'js_responsive5Enable') == '0') || (($cck->getStyleParam( 'slick_responsive5Bp' ) == '') || ($cck->getStyleParam( 'slick_responsive5Settings ') == ''))) ? '' : '{breakpoint: '.$cck->getStyleParam( 'slick_responsive5Bp' ).', settings: {'.$cck->getStyleParam( 'slick_responsive5Settings' ).'}},';
$jsResponsive 							=		$jsResponsive1 . $jsResponsive2 . $jsResponsive3 . $jsResponsive4 . $jsResponsive5;
/*Slick Settings*/
$slickSettings 							= 		array();
$slickSettings['accessibility'] 		=		$cck->getStyleParam( 'slick_accessibility') == 'true' ? '' : $cck->getStyleParam( 'slick_accessibility');
$slickSettings['adaptiveHeight'] 		=		$cck->getStyleParam( 'slick_adaptiveHeight') == 'false' ? '' : $cck->getStyleParam( 'slick_adaptiveHeight');
$slickSettings['autoplay'] 				=		$cck->getStyleParam( 'slick_autoplay') == 'false' ? '' : $cck->getStyleParam( 'slick_autoplay');
$slickSettings['autoplaySpeed'] 		=		$cck->getStyleParam( 'slick_autoplayspeed') == '3000' ? '' : $cck->getStyleParam( 'slick_autoplayspeed');
$slickSettings['arrows'] 				=		$cck->getStyleParam( 'slick_arrows') == 'true' ? '' : $cck->getStyleParam( 'slick_arrows');
$slickSettings['asNavFor'] 				=		$cck->getStyleParam( 'slick_asNavFor') == '' ? '' : '\'.'.$cck->getStyleParam( 'slick_asNavFor').'\'';
$slickSettings['appendArrows'] 			=		$cck->getStyleParam( 'slick_appendArrows') == '$(element)' ? '' : '\''.$cck->getStyleParam( 'slick_appendArrows').'\'';
$slickSettings['prevArrow'] 			=		$cck->getStyleParam( 'slick_prevArrowElement') == '' ? '' : '\''.'<'.$cck->getStyleParam( 'slick_prevArrowElement').' data-role="none" class="'.$cck->getStyleParam( 'slick_prevArrowClass' ).'" aria-label="'.$cck->getStyleParam( 'slick_prevArrowText' ).'" tabindex="0" role="button">'.$cck->getStyleParam( 'slick_prevArrowText' ).'</'.$cck->getStyleParam( 'slick_prevArrowElement' ).'>'.'\'';
$slickSettings['nextArrow'] 			=		$cck->getStyleParam( 'slick_nextArrowElement') == '' ? '' : '\''.'<'.$cck->getStyleParam( 'slick_nextArrowElement').' data-role="none" class="'.$cck->getStyleParam( 'slick_nextArrowClass' ).'" aria-label="'.$cck->getStyleParam( 'slick_nextArrowText' ).'" tabindex="0" role="button">'.$cck->getStyleParam( 'slick_nextArrowText' ).'</'.$cck->getStyleParam( 'slick_nextArrowElement' ).'>'.'\'';
$slickSettings['centerMode'] 			=		$cck->getStyleParam( 'slick_centerMode') == 'false' ? '' : $cck->getStyleParam( 'slick_centerMode');
$slickSettings['centerPadding'] 		=		$cck->getStyleParam( 'slick_centerPadding') == '' ? '' : '\''.$cck->getStyleParam( 'slick_centerPadding' ).($cck->getStyleParam( 'slick_centerPaddingUnits' ) == 0 ? 'px' : '%').'\'';
$slickSettings['cssEase'] 				=		$cck->getStyleParam( 'slick_cssEase') == 'ease' ? '' : '\''.$cck->getStyleParam( 'slick_cssEase' ).'\'';
$slickSettings['customPaging'] 			=		$cck->getStyleParam( 'slick_customPaging') == '' ? '' : ': ' . $cck->getStyleParam( 'customPaging' );
$slickSettings['dots'] 					=		$cck->getStyleParam( 'slick_dots') == 'false' ? '' : $cck->getStyleParam( 'slick_dots');
$slickSettings['dotsClass'] 			=		$cck->getStyleParam( 'slick_dotsClass') == 'slick-dots' ? '' : '\''.$cck->getStyleParam( 'slick_dotsClass' ).'\'';
$slickSettings['appendDots'] 			=		$cck->getStyleParam( 'slick_appendDots') == '$(element)' ? '' : '\''.$cck->getStyleParam( 'slick_appendDots' ).'\'';
$slickSettings['draggable'] 			=		$cck->getStyleParam( 'slick_draggable') == 'true' ? '' : $cck->getStyleParam( 'slick_draggable');
$slickSettings['fade'] 					=		$cck->getStyleParam( 'slick_fade') == 'false' ? '' : $cck->getStyleParam( 'slick_fade');
$slickSettings['focusOnSelect'] 		=		$cck->getStyleParam( 'slick_focusOnSelect') == 'false' ? '' : $cck->getStyleParam( 'slick_focusOnSelect');
$slickSettings['easing'] 				=		$cck->getStyleParam( 'slick_easing') == 'linear' ? '' : '\''.$cck->getStyleParam( 'slick_easing').'\'';
$slickSettings['edgeFriction'] 			=		$cck->getStyleParam( 'slick_edgeFriction') == '0.15' ? '' : $cck->getStyleParam( 'slick_edgeFriction');
$slickSettings['infinite'] 				=		$cck->getStyleParam( 'slick_infinite') == 'true' ? '' : $cck->getStyleParam( 'slick_infinite');
$slickSettings['initialSlide'] 			=		$cck->getStyleParam( 'slick_initialSlide') == '0' ? '' : $cck->getStyleParam( 'slick_initialSlide');
$slickSettings['lazyLoad'] 				=		$cck->getStyleParam( 'slick_lazyLoad') == 'ondemand' ? '' : '\''.$cck->getStyleParam( 'slick_lazyLoad').'\'';
$slickSettings['mobileFirst'] 			=		$cck->getStyleParam( 'slick_mobileFirst') == 'false' ? '' : $cck->getStyleParam( 'slick_mobileFirst');
$slickSettings['pauseOnFocus'] 			=		$cck->getStyleParam( 'slick_pauseOnFocus') == 'true' ? '' : $cck->getStyleParam( 'slick_pauseOnFocus');
$slickSettings['pauseOnHover'] 			=		$cck->getStyleParam( 'slick_pauseOnHover') == 'true' ? '' : $cck->getStyleParam( 'slick_pauseOnHover');
$slickSettings['pauseOnDotsHover'] 		=		$cck->getStyleParam( 'slick_pauseOnDotsHover') == 'false' ? '' : $cck->getStyleParam( 'slick_pauseOnDotsHover');
$slickSettings['respondTo'] 			=		$cck->getStyleParam( 'slick_respondTo') == 'window' ? '' : '\''.$cck->getStyleParam( 'slick_respondTo').'\'';
$slickSettings['responsive'] 			=		$jsResponsive == '' ? '' : '['.$jsResponsive.']';
$slickSettings['rows'] 					=		$cck->getStyleParam( 'slick_rows') == '1' ? '' : $cck->getStyleParam( 'slick_rows');
$slickSettings['slide'] 				=		$cck->getStyleParam( 'slick_slide') == '' ? '' : $cck->getStyleParam( 'slick_slide');
$slickSettings['slidesPerRow'] 			=		$cck->getStyleParam( 'slick_slidesPerRow') == '1' ? '' : $cck->getStyleParam( 'slick_slidesPerRow');
$slickSettings['slidesToShow'] 			=		$cck->getStyleParam( 'slick_slidesToShow') == '1' ? '' : $cck->getStyleParam( 'slick_slidesToShow');
$slickSettings['slidesToScroll'] 		=		$cck->getStyleParam( 'slick_slidesToScroll') == '1' ? '' : $cck->getStyleParam( 'slick_slidesToScroll');
$slickSettings['speed'] 				=		$cck->getStyleParam( 'slick_speed') == '300' ? '' : $cck->getStyleParam( 'slick_speed');
$slickSettings['swipe'] 				=		$cck->getStyleParam( 'slick_swipe') == 'true' ? '' : $cck->getStyleParam( 'slick_swipe');
$slickSettings['swipeToSlide'] 			=		$cck->getStyleParam( 'slick_swipeToSlide') == 'false' ? '' : $cck->getStyleParam( 'slick_swipeToSlide');
$slickSettings['touchMove'] 			=		$cck->getStyleParam( 'slick_touchMove') == 'true' ? '' : $cck->getStyleParam( 'slick_touchMove');
$slickSettings['touchThreshold'] 		=		$cck->getStyleParam( 'slick_touchThreshold') == '5' ? '' : $cck->getStyleParam( 'slick_touchThreshold');
$slickSettings['useCSS'] 				=		$cck->getStyleParam( 'slick_useCSS') == 'true' ? '' : $cck->getStyleParam( 'slick_useCSS');
$slickSettings['useTransform'] 			=		$cck->getStyleParam( 'slick_useTransform') == 'true' ? '' : $cck->getStyleParam( 'slick_useTransform');
$slickSettings['variableWidth'] 		=		$cck->getStyleParam( 'slick_variableWidth') == 'false' ? '' : $cck->getStyleParam( 'slick_variableWidth');
$slickSettings['vertical'] 				=		$cck->getStyleParam( 'slick_vertical') == 'false' ? '' : $cck->getStyleParam( 'slick_vertical');
$slickSettings['verticalSwiping'] 		=		$cck->getStyleParam( 'slick_verticalSwiping') == 'false' ? '' : $cck->getStyleParam( 'slick_verticalSwiping');
$slickSettings['rtl'] 					=		$cck->getStyleParam( 'slick_rtl') == 'false' ? '' : $cck->getStyleParam( 'slick_rtl');
$slickSettings['waitForAnimate'] 		=		$cck->getStyleParam( 'slick_waitForAnimate') == 'true' ? '' : $cck->getStyleParam( 'slick_waitForAnimate');
$slickSettings['zIndex'] 				=		$cck->getStyleParam( 'slick_zIndex') == '1000' ? '' : $cck->getStyleParam( 'slick_zIndex');
?>

<?php //-- Render

if ( $count )
{
	if ( $id_class && !$isMore )
	{
	// <!--Render-->
	    $html .= '<div class="'.trim( $cck->id_class ).'">';
	}

	// --- Position 'before' external of the list i.e. <ul><li></li></ul><before>
	// Only want to render it once 'outside' of list
	foreach ( $items as $key => $item )
	{
		if (($key + 1) === $count) 
		{
			if ( $cck->countFields( 'before' ) )
			{
				$html .= $item->renderPosition( 'before' );
			}
		}
	}
	// --- Position 'before' END	

	if ( !( $isRaw || $isMore ) )
	{
	    $html .= '<'.$outputElementParent.' class="'.$class.' '.$cssSlickIdentifier.' '.$cssClassesParent.'" '.$custom_attr.' '.$attributesParent.'>';
	}

	// --- Position  'above'
	// Cool for things like masonry where you need a single element preceeding a list i.e. '<div class="grid-sizer"></div>'
	foreach ( $items as $key => $item )
	{
		if ( $cck->countFields( 'above' ) )
		{
			$html .= $item->renderPosition( 'above' );
		}
	}
	// --- Position  'above' END

	if ( $display_mode === 2 )
	{
		// Intermediate (List View + Positions)
		foreach ( $items as $item )
		{
			$row	=	$item->renderPosition( 'element' );
			if ( $row )
			{
				$row 	=	'<'.$outputElementsChild.' class="'.$item->replaceLive( $cssClassesChild ).'" '.$item->replaceLive( $attributesChild ).' '.$item->replaceLive( $attributes ).'>'.$row.'</'.$outputElementsChild.'>';
				
			}
			$html	.=	$row;
		}
	} 
	elseif ( $display_mode === 1 )
	{
		// Advanced (Item View)
		foreach ( $items as $pk=>$item )
		{
			$row	=	$cck->renderItem( $pk );
			if ( $row && !$isRaw )
			{
				$row 	=	'<'.$outputElementsChild.' class="'.$item->replaceLive( $cssClassesChild ).'" '.$item->replaceLive( $attributesChild ).' '.$item->replaceLive( $attributes ).'>'.$row.'</'.$outputElementsChild.'>';
			}
			$html	.=	$row;
		}
	} 
	else 
	{
		
		// Loop through the results
		// (Use this with Slicked List, however, List Views disable the option of position overrides, in which case, use $display_mode = 1 and in item view use some other template)
		foreach ( $items as $item )
		{
	
			$rowElement  = ''; // for position 'element'
			$rowOpen  = ''; // for position 'open'
			$rowClose  = ''; // for position 'close'
			$rowModal  = ''; // for position 'modal'
			$rowHidden  = ''; // for position 'hidden'
	
			// Create Unique Modal Value
			$modalIdentifier = $modalIdentifierName.'-'.$mI;


			// --- Positions 'open'
			// Overrides the opening html element for each list item
			if ( $cck->countFields( 'open' ))
			{
				$outputOpen = $item->renderPosition( 'open' );
				$rowOpen = $outputOpen;
			} 
			else 
			{
				$rowOpen = '<'.$outputElementsChild.' class="'.$item->replaceLive( $cssClassesChild ).'" '.$item->replaceLive( $attributesChild ).' '.$item->replaceLive( $attributes ).'>';
			}
			// --- Positions 'open' END


			// --- Position 'element'
			foreach ( $fieldnamesElement as $fieldnameElement )
			{
				$outputElement    =   $item->renderField( $fieldnameElement );
				if ( $outputElement != '' )
				{
					if (($item->getMarkup( $fieldnameElement ) != 'none') && ($item->getMarkup_Class( $fieldnameElement )))
					{
						$outputElement = '<span class="'.$item->getMarkup_Class( $fieldnameElement ).'">'.$outputElement.'</span>';
					}
					if (($item->getLabel( $fieldnameElement ) != '') && ($item->getLabel( $fieldnameElement ) != 'clear') && ($item->getType( $fieldnameElement ) != 'field_x' ) )
					{
						$outputElement   =  '<label class="label">'.$item->getLabel( $fieldnameElement ).'</label>'.$outputElement;
					}
					if (($item->getLabel( $fieldnameElement ) != '') && ($item->getLabel( $fieldnameElement ) != 'clear') && ($item->getType( $fieldnameElement ) == 'field_x') && ($item->getTypo( $fieldnameElement ) != '') )
					{
						$outputElement   =  '<label class="label">'.$item->getLabel( $fieldnameElement ).'</label>'.$outputElement;
					}
				}
				$rowElement .= $outputElement;
			}

			// --- Position 'element' END

			// --- Position 'hidden'
			if ( $cck->countFields( 'hidden' ) )
			{
				$outputHidden = '<div style="display:none">'.$item->renderPosition( 'hidden' ).'</div>';
				$rowHidden .= $outputHidden;
			}
			// --- Position 'hidden' END


			// --- Positions 'close'
			// Overrides the closing html element for each list item
			if ( $cck->countFields( 'close' ))
			{
				$outputClose = $item->renderPosition( 'close' );
				$rowClose = $outputClose;
			} 
			else 
			{
				$rowClose = '</'.$outputElementsChild.'>';
			}
			// --- Positions 'close' END		

			// Send 'Open', 'Element', 'Hidden', 'Close' to $rowE
			$rowElement = $rowOpen.$rowElement.$rowHidden.$rowClose;
			
			// Update with with Modal Identifier
			$rowElement = str_replace($modalIdentifierName,$modalIdentifier,$rowElement);	

			// 
			$html .= $rowElement;

			// --- Position 'below' outputs best if Slick not in use, due to the way it does stuff
			// i.e. no slick: <ul> <pos above> <li>element</li> <pos below> </ul>
			// i.e. with slick: <ul> <pos above> <pos below> <li>element</li> </ul>
			if ( $cck->countFields( 'below' ) )
			{
				$html .= $item->renderPosition( 'below' );
			}
			// --- Position 'below' END		

			// --- Position 'modal'
			if ( $cck->countFields( 'modal' ) && (0 !== $modalFramework))
			{
				// select the modal version ie Bootstrap 3 or Foundation 6
				switch ($modalFramework)
				{
					case 'tb':
						// Twitter Bootstrap 2|3|4
						if (2 === $modalVersion)
						{
							$rowModal .= '<div id="'.$modalIdentifier.'" class="modal hide fade '.$modalIdentifier.' '.$modalClassesParent.'" tabindex="-1" role="dialog" '. $modalAriaLabelledBy.' '.$modalAriaHidden.'>';
							$rowModal .= '<div class="modal-dialog" role="document">';
						} elseif ((3 === $modalVersion) || (4 === $modalVersion))
						{
							$rowModal .= '<div id="'.$modalIdentifier.'" class="modal fade '.$modalIdentifier.' '.$modalClassesParent.'" tabindex="-1" role="dialog" '.$modalAriaLabelledBy.' '.$modalAriaHidden.'>';
							$rowModal .= '<div class="modal-dialog" role="document">';
						}
						break;
			
					case 'zf':
						// Zurb Foundation 4|5
						if (4 === $modalVersion)
						{
							$rowModal .= '<div id="'.$modalIdentifier.'" class="reveal-modal '.$modalIdentifier.' '.$modalClassesParent.'" data-reveal '.$modalAriaLabelledBy.$modalAriaHidden.'role="dialog">';
						} elseif ( 5 === $modalVersion )
						{
							$rowModal .= '<div id="'.$modalIdentifier.'" class="reveal '.$modalIdentifier.' '.$modalClassesParent.'" data-reveal '.$modalAriaLabelledBy.$modalAriaHidden.'role="dialog">';
						}
						break;
			
					case 'yu':
						// YooTheme UiKit 2|3
						if (2 === $modalVersion)
						{
							$rowModal .= '<div id="'.$modalIdentifier.'" class="uk-modal '.$modalIdentifier.' '.$modalClassesParent.'" '.$modalAriaLabelledBy.$modalAriaHidden.'role="dialog">';
							$rowModal .= '<div class="uk-modal-dialog">';
						} elseif (3 === $modalVersion)
						{
							$rowModal .= '<div id="'.$modalIdentifier.'" uk-modal class=" '.$modalIdentifier.' '.$modalClassesParent.'" '.$modalAriaLabelledBy.$modalAriaHidden.'role="dialog">';
							// Addition to place .uk-modal-body better. In the future, this will not be an option. It will need to be added manually if wanted.
							switch ($modalUkModalBody)
							{
			
								case 0:
									$rowModal .= '<div class="uk-modal-dialog uk-modal-body">';
									break;
			
								case 1:
									$rowModal .= '<div class="uk-modal-dialog"><div class="uk-modal-body">';
									break;
			
								case 2:
									$rowModal .= '<div class="uk-modal-dialog">';
									break;
			
								default:
									$rowModal .= '<div class="uk-modal-dialog uk-modal-body">';
									break;
							}
						}
						break;
			
					case 'x':
						// Skeleton Modal
						break;
			
					default:
						// Twitter Bootstrap 2
						$rowModal .= '<div id="'.$modalIdentifier.'" class="modal hide fade '.$modalIdentifier.'" tabindex="-1" role="dialog" '. $modalAriaLabelledBy.' '.$modalAriaHidden.'>';
						$rowModal .= '<div class="modal-dialog" role="document">';
			
						break;
				}
			
				// Labels
				foreach ( $fieldnamesModal as $fieldnameModal )
				{
					$outputModal = $item->renderField( $fieldnameModal );
					if ( $outputModal != '' )
					{
						if ( $item->getMarkup( $fieldnameModal ) != 'none' && ( $item->getMarkup_Class( $fieldnameModal ) ) )
						{
							$outputModal = '<span class="'.$item->getMarkup_Class( $fieldnameModal ).'">'.$outputModal.'</span>';
						}
						if (($item->getLabel( $fieldnameModal ) != '') && ($item->getLabel( $fieldnameModal ) != 'clear') && ($item->getType( $fieldnameModal ) != 'field_x' ) )
						{
							$outputModal   =  '<label class="label">'.$item->getLabel( $fieldnameModal ).'</label>'.$outputModal;
						}
						if (($item->getLabel( $fieldnameModal ) != '') && ($item->getLabel( $fieldnameModal ) != 'clear') && ($item->getType( $fieldnameModal ) == 'field_x') && ($item->getTypo( $fieldnameModal ) != '') )
						{
							$outputModal   =  '<label class="label">'.$item->getLabel( $fieldnameModal ).'</label>'.$outputModal;
						}
					}
			
					$rowModal .= $outputModal;
				}
			
			
				// Closing the Modal
				switch ($modalFramework)
				{
					case 'tb':
						// Twitter Bootstrap 2|3|4
						$rowModal .= '</div></div>';
						break;
			
					case 'zf':
						// Zurb Foundation 4|5
						$rowModal .= '</div>';
						break;
			
					case 'yu':
						// YooTheme UiKit 2|3
						$rowModal .= '</div></div>';
						// if .uk-modal-dialog .uk-modal-body
						if(1 === $modalUkModalBody)
						{
							$rowModal .= '</div>';
						}
						break;
			
					case 'x':
						// Skeleton Modal
						// Update Blank Modal with ModalIdentifier, other modals already have it applied in code above
						$rowModal = str_replace($modalIdentifierName,$modalIdentifier,$rowModal);
						break;
			
					default:
						// Twitter Bootstrap 2
						$rowModal .= '</div></div>';
						break;
				}
			
				// Send to $htmlModal
				$htmlModal .= $rowModal;

				// Increase Modal Index
				$mI++;

			}
			// --- Position 'modal' END

		}



		
	}
	

	if ( !( $isRaw || $isMore ) )
	{
		$html .= '</'.$outputElementParent.'>';
	}

	// --- Position 'after' external of the list i.e. <ul><li></li></ul><after>
	// Only want to render it once 'outside' of list
	foreach ( $items as $key => $item )
	{
		if (($key + 1) === $count) 
		{
			if ( $cck->countFields( 'after' ) )
			{
				$html .= $item->renderPosition( 'after' );
			}
		}
	}
	// --- Position 'after' END	

	// --- Position 'Modal' external of list i.e. <ul><li></li></ul><modal>
	 $html .= $htmlModal;
	
    if ( $id_class && !$isMore )
    {
        $html .= '</div>';
    }

	echo $html;
} // -- Render END
?>





<?php
// Load Slick JS and CSS?
if (1 === $jsFileLoad)
{
    $cck->addScript($jsFileLoadLocation);
}

if (1 === $jsApply)
{
    foreach($slickSettings as $settings => $setting)
    {
        if (!'' == $setting)
        {
            $jsApplySettings .= $settings.': '.$setting.','."\n";
        }
    }
    $jsOutput = $jsApplyStart.$jsApplySettings.$jsApplyEnd.$jsCustom;
    $cck->addScriptDeclaration($jsOutput);
}

if (1 === $cssFileLoad)
{
    $cck->addStyleSheet($cssFileLoadLocation);
}
if (1 === $cssThemeFileLoad)
{
    $cck->addStyleSheet($cssThemeFileLoadLocation);
}
?>


<?php
// -- Finalize
$cck->finalize();
?>
