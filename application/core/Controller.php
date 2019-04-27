<?php
class Controller
{
    // public function __construct(){
    //     if (session_status() == PHP_SESSION_NONE) {
	// 	    session_start();
	// 	  }
    // }
    public function view($view, $data = [])
    {
        require_once '../application/view/' . $view . '.php';
    }

    public function model($model)
    {
        require_once '../application/model/' . $model . '.php';
        return new $model;
    }

    public function helper($helper)
    {
        require_once '../application/helpers/' . $helper . '.php';
    }

    public function redirect($page){
        header('location: '.BASEURL.''.$page);
    }

    public function isLoggedIn(){
        if(isset($_SESSION['id'])){
            return true;
        } else {
            return false;
        }
    }

}