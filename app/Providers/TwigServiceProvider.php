<?php
namespace Providers;


use Controller\UserController;
use UrlGenerator\UrlGenerator;

class TwigServiceProvider
{
    private $config;
    private $loader;

    private $params;

    public function __construct($config, $params = [])
    {
        $this->config = $config;
        $this->params = $params;
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

        $activeMenuFunction = new \Twig_Function('activeMenu',function($menuLink){
            if($menuLink === $this->params['routeName'])
                return true;
            else
                return false;
        });

        $attachmentFunction = new \Twig_Function('attachmentLink',function($attachmentName){
            $urlGenerator = new UrlGenerator($this->config['url']);
            return $urlGenerator->generateUrlToAttachments($attachmentName);
        });

        $userControllerFunction = new \Twig_Function('UserController',function($method){
            return \Controller\UserController::$method();
        });

        $twig->addFunction($urlGeneratorFunction);
        $twig->addFunction($activeMenuFunction);
        $twig->addFunction($attachmentFunction);
        $twig->addFunction($userControllerFunction);
        $twig->addExtension(new \Twig_Extension_Debug());

        return $twig;
    }
}