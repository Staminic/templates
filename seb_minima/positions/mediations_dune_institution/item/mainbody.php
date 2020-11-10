<?php
// No Direct Access
defined( '_JEXEC' ) or die;

$accroche  = strip_tags($cck->getValue('md_mediation_accroche'));

if (strlen($accroche) > 200) {
  $accroche = substr($accroche, 0, 150);
  $accroche = $accroche . "...";
}

?>

<a class="card-img-top" href="<?php echo $cck->getLink('md_mediation_readmore'); ?>">
  <picture>
    <source media="(max-width: 575.98px)" srcset="<?php echo $cck->getThumb2('md_mediation_vignette'); ?>, <?php echo $cck->getThumb3('md_mediation_vignette'); ?> 2x">
    <source media="(min-width: 576px)" srcset="<?php echo $cck->getThumb4('md_mediation_vignette'); ?>, <?php echo $cck->getThumb2('md_mediation_vignette'); ?> 2x">
    <img src="<?php echo $cck->getThumb3('md_mediation_vignette'); ?>" alt="<?php echo 'Vignette de la médiation ' . ucfirst($cck->getValue('art_title')); ?>">
  </picture>
</a>

<div class="card-body">
  <h2 class="card-title"><a href="<?php echo $cck->getLink('md_mediation_readmore'); ?>"><?php echo $cck->getValue('art_title'); ?></a></h2>

  <div class="card-text">
    <?php if ($cck->getValue('md_mediation_annee_lancement')) : ?>
      <p class="meta">
        <?php echo $cck->getLabel('md_mediation_annee_lancement') . '&nbsp;: ' . $cck->getValue('md_mediation_annee_lancement'); ?>
      </p>
    <?php endif; ?>

    <p><?php echo $accroche; ?></p>

    <div class="meta">
      <?php
        if ($cck->getValue('md_mediation_thematiques')) {
          echo str_replace(',', ' ', $cck->renderField('md_mediation_thematiques'));
        }
      ?>

      <?php
        if ($cck->getValue('md_mediation_types')) {
          echo str_replace(',', ' ', $cck->renderField('md_mediation_types'));
        }
      ?>

      <?php
        if ($cck->getValue('md_mediation_publics')) {
          echo str_replace(',', ' ', $cck->renderField('md_mediation_publics'));
        }
      ?>
    </div>

  </div>
</div>

<div class="card-footer">
  <a class="btn btn-black btn-sm" href="<?php echo $cck->getLink('md_mediation_readmore'); ?>"><?php echo strip_tags($cck->getValue('md_mediation_readmore')); ?></a>
</div>
