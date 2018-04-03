<?php

use Providers\DoctrineServiceProvider;

class App
{
    private $router;

    private $controller;
    private $method;
    private $errorController;

    private $request;

    public function init()
    {
        $this->errorController = new \Controller\ErrorController();
        $this->router = new Router();
        $this->controller = $this->router->getController();
        $this->method = $this->router->getControllerMethod();
        $this->start();
    }

    private function start()
    {
        session_start();

        $this->buildRequest();

        if(class_exists($this->controller)){
            $controller = new $this->controller($this->request,$this->router->getParams());

            if(method_exists($controller,$this->method)){
                if($this->checkAcceptJson())
                    $controller->setJson(true);
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

    private function buildRequest()
    {
        $request = [
            'matchRouteName' => $this->router->getNameRouteMatch()
        ];

        $this->request = $request;
    }

    public function error($message, $exception = null)
    {
        $this->errorController->error($message, $exception);
    }

    public function errorDocument($errorCode)
    {
        $this->errorController->errorDocument($errorCode);
    }

    private function checkAcceptJson()
    {
        if($_SERVER['HTTP_ACCEPT'] == 'application/json')
            return true;

        return false;
    }

}