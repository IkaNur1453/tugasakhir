<?php


class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->library('form_validation');
        $this->load->library('template');
        $this->load->model('M_Reservasi', 'reservasi');
    }

    public function index()
    {
        $data['page']="Dashboard";
        $data['reservasi'] = $this->reservasi->getWhereKonfirmasiPembayaran(array("timestamp" => date("Y-m-d")));
        $this->template->layout('admin/dashboard/index', $data);
    }
}
?>