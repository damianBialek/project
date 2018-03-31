<?php

class Router
{
    private $fullPathInfo;
    private $pathInfoParams;

    private $routeCollection;

    private $controller;
    private $controllerMethod;
    private $nameRouteMatch;

    private $matchedParams;

    public function getNameRouteMatch()
    {
        return $this->nameRouteMatch;
    }

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
        $this->routeCollection = new RouteCollection();
        $this->routeCollection = $this->routeCollection->getRoutesItems($_SERVER['REQUEST_METHOD']);
    }

    private function buildRoutesRegexAndParams()
    {
        foreach ($this->routeCollection as $routeName => $route){
            $routeArray = explode('/', $route[0]);
            unset($routeArray[0]);

            if(!empty($routeArray)) {
                foreach ($routeArray as $key => $param) {
                    if (preg_match('%{{(.*)}}%', $param, $match)) {
                        $this->routeCollection[$routeName]['params'][$key] = $this->buildRouteParamRegex($param)['name'];
                        $this->routeCollection[$routeName]['regex'][$key] = $this->buildRouteParamRegex($param)['regex'];

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

    private function buildRouteParamRegex($param)
    {
        preg_match('%{{(.*)}}%', $param, $matches);
        $param = $matches[1];

        $explode = explode('::',$param);
        $paramName = $explode[0];
        $paramTyp = $explode[1];

        switch ($paramTyp){
            case 'int':{
                $paramRegex = '%^[0-9]+$%';
                break;
            }
        }

        return ['name' => $paramName, 'regex' => $paramRegex];
    }

    public function routing()
    {
        $match = $this->match();

        if($match){
            $extractControllerInfo = explode('::',$this->routeCollection[$match['routeName']][1]);
            $this->controller = $extractControllerInfo[0];
            $this->controllerMethod = $extractControllerInfo[1];
            $this->nameRouteMatch = $match['routeName'];
            $this->matchedParams = $match['params'];
        }
        else{
            throw new \RouterException();
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
        if(count($this->pathInfoParams) != count($routeArrayRegex))
            return false;

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

    public function getParams()
    {
        return $this->matchedParams;
    }
}