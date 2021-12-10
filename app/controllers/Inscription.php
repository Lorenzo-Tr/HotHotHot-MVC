<?php

class Inscription extends Controller
{
    public function index()
    {
        $data['title'] = "Inscription";

        view('inscription', $data);
    }

    public function addUser($array)
    {
        var_dump($_POST);

        $db = new Database();
        $db->addUser($_POST);

        $this->redirect('');
    }
}