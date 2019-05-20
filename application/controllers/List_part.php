<?php
class List_part extends Controller {

    public function __construct()
    {
        if($this->isLoggedIn()){
        } else {
            $this->redirect('Users/login');
        }

        // panggil helper
        $this->helper('field_data');
        $this->helper('upload');
        $this->model = $this->model('M_part');

    }


    public function index(){
        $data = $this->model->getAll();
        $this->template('list_part',[
            "data" => $data,
            "url_preview" => BASEURL."List_part/detail/",
            "url_edit" => BASEURL."List_part/edit/",
            "url_remove" => BASEURL."List_part/delete/",
        ]);
    }

    public function add(){
        $this->template('list_part_form',[
            'title' => 'Add Part',
            'action' => 'insert',
            'this' => 'add',
            'nav' => 'list_part'
        ]);
    }

    public function edit($id){
        $data = $this->model->getById($id);
        // get data from part by id
        $this->template('list_part_form',[
            'title' => 'Edit Part',
            'action' => 'update',
            'this' => 'edit',
            'nav' => 'list_part',
            'data' => $data
        ]);
    }
    
    public function remove(){

    }


    // action
    public function insert(){

    }

    public function update($id){

    }

    public function delete($id){

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