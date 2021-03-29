<?php
# Core class creates URL and loads core controller
# URL format -> /controller/method/parameters

class Core{
    protected $controller = 'Pages';         // if no other controller is called -> loads Pages controller
    protected $method = 'index';         // if no other method is called -> loads index method
    protected $param =[];            // if no other parameter is called -> loads empty array

    public function __construct(){          // when Core class object is instantiated -> calls constructor and first method -> to get url
        $url = $this->fetchUrl();
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){      // checks from URL /controller/ if it exists in controllers folder
            $this->controller = ucwords($url[0]);            // sets controller to current
            unset($url[0]);         // unsets first (0) controller
        }
        
        
        require_once '../app/controllers/' . $this->controller . '.php';            // fetching the controller
        $this->controller = new $this->controller;          // instantiate controller class object
        


        if(isset($url[1])){         // checks if method is set; method is adrresed as second or (1) 'part' in URL structure array
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }



        $this->param = $url ? array_values($url) : [];          // checks if there are any params; of not -> sets an empty array for params

        call_user_func_array([$this->controller, $this->method], $this->param);            // callback with array of params
        
    }
    
    
    public function fetchUrl(){         // this function will get everything after url 'index.php?url=....'
        if(isset($_GET['url'])){ 
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);            // removes all illegal URL characters
            $url = explode('/',$url);           // breaks URL into an array
            return $url;
        }
    }

}