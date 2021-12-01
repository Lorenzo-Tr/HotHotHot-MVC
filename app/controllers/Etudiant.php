<?php
class Etudiant extends Controller{
  public function index(){
    $data['title'] = "Accueil";
    
    $this->view('home', $data);
  }
}