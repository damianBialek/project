<?php

class RouteCollection
{
    private $routeFile = __DIR__.'/route.php';

    private $routesItems;
    private $collateRoutesItems;

    public function __construct()
    {
        $this->loadRouteFile();
        $this->collateRoutesItems();
    }

    public function loadRouteFile()
    {
        if(file_exists($this->routeFile)){
            $this->routesItems = include $this->routeFile;
        }
        else{
            throw new Exception("Route file not found !");
        }
    }

    public function collateRoutesItems()
    {
        if(!empty($this->routesItems)){
            foreach ($this->routesItems as $routeName => $route){
                $this->collateRoutesItems[$route[2]][$routeName] = $route;
            }
        }
    }

    public function getRoutesItems($requestMethod){
        $requestMethod = mb_strtolower($requestMethod);
        return (isset($this->collateRoutesItems[$requestMethod]) ? $this->collateRoutesItems[$requestMethod] : []);
    }
}