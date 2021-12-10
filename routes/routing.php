<?php

class Routing{
  private $route = '';
  private $controller = '';
  private $methode = '';
  private $data = '';

  public function __construct(){
    $this->route = explode('/', $_GET['route']);
    // TODO : ADD Const for default controller
    $this->controller = empty($this->route[0]) ? 'Home' : ucfirst($this->route[0]);
    $this->methode = empty($this->route[1]) ? 'index' : $this->route[1];
    $this->data = empty($this->route[2]) ? null : $this->route[2];
    if(class_exists($this->controller) && method_exists($this->controller, $this->methode)){
        call_user_func_array([new $this->controller, $this->methode], [$this->data]);
    }
  }
}