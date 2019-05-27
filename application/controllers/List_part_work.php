<?php
class List_part_work extends My_Controller {

    public function __construct()
    {
        // user level role
        parent::__construct("List_part_work");

        // panggil helper
        $this->helper('field_data');
        $this->model = $this->model('M_part_workcenter');
        // $this->model_supplier = $this->model('M_supplier');

    }


    public function index($alert = NULL, $msg =NULL){
        $data = $this->model->getAll();
        $this->template->get_template('list_part_work',[
            "data" => $data,
            "url_preview" => BASEURL."List_part/detail/",
            "url_edit" => BASEURL."List_part/edit/",
            "url_remove" => BASEURL."List_part/delete/",
            'alert' => $alert,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }
    // custom template
    // public function template($page, $data=[]){
    //     $this->view('admin/partials/header');
    //     $this->view('admin/partials/sidebar', ['menu' => 'list_part']);
    //     $this->view('admin/partials/navbar');
    //     $this->view('admin/dashboard/'.$page, $data);
    //     $this->view('admin/partials/footer');
    // }

}