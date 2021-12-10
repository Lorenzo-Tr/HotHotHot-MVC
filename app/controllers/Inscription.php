<?php

class Inscription extends Controller
{
    public function index()
    {
        $data['title'] = "Inscription";

        view('inscription', $data);
    }
}