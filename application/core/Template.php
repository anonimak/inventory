<?php
class Template extends Controller
{
    public $header;
    public $sidebar;
    public $navbar;
    public $menu;
    public $footer;

    public function __construct()
    {
        $this->header = 'admin/partials/header';
        $this->sidebar = 'admin/partials/sidebar';
        $this->navbar = 'admin/partials/navbar';
        $this->menu = 'admin/dashboard/';
        $this->footer = 'admin/partials/footer';
    }

    public function set_template($data){
        $this->header = $data['header'];
        $this->sidebar = $data['sidebar'];
        $this->navbar = $data['navbar'];
        $this->menu = $data['menu'];
        $this->footer = $data['footer'];
    }

    public function set_header($header){
        $this->header = $header;
    }

    public function set_sidebar($sidebar){
        $this->sidebar = $sidebar;
    }

    public function set_navbar($navbar){
        $this->navbar = $navbar;
    }

    public function set_menu($menu){
        $this->menu = $menu;
    }

    public function set_footer($footer){
        $this->footer = $footer;
    }

    public function get_template($page,$data=[]){
        $this->view($this->header);
        $this->view($this->sidebar, ['menu' => $page]);
        $this->view($this->navbar);
        $this->view($this->menu.$page,$data);
        $this->view($this->footer);
    }
}
?>