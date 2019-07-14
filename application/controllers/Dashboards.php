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
        $this->model_transaksi = $this->model('M_part_transaksi');
        $this->model_part = $this->model('M_part');
        // panggil template
    }


    public function index($alert = NULL, $msg =NULL){
        if($_SESSION['level'] == 1){
            $data = $this->model_transaksi->getByStatus('submit');
            $this->template->get_template('home',[
            "data" => $data,
            "url_Approve" => BASEURL."Approval_pengajuan",
            'alert' => $alert,
            "msg" => str_replace('_', ' ', $msg)
        ]);
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