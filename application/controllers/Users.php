<?php
  class Users extends Controller{
    public function __construct(){
      $this->userModel = $this->model('M_login');
    }

    public function index(){
      // $this->redirect('home');
      $this->login();
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
          'email_err' => '',
          'password_err' => '',       
        ];

        // Check for email
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter email.';
        } else {
          // Check for user
          if($this->userModel->findUserByEmail($data['email'])){
            
          } else {
            // No User
            $data['email_err'] = 'This email is not registered.';
          }
        }

        if(empty($data['password'])){
          $data['password_err'] = 'Please enter password.';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['password_err'])){

          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);

          if($loggedInUser){
            // User Authenticated!
            $this->createUserSession($loggedInUser);
            
            // echo "test";
          } else {
            $data['password_err'] = 'Password incorrect.';
            // Load View
            $this->view('test', $data);
            //echo "berhasil";
          }
          
        } else {
          // Load View
          $this->view('test', $data);

          echo "berhasil";
        }

      } else {
        // If NOT a POST

        // Init data
        $data = [
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',
        ];

        // Load View
        $this->view('test', $data);
      }
    }

    // Create Session With User Info
    public function createUserSession($user){
      
      $_SESSION['id'] = $user['id_login'];
      $_SESSION['username'] = $user['username'];
      $this->redirect('Dashboards');
    }

    // Logout & Destroy Session
    public function logout(){
      
      session_unset('id');
      session_unset('username');
      session_destroy(); 
      $this->redirect('Users');

    }
}