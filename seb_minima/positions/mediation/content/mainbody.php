<?php
// No Direct Access
defined( '_JEXEC' ) or die;

$complexite = $cck->getValue('md_mediation_eval_complexite');
$duree = $cck->getValue('md_mediation_eval_duree');
$preparation = $cck->getValue('md_mediation_eval_temps');
$competence = $cck->getValue('md_mediation_eval_competences');
$presence = $cck->getValue('md_mediation_eval_presence');
$budget = $cck->getValue('md_mediation_eval_budget');
$horsdans = $cck->getValue('md_mediation_eval_horsdans');
$public = $cck->getValue('md_mediation_eval_public');
$participant = $cck->getValue('md_mediation_eval_nb_part');
$implication = $cck->getValue('md_mediation_eval_implication_public');

?>

<div class="row content">
  <div class="col-md-7 main-col">
    <div class="inner">
      <h1>
        <?php echo $cck->getValue('md_mediation_nom'); ?>

        <?php if ($cck->getValue('art_access') == '2' ) : ?>
          <?php echo $cck->renderField('md_mediation_draft'); ?>
        <?php endif; ?>
        
        <?php echo $cck->renderField('md_mediation_edit_2'); ?>
      </h1>

      <section class="content-createdby mt-0 p-0 help small" style="border: none;">
        Publié par&nbsp;: <?php echo $cck->renderField('art_created_by'); ?>
      </section>

      <section class="content-wysiswyg">
        <?php echo $cck->renderField('art_introtext'); ?>

        <?php if($cck->renderField('md_mediation_more_info_link_fx')) : ?>
          <div class="card-body">
            <h4>Pour en savoir plus :</h4>
            <?php echo $cck->renderField('md_mediation_more_info_link_fx') ; ?>
          </div>
        <?php endif; ?>
      </section>

      <?php if($cck->renderField('md_mediation_medias')) : ?>
        <section class="content-media">
          <h2>Téléchargement</h2>
          <ul>
            <?php foreach($cck->get('md_mediation_medias')->value as $media ) {
              $filePath = pathinfo($media->value);
              $fileExtension = $filePath['extension'];

              if(($fileExtension == 'png') || ($fileExtension == 'PNG') || ($fileExtension == 'jpg') || ($fileExtension == 'JPG')) {
                $fileIcon = '<i class="fas fa-file-image"></i>';
              } ?>

              <li>
                <a href="<?php echo $media->link; ?>" ><?php echo $fileIcon; ?> <?php echo $media->text; ?></a>
              </li>
            <?php } ?>
          </ul>
        </section>
      <?php endif; ?>

      <div class="mt-4">{ampz:share-content}</div>
    </div>
  </div>

  <div class="col-md-4 offset-md-1 right-col">
    <div class="py-3">
      <section class="content-map">
        <div class="embed-responsive embed-responsive-1by1">
          <?php echo $cck->renderField('md_mediation_carte'); ?>
        </div>
        <div class="meta meta-institution">
          <?php echo $cck->renderField('md_mediation_institution'); ?>
        </div>
      </section>

      <?php if($cck->renderField('md_mediation_annee_lancement')) : ?>
        <section class="content-year">
          <h3 class="h4">Année de lancement</h3 class="h4">
          <div class="meta meta-year">
            <?php echo $cck->getValue('md_mediation_annee_lancement'); ?>
          </div>
        </section>
      <?php endif; ?>

      <?php if ($cck->getValue('md_mediation_thematiques')) : ?>
        <section class="content-theme">
          <h3 class="h4">Champs thématiques</h3 class="h4">
          <div class="meta meta-theme">
            <?php echo str_replace(',', ' ', $cck->renderField('md_mediation_thematiques')); ?>
          </div>
        </section>
      <?php endif; ?>

      <?php if ($cck->getValue('md_mediation_types')) : ?>
        <section class="content-type">
          <h3 class="h4">Type de médiation</h3 class="h4">
          <div class="meta meta-type">
            <?php echo str_replace(',', ' ', $cck->renderField('md_mediation_types')); ?>
          </div>
        </section>
      <?php endif; ?>

      <?php if ($cck->getValue('md_mediation_publics')) : ?>
        <section class="content-public">
          <h3 class="h4">Types de Public</h3 class="h4">
          <div class="meta meta-public">
            <?php echo str_replace(',', ' ', $cck->renderField('md_mediation_publics')); ?>
          </div>
        </section>
      <?php endif; ?>

      <?php if ($cck->renderField('md_mediation_situation')) : ?>
        <section class="content-place">
          <h3 class="h4">Situation</h3 class="h4">
          <div class="meta meta-place">
            <?php echo str_replace(',', ' / ', $cck->renderField('md_mediation_situation')); ?>

            <?php if ($cck->getValue('md_mediation_options_hors_les_murs')) : ?>
              <?php echo ' / ' . str_replace(',', ' / ', $cck->renderField('md_mediation_options_hors_les_murs')); ?>
            <?php endif; ?>
          </div>
        </section>
      <?php endif; ?>

      <?php if ($cck->getValue('art_tags')) : ?>
        <section class="content-tag">
          <h3 class="h4">Autres thèmes</h3 class="h4">
          <div class="meta meta-tag">
            <?php echo $cck->renderField('md_mediation_tags'); ?>
          </div>
        </section>
      <?php endif; ?>

      <?php // if ($cck->renderField('md_mediation_url')) : ?>
        <!-- <section class="content-url">
          <div class="meta meta-url">
            <a class="meta-link btn btn-primary btn-sm" href="<?php // echo $cck->getText('md_mediation_url'); ?>" target="_blank">Plus d'infos sur le site de la structure</a>
          </div>
        </section> -->
      <?php // endif; ?>

      <?php if ($cck->renderField('md_mediation_contacts')) : ?>
        <section class="content-contact">
          <?php foreach($cck->get( 'md_mediation_contacts' )->value as $contact) { ?>
          <p>
            <?php if ($contact['md_contact_mediation_nom']->value) : ?>
              <span class="contact-name"><?php echo $contact['md_contact_mediation_nom']->value; ?></span><br />
            <?php endif; ?>

            <?php if ($contact['md_contact_mediation_fonction']->value) : ?>
              <span class="function"><?php echo $contact['md_contact_mediation_fonction']->value; ?></span><br />
            <?php endif; ?>

            <?php if ($contact['md_contact_mediation_email']->value) : ?>
              <span class="function"><a href="mailto:<?php echo $contact['md_contact_mediation_email']->link; ?>"><?php echo $contact['md_contact_mediation_email']->value; ?></span></a>
            <?php endif; ?>
          </p>
        <?php } ?>
        </section>
      <?php endif; ?>

  </div>
