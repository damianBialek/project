<?php
return [
    'start' => [
        '/','Controller\\PageController::index'
    ],
    'test2' => [
        '/test2/{{page}}','TestController::show'
    ]
];