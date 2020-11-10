<?php
/**
* @version			SEBLOD 3.x Core
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				https://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved.
* @license			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

// The markup around each field (label+value/form) can be Overridden.
// Remove the underscore [_] from the Filename. (filename = markup.php)
// Edit the function name:
//	- fields/markup.php 			=>	cckMarkup_[template]
//	- fields/[contenttype]/markup.php	=>	cckMarkup_[template]_[contenttype]
//	- fields/[searchtype]/markup.php	=>	cckMarkup_[template]_[searchtype]
// Write your Custom Markup code. (see default markup below)

// cckMarkup
function cckMarkup_seb_minima( $cck, $html, $field, $options )
{
	// Computation
	if ( isset( $field->computation ) && $field->computation ) {
		$cck->setComputationRules( $field );
	}
	// Conditional
	if ( isset( $field->conditional ) && $field->conditional ) {
		$cck->setConditionalStates( $field );
	}

	$desc	=	'';
	if ( $cck->getStyleParam( 'field_description', 0 ) ) {
		$desc	=	( $field->description != '' ) ? '<small class="form-text text-muted">' . $field->description . '</small>' : '';
	}

	$label	=	'';
	if ( $options->get( 'field_label', $cck->getStyleParam( 'field_label', 1 ) ) ) {
		$label	=	$cck->getLabel( $field->name, true, ( $field->required ? '*' : '' ) );

		if ( $field->markup_class == ' thumbnail' ) {
			$label = '<div class="custom-file-label">' . $label . '</div>';
		}

		$label	=	( $label != '' ) ? $label : '';
	}

	if ( $field->markup_class == ' thumbnail' ) {
		$html	=	'<label>Vignette</label><div id="'.$cck->id.'_'.$cck->mode_property.'_'.$field->name.'" class="custom-file">' . $html . $label . $desc . '</div>';
	} elseif ( $field->markup_class == ' field' ) {
		$html	=	'<label>Document(s) téléchargeable(s)</label><div id="'.$cck->id.'_'.$cck->mode_property.'_'.$field->name.'" class="custom-file">' . $html . $label . $desc . '</div>';
	} else {
		$html	=	'<div id="'.$cck->id.'_'.$cck->mode_property.'_'.$field->name.'" class="form-group">' . $label . $html . $desc . '</div>';
	}

	return $html;
}
?>
