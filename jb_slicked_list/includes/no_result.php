<?php
/**
* @version 			SEBLOD 3.x More ~ $Id: index.php jonbuckner $
* @package			SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url				http://www.seblod.com
* @editor			Octopoos - www.octopoos.com
* @copyright		Copyright (C) 2013 SEBLOD. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/  

defined( '_JEXEC' ) or die;

// "No Result" Page.
echo '<div class="no-result">'.$no_message.'</div>';	// echo JText::_( 'COM_CCK_NO_RESULT' );

require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../index.php';

?>
