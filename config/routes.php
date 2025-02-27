<?php

$routes = [
    'home' => [
        'controller' => 'App\Controllers\HomeController',
        'method' => 'index'
    ],
    'login' => [
        'controller' => 'App\Controllers\AuthController',
        'method' => 'login'
    ],
    'signup' => [
        'controller' => 'App\Controllers\AuthController',
        'method' => 'signup'
    ],
    'logout' => [
        'controller' => 'App\Controllers\AuthController',
        'method' => 'logout'
    ],
    'about' => [
        'controller' => 'App\Controllers\HomeController',
        'method' => 'about'
    ],
    'contact' => [
        'controller' => 'App\Controllers\HomeController',
        'method' => 'contact'
    ],
    'lieux' => [
        'controller' => 'App\Controllers\LieuxController',
        'method' => 'index'
    ],
    'evenements' => [
        'controller' => 'App\Controllers\EvenementsController',
        'method' => 'index'
    ]
];

return $routes;