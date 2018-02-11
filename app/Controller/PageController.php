<?php
namespace Controller;


class PageController extends MainController
{
    public function index()
    {
        $this->render('index.html.twig');
    }
    public function projects()
    {
        $this->render('projects.html.twig');
    }
}