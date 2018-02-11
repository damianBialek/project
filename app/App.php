<?php

use Providers\DoctrineServiceProvider;

class App
{
    private $controller;
    private $method;
    private $errorController;

    public function init()
    {
        $this->errorController = new \Controller\ErrorController();
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
                call_user_func_array(array($controller, $this->method),array());
            }
            else{
                $this->error("Metoda $this->method w $this->controller nie istnieje");
            }
        }
        else{
            $this->error("Taki kontroler nie istnieje $this->controller");
        }

    }

    public function error($message)
    {
        $this->errorController->error($message);
    }

}