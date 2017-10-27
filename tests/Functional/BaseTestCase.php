<?php

namespace Tests\Functional;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Headers;
use Slim\Http\Environment;
require __DIR__ . '/../../src/Settings.php';

require __DIR__ . '/../../src/auth.php';

class BaseTestCase extends \PHPUnit_Framework_TestCase {
    public function runApp($requestMethod, $requestUri, $requestData = null){
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri,
            ]
        );
        
        $request = Request::createFromEnvironment($environment);
        if (isset($requestData)) {
            $request = $request->withHeader('AUTHORIZATION', $requestData);
        }
        $response = new Response();
        
        $app = new \Slim\App();
        // Set up dependencies
        require __DIR__ . '/../../src/dependencies.php';
        
        // Register middleware
        require __DIR__ . '/../../src/middleware.php';
        
        // Register routes
        require __DIR__ . '/../../src/routes.php';
        $response = $app->process($request, $response);
        
        return $response;
    }

}