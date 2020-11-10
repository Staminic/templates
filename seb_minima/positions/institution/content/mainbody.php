<?php
// No Direct Access
defined( '_JEXEC' ) or die;

?>

<div class="inner">
  <h1>
    <?php echo $cck->getValue('md_institution_nom'); ?>
  </h1>

  <address>
    <?php echo $cck->getValue('md_institution_rue') . ' ' . $cck->getValue('md_institution_cp') . ' ' . $cck->getValue('md_institution_ville') . ' ' . $cck->getText('md_institution_pays'); ?>
  </address>

  <?php if($cck->getValue('md_institution_url')) : ?>
    <div class="content-link mb-4">
      <?php echo $cck->renderField('md_institution_url'); ?>
    </div>
  <?php endif; ?>

  <section class="content-map">
    <div class="embed-responsive embed-responsive-21by9">
      <?php echo $cck->renderField('md_institution_carte'); ?>
    </div>
  </section>

  <section class="content-related">
    <div class="section-title section-title-btn arrow">
      <h2 class="h4">Dernières contributions</h2>
      <!--<a class="btn btn-primary btn-sm"
          href="les-mediations?md_mediation_search_generic=&md_mediation_institution=<?php echo $cck->getValue('art_id'); ?>&md_mediation_annee_lancement=&md_mediation_order=art_created%3Adesc&search=liste_des_mediations&task=search">
      Toutes ses médiations</a>-->
    </div>

    <div class="full-width bg-sand">
      <div class="container inner">
        <?php echo $cck->renderField('md_institution_mediations'); ?>
      </div>
    </div>
  </section>
</div>
