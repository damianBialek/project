<?php
namespace Controller;


class PageController extends MainController
{
    public function index()
    {
        echo $this->urlGenerator->generateUrl('test');
//        $this->render('index.html.twig');
    }
}