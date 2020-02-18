<?php
  class Database {

    private $db;
    private $query;

    public function __construct() {
      $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME; // Data Source Name
      $pdoOptions = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES => false
      ];
      try {
        $this->db = new PDO($dsn, DB_USER, DB_PASS, $pdoOptions);
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function dbQuery($sql) {
      $this->query = $this->db->prepare($sql);
    }

    public function dbBind($param, $value) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
      $this->query->bindValue($param, $value, $type);
    }
    
    // Following functions can be used after calling dbQuery and dbBind.

    public function dbExecute() {
      return $this->query->execute();
    }

    public function dbFetchAll() {
      $this->dbExecute();
      return $this->query->fetchAll();
    }

    public function dbFetch() {
      $this->dbExecute();
      return $this->query->fetch();
    }

    public function dbRowCount() {
      return $this->query->rowCount();
    }

  }