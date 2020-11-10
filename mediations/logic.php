<?php defined( '_JEXEC' ) or die;

// variables
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$jinput = $app->input;
$menu = $app->getMenu();
$active = $app->getMenu()->getActive();
$params = $app->getParams();
$pageclass = $params->get('pageclass_sfx');
$tpath = $this->baseurl.'/templates/'.$this->template;
$view = $jinput->get('view');

$user = JFactory::getUser();

// generator tag
$this->setGenerator(null);

// responsive meta tag (recommended in Bootstrap 4 doc)
$doc->setMetadata('viewport', 'width=device-width, initial-scale=1, shrink-to-fit=no');

// google fonts
$doc->addStyleSheet('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Oswald:wght@400;500&family=Roboto+Condensed&display=swap');

// css
$doc->addStyleSheet($tpath.'/build/main.css');

// JHtml::_('jquery.framework');
$doc->addScript('https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', '', array('integrity' => 'sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo', 'crossorigin' => 'anonymous', 'defer' => 'defer'));
$doc->addScript($tpath . '/js/bootstrap.min.js', '', array('defer' => 'defer'));
$doc->addScript($tpath . '/js/script.js', '', array('defer' => 'defer'));

// unset
// unset($doc->_scripts[$this->baseurl .'/media/jui/js/jquery.min.js']);
unset($doc->_scripts[$this->baseurl .'/media/jui/js/jquery-noconflict.js']);
unset($doc->_scripts[$this->baseurl .'/media/jui/js/jquery-migrate.min.js']);
unset($doc->_scripts[$this->baseurl .'/media/jui/js/bootstrap.min.js']);
unset($doc->_scripts[$this->baseurl .'/media/system/js/caption.js']);
// unset($doc->_scripts[$this->baseurl .'/media/system/js/core.js']);
unset($doc->_scripts[$this->baseurl .'/media/system/js/tabs-state.js']);
unset($doc->_scripts[$this->baseurl .'/media/system/js/validate.js']);

if (isset($doc->_script['text/javascript']))
{
    $doc->_script['text/javascript'] = preg_replace('%jQuery\(window\)\.on\(\'load\'\,\s*function\(\)\s*\{\s*new\s*JCaption\(\'img.caption\'\);\s*}\s*\);\s*%', '', $doc->_script['text/javascript']);
    $doc->_script['text/javascript'] = preg_replace("%\s*jQuery\(document\)\.ready\(function\(\)\{\s*jQuery\('\.hasTooltip'\)\.tooltip\(\{\"html\":\s*true,\"container\":\s*\"body\"\}\);\s*\}\);\s*%", '', $doc->_script['text/javascript']);
    if (empty($doc->_script['text/javascript']))
    {
        unset($doc->_script['text/javascript']);
    }
}
