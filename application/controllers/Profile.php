<?php 

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template');
    }

    public function index()
    {
        $data['page'] = "Reservasi";
        $this->template->layout2('guest/profile/index', $data);
    }

}