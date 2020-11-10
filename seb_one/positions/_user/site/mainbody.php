<?php
// No Direct Access
defined( '_JEXEC' ) or die;

?>

<div class="inner">
  <h2>Profil</h2>
  <div class="card mb-4">
    <div class="card-body">
      <?php echo $cck->renderField('user_username') ; ?>
      <?php echo $cck->renderField('user_email') ; ?>
      <?php echo $cck->renderField('user_password') ; ?>
      <?php echo $cck->renderField('user_password2') ; ?>
      <?php echo $cck->renderField('user_grp_password') ; ?>
    </div>
  </div>

  <section class="institution-edit actions d-flex flex-column" style="border: none;">
    <div class="form-group d-flex justify-content-end">
      <?php echo $cck->renderField('button_cancel') ; ?>
      <?php echo $cck->renderField('button_save_close') ; ?>
    </div>
  </section>
</div>
