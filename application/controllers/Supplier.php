<?php
class Supplier extends Controller {

    public function __construct()
    {
        if($this->isLoggedIn()){
        } else {
            $this->redirect('Users/login');
        }

        // panggil helper
        $this->helper('field_data');
        $this->model = $this->model('M_supplier');

    }


    public function index($alert = NULL, $msg =NULL){
        $data = $this->model->getAll();
        $this->template('supplier',[
            "data" => $data,
            "url_preview" => BASEURL."Supplier/detail/",
            "url_edit" => BASEURL."Supplier/edit/",
            "url_remove" => BASEURL."Supplier/delete/",
            'alert' => $alert,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }

    public function add($error = NULL, $msg = NULL){
        $this->template('supplier_form',[
            'title' => 'Add Supplier',
            'action' => BASEURL.'Supplier/insert/',
            'this' => 'add',
            'nav' => 'supplier',
            'alert' => $error,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }

    public function edit($id,$alert = NULL, $msg = NULL){
        $data = $this->model->getById($id);
        // get data from supplier by id
        $this->template('supplier_form',[
            'title' => 'Edit Supplier',
            'action' => BASEURL.'Supplier/update/',
            'this' => 'edit',
            'nav' => 'supplier',
            'data' => $data,
            'alert' => $alert,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }

    // action
    public function insert(){
        $data = array(
            'id_supplier' => NULL, 
            'nama' => $_POST['nama'], 
            'detail' => $_POST['detail'], 
        );
        $result = $this->model->insert(field_data($data));
        if($result){
            $msg = "Success_insert_Supplier.";
            header("Location: ".BASEURL."Supplier/success/$msg");
        } else {
            $msg = "Failed_to_insert_Supplier.";
            header("Location: ".BASEURL."Supplier/add/error/$msg");
        }
    }

    public function update(){
        $data = array(
            'id_supplier' => $_POST['id'], 
            'nama' => $_POST['nama'], 
            'detail' => $_POST['detail']
        );
        $result = $this->model->update(field_edit($data));
        if($result){
            $msg = "Success_edit_Supplier_$data[nama].";
            // var_dump($result);
            header("Location: ".BASEURL."Supplier/edit/$_POST[id]/success/$msg");
        } else {
            $msg = "Failed_to_edit_Supplier.";
            header("Location: ".BASEURL."Supplier/edit/$_POST[id]/error/$msg");
        }
    }

    public function delete($id){
        // delete record
        $result = $this->model->delete($id);
        // check if success delete
        if($result){
            $msg = "Successful_delete_Suppler.";
            header("Location: ".BASEURL."Supplier/success/$msg");
        } else {
            $msg = "Failed_to_delete_Supplier.";
            header("Location: ".BASEURL."Supplier/error/$msg");
        }
    }
    
    public function template($page, $data=[]){
        $this->view('admin/partials/header');
        $this->view('admin/partials/sidebar', ['menu' => 'supplier']);
        $this->view('admin/partials/navbar');
        $this->view('admin/dashboard/'.$page, $data);
        $this->view('admin/partials/footer');
    }

}