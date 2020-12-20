<?php

class Penjadwalan extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->library('template');
        $this->load->model('M_Reservasi', 'reservasi');
    }

    public function index()
    {
        $data['page']="Penjadwalan";
        $this->template->layout2('guest/penjadwalan/index', $data);
    }

    public function getAllJadwal()
    {
        $getPenjadwalan = $this->reservasi->get_by_where(array("status" => "sudah"));

        echo json_encode($getPenjadwalan);
    }
}
?>