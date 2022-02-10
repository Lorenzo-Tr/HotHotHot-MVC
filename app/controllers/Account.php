<?php

class Account extends Controller
{

    public function index()
    {
        $data['title'] = "Login";
        if (!AccountModel::login())
            view('login',$data);
        else
        $this->redirect('');

    }

    public function logout(){
        AccountModel::logout();
        $this->redirect('');
    }

}