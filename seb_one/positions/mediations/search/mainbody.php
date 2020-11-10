<?php
// No Direct Access
defined( '_JEXEC' ) or die;

?>

<div class="d-flex mb-3 align-items-center">
  <h2 class="mb-0 mr-4">Médiations</h2><?php echo$cck->renderField('md_mediation_add'); ?>
</div>

<div class="d-flex flex-column">
  <div class="d-flex justify-content-between">
    <div>
      <?php echo$cck->renderField('art_title'); ?>
      <?php echo$cck->renderField('md_mediation_contributeur_filtre'); ?>
    </div>
    <?php echo$cck->renderField('art_state'); ?>
  </div>

  <div class="form-group">
    <?php echo$cck->renderField('button_search_gestionnaire_mediations'); ?>
  </div>
</div>
