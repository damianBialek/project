<?php
return [
    'home' => [
        '','Controller\\PageController::index', 'get'
    ],
    'projects' => [
        '/my-projects', 'Controller\\PageController::projects', 'get'
    ],
    'login' => [
        '/login', 'Controller\\UserController::login', 'get'
    ],
    'loginIn' => [
        '/login', 'Controller\\UserController::loginIn', 'post'
    ],
    'logout' => [
        '/logout', 'Controller\\UserController::logout', 'get'
    ],
    'register' => [
        '/register', 'Controller\\UserController::register', 'get'
    ],
    'registerSignIn' => [
        '/register', 'Controller\\UserController::registerSignIn', 'post'
    ]
];