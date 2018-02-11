<?php
namespace Controller;


class ErrorController extends MainController
{
    public function index()
    {
        // TODO: Implement index() method.
    }

    public function error($message, $exception = null)
    {
        $this->render('Errors/main.html.twig',['message' => $message, 'exception' => $exception]);
        exit();
    }

    public function errorDocument($errorCode)
    {
        $this->render("Errors/$errorCode.html.twig");
        exit();
    }
}