</div>

<?php if(($complexite != '1') || ($duree != '1') || ($preparation != '1') || ($competence != '1') || ($presence != '1') || ($budget != '1') || ($horsdans != '1') || ($public != '1') || ($participant != '1') || ($implication != '1')) : ?>
  <section class="content-eval">
    <h2>Auto-évaluation</h2>
      <div class="row">
        <div class="col-lg-4">
          <p>Le schéma ci-contre représente selon dix critères, classés de 1 à 5, une forme d’auto-évaluation par l’institution. Sans aucune hiérarchie d’intérêt entre une médiation et une autre, il s’agit de se donner seulement une représentation en fonction du temps de préparation nécessaire, de l’implication des usagers attendue, du budget à consentir, du nombre de partenaires à mobiliser, des compétences techniques nécessaires, des spécialistes à réunir, du temps de préparation, de la durée de l’action proposée.</p>
        </div>

        <div class="col-lg-8">
          <div id="chartdiv"></div>
        </div>
      </div>
  </section>
<?php endif; ?>

<section class="content-related">
  <div class="section-title section-title-btn arrow">
    <h2 class="h3">Vous aimerez aussi</h2>
    <a class="btn btn-primary btn-sm" href="mediations">Toutes les médiations</a>
  </div>

  <div class="full-width bg-sand">
    <div class="container px-0 inner">
      <?php echo $cck->renderField('md_mediation_enrelation'); ?>
    </div>
  </div>
</section>
