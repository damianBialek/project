<?php
return [
    'home' => [
        '','Controller\\PageController::index', 'get'
    ],
    'css' => [
        '/public/css','', 'get'
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
    ],
    'questions' => [
        '/questions', 'Controller\\QuestionsController::index', 'get'
    ],
    'questionAdd' => [
        '/questions/add', 'Controller\\QuestionsController::addNewQuestion', 'get'
    ],
];