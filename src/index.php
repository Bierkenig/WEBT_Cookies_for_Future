<?php

require_once '../vendor/autoload.php';

use TYPO3Fluid\Fluid\View\TemplateView;

$view = new TemplateView();
$view->assign('foos', array('bar', 'baz'));
echo $view->render();