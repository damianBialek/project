<?php
namespace ToDo\Controller;


class ToDoController extends \Controller\MainController
{
    public function index()
    {
        $records = $this->entityManager->getRepository("\ToDo\Model\Works")->findAll();

        $this->render('ToDo/index.html.twig',['allWorks' => $records]);
    }

    public function getAllWorks()
    {
        $allWorks = $this->entityManager->getRepository("\ToDo\Model\Works")->findAll();

        echo '<pre>';
        print_r($allWorks);
    }

    public function getWork()
    {
        print_r($this->requestParams);
    }

    public function addNewWork()
    {
        $newWork = new \ToDo\Model\Works();
        $newWork->setName($_POST['name']);
        $newWork->setDescription($_POST['description']);

        $this->entityManager->persist($newWork);
        $this->entityManager->flush();

        $data = [
          'success' => 'true',
          'id' => $newWork->getId()
        ];

        if($this->toJson)
            echo json_encode($data);
    }
}