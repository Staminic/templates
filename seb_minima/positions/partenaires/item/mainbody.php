<?php
// No Direct Access
defined( '_JEXEC' ) or die;
?>

<a class="card h-100" style="color: #000;" href="<?php echo $cck->getValue('md_partenaire_url'); ?>" target="_blank" rel="noopener">
  <div class="card-body text-center">
    <img src="<?php echo $cck->getThumb4('md_partenaire_logo'); ?>" alt="Logo <?php echo $cck->getValue('md_partenaire_nom'); ?>" class="logo card-img-top mb-3" />
    <h3 class="card-title"><?php echo $cck->getValue('md_partenaire_nom'); ?></h3>
  </div>
</a>
