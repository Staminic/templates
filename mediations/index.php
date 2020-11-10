<?php defined( '_JEXEC' ) or die;

include_once JPATH_THEMES.'/'.$this->template.'/logic.php';

?>

<!doctype html>
<html lang="<?php echo $this->language; ?>">
  <head>
    
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KDMC58D');</script>
    

    <jdoc:include type="head" />
  </head>

  <body class="site <?php echo $active->alias . ($pageclass ? ' ' . $pageclass : ''); ?> item-<?php echo $active->id; ?><?php echo ((($active->parent_id) && ($active->parent_id != '1')) ? ' parent-itemid-' . $active->parent_id : ''); ?> view-<?php echo $view; ?><?php echo (($user->groups[11] == '11') ? ' loggedin' : '') ; ?>">
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KDMC58D"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    <?php // print_r($user->groups[11]); ?>

    <header class="header">
      <nav class="navbar navbar-expand-xl bg-black d-flex">
        <a class="navbar-brand mr-lg-auto flex-lg-grow-1 " href="/">
          <img src="<?php echo $tpath; ?>/img/pmm-logo.svg" class="mr-3" style="height: 38px;" alt="Logo de la Plateforme des médiations muséales" />
          <span class="d-none d-sm-inline">Plateforme des médiations muséales</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse" aria-controls="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapse">
          <jdoc:include type="modules" name="main-navbar" />
        </div>
      </nav>
    </header>

    <main class="main overflow-hidden">
      <?php if ($this->countModules('content-above')) : ?>
        <jdoc:include type="modules" name="content-above" style="html5"/>
      <?php endif; ?>

      <div class="container">
        <jdoc:include type="message" />

        <jdoc:include type="modules" name="component-above" />

        <jdoc:include type="component" />

        <jdoc:include type="modules" name="component-below" />
      </div>
    </main>

    <footer class="footer">
      <div class="footer bg-black py-3">
        <div class="container">
          <jdoc:include type="modules" name="footer" />
        </div>
      </div>

      <div class="footer-below py-3">
        <div class="container">
          <jdoc:include type="modules" name="footer-below" />
        </div>
      </div>
    </footer>

    <jdoc:include type="modules" name="debug" />
  </body>
</html>
