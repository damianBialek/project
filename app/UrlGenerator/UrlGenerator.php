<?php
namespace UrlGenerator;

class UrlGenerator
{
    private $config;
    private $httpProtocol;
    private $host;
    private $routes;

    public function __construct($config)
    {
        $this->config = $config;

        $this->setHttpProtocol();
        $this->setHost();
        $this->loadRoutes();
    }

    private function setHttpProtocol()
    {
        $this->httpProtocol = $_SERVER['REQUEST_SCHEME'];
    }

    private function setHost()
    {
        $this->host = $_SERVER['HTTP_HOST'];
    }

    private function loadRoutes()
    {
        $this->routes = include __DIR__.'/../route.php';
    }

    public function buildUrl()
    {
        $fullUrl = $this->httpProtocol.'://'.$this->host;

        return $fullUrl;
    }

    public function generateUrl($name, $params = [])
    {
        $url = $this->config['basename'];

        if(!isset($this->routes[$name]))
            throw new \Exception("($name) Taki router nie istnieje");

        $url .= $this->routes[$name][0];

        return $url;
    }

    public function generateUrlToAttachments($attachmentName)
    {
        $url = $this->config['attachments'];

        $url .= $attachmentName;

        return $url;
    }

}