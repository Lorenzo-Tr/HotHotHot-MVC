<?php
class Campaign extends Controller{
    public function index($error = null){
        $data['error'] = $error;
        $data['title'] = "Accueil";
        
        $this->view('campaign', $data);
        }
}