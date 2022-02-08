<?php

class Hothothot extends Controller
{
    public function index()
    {
        $data['title'] = "My app";

        view('app', $data);
    }


}