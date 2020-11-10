<?php
// No Direct Access
defined( '_JEXEC' ) or die;

?>

<div class="inner">
  <div class="row">
    <div class="col-sm-6 col-lg-7">
      <h1 class="h2">Contacter la plateforme des médiations muséales</h1>
      <?php echo $cck->renderField('md_contact_form_nom'); ?>
      <?php echo $cck->renderField('md_contact_form_prenom'); ?>
      <?php echo $cck->renderField('md_contact_form_email'); ?>
      <?php echo $cck->renderField('md_contact_form_institution'); ?>
      <?php echo $cck->renderField('md_contact_form_message'); ?>
      <?php echo $cck->renderField('md_recaptcha'); ?>

      <section class="institution-edit actions d-flex flex-column" style="border: none;">
        <div class="form-group d-flex justify-content-end">
          <?php echo $cck->renderField('button_cancel') ; ?>
          <?php echo $cck->renderField('md_contact_form_save') ; ?>
        </div>
      </section>
    </div>

    <div class="col-sm-6 col-lg-4">
      <div class="card bg-primary text-white">
        <div class="card-body">
          <h3>Plateforme des médiations muséales</h3>
          <address>
            <span>L’Art de Muser</span><br />
            <span>Université d’Artois</span><br />
            <span>9 rue du Temple</span>
            <span>62000 ARRAS</span>
          </addresse>
        </div>
      </div>
    </div>
  </div>
</div>
