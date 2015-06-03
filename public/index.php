<?php

$instance_name = basename(dirname(getcwd()));

chdir(dirname(getcwd()));
chdir(dirname(getcwd()));
chdir(dirname(getcwd()));

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
#chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Setup autoloading
require 'init_autoloader.php';

$applicationConfig = require 'config/application.config.php';

if (file_exists(__DIR__.'/../config/instance.config.php')) {
    $applicationConfig = Zend\Stdlib\ArrayUtils::merge($applicationConfig, require __DIR__.'/../config/instance.config.php');
}

if (file_exists('config/development.config.php')) {
    $applicationConfig = Zend\Stdlib\ArrayUtils::merge($applicationConfig, require 'config/development.config.php');
}

// Run the application!
Zend\Mvc\Application::init($applicationConfig)->run();
