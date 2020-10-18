<?php


class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->library('form_validation');
        $this->load->library('template');
    }

    public function index()
    {
        $data['page']="Dashboard";
        $this->template->layout('admin/dashboard/index', $data);
    }
}
?>