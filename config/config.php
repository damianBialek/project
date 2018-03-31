<?php
return [
    'database' => [
        'driver'   => 'pdo_mysql',
        'user'     => 'root',
        'password' => '',
        'dbname'   => 'study_002',
        'driver_pdo' => 'mysql',
        'host' => 'localhost'
    ],
    'view' => [
        'path' => $_SERVER['DOCUMENT_ROOT'].'/project/resources/',
        'cache' => $_SERVER['DOCUMENT_ROOT'].'/project/cache/',
        'url' => [
            'basename' => 'http://localhost/project',
            'attachments' => 'http://localhost/project/public/media/'
        ]
    ],
    'url' => [
        'basename' => 'http://localhost/project'
    ]
];