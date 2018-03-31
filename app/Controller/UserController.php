<?php

namespace Controller;

use Model\UserModel;

class UserController extends MainController
{
    public function login()
    {
        $this->render('User/login.html.twig');
    }

    public function register()
    {
        $this->render('User/register.html.twig');
    }

    public function registerSignIn()
    {
        $user = new UserModel($this->config['database']);

        if($user->userExist(['email' => $_POST['email']])){
            $this->redirect('register');
        }
    }
}