<?php
require '../vendor/autoload.php';
try{
    $app = new App();
    $app->init();
}
catch (RouterException $e){
    header("HTTP/1.0 404 Not Found");
}
