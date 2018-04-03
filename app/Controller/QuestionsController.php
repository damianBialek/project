<?php
namespace Controller;

use Model\QuestionsModel;

class QuestionsController extends MainController
{
    public function index()
    {
        $questions = new QuestionsModel($this->config['database']);
        $allQuestions = $questions->getAll();

        $this->render('Questions/list.html.twig', ['questions' => $allQuestions]);


    }
}