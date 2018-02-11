<?php
require '../vendor/autoload.php';
try{
    $app = new App();
    $app->init();
}
catch (\Exception $e){
    $app->error($e->getMessage());

    echo '<pre>';
    echo $e->getTraceAsString();
    echo '</pre>';
}
