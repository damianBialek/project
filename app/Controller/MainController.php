<?php
namespace Controller;


abstract class MainController
{
    private $config;

    protected $request;
    protected $entityManager;
    protected $view;
    protected $urlGenerator;

    public function __construct($request = null)
    {
        $this->request = $request;
        $this->loadConfig();
        $this->doctrineInit();
        $this->twigInit();
    }

    private function loadConfig()
    {
        $this->config = include __DIR__.'/../../config/config.php';
    }

    private function doctrineInit()
    {
        $doctrine = new \Providers\DoctrineServiceProvider($this->config['database']);
        $this->entityManager = $doctrine->provide();
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

    abstract public function index();
}