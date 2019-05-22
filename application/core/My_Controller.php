<?php
class My_Controller extends Controller
{
    protected $exist_controller = false;

    public function level_role($controller){
        if(isset($_SESSION['level'])){
            switch ($_SESSION['level']){
                case '1':
                    $module = ['Part_masuk','List_part','Supplier'];
                    if (in_array($controller, $module)){
                        $this->exist_controller = true;
                    }
                    break;
                
                case '2':
                    # code...
                    break;
                
                default:
                    # code...
                    break;
            }
            if(!$this->exist_controller){
                header("location:".BASEURL);
            }
        }
    }
}
?>