<?php
class My_Controller extends Controller
{
    protected $exist_controller = false;
    public $template;

    public function __construct($controller)
    {
        if($this->isLoggedIn()){
        } else {
            $this->redirect('Users/login');
        }

        $this->template = new Template;
        $this->level_role($controller);
    }

    public function level_role($controller){

        if(isset($_SESSION['level'])){
            switch ($_SESSION['level']){
                case '1':
                    // set template
                    $this->template->set_sidebar('admin/partials/sidebar');

                    $module = ['Dashboard','Part_masuk','List_part','Supplier','Approval_pengajuan'];
                    if (in_array($controller, $module)){
                        $this->exist_controller = true;
                    }
                    break;
                
                case '2':
                    // set template
                    $this->template->set_sidebar('admin/partials/sidebar_2');

                    $module = ['Dashboard','Request_part','List_part_work','Pengambilan_part'];
                    if (in_array($controller, $module)){
                        $this->exist_controller = true;
                    }
                    break;
                
                default:
                    # code...
                    break;
            }
            if(!$this->exist_controller){
                $this->redirect('');
            }
        }
    }
}
?>