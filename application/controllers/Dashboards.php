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
        $this->model = $this->model('M_part_workcenter');
        // panggil template
    }


    public function index(){
        if($_SESSION['level'] == 1){
            $this->template->get_template('home');
        } else {
            $data = $this->model->getAll();
            $this->template->get_template('home2',[
                "data" => $data]);
        }
    }

    public function excel(){
        $data = $this->model->getAll();
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Report_item_keluar_periode.xls");
        $this->view('admin/dashboard/report_part_workcenter',["data" => $data]); 
    }

}