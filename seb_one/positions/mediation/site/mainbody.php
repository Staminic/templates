<?php
// No Direct Access
defined( '_JEXEC' ) or die;

?>

<h2>Médiation - Édition <?php echo ($cck->getValue('art_alias') ? '<a href="mediations/' . $cck->getValue('art_alias') . '"><span style="font-size: 62.5%; font-weight: 700;"><i class="fas fa-eye"></i>&nbsp;Voir</span></a>' : ''); ?></h2>

<section class="mediation-edit mediation-institution card">
  <div class="px-5">
    <div class="card-body">
      <h3>De quelle structure dépend la médiation ?</h3>
        <div class="row">
          <div class="col-sm-6 col-lg-8">
            <p class="h5">Si la structure ne figure pas dans la liste déroulante, vous devez d’abord la créer.</p>
            <p><a class="btn btn-black" href="gerer-les-institutions/creer-editer-une-institution">Créer une structure</a></p>
            <p class="h5">Vous pourrez ensuite revenir sur cette page pour créer la médiation.</p>
          </div>

          <div class="col-sm-6 col-lg-4">
            <?php echo $cck->renderField('md_mediation_institution') ; ?>
          </div>
        </div>
      </div>
    </div>
</section>

<section class="mediation-edit basic">
  <div class="row">
    <div class="col-sm-6 col-lg-8">
      <?php echo $cck->renderField('art_title') ; ?>
      <?php echo $cck->renderField('md_mediationaccroche_2') ; ?>
    </div>

    <div class="col-sm-6 col-lg-4">
      <?php echo $cck->renderField('art_state') ; ?>
      <?php echo $cck->renderField('art_access') ; ?>
      <p class="help small"><i class="fas fa-question-circle"></i> Pour que votre article soit visible il doit être publié <u>ET</u> en accès public. Un article publié et en accès enregistré n'est visible que par son auteur quand il est connecté (mode 'brouillon'). Un article non publié (quelque soit son niveau d'accès) n'est plus visible (mode 'corbeille').</p>
      <?php echo $cck->renderField('md_mediation_vignette') ; ?>
      <p class="help small"><i class="fas fa-question-circle"></i> Dimension optimale de l'image : <br />
        largeur 1200 pixels, hauteur 680 pixels </p>
      <?php echo $cck->renderField('md_mediation_vignette_caption') ; ?>
    </div>
  </div>
</section>

<section  class="mediation-edit description">
  <?php echo $cck->renderField('art_introtext') ; ?>
  <p class="help small"><i class="fas fa-question-circle"></i> Donnez des détails sur la médiation (contexte de création, déroulé, publics ciblés) et ajoutez des photos et vidéos directement dans la zone d'édition.</p>
</section>

<section class="mediation-edit year">
  <div class="row">
    <div class="col-sm-6 col-lg-4">
      <?php echo $cck->renderField('md_mediation_annee_lancement') ; ?>
    </div>
    <div class="col-sm-6 col-lg-8">
      <?php echo $cck->renderField('md_mediation_more_info_link_fx') ; ?>
    </div>
  </div>
</section>

<section class="mediation-edit tags">
  <div class="row">
    <div class="col-sm-6 col-lg-3 mb-3">
      <?php echo $cck->renderField('md_mediation_thematiques') ; ?>
      <p>Vous souhaitez suggérer une nouvelle thématique ? <a href="contact" target="_blank">Contactez-nous</a></p>
    </div>

    <div class="col-sm-6 col-lg-3 mb-3">
      <?php echo $cck->renderField('md_mediation_types') ; ?>
      <p>Vous souhaitez suggérer un nouveau type de médiation ? <a href="contact" target="_blank">Contactez-nous</a></p>
    </div>

    <div class="col-sm-6 col-lg-3 mb-3">
      <?php echo $cck->renderField('md_mediation_publics') ; ?>
      <p>Vous souhaitez suggérer un nouveau type de public ? <a href="contact" target="_blank">Contactez-nous</a></p>
    </div>

    <div class="col-sm-6 col-lg-3 mb-3">
      <?php echo $cck->renderField('md_mediation_situation') ; ?>
      <p class="help small"><i class="fas fa-question-circle"></i> Cochez une ou les 2 options</p>
      <?php echo $cck->renderField('md_mediation_options_hors_les_murs') ; ?>
      <p>Vous souhaitez suggérer une nouvelle situation ? <a href="contact" target="_blank">Contactez-nous</a></p>
    </div>

    <div class="col-sm-6 col-lg-3">
      <?php echo $cck->renderField('art_tags') ; ?>
    </div>
  </div>
</section>

