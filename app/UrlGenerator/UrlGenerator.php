<?php
namespace UrlGenerator;

class UrlGenerator
{
    private $httpProtocol;
    private $host;


    public function __construct()
    {
        $this->setHttpProtocol();
        $this->setHost();
    }

    private function setHttpProtocol()
    {
        $this->httpProtocol = $_SERVER['REQUEST_SCHEME'];
    }

    private function setHost()
    {
        $this->host = $_SERVER['HTTP_HOST'];
    }

    public function buildUrl()
    {
        $fullUrl = $this->httpProtocol.'://'.$this->host;

        return $fullUrl;
    }

}