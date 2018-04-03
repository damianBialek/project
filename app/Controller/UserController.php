<?php

namespace Controller;

use Model\UserModel;

class UserController extends MainController
{
    public function login()
    {
        if(self::isLogged())
            $this->redirect('home');
        $this->render('User/login.html.twig');
    }

    public function logout()
    {
        if(self::isLogged()){
            unset($_SESSION['logged']);
            unset($_SESSION['login']);
        }
        $this->redirect('home');
    }

    public function loginIn()
    {
        $user = new UserModel($this->config['database']);

        if($result = $user->login(['email' => $_POST['email'], 'passwd' => $_POST['password']])){
            $_SESSION['logged'] = true;
            $_SESSION['login'] = $result['email'];

            $this->redirect('home');
        }
        else{
            $this->redirect('login');
        }
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

    public static function isLogged()
    {
        if(isset($_SESSION['logged']) && $_SESSION['logged'] === true)
            return $_SESSION['login'];
        else
            return false;
    }
}