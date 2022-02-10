<?php

class Account extends Controller
{

    public function login()
    {
        $data['title'] = "Login";
        if (!AccountModel::login()) {
            view('login', $data);
        } else
            $this->redirect('');

    }

    public function logout()
    {

        AccountModel::logout();
        $this->redirect('');
    }

    public function recoverPassword()
    {
        AccountModel::recoverPassword();
        $data['title'] = "Mot de passe oublié";
        view('recoverPassword', $data);
    }

}