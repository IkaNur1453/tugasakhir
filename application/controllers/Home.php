<?php

class Home extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->library('form_validation');
        $this->load->library('template');
    }

    public function index()
    {
        $data['page']="Home";
        $this->template->layout2('guest/home/index', $data);
    }
}
?>