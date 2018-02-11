<?php
namespace Providers;


use UrlGenerator\UrlGenerator;

class TwigServiceProvider
{
    private $config;
    private $loader;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function provide()
    {
        $this->loader = new \Twig_Loader_Filesystem($this->config['path']);

        $twig = new \Twig_Environment($this->loader,[
//            'cache' => $this->config['cache']
            'cache' => false,
            'auto_reload' => true,
            'debug' => true
        ]);

        $urlGeneratorFunction = new \Twig_Function('urlGenerator',function($name, $param = []){
            $urlGenerator = new UrlGenerator($this->config['url']);
            return $urlGenerator->generateUrl($name,$param);
        });

        $twig->addFunction($urlGeneratorFunction);

        return $twig;
    }
}