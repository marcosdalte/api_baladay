<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $conf = new Settings;
    $name = $conf->getConfValue("name");
    $path = $conf->getConfValue("path");
    $level = $conf->getConfValue("level");
    
    $logger = new Monolog\Logger($name);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($path, $level));
    return $logger;
};
