<?php
  require_once '../app/config/config.php';
  require_once '../app/helpers/helper.php';

  spl_autoload_register(
    function($className) {
      require_once 'libraries/'.$className.'.php';
    }
  );