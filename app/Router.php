<?php

class Router
{
    private $fullPathInfo;
    private $pathInfoParams;

    private $routeCollection;

    private $controller;
    private $controllerMethod;

    public function __construct()
    {
        $this->setPathInfo();
        $this->loadRouteCollection();
        $this->buildRoutesRegexAndParams();
        $this->routing();
    }

    private function setPathInfo()
    {
        $this->fullPathInfo = (!empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '');

        $this->setPathInfoParams();
    }

    private function setPathInfoParams()
    {
        if(!empty($this->fullPathInfo)) {
            $this->pathInfoParams = explode('/', $this->fullPathInfo);
            unset($this->pathInfoParams[0]);
        }
    }

    private function loadRouteCollection()
    {
        $this->routeCollection = include 'route.php';
    }

    private function buildRoutesRegexAndParams()
    {
        foreach ($this->routeCollection as $routeName => $route){
            $routeArray = explode('/', $route[0]);
            unset($routeArray[0]);

            if(!empty($routeArray)) {
                foreach ($routeArray as $key => $param) {
                    if (preg_match('%{{(.*)}}%', $param, $match)) {
                        $this->routeCollection[$routeName]['params'][$key] = $match[1];
                        continue;
                    }

                    $this->routeCollection[$routeName]['regex'][$key] = '%^' . $param . '$%';
                }
            }
            else{
                $this->routeCollection[$routeName]['regex'][1] = '%^$%';
            }
        }

    }

    public function routing()
    {
        $match = $this->match();

        if($match){
            $extractControllerInfo = explode('::',$this->routeCollection[$match['routeName']][1]);
            $this->controller = $extractControllerInfo[0];
            $this->controllerMethod = $extractControllerInfo[1];
        }
        else{
            header("HTTP/1.0 404 Not Found");
        }


    }

    public function match()
    {
        foreach ($this->routeCollection as $routeName => $route) {
            $routeArrayRegex = (!empty($this->routeCollection[$routeName]['regex']) ? $this->routeCollection[$routeName]['regex'] : []);
            $routeArrayParam = (!empty($this->routeCollection[$routeName]['params']) ? $this->routeCollection[$routeName]['params'] : []);

            if(!$this->matchRoute($routeArrayRegex))
                continue;

            if(!empty($routeArrayParam)) {
                foreach ($routeArrayParam as $key => $paramName) {
                    $params[$paramName] = $this->pathInfoParams[$key];
                }
            }

            return ['params' => (isset($params) ? $params : []), 'routeName' => $routeName];
        }

    }

    public function matchRoute($routeArrayRegex)
    {
        foreach ($routeArrayRegex as $key => $regex) {
            if (!preg_match($regex, $this->pathInfoParams[$key]))
                return false;
        }

        return true;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getControllerMethod()
    {
        return $this->controllerMethod;
    }
}