<section class="mediation-edit media contact">
  <div class="row w-100">
    <div class="col-6">
      <?php echo $cck->renderField('md_mediation_medias') ; ?>
      <p class="help small"><i class="fas fa-question-circle"></i> Taille maximum de chaque fichier&nbsp;: 8&nbsp;MO</p>
    </div>

    <div class="col-6">
      <div class="form-group">
        <?php echo $cck->renderField('md_mediation_contacts') ; ?>
      </div>

      <?php // echo $cck->renderField('md_mediation_url') ; ?>
    </div>
  </div>
</section>

<section class="mediation-edit eval p-0"  style="border: none;">
  <h3>Auto-évaluation</h3>
  <p>Cette auto-évaluation subjective vise à construire une cartographie globale de l’action, nous vous invitons à la remplir en prenant de la distance pour la recontextualiser dans le panorama générale des médiations possibles.<br />
  <u>Attention</u>&nbsp;: cette auto-évaluation est réservée aux personnes et structures qui ont réalisé la médiation ou l’action culturelle.</p>
  <div class="row">
    <div class="col-md-6">
      <?php echo $cck->renderField('md_mediation_eval_complexite') ; ?>
      <p class="help small"><i class="fas fa-question-circle"></i> Complexité des actions à réaliser par les publics et difficulté de mise en œuvre de la médiation. <br />1 = Très simple / 5 = Complexe.</p>
      <?php echo $cck->renderField('md_mediation_eval_duree') ; ?>
      <p class="help small"><i class="fas fa-question-circle"></i> Temps d’occupation total des participants. <br />1 = Une heure et moins / 5 = Plusieurs mois.</p>
      <?php echo $cck->renderField('md_mediation_eval_temps') ; ?>
      <p class="help small"><i class="fas fa-question-circle"></i> Dans quelle mesure a-t-il été long de préparer cette médiation ? <br />1 = Quelques heures / 5 = Plusieurs mois.</p>
      <?php echo $cck->renderField('md_mediation_eval_competences') ; ?>
      <p class="help small"><i class="fas fa-question-circle"></i> La médiation nécessite-t-elle des compétences techniques ? <br />1 = Pas de compétences techniques / 5 = Fortes compétences techniques.</p>
      <?php echo $cck->renderField('md_mediation_eval_presence') ; ?>
      <p class="help small"><i class="fas fa-question-circle"></i> Des spécialistes (artistes, scientifiques) sont-ils nécessairement présents pour assurer la médiation ? <br />1 = Pas de spécialistes / 5 = Forte présence de spécialistes.</p>
    </div>

    <div class="col-md-6">
      <?php echo $cck->renderField('md_mediation_eval_budget') ; ?>
      <p class="help small"><i class="fas fa-question-circle"></i> Investissement financier nécessaire à la médiation. <br />1 = Petit budget, voir aucun / 5 = Très fort budget à réunir.</p>
      <?php echo $cck->renderField('md_mediation_eval_horsdans') ; ?>
      <p class="help small"><i class="fas fa-question-circle"></i> Lieu où se pratique la médiation vis-à-vis de la structure. <br />1 = Totalement dans les murs / 5 = Totalement à l’extérieur / 3 = Actions mixtes.</p>
      <?php echo $cck->renderField('md_mediation_eval_public') ; ?>
      <p class="help small"><i class="fas fa-question-circle"></i> La médiation est pensée pour des publics spécifiques : scolaires, incarcérés, en situation de handicap… <br />1 = Tous publics / 5 = Publics très spécialisés.</p>
      <?php echo $cck->renderField('md_mediation_eval_nb_part') ; ?>
      <p class="help small"><i class="fas fa-question-circle"></i> Importance des partenaires dans la réalisation de la médiation. <br />1 = Peu de partenaires / 5 = Présence importante et multiple de partenaires.</p>
      <?php echo $cck->renderField('md_mediation_eval_implication_public') ; ?>
      <p class="help small"><i class="fas fa-question-circle"></i> Degré de participation des publics. <br />1 = Publics peu actifs / 5 = Pas de médiation sans participation !</p>
    </div>
  </div>
</section>

<?php // echo $cck->renderField('art_catid') ; ?>

<section class="mediation-edit author d-flex justify-content-end">
  <?php echo $cck->renderField('art_created_by') ; ?>
</section>

<section class="mediation-edit actions d-flex flex-column" style="border: none;">
  <div class="form-group d-flex justify-content-end">
    <?php echo $cck->renderField('button_cancel') ; ?>
    <?php echo $cck->renderField('button_save') ; ?>
  </div>

  <small class="text-right text-muted">
    <p>Besoin d’aide pour la création de votre médiation ? <a href="contact" target="_blank">Contactez-nous</a></p>
  </small>
</section>
