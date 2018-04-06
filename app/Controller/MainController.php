<?php
namespace Controller;


use UrlGenerator\UrlGenerator;

abstract class MainController
{
    protected $config;

    protected $toJson = false;
    protected $request;
    protected $view;
    protected $urlGenerator;
    protected $requestParams;

    public function __construct($request = null, $requestParams = [])
    {
        $this->request = $request;
        $this->requestParams = $requestParams;
        $this->loadConfig();
        $this->twigInit();
    }

    private function loadConfig()
    {
        $this->config = include __DIR__.'/../../config/config.php';
    }


    private function twigInit()
    {
        $twig = new \Providers\TwigServiceProvider($this->config['view'],['routeName' => $this->request['matchRouteName']]);
        $this->view = $twig->provide();
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function render($name, $data = [])
    {
        echo $this->view->render($name,$data);
    }

    public function setJson($json)
    {
        $this->toJson = $json;
    }

    public function redirect($name, $param = [])
    {
        $url = new UrlGenerator($this->config['url']);
        $url = $url->generateUrl($name, $param);

        header("Location: $url");
    }
}