<?php
return [
    'database' => [
        'driver'   => 'pdo_mysql',
        'user'     => 'root',
        'password' => '',
        'dbname'   => 'study_002'
    ],
    'view' => [
        'path' => $_SERVER['DOCUMENT_ROOT'].'/project/resources/',
        'cache' => $_SERVER['DOCUMENT_ROOT'].'/project/cache/',
        'url' => [
            'basename' => 'http://localhost/project'
        ]
    ],
    'url' => [
        'basename' => 'http://localhost/project'
    ]
];