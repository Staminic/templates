<?php
// No Direct Access
defined( '_JEXEC' ) or die;

$app = JFactory::getApplication();
$active = $app->getMenu()->getActive();
?>

<div class="inner">
  <pre><?php echo $active->alias; ?></pre>

  <?php echo $cck->renderField('md_contributeur_form_title') ; ?>
  <?php echo $cck->renderField('md_contributeur_form_title2') ; ?>

  <div class="card mb-4">
    <div class="card-body">
      <?php echo $cck->renderField('md_contributeur_form_subtitle') ; ?>
      <?php echo $cck->renderField('md_contributeur_form_subtitle2') ; ?>
      <?php echo $cck->renderField('user_username') ; ?>
      <?php echo $cck->renderField('user_email') ; ?>

      <?php if($active->alias != 'creer-un-compte-contribueur') : ?>
        <?php echo $cck->renderField('user_password'); ?>
        <?php echo $cck->renderField('user_password2'); ?>
      <?php endif; ?>
      <?php echo $cck->renderField('user_grp_password'); ?>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-body">
      <?php echo $cck->renderField('md_contributeur_form_subtitle3') ; ?>
      <?php echo $cck->renderField('md_contributeur_form_subtitle4') ; ?>
      <p class="small help">Votre nom, votre prénom et le nom de votre structure sont utilisés pour désigner l'auteur de l'article publié sur la Plateforme. L'auteur est affiché sous le titre de la médiation.</p>
      <?php echo $cck->renderField('user_last_name') ; ?>
      <?php echo $cck->renderField('user_first_name') ; ?>
      <?php echo $cck->renderField('user_company') ; ?>
      <?php echo $cck->renderField('user_address1') ; ?>
      <?php echo $cck->renderField('user_phone') ; ?>
    </div>
  </div>

  <?php echo $cck->renderField('md_recaptcha') ; ?>

  <div class="user-activation d-flex justify-content-end">
    <?php echo $cck->renderField('user_block') ; ?>
  </div>

  <section class="institution-edit actions d-flex flex-column" style="border: none;">
    <div class="form-group d-flex justify-content-end">
      <?php echo $cck->renderField('button_cancel') ; ?>
      <?php echo $cck->renderField('button_save') ; ?>
    </div>
  </section>
</div>
