<?php
  class Users extends Controller {

    private $userModel;

    public function __construct() {
      $this->userModel = $this->model('User');
    }

    public function register() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'login' => trim($_POST['login']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'loginErr' => '',
          'emailErr' => '',
          'passwordErr' => '',
          'confirm_passwordErr' => ''
        ];

        if (empty($data['login'])) {
          $data['loginErr'] = 'podaj login';
        } elseif ($this->userModel->isLoginRegistered($data['login'])) {
          $data['loginErr'] = 'login zajęty';
        }
                
        if (empty($data['email'])) {
          $data['emailErr'] = 'podaj email';
        } elseif ($this->userModel->isEmailRegistered($data['email'])) {
          $data['emailErr'] = 'email zajęty';
        }

        if (empty($data['password'])) {
          $data['passwordErr'] = 'podaj hasło';
        } elseif (strlen($data['password']) < 6) {
          $data['passwordErr'] = 'hasło musi mieć przynajmniej 6 znaków';
        }

        if (empty($data['confirm_password'])) {
          $data['confirm_passwordErr'] = 'potwierdź hasło';
        } elseif ($data['password'] != $data['confirm_password']) {
          $data['confirm_passwordErr'] = 'podane hasła nie są identyczne';
        }

        if (empty($data['loginErr']) &&
        empty($data['emailErr']) &&
        empty($data['passwordErr']) &&
        empty($data['confirm_passwordErr'])) {
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          if ($this->userModel->register($data)) {
            redirect('users/login');
          } else {
            exit('Rejestracja nieudana');
          }
        } else {
          $this->view('users/register', $data);
        }

      } else {
        $data = [
          'login' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'loginErr' => '',
          'emailErr' => '',
          'passwordErr' => '',
          'confirm_passwordErr' => ''
        ];
        $this->view('users/register', $data);
      }
    }

    public function login() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'login' => trim($_POST['login']),
          'password' => trim($_POST['password']),
          'loginErr' => '',
          'passwordErr' => ''
        ];

        if (empty($data['login'])) {
          $data['loginErr'] = 'podaj login';
        } elseif (!$this->userModel->isLoginRegistered($data['login'])) {
          $data['loginErr'] = 'zły login';
        }

        if (empty($data['password'])) {
          $data['passwordErr'] = 'podaj hasło';
        } elseif (empty($data['loginErr']) && $this->userModel->isPasswordValid($data['login'], $data['password']) == false) {
          $data['passwordErr']  = 'złe hasło';
        }

        if (empty($data['loginErr']) && empty($data['passwordErr'])) {
          $_SESSION['userId'] = $this->userModel->getUserInfoByLogin($data['login'])->id ?: '';
          $_SESSION['userLogin'] = $data['login'];
          if ($_SESSION['userId'] == '') exit('Nie udało się pobrać danych użytkownika z bazy');
          redirect('recipes/index');
        } else {
          $this->view('users/login', $data);
        }
        
      } else {
        $data = [
          'login' => '',
          'password' => '',
          'loginErr' => '',
          'passwordErr' => ''
        ];
        $this->view('users/login', $data);
      }
    }

    public function logout() {
      unset($_SESSION['userId']);
      unset($_SESSION['userLogin']);
      redirect('');
    }
    
  }
