<?php
// No Direct Access
defined( '_JEXEC' ) or die;

?>

<h2>Type de public</h2>

<?php echo $cck->renderField('art_title'); ?>

<section class="institution-edit actions d-flex flex-column" style="border: none;">
  <div class="form-group d-flex justify-content-end">
    <?php echo $cck->renderField('button_cancel') ; ?>
    <?php echo $cck->renderField('button_save') ; ?>
  </div>
</section>