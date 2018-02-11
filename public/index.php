<?php
require '../vendor/autoload.php';
try{
    $app = new App();
    $app->init();
}
catch (\RouterException $e){
    $app->errorDocument(404);
}
catch (\Exception $e){
    $app->error($e->getMessage(), $e->getTraceAsString());
}

