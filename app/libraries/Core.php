<?php
// URL format - /controller/method/param1/param2/paramX...
  class Core {    

    private $currentController = "Pages";
    private $currentMethod = "index";
    private $additionalParameters = [];
    
    public function __construct() {
      $parameters = $this->getParameters(); // fetching string of parameters from url (controller [0], method [1])

      if (isset($parameters[0]) && file_exists($controlClassFile = APPROOT . '/controllers/' . ucfirst($parameters[0]) . '.php')) {

        require_once $controlClassFile;
        $this->currentController = $parameters[0];
        if (isset($parameters[1]) && method_exists(new $parameters[0], $parameters[1])) { 
          $this->currentMethod = $parameters[1];
          $this->additionalParameters = array_slice($parameters, 2);
        }
      } else {
        require_once '../app/controllers/Pages.php';
      }

      call_user_func([new $this->currentController, $this->currentMethod], $this->additionalParameters);
    }

    private function getParameters() {
      if (isset($_GET['parameters'])) {
        $parameters = rtrim($_GET['parameters'], '/');
        $parameters = filter_var($parameters, FILTER_SANITIZE_URL);
        $parameters = explode('/', $parameters);
	return $parameters; // returns array of parameters provided in url
      }
    }
    
  }