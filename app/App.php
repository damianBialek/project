<?php

use Providers\DoctrineServiceProvider;

class App
{
    private $controller;
    private $method;

    public function init()
    {
        $router = new Router();
        $this->controller = $router->getController();
        $this->method = $router->getControllerMethod();

        $this->start();
    }

    private function start()
    {
        if(class_exists($this->controller)){
            $controller = new $this->controller();

            if(method_exists($controller,$this->method)){
                $controller->index();
            }
            else{
                die("metoda nie istnieje ".$this->method);
            }
        }
        else{
            die("Taki kontroler nie istnieje ".$this->controller);
        }

    }

}