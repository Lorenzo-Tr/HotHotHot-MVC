<?php

class Controller{
  public function redirect($url, $data = []){
      header('Location: https://'. $_SERVER['HTTP_HOST'] . '/' . ucfirst($url));
      exit();
  }
}