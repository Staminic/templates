<?php
// No Direct Access
defined( '_JEXEC' ) or die;

?>

<div class="inner">
  <h2>Structure - Édition</h2>

  <?php echo $cck->renderField('md_institution_nom'); ?>
  <?php echo $cck->renderField('md_institution_url'); ?>

  <section class="institution-edit map">
    <div class="row">
      <div class="col-md-6">
        <?php echo $cck->renderField('md_institution_rue'); ?>
        <?php echo $cck->renderField('md_institution_cp'); ?>
        <?php echo $cck->renderField('md_institution_ville'); ?>
        <?php echo $cck->renderField('md_institution_pays'); ?>
        <?php echo $cck->renderField('md_institution_lat_long_texte'); ?>
        <?php echo $cck->renderField('md_institution_latitude'); ?>
        <?php echo $cck->renderField('md_institution_longitude'); ?>
      </div>

      <div class="col-md-6">
        <div class="embed-responsive embed-responsive-1by1">
          <?php echo $cck->renderField('md_institution_carte'); ?>
        </div>
      </div>
    </div>
  </section>

  <section class="institution-edit actions d-flex flex-column" style="border: none;">
    <div class="form-group d-flex justify-content-end">
      <?php echo $cck->renderField('button_cancel') ; ?>
      <?php echo $cck->renderField('button_save') ; ?>
    </div>

    <small class="text-right text-muted">
      <p>Besoin d’aide pour la création d'une structure ? <a href="#0" target="_blank">Contactez-nous</a></p>
    </small>
  </section>

  <?php echo $cck->renderField('md_institution_coord2address') ; ?>
</div>
