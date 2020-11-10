<?php


/**
* @package   yoo_joy
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// get theme configuration
include($this['path']->path('layouts:theme.config.php'));

?>
<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>"  data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>

<head>
<?php echo $this['template']->render('head'); ?>


</head>

<body class="<?php echo $this['config']->get('body_classes'); if ($this['widgets']->count('bottom-hero')) echo ' tm-footer-fixed'; ?>">

    <div id="tm-page" class="tm-page uk-position-relative">

        <?php if ($this['widgets']->count('logo + logo-small + headerbar + search + menu + offcanvas + offcanvas-right, toolbar-l + toolbar-r')) : ?>
            <?php echo $this['template']->render('theme.header'); ?>
        <?php endif; ?>

        <?php if ($this['widgets']->count('top-hero')) : ?>
        <div id="tm-top-hero" class="tm-hero-container uk-position-relative <?php echo $block_classes['top-hero']; ?>" <?php echo implode(' ', array($styles['block.top-hero'], $block_attributes['top-hero'])); ?>>
            <section class="<?php echo $grid_classes['top-hero']; echo $display_classes['top-hero']; ?> uk-flex uk-flex-middle" data-uk-grid-margin><?php echo $this['widgets']->render('top-hero', array('layout'=>$this['config']->get('grid.top-hero.layout'))); ?></section>
        </div>
        <?php endif; ?>

        <div class="tm-page-container uk-position-relative <?php echo $this['config']->get('page_appearance'); ?>">

            <?php if ($this['widgets']->count('top-a')) : ?>
            <div id="tm-top-a" class="<?php echo $block_classes['top-a']; ?>" <?php echo $styles['block.top-a']; ?>>
                <div <?php if ($container_class['top-a']) echo 'class="'.$container_class['top-a'].'"'; ?>>
                    <section class="<?php echo $grid_classes['top-a']; echo $display_classes['top-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-a', array('layout'=>$this['config']->get('grid.top-a.layout'))); ?></section>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($this['widgets']->count('top-b')) : ?>
            <div id="tm-top-b" class="<?php echo $block_classes['top-b']; ?>" <?php echo $styles['block.top-b']; ?>>
                <div <?php if ($container_class['top-b']) echo 'class="'.$container_class['top-b'].'"'; ?>>
                    <section class="<?php echo $grid_classes['top-b']; echo $display_classes['top-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-b', array('layout'=>$this['config']->get('grid.top-b.layout'))); ?></section>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($this['widgets']->count('top-c')) : ?>
            <div id="tm-top-c" class="<?php echo $block_classes['top-c']; ?>" <?php echo $styles['block.top-c']; ?>>
                <div <?php if ($container_class['top-c']) echo 'class="'.$container_class['top-c'].'"'; ?>>
                    <section class="<?php echo $grid_classes['top-c']; echo $display_classes['top-c']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-c', array('layout'=>$this['config']->get('grid.top-c.layout'))); ?></section>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($this['widgets']->count('top-d')) : ?>
            <div id="tm-top-d" class="<?php echo $block_classes['top-d']; ?>" <?php echo $styles['block.top-d']; ?>>
                <div <?php if ($container_class['top-d']) echo 'class="'.$container_class['top-d'].'"'; ?>>
                    <section class="<?php echo $grid_classes['top-d']; echo $display_classes['top-d']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-d', array('layout'=>$this['config']->get('grid.top-d.layout'))); ?></section>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($this['widgets']->count('main-top + main-bottom + sidebar-a + sidebar-b') || $this['config']->get('system_output', true)) : ?>
            <div id="tm-main" class="<?php echo $block_classes['main']; ?>" <?php echo $styles['block.main']; ?>>

                <div <?php if ($container_class['main']) echo 'class="'.$container_class['main'].'"'; ?>>

                    <?php if ($this['widgets']->count('breadcrumbs')) : ?>
                        <?php echo $this['widgets']->render('breadcrumbs'); ?>
                    <?php endif; ?>

                    <div class="uk-grid" data-uk-grid-match data-uk-grid-margin>

                        <?php if ($this['widgets']->count('main-top + main-bottom') || $this['config']->get('system_output', true)) : ?>
                        <div class="<?php echo $columns['main']['class'] ?>">

                            <?php if ($this['widgets']->count('main-top')) : ?>
                            <section id="tm-main-top" class="<?php echo $grid_classes['main-top']; echo $display_classes['main-top']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-top', array('layout'=>$this['config']->get('grid.main-top.layout'))); ?></section>
                            <?php endif; ?>

                            <?php if ($this['config']->get('system_output', true)) : ?>

                            <main id="tm-content" class="tm-content">

                                <?php echo $this['template']->render('content'); ?>

                            </main>
                            <?php endif; ?>

                            <?php if ($this['widgets']->count('main-bottom')) : ?>
                            <section id="tm-main-bottom" class="<?php echo $grid_classes['main-bottom']; echo $display_classes['main-bottom']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-bottom', array('layout'=>$this['config']->get('grid.main-bottom.layout'))); ?></section>
                            <?php endif; ?>

                        </div>
                        <?php endif; ?>

                        <?php foreach($columns as $name => &$column) : ?>
                        <?php if ($name != 'main' && $this['widgets']->count($name)) : ?>
                        <aside class="<?php echo $column['class'] ?>"><?php echo $this['widgets']->render($name) ?></aside>
                        <?php endif ?>
                        <?php endforeach ?>

                    </div>

                </div>

            </div>
            <?php endif; ?>

            <?php if ($this['widgets']->count('bottom-a')) : ?>
            <div id="tm-bottom-a" class="<?php echo $block_classes['bottom-a']; ?>" <?php echo $styles['block.bottom-a']; ?>>
                <div <?php if ($container_class['bottom-a']) echo 'class="'.$container_class['bottom-a'].'"'; ?>>
                    <section class="<?php echo $grid_classes['bottom-a']; echo $display_classes['bottom-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-a', array('layout'=>$this['config']->get('grid.bottom-a.layout'))); ?></section>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($this['widgets']->count('bottom-b')) : ?>
            <div id="tm-bottom-b" class="<?php echo $block_classes['bottom-b']; ?>" <?php echo $styles['block.bottom-b']; ?>>
                <div <?php if ($container_class['bottom-b']) echo 'class="'.$container_class['bottom-b'].'"'; ?>>
                    <section class="<?php echo $grid_classes['bottom-b']; echo $display_classes['bottom-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-b', array('layout'=>$this['config']->get('grid.bottom-b.layout'))); ?></section>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($this['widgets']->count('bottom-c')) : ?>
            <div id="tm-bottom-c" class="<?php echo $block_classes['bottom-c']; ?>" <?php echo $styles['block.bottom-c']; ?>>
                <div <?php if ($container_class['bottom-c']) echo 'class="'.$container_class['bottom-c'].'"'; ?>>
                    <section class="<?php echo $grid_classes['bottom-c']; echo $display_classes['bottom-c']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-c', array('layout'=>$this['config']->get('grid.bottom-c.layout'))); ?></section>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($this['widgets']->count('bottom-d')) : ?>
            <div id="tm-bottom-d" class="<?php echo $block_classes['bottom-d']; ?>" <?php echo $styles['block.bottom-d']; ?>>
                <div <?php if ($container_class['bottom-d']) echo 'class="'.$container_class['bottom-d'].'"'; ?>>
                    <section class="<?php echo $grid_classes['bottom-d']; echo $display_classes['bottom-d']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-d', array('layout'=>$this['config']->get('grid.bottom-d.layout'))); ?></section>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($this['widgets']->count('footer + debug') || $this['config']->get('warp_branding', true) || $this['config']->get('totop_scroller', true)) : ?>
            <footer id="tm-footer" class="tm-footer <?php echo $block_classes['footer']; ?>">
                <div <?php if ($container_class['footer']) echo 'class="'.$container_class['footer'].'"'; ?>>
                    <?php
                        echo $this['widgets']->render('footer');
                        $this->output('warp_branding');
                        echo $this['widgets']->render('debug');
                    ?>
                    <?php if ($this['config']->get('totop_scroller', true)) : ?>
                    <a class="tm-totop-scroller" data-uk-smooth-scroll href="#"></a>
                    <?php endif; ?>
                </div>
            </footer>
            <?php endif; ?>

        </div>

        <?php if ($this['widgets']->count('smoothscroll')) : ?>
            <div class="tm-smoothscroll-bar uk-flex uk-flex-middle uk-visible-large">
                <?php echo $this['widgets']->render('smoothscroll'); ?>
            </div>
        <?php endif; ?>

    </div>

    <?php echo $this->render('footer'); ?>

    <?php if ($this['widgets']->count('offcanvas')) : ?>
        <div id="offcanvas" class="uk-offcanvas">
            <div class="uk-offcanvas-bar uk-offcanvas-bar-flip"><?php echo $this['widgets']->render('offcanvas'); ?></div>
        </div>
    <?php endif; ?>

    <?php if ($this['widgets']->count('offcanvas-right')) : ?>
    <div id="offcanvas-right" class="uk-offcanvas">
        <div class="uk-offcanvas-bar uk-offcanvas-bar-flip"><?php echo $this['widgets']->render('offcanvas-right'); ?></div>
    </div>
    <?php endif; ?>

    <?php if ($this['widgets']->count('bottom-hero')) : ?>
    <div id="tm-bottom-hero" class="tm-bottom-hero-container <?php echo $block_classes['bottom-hero']; ?>" <?php echo implode(' ', array($styles['block.bottom-hero'], $block_attributes['bottom-hero']));?>>
        <section class="<?php echo $grid_classes['bottom-hero']; echo $display_classes['bottom-hero']; ?> uk-flex uk-flex-middle" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-hero', array('layout'=>$this['config']->get('grid.bottom-hero.layout'))); ?></section>
    </div>
    <?php endif; ?>

</body>








</html>
