<?php
// No Direct Access
defined( '_JEXEC' ) or die;
?>

<div class="card-header" id="heading-<?php echo $cck->getValue('art_id') ?>">
  <h2 class="mb-0">
    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $cck->getValue('art_id') ?>" aria-expanded="true" aria-controls="collapse-<?php echo $cck->getValue('art_id') ?>">
      <?php echo $cck->renderField('md_faq_question'); ?>
    </button>
  </h2>
</div>

<div id="collapse-<?php echo $cck->getValue('art_id') ?>" class="collapse" aria-labelledby="heading-<?php echo $cck->getValue('art_id') ?>" data-parent=".accordionFAQ">
  <div class="card-body">
    <?php echo $cck->renderField('md_faq_reponse'); ?>
  </div>
</div>