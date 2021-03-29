<?php
# every controller extend this 'base'controller
# methods to load views and models

class controller {
    # first - require a model to load
    public function model($model){
        require_once '../app/models/' . $model .'.php';

        # instatiate that model
        return new $model();
    }

    # pass in view and array of 'data' for dynamic values that can be passed trough views
    public function view($view, $data = []){
        if(file_exists('../app/views/' . $view . '.php')){ 
            require_once '../app/views/' . $view . '.php';
        } else{
            die('This view does not exist!');

        }
    } 

}