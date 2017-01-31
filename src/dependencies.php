<?php
// DIC configuration

$container = $app->getContainer();
$conf = new Settings;

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) use ($conf) {
    $name = $conf->getConfValue("name");
    $path = $conf->getConfValue("path");
    $level = $conf->getConfValue("level");
    
    $logger = new Monolog\Logger($name);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($path, $level));
    return $logger;
};

$container['db'] = function ($c) use ($conf) {
    $host = $conf->getConfValue('host');
    $dbname = $conf->getConfValue('dbname');
    $user = $conf->getConfValue('user');
    $pass = $conf->getConfValue('pass');
    
    $pdo = new PDO("mysql:host=" . $host . ";dbname=" . $dbname, $user, $pass);
    $pdo->exec("set names utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};