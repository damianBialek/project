<?php
namespace Controller;


class PageController extends MainController
{
    public function index()
    {
        $this->render('index.html.twig');
    }
}