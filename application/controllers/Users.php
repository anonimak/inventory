<?php
  class Users extends Controller{
    public function __construct(){
      $this->userModel = $this->model('M_login');
    }

    public function index(){
      // echo $_SESSION['id'];
      if($this->isLoggedIn()){
        $this->redirect('Dashboards');
      } else {
        $this->login();
      }
    }

    public function login(){
      // Check if logged in
      if($this->isLoggedIn()){
        $this->redirect('Dashboards');
        echo $this->isLoggedIn();
      }
       // session_start();
      // Check if POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data = [       
          'email' => trim($_POST['email']),
          'password' => md5(($_POST['password'])),        
          'error' => false,
          'msg' => '',       
        ];

        // Check for email
        if(empty($data['email'])){
          $data['error'] = true;
          $data['msg'] = 'Please enter email.';
        } else {
          // Check for user
          if($this->userModel->findUserByEmail($data['email'])){
            
          } else {
            // No User
            $data['error'] = true;
            $data['msg'] = 'This email is not registered.';
          }
        }

        if(empty($data['password'])){
          $data['error'] = true;
          $data['msg'] = 'Please enter password.';
        }

        // Make sure errors are empty
        if(!$data['error']){

          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);

          if($loggedInUser){
            // User Authenticated!
            $this->createUserSession($loggedInUser);
            
            // echo "test";
          } else {
            $data['error'] = true;
            $data['msg'] = 'Password incorrect.';
            // Load View
            $this->template('login_form', $data);
            //echo "berhasil";
          }
          
        } else {
          // Load View
          $this->template('login_form', $data);

        }

      } else {
        // If NOT a POST

        // Init data
        $data = [
          'email' => '',
          'password' => '',
          'error' => false,
          'msg' => '',
        ];

        // Load View
        $this->template('login_form', $data);
      }
    }

    // Create Session With User Info
    public function createUserSession($user){
      $_SESSION['id'] = $user['id_login'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['level'] = $user['level'];
      $this->redirect('Dashboards');
    }

    // Logout & Destroy Session
    public function logout(){
      
      session_unset('id');
      session_unset('username');
      session_destroy(); 
      $this->redirect('Users');

    }

    public function template($page, $data=[]){
      $this->view('admin/partials/header');
      $this->view('login/'.$page, $data);
      $this->view('admin/partials/login_footer');
    }
}