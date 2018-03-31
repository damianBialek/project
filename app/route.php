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
    'register' => [
        '/register', 'Controller\\UserController::register', 'get'
    ],
    'registerSignIn' => [
        '/register', 'Controller\\UserController::registerSignIn', 'post'
    ]
];