<?php

class HomeController extends Controller
{
    public function index()
    {
        $data['title'] = "Home Page";
        
        view('home', $data);
    }


}