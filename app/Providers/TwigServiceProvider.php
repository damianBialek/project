<?php
namespace Providers;


class TwigServiceProvider
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function provide()
    {
        $loader = new \Twig_Loader_Filesystem($this->config['path']);
        $twig = new \Twig_Environment($loader,[
//            'cache' => $this->config['cache']
            'cache' => false,
            'auto_reload' => true,
            'debug' => true
        ]);

        return $twig;
    }
}