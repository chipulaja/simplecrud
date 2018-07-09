<?php
require __DIR__ .'/../vendor/autoload.php';
require_once 'db-config.php';
require_once 'Doctrine.php';

$doctrine = new Doctrine($dbConfig);
$em = $doctrine->em;

 $helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));

 \Doctrine\ORM\Tools\Console\ConsoleRunner::run($helperSet);
