<?php
/**
* @package   yoo_joy
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

/*
 * Navbar settings
 */
$navbar_dropdown = '';
$navbar_sticky   = array();
$navbar_style    = '';

if ($this['config']->get('dropdown_overlay', 0)) {
   $navbar_dropdown = ' data-uk-dropdown-overlay="{cls: \'tm-dropdown-overlay\'}"';
}

if ($this['config']->get('absolute_navigation', 0)) {
    $navbar_style .= ' tm-navbar-absolute';
}

if ($this['config']->get('contrast_navigation', 0)) {
    $navbar_style .= ' uk-contrast';
}

if ($this['config']->get('fixed_navigation', 0)) {
    $navbar_sticky[] = "media: 768";
    $navbar_sticky[] = "animation: 'uk-animation-slide-top'";
    $navbar_sticky[] = ($this['widgets']->count('top-hero')) ? "top: '.tm-top-hero'" : "top: -500";
    $navbar_sticky[] = ($navbar_style) ? "clsinactive: '".$navbar_style."'" : '';
    $navbar_sticky   = sprintf('data-uk-sticky="{%s}"', implode(', ', $navbar_sticky));
}
?>

<?php if ($this['widgets']->count('toolbar-l + toolbar-r')) : ?>
<div class="tm-toolbar uk-hidden-small">

    <div class="uk-clearfix <?php echo $this['config']->get('page_appearance'); ?>">

        <?php if ($this['widgets']->count('toolbar-l')) : ?>
        <div class="uk-float-left"><?php echo $this['widgets']->render('toolbar-l'); ?></div>
        <?php endif; ?>

        <?php if ($this['widgets']->count('toolbar-r')) : ?>
        <div class="uk-float-right"><?php echo $this['widgets']->render('toolbar-r'); ?></div>
        <?php endif; ?>
    </div>

</div>
<?php endif; ?>

<div class="tm-navbar <?php echo $navbar_style; ?>" <?php echo $navbar_sticky; echo $navbar_dropdown ?>>

    <div class="uk-navbar uk-position-relative uk-hidden-small uk-flex <?php echo $this['config']->get('page_appearance'); ?>">

        <?php if ($this['widgets']->count('logo')) : ?>
        <a class="tm-logo uk-navbar-brand tm-navbar-left" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
        <?php endif; ?>

        <?php if ($this['widgets']->count('menu')) : ?>
        <nav class="uk-flex uk-flex-middle uk-flex-item-1 <?php echo $this['config']->get('navigation_style', 'uk-flex-center'); ?>">
            <?php echo $this['widgets']->render('menu'); ?>
        </nav>
        <?php endif; ?>

        <?php if ($this['widgets']->count('headerbar + search')) : ?>
        <div class="tm-navbar-content uk-flex uk-flex-middle">

            <?php if ($this['widgets']->count('headerbar')) : ?>
                <?php echo $this['widgets']->render('headerbar'); ?>
            <?php endif; ?>

            <?php if ($this['widgets']->count('search')) : ?>
            <div>
                <?php echo $this['widgets']->render('search'); ?>
            </div>
            <?php endif; ?>

            <?php if ($this['widgets']->count('offcanvas-right')) : ?>
                <a href="#offcanvas-right" class="uk-navbar-toggle uk-navbar-flip uk-margin-left" data-uk-offcanvas></a>
            <?php endif; ?>

        </div>
        <?php endif; ?>

    </div>

    <div class="uk-navbar uk-visible-small">

        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <?php if ($this['widgets']->count('logo-small')) : ?>
            <a class="tm-logo-small" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a>
            <?php endif; ?>

            <?php if ($this['widgets']->count('offcanvas')) : ?>
                <a href="#offcanvas" class="uk-navbar-toggle" data-uk-offcanvas></a>
            <?php endif; ?>

        </div>

    </div>

</div>
