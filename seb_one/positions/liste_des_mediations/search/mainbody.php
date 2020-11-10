<?php
// No Direct Access
defined( '_JEXEC' ) or die;

?>

<div class="full-width bg-sand mb-4">
  <div class="container">
    <div class="inner">
      <h2 class="text-uppercase">Trouver une médiation</h2>

      <div class="form-group">
        <?php echo $cck->renderField('md_mediation_search_generic'); ?>
      </div>

      <div class="search-wrapper">
        <div class="form-group">
          <button class="btn btn-outline-black btn-sm" type="button" data-toggle="collapse" data-target="#advancedSearch" aria-expanded="false" aria-controls="advancedSearch">
            <span>d'options de recherche</span>
          </button>
        </div>

        <div id="advancedSearch" class="collapse">
          <div class="mb-3 bg-sand">
            <div class="row">
              <div class="col-6 col-md-4">
                <?php echo $cck->renderField('md_mediation_thematiques_search'); ?>
              </div>

              <div class="col-6 col-md-4">
                <?php echo $cck->renderField('md_mediation_types_search'); ?>
              </div>

              <div class="col-6 col-md-4">
                <?php echo $cck->renderField('md_mediation_publics_search'); ?>
              </div>

              <div class="col-6 col-md-4">
                <?php echo $cck->renderField('art_tags'); ?>
              </div>

              <div class="col-6 col-md-4">
                <?php echo $cck->renderField('md_mediation_institution'); ?>
              </div>

              <div class="col-6 col-md-4">
                <?php echo $cck->renderField('md_mediation_annee_lancement'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="action-search">
        <div class="form-group">
          <?php echo $cck->renderField('md_mediations_search_button'); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-6 col-md-4 col-lg-3">
    <?php echo $cck->renderField('md_mediation_order'); ?>
  </div>
</div>
