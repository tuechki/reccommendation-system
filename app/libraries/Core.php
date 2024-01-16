<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); // Getting an undeserved notice due to late PHP version (for line 19)
/*
    * App Core Class
    * Creates URL & loads core controller
    * URL FORMAT - /controller/method/params
*/

class Core {
    protected $currentController = 'DefaultController';// If there is no controller
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
      //print_r($this->getUrl());

      $url = $this->getUrl();

      // Look in controllers for first value
      if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){// path is as if we are in index.php; Also controller names are capitalized
        // If exists, set as controller
        $this->currentController = ucwords($url[0]);
        // Unset 0 Index
        unset($url[0]);
      }

      // Require the controller
      require_once '../app/controllers/'. $this->currentController . '.php';

      // Instantiate controller class
      $this->currentController = new $this->currentController;

      // Check for second part of url
      if(isset($url[1])){
        // Check to see if method exists in controller
        if(method_exists($this->currentController, $url[1])){
          $this->currentMethod = $url[1];
          // Unset 1 index
          unset($url[1]);
        }
      }

      // Get params
      $this->params = $url ? array_values($url) : [];

      // Call a callback with array of params
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }
    /*Method to fetch the parameters from the url */
    public function getUrl(){
      if(isset($_GET['url'])){
        $url = rtrim($_GET['url'], '/'); //strip slashes from url params
        $url = filter_var($url, FILTER_SANITIZE_URL); //prevents from unwanted characters in url
        $url = explode('/', $url);
        return $url;
      }
    }
  } 

?>