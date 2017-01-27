<?php

require __DIR__ . '/../vendor/autoload.php';

// Instantiate the app
$app = new \Slim\App();

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

require __DIR__ . '/../src/Settings.php';
require __DIR__ . '/../src/auth.php';

// Register routes
require __DIR__ . '/../src/routes.php';

$app->run();
