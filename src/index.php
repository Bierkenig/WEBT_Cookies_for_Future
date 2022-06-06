<?php

use Doctrine\DBAL\DriverManager;
use TYPO3Fluid\Fluid\View\TemplateView;

require_once '../vendor/autoload.php';

$connectionParams = [
    'dbname' => 'fortunecookies',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
$maxCookies = 5;

function getRandomQuote()
{
    global $connectionParams;
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

function renderDefaultView($cookiesLeft)
{
    $view = new TemplateView();
    $paths = $view->getTemplatePaths();
    $paths->setTemplateRootPaths([__DIR__ . '/Resources/Private/Templates/']);
    $paths->setLayoutRootPaths([__DIR__ . '/Resources/Private/Layouts/']);
    $view->assign('quote', getRandomQuote());
    $view->assign('cookiesLeft', $cookiesLeft);
    return $view->render('Default');
}

function renderCookieLimitView()
{
    $view = new TemplateView();
    $paths = $view->getTemplatePaths();
    $paths->setTemplateRootPaths([__DIR__ . '/Resources/Private/Templates/']);
    $paths->setLayoutRootPaths([__DIR__ . '/Resources/Private/Layouts/']);
    return $view->render('Limit');
}

function getUserIP()
{
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function checkIPAndRender()
{
    global $connectionParams;
    global $maxCookies;
    try {
        $connection = DriverManager::getConnection($connectionParams);
        $userRecords = $connection
            ->createQueryBuilder()
            ->select('lastAccessDate, accessCount')
            ->from('access_records')
            ->where('pk_ip = ?')
            ->setParameter(0, getUserIP())
            ->executeQuery()
            ->fetchAllAssociative();
        $currentDate = $connection
            ->createQueryBuilder()
            ->select('curdate()')
            ->executeQuery()
            ->fetchAllAssociative();
        if (sizeof($userRecords) == 0) {
            $connection
                ->createQueryBuilder()
                ->insert('access_records')
                ->setValue('pk_ip', '?')
                ->setValue('lastAccessDate', 'curdate()')
                ->setValue('accessCount', 1)
                ->setParameter(0, getUserIP())
                ->executeQuery();
            echo renderDefaultView($maxCookies);
        } else if ($userRecords[0]['lastAccessDate'] != $currentDate[0]['curdate()']) {
            $connection
                ->createQueryBuilder()
                ->update('access_records', 'ar')
                ->set('ar.accessCount', '?')
                ->where('pk_ip = ?')
                ->setParameter(0, 1)
                ->setParameter(1, getUserIP())
                ->executeQuery();
            echo renderDefaultView($maxCookies);
        } else if ($userRecords[0]['lastAccessDate'] == $currentDate[0]['curdate()']) {
            $currentAccessCount = intval($userRecords[0]['accessCount']);
            $newAccessCount = $currentAccessCount + 1;
            if ($newAccessCount > $maxCookies) {
                echo renderCookieLimitView();
            } else {
                $connection
                    ->createQueryBuilder()
                    ->update('access_records', 'ar')
                    ->set('ar.accessCount', '?')
                    ->where('pk_ip = ?')
                    ->setParameter(0, $newAccessCount)
                    ->setParameter(1, getUserIP())
                    ->executeQuery();
                echo renderDefaultView($maxCookies - $currentAccessCount);
            }
        }
    } catch (\Doctrine\DBAL\Exception $e) {
        echo 'DATABASE CONNECTION FAILED' . $e;
    }
}

checkIPAndRender();