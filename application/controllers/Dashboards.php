<?php
class Dashboards extends Controller {

    public function __construct()
    {
        if($this->isLoggedIn()){
        } else {
            $this->redirect('Users/login');
        }


        // panggil helper
        $this->helper('field_data');
    }


    public function index(){
        $this->template('home');
    }
    
    public function template($page, $data=[]){
        $this->view('admin/partials/header');
        $this->view('admin/partials/sidebar', ['menu' => $page]);
        $this->view('admin/partials/navbar');
        $this->view('admin/dashboard/'.$page);
        $this->view('admin/partials/footer');
    }

}