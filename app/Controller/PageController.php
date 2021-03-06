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
    public function post()
    {
        if($this->toJson) {

            $array = [
                apache_request_headers(),
                $_SERVER
            ];
            echo json_encode($array);
        }else{
            $this->index();
        }
    }
}