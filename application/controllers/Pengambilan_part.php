<?php
class Pengambilan_part extends My_Controller {

    public function __construct()
    {
        // user level role
        parent::__construct("Pengambilan_part");

        // panggil helper
        $this->helper('field_data');
        $this->model = $this->model('M_part_pengambilan');
        $this->model_part = $this->model('M_part_workcenter');
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
            'title' => 'Add Pengambilan Part',
            'action' => BASEURL.'Pengambilan_part/insert/',
            'this' => 'add',
            'alert' => $error,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }

    public function detail($id, $error = NULL, $msg = NULL){

        $data = $this->model->getAllDetail($id);
        $this->template->get_template('pengambilan_detail_part',[
            'data' => $data,
            'id_detail' => $id,
            'title' => "Detail Pengambilan Part",
            "url_remove" => BASEURL."Pengambilan_part/delete_detail/",
            'alert' => $error,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }

    public function add_detail($id, $error = NULL, $msg = NULL){
        $data_part = $this->model_part->getAll($id);
        $this->template->get_template('pengambilan_detail_part_form',[
            'data_part' => $data_part,
            'id' => $id,
            'title' => 'Add Detail Pengambilan Part',
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
            'id' => NULL, 
            'tgl' => $_POST['tgl'],
            'deskripsi' => $_POST['deskripsi']
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
        $data_part = $this->model_part->getById($_POST['id_part']);
        $data = array(
            'id_d_pengambilan' => NULL, 
            'id' => $id,
            'id_part' => $_POST['id_part'],
            'qty' => $_POST['qty']
        );

        $result = $this->model->insertDetail(field_data($data));
                    // ubah stock berdasarkan detail
                    $a = 1;
                    $each = $data_part["qty"];
                    do{
                        $each = $data_part["qty"]*$a;
                        $a++;
                    } while($each < $_POST['qty']);
        
                    $array_part = array(
                        'id_part' => $_POST['id_part'],
                        'stock' => $data_part['stock']-$a
                    );
        
                    $this->model_part->update(field_edit($array_part));
        
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
        $detail = $this->model->getDetailById($id);
        $result = $this->model->deleteDetail($id);
        // check if success delete
        if($result){
            
            $data_part = $this->model_part->getById($detail['id_part']);
            $a = 1;
            $each = $data_part["qty"];
            while ($each < $detail['qty_detail']){
                $each = $data_part["qty"]*$a;
                $a++;
            }

            $array_part = array(
                'id_part' => $detail['id_part'],
                'stock' => $data_part['stock']+$a
            );

            $res = $this->model_part->update(field_edit($array_part));

            $msg = "Successful_delete_Detail.";
            $this->redirect("Pengambilan_part/detail/$detail[id]/success/$msg");
        } else {
            $msg = "Failed_to_delete_Detail.";
            $this->redirect("Pengambilan_part/detail/$detail[id]/error/$msg");
        }
    }
    

}