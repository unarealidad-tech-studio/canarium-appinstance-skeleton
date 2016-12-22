<?php

use Zend\Mvc\Application;

ini_set('display_errors', true);

$instance_name = basename(getcwd());

chdir(dirname(getcwd()));
chdir(dirname(getcwd()));

$previousDir = '.';

while (!file_exists('config/application.config.php')) {
    $dir = dirname(getcwd());

    if ($previousDir === $dir) {
        throw new RuntimeException(
            'Unable to locate "config/application.config.php": ' .
            'is DoctrineModule in a subdir of your application skeleton?'
        );
    }

    $previousDir = $dir;
    chdir($dir);
}

if (is_readable('init_autoloader.php')) {
    include_once 'init_autoloader.php';
} elseif (!(@include_once __DIR__ . '/../vendor/autoload.php') && !(@include_once __DIR__ . '/../../../autoload.php')) {
    throw new RuntimeException('Error: vendor/autoload.php could not be found. Did you run php composer.phar install?');
}

$applicationConfig = require 'config/application.config.php';

if (file_exists(__DIR__.'/../config/instance.config.php')) {
    $applicationConfig = Zend\Stdlib\ArrayUtils::merge($applicationConfig, require __DIR__.'/../config/instance.config.php');
}

if (file_exists('config/development.config.php')) {
    $applicationConfig = Zend\Stdlib\ArrayUtils::merge($applicationConfig, require 'config/development.config.php');
}

$application = Application::init($applicationConfig);

/* @var $cli \Symfony\Component\Console\Application */
$cli = $application->getServiceManager()->get('doctrine.cli');
$cli->run();
