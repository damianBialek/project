<?php
namespace Providers;

class DoctrineServiceProvider
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function provide()
    {
        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration([],true);
        return \Doctrine\ORM\EntityManager::create($this->config, $config);
    }
}