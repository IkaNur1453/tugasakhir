<?php

class Penjadwalan extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->library('template');
    }

    public function index()
    {
        $data['page']="Penjadwalan";
        $this->template->layout2('guest/penjadwalan/index', $data);
    }
}
?>