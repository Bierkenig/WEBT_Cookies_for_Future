<?php

use Doctrine\DBAL\DriverManager;
use TYPO3Fluid\Fluid\View\TemplateView;

require_once '../vendor/autoload.php';

function getRandomQuote()
{
    $connectionParams = [
        'dbname' => 'fortunecookies',
        'user' => 'root',
        'password' => '',
        'host' => 'localhost',
        'driver' => 'pdo_mysql',
    ];
    try {
        $connection = DriverManager::getConnection($connectionParams);
        $numberPks = $connection
            ->createQueryBuilder()
            ->select('COUNT(pk_quote_id) AS NUMBER_PKS')
            ->from('quote')
            ->executeQuery()
            ->fetchAllAssociative();
        $quote = $connection
            ->createQueryBuilder()
            ->select('text')
            ->from('quote')
            ->where('pk_quote_id = ' . rand(1, intval($numberPks[0]['NUMBER_PKS'])))
            ->executeQuery()
            ->fetchAllAssociative();
        return $quote[0]['text'];
    } catch (\Doctrine\DBAL\Exception $e) {
        return 'DATABASE CONNECTION FAILED';
    }
}

$view = new TemplateView();
$paths = $view->getTemplatePaths();
$paths->setTemplateRootPaths([__DIR__ . '/Resources/Private/Templates/']);
$paths->setLayoutRootPaths([__DIR__ . '/Resources/Private/Layouts/']);
$view->assign('quote', getRandomQuote());
echo $view->render('Default');