<?php
class Dashboards extends My_Controller {

    public function __construct()
    {
        parent::__construct('Dashboard');
        // if(isset($_SESSION['id'])){
        //     return true;
        // } else {
        //     $this->redirect('Users/login');
        // }



        // panggil helper
        $this->helper('field_data');
        // panggil template
    }


    public function index(){
        if($_SESSION['level'] == 1){
            $this->template->get_template('home');
        } else {
            $this->template->get_template('home2');
        }
    }

}