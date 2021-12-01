<?php

class Controller{
  public function view($view, $data = []){
    $S_file = Constants::getViewPath() . $view . '.php';

    extract($data);
    ob_start();
    include $S_file;
    $content = ob_get_contents();
    ob_end_flush();

    return $content;
  }

  public function css($filename){
    echo "<style>".file_get_contents(APP_PATH . "/resources/css/$filename.css")."</style>";
  }

  public function redirect($url, $data = []){
      header('Location: https://'. $_SERVER['HTTP_HOST'] . '/' . ucfirst($url));
      exit();
  }
}