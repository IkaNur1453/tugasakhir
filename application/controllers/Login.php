<?php


class Login extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->library('form_validation');
        $this->load->library('template');
    }

    public function index()
    {
        $data['page']="Login";
        $this->load->view('guest/login/index', $data);
    }
}
?>