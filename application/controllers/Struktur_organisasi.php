<?php

class Struktur_organisasi extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->library('template');
    }

    public function index()
    {
        $data['page']="Struktur Organisasi";
        $this->template->layout2('guest/struktur_organisasi/index', $data);
    }
}
?>