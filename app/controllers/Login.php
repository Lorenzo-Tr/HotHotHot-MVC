<?php

class Login extends Controller
{

    public function index()
    {
        $data['title'] = "Login";
        if (!LoginModel::login())
            view('login',$data);
        else
        $this->redirect('');

    }

    public function logout(){
        LoginModel::logout();
        $this->redirect('');
    }

}