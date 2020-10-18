<?php


class Reservasi extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->library('form_validation');
        $this->load->library('template');
    }

    public function reservasi()
    {
        $data['page']="Reservasi";
        $this->template->layout2('guest/reservasi/reservasi', $data);
    }
    public function pembatalan()
    {
        $data['page']="Pembatalan";
        $this->template->layout2('guest/reservasi/pembatalan', $data);
    }
    public function penjadwalan()
    {
        $data['page']="Penjadwalan";
        $this->template->layout2('guest/reservasi/penjadwalan', $data);
    }
}
?>