<?php
class Report_item_keluar extends My_Controller {

    public function __construct()
    {
        parent::__construct('Report_item_keluar');

        // panggil helper
        $this->helper('field_data');
        $this->model = $this->model('M_part_transaksi');
    }


    public function index(){
        $tgl_awal = (isset($_POST["tgl_awal"])) ? $_POST["tgl_awal"] : null ;
        $tgl_akhir = (isset($_POST["tgl_akhir"])) ? $_POST["tgl_akhir"] : null ;
        $data = $this->model->getReportItemByPeriode($tgl_awal, $tgl_akhir);
        // $data = null;
        $this->template->get_template('report_item_keluar',[
            "data" => $data,
            "tgl_awal" => $tgl_awal,
            "tgl_akhir" => $tgl_akhir,
            "action" => BASEURL."Report_item_keluar",
            "url_print_pdf" => BASEURL."Report_item_keluar/pdf/".$tgl_awal."/".$tgl_akhir,
            "url_print_excel" => BASEURL."Report_item_keluar/excel/".$tgl_awal."/".$tgl_akhir
        ]);
    }

    public function pdf($tgl_awal =null, $tgl_akhir=null){

    }

    public function excel($tgl_awal =null, $tgl_akhir=null){

    }

}