<?php

class Test extends Controller
{
    public function index(){
        $data['title'] = "Test";

        $this->view('home', $data);
    }
}