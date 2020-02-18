<?php
  session_start();

  function redirect($location) {
    header('Location: ' . URLROOT . '/' . $location);
  }

  function redirectIfNotLoggedIn() {
    if (!isset($_SESSION['userId'])) {
      header('Location: ' . URLROOT);
    }
  }

  function userLoggedIn() {
    return isset($_SESSION['userId']) ? true : false;
  }


  //temp functions - to be removed:

  function vdp($data) {
    echo '<pre>', var_dump($data), '</pre>';
  }
  function prp($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
  }