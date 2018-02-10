<?php

use Providers\DoctrineServiceProvider;

class App
{
    private $config;
    private $entityManager;

    public function __construct()
    {
        $this->loadConfig();
        $this->doctrineInit();
    }

    private function loadConfig()
    {
        $this->config = include '../config/config.php';
    }

    private function doctrineInit()
    {
        $doctrine = new DoctrineServiceProvider($this->config['database']);
        $this->entityManager = $doctrine->provide();
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

}