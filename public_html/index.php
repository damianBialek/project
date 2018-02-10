<?php
require '../vendor/autoload.php';

$url = new \UrlGenerator\UrlGenerator();



echo '<pre>';
print_r($url);

echo $url->buildUrl();

echo '<pre>';
print_r($_SERVER);

try{
    $app = new Router();
}
catch (RouterException $e){
    header("HTTP/1.0 404 Not Found");
}
