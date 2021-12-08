<?php

class Controller{
  public function redirect($url, $data = []){
      header('Location: http://'. $_SERVER['HTTP_HOST'] . '/' . ucfirst($url));
      exit();
  }
}