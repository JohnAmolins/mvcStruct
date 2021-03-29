<?php
    class Pages extends Controller{
        public function __construct(){

        # firstly - load a model
            
        }

        # secondly - call a model function
        public function index(){            // method 'index'; need to have an index method as 'default' if no other methods are present
            
            $data = ['title'=> 'Welcome to ForumApp'];          
            
            
        # pass data into a view
            $this->view('pages/index', $data);           // can access method 'view' from Controller; 
        }

        public function about(){ // method 'about'
            $data = ['title'=> 'About Us'];          // pass data into View
            $this->view('about/index', $data);
           
   
        }      
    }
  
?>    