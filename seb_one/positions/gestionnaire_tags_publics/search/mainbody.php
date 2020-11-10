<?php
// No Direct Access
defined( '_JEXEC' ) or die;

?>

<div class="d-flex mb-3 align-items-center">
  <h2 class="mb-0 mr-4">Types de public</h2><?php echo$cck->renderField('md_tag_publics_add'); ?>
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
