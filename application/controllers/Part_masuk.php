<?php
class Part_masuk extends Controller {

    public function __construct()
    {
        if($this->isLoggedIn()){
        } else {
            $this->redirect('Users/login');
        }

        // panggil helper
        $this->helper('field_data');
        $this->model = $this->model('M_part');

    }


    public function index($alert = NULL, $msg =NULL){
        $data = $this->model->getAll();
        $this->template('part_masuk',[
            'title' => 'Part Masuk',
            'action' => BASEURL.'Part_masuk/add_part/',
            'this' => 'update',
            'nav' => 'part_masuk',
            'alert' => $alert,
            'data_part' => $data,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }

    public function add_part(){
        $data = array(
            'id_part' => $_POST['id_part'], 
            'stock' => $_POST['stock']+$_POST['hid_stock']
        );
        $result = $this->model->update(field_edit($data));
        if($result){
            $msg = "Success_add_stock_$data[nama].";
            // var_dump($result);
            header("Location: ".BASEURL."Part_masuk/success/$msg");
        } else {
            $msg = "Failed_to_add_stock.";
            header("Location: ".BASEURL."Part_masuk/error/$msg");
        }
    }
    
    public function template($page, $data=[]){
        $this->view('admin/partials/header');
        $this->view('admin/partials/sidebar', ['menu' => 'part_masuk']);
        $this->view('admin/partials/navbar');
        $this->view('admin/dashboard/'.$page, $data);
        $this->view('admin/partials/footer');
    }
}