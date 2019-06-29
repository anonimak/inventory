<?php
class Pengambilan_part extends My_Controller {

    public function __construct()
    {
        // user level role
        parent::__construct("Pengambilan_part");

        // panggil helper
        $this->helper('field_data');
        $this->model = $this->model('M_part_pengambilan');
        $this->model_part = $this->model('M_part');
        // $this->model_supplier = $this->model('M_supplier');

    }


    public function index($alert = NULL, $msg =NULL){
        $data = $this->model->getAll();
        $this->template->get_template('pengambilan_part',[
            "data" => $data,
            "url_add" => BASEURL."Pengambilan_part/add/",
            "url_submit" => BASEURL."Pengambilan_part/submit/",
            "url_preview" => BASEURL."Pengambilan_part/detail/",
            "url_preview_detail" => BASEURL."Pengambilan_part/detail_preview/",
            "url_remove" => BASEURL."Pengambilan_part/delete/",
            'alert' => $alert,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }

    public function add($error = NULL, $msg = NULL){
        $this->template->get_template('Pengambilan_part_form',[
            'title' => 'Add Request Part',
            'action' => BASEURL.'Pengambilan_part/insert/',
            'this' => 'add',
            'alert' => $error,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }

    public function detail($id, $error = NULL, $msg = NULL){

        $data = $this->model->getAllDetail($id);
        $this->template->get_template('request_detail_part',[
            'data' => $data,
            'id_detail' => $id,
            'title' => "Request Detail Part",
            "url_remove" => BASEURL."Pengambilan_part/delete_detail/",
            'alert' => $error,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }

    public function detail_preview($id){

        $data = $this->model->getAllDetail($id);
        $this->template->get_template('request_detail_part_preview',[
            'data' => $data,
            'id_detail' => $id,
            'title' => "Preview Request Detail Part"
        ]);
    }

    public function add_detail($id, $error = NULL, $msg = NULL){
        $data_part = $this->model_part->getAllNotInTransaksi($id);
        $data = $this->model->getAllDetail($id);
        $this->template->get_template('request_detail_part_form',[
            'data_part' => $data_part,
            'id' => $id,
            'title' => 'Add Detail Part',
            'action' => BASEURL.'Pengambilan_part/insert_detail/'.$id,
            'this' => 'add',
            'alert' => $error,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }

    public function edit($id,$alert = NULL, $msg = NULL){
        $data = $this->model->getById($id);
        // get data from supplier by id
        $this->template->get_template('Pengambilan_part_form',[
            'title' => 'Edit Request Part',
            'action' => BASEURL.'Pengambilan_part/update/',
            'this' => 'edit',
            'data' => $data,
            'alert' => $alert,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }


    // action

    public function submit($id){
        // delete record
        $result = $this->model->update(field_edit([
            "id_part_request" => $id,
            "status" => "submit"
        ]));
        // check if success update
        if($result){
            $msg = "Successful_Submit.";
            $this->redirect("Pengambilan_part/success/$msg");
        } else {
            $msg = "Failed_to_submit.";
            $this->redirect("Pengambilan_part/error/$msg");
        }
    }

    public function insert(){
        $data = array(
            'id_part_request' => NULL, 
            'deskripsi' => $_POST['deskripsi'],
            'status' => 'edit'
        );
        $result = $this->model->insertGetId(field_data($data));
        if($result){
            $msg = "Success_add_request.";
            $this->redirect("Pengambilan_part/detail/$result");
        } else {
            $msg = "Failed_to_insert_Supplier.";
            $this->redirect("Pengambilan_part/error/$msg");
        }
    }

    public function insert_detail($id){
        $data = array(
            'id' => NULL, 
            'id_part_request' => $id,
            'id_part' => $_POST['id_part'],
            'stock' => $_POST['stock']
        );
        $result = $this->model->insertDetail(field_data($data));
        if($result){
            $msg = "Success_add_detail.";
            $this->redirect("Pengambilan_part/add_detail/$id/success/$msg");
        } else {
            $msg = "Failed_to_insert_Detail.";
            $this->redirect("Pengambilan_part/add_detail/$id/error/$msg");
        }
    }

    public function delete($id){
        // delete record
        $result = $this->model->delete($id);
        // check if success delete
        if($result){
            $msg = "Successful_delete.";
            $this->redirect("Pengambilan_part/success/$msg");
        } else {
            $msg = "Failed_to_delete.";
            $this->redirect("Pengambilan_part/error/$msg");
        }
    }

    public function delete_detail($id){
        // delete record
        $result = $this->model->deleteDetail($id);
        // check if success delete
        if($result){
            $msg = "Successful_delete_Detail.";
            $this->redirect("Pengambilan_part/detail/$id/success/$msg");
        } else {
            $msg = "Failed_to_delete_Detail.";
            $this->redirect("Pengambilan_part/detail/$id/error/$msg");
        }
    }
    

}