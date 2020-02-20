<?php
  class User extends Database {

    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function register($data) {
      $this->db->dbQuery('INSERT INTO users(login, email, password) VALUES(:login, :email, :password)');
      $this->db->dbBind(':login', $data['login']);
      $this->db->dbBind(':email', $data['email']);
      $this->db->dbBind(':password', $data['password']);
      return $this->db->dbExecute() ? true : false;
    }

    public function isLoginRegistered($login) {
      $this->db->dbQuery('SELECT login FROM users WHERE login = :login');
      $this->db->dbBind(':login', $login);
      $result = $this->db->dbFetch();
      if (!empty($result) && $result->login == $login) {
        return true;
      }
      return false;
    }

    public function isEmailRegistered($email) {
      $this->db->dbQuery('SELECT email FROM users WHERE email = :email');
      $this->db->dbBind(':email', $email);
      $result = $this->db->dbFetch();
      if (!empty($result) && $result->email == $email) {
        return true;
      }
      return false;
    }

    public function isPasswordValid($login, $password) {
      $this->db->dbQuery('SELECT login, password FROM users WHERE login = :login');
      $this->db->dbBind(':login', $login);
      $result = $this->db->dbFetch();
      if (!empty($result) && password_verify($password, $result->password)) {
        return true;
      }
      return false;
    }

    public function getUserInfoByLogin($login) {
      $this->db->dbQuery('SELECT * FROM users WHERE login = :login');
      $this->db->dbBind(':login', $login);
      $result = $this->db->dbFetch();
      if (!empty($result)) {
        return $result;
      } else {
        return false;
      }
    }
    
  }