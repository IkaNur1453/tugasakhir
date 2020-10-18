<?php

class Adart extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->library('template');
    }

    public function index()
    {
        $data['page']="Ad/art";
        $this->template->layout2('guest/adart/index', $data);
    }
}
?>