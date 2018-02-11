<?php
namespace Controller;


class ErrorController extends MainController
{
    public function index()
    {
        // TODO: Implement index() method.
    }

    public function error($message)
    {
        $this->render('Errors/main.html.twig',['message' => $message]);
        exit();
    }
}