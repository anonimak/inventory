<?php
class List_part extends My_Controller {

    public function __construct()
    {
        if($this->isLoggedIn()){
        } else {
            $this->redirect('Users/login');
        }

        // user level role
        $this->level_role("List_part");

        // panggil helper
        $this->helper('field_data');
        $this->helper('upload');
        $this->model = $this->model('M_part');
        $this->model_supplier = $this->model('M_supplier');

    }


    public function index($alert = NULL, $msg =NULL){
        $data = $this->model->getAll();
        $this->template('list_part',[
            "data" => $data,
            "url_preview" => BASEURL."List_part/detail/",
            "url_edit" => BASEURL."List_part/edit/",
            "url_remove" => BASEURL."List_part/delete/",
            'alert' => $alert,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }

    public function add($error = NULL, $msg = NULL){
        // get data supplier
        $data_supplier = $this->model_supplier->getAll();

        $this->template('list_part_form',[
            'title' => 'Add Part',
            'action' => BASEURL.'List_part/insert/',
            'this' => 'add',
            'nav' => 'list_part',
            'data_supplier' => $data_supplier,
            'alert' => $error,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }

    public function edit($id,$alert = NULL, $msg = NULL){
        // get data supplier
        $data_supplier = $this->model_supplier->getAll();

        // get data from part by id
        $data = $this->model->getById($id);

        $this->template('list_part_form',[
            'title' => 'Edit Part',
            'action' => BASEURL.'List_part/update/',
            'this' => 'edit',
            'nav' => 'list_part',
            'data' => $data,
            'data_supplier' => $data_supplier,
            'alert' => $alert,
            "msg" => str_replace('_', ' ', $msg)
        ]);
    }
    
    public function remove(){

    }


    // action
    public function insert(){
        $data = array(
            'id_part' => NULL, 
            'id_supplier' => $_POST['id_supplier'], 
            'uniq_no' => $_POST['uniq_no'], 
            'model' => $_POST['model'], 
            'part_number' => $_POST['part_number'], 
            'part_name' => $_POST['part_name'], 
            'stock' => $_POST['stock'], 
            'stock_min' => $_POST['stock_min'], 
            'qty' => $_POST['qty'], 
            'image' => $_POST['hid_image'] 
        );
        $result = $this->model->insert(field_data($data));
        if($result){
            $msg = "Success_insert_Part.";
            header("Location: ".BASEURL."List_part/success/$msg");
        } else {
            $msg = "Failed_to_insert_Part.";
            header("Location: ".BASEURL."List_part/add/error/$msg");
        }
    }

    public function update(){
        $data = array(
            'id_part' => $_POST['id'], 
            'id_supplier' => $_POST['id_supplier'], 
            'uniq_no' => $_POST['uniq_no'], 
            'model' => $_POST['model'], 
            'part_number' => $_POST['part_number'], 
            'part_name' => $_POST['part_name'], 
            'stock' => $_POST['stock'], 
            'stock_min' => $_POST['stock_min'], 
            'qty' => $_POST['qty'], 
            'image' => $_POST['hid_image'] 
        );
        $result = $this->model->update(field_edit($data));
        if($result){
            $msg = "Success_edit_Part_$data[part_name].";
            // var_dump($result);
            header("Location: ".BASEURL."List_part/edit/$_POST[id]/success/$msg");
        } else {
            $msg = "Failed_to_edit_Part.";
            header("Location: ".BASEURL."List_part/edit/$_POST[id]/error/$msg");
        }
    }

    public function delete($id){
        // get data image
        $data = $this->model->getById($id);
        $path = './img/part/';
        $img = $data['image'];

        // delete record
        $result = $this->model->delete($id);

        // check if success delete
        if($result){
            // delete image
            delete_file($path,$img);
            $msg = "Successful_delete_Part.";
            header("Location: ".BASEURL."List_part/success/$msg");
        } else {
            $msg = "Failed_to_delete_Part.";
            header("Location: ".BASEURL."List_part/error/$msg");
        }
    }

    public function upload_image(){
        $path = './img/part/';
        if (isset($_POST['photo'])) {
			$data = $_POST['photo'];

			$image_array_1 = explode(";", $data);

			$image_array_2 = explode(",", $image_array_1[1]);

			$data = base64_decode($image_array_2[1]);

			$imageName = time() . '.png';
			delete_file($path,$_POST['old_photo']);

            file_put_contents($path.$imageName,$data);
            
            $return['name'] = $imageName;
            
            echo json_encode($return);
		}
    }

    public function template($page, $data=[]){
        $this->view('admin/partials/header');
        $this->view('admin/partials/sidebar', ['menu' => 'list_part']);
        $this->view('admin/partials/navbar');
        $this->view('admin/dashboard/'.$page, $data);
        $this->view('admin/partials/footer');
    }

}