<?php
// No Direct Access
defined( '_JEXEC' ) or die;

?>

<div class="d-flex">
  <h2 class="mr-4">Champs thématiques</h2><?php echo$cck->renderField('md_tag_thematiques_add'); ?>
</div>

<div class="d-flex flex-column">
  <div class="d-flex justify-content-between">
    <?php echo$cck->renderField('art_title'); ?>
    <?php echo$cck->renderField('art_state'); ?>
  </div>

  <div class="form-group">
    <?php echo$cck->renderField('button_search'); ?>
  </div>
</div>