<?php

class Controller{
  public function redirect($url, $data = []){
      header('Location: /' . ucfirst($url));
      exit();
  }
}