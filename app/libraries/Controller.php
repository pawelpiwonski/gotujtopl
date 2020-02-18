<?php
  class Controller {

    public function view($view, $data = []) {
      if (file_exists($file = '../app/views/' . $view .'.php')) {
        require_once ($file);
      } else {
        exit('No view file to be loaded');
      }
    }

    public function model($model) {
      require_once '../app/models/' . ucfirst($model) . '.php';
      return new $model();
    }
  }