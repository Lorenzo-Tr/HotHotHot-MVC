<?php

class Inscription extends Controller
{
    public function index()
    {
        $data['title'] = "Inscription";

        view('inscription', $data);
    }
<<<<<<< Updated upstream
=======

    public function addUser($array)
    {
        $db = new Database();
        $db->addUser($_POST);

        $this->redirect('');
    }
>>>>>>> Stashed changes
}