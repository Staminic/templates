<?php
/**
* @package   yoo_joy
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

return array(

    'name' => 'widget/slideshow-joy',

    'main' => 'YOOtheme\\Widgetkit\\Widget\\Widget',

    'config' => array(

        'name'  => 'slideshow-joy',
        'label' => 'Slideshow Joy',
        'core'  => false,
        'icon'  => 'plugins/widgets/slideshow-joy/widget.svg',
        'view'  => 'plugins/widgets/slideshow-joy/views/widget.php',
        'item'  => array('title', 'content', 'media'),
        'settings' => array(
            'slidenav'           => 'bottom-right',
            'nav_contrast'       => true,
            'animation'          => 'fade',
            'slices'             => '15',
            'duration'           => '500',
            'autoplay'           => false,
            'interval'           => '3000',
            'autoplay_pause'     => true,
            'kenburns'           => false,
            'kenburns_animation' => '',
            'kenburns_duration'  => '15',
            'fullscreen'         => false,
            'min_height'         => '300',

            'media'              => true,
            'image_width'        => 'auto',
            'image_height'       => 'auto',
            'overlay'            => 'none',
            'overlay_animation'  => 'fade',
            'overlay_background' => true,

            'title'              => true,
            'content'            => true,
            'title_size'         => 'h3',
            'content_size'       => '',
            'link'               => true,
            'link_style'         => 'button',
            'link_text'          => 'Read more',
            'badge'              => true,
            'badge_style'        => 'badge',

            'link_target'        => false,
            'class'              => ''
        )

    ),

    'events' => array(

        'init.site' => function($event, $app) {

        },

        'init.admin' => function($event, $app) {
            $app['angular']->addTemplate('slideshow-joy.edit', 'plugins/widgets/slideshow-joy/views/edit.php', true);
        }

    )

);
