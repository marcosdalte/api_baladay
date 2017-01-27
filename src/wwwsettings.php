<?php 


    $settings = [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            // 'level' => \Monolog\Logger::DEBUG,
        ],
        // Authentication
        'authentication' => [
            'api_key' => 'sKpDMwwP9ngBf7I4',
            'api_secret' => 'RNe9NiCec3ENMe4q7KJkwm52',
        ],
    ],
];
