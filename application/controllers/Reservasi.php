<?php


class Reservasi extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->library('form_validation');
        $this->load->library('template');
        $this->load->model('M_Galeri', 'galeri');
        $this->load->model('M_Kabupaten', 'kabupaten');
        $this->load->model('M_Layanan', 'layanan');
        $this->load->model('M_Reservasi', 'reservasi');
        $this->load->model('M_User', 'user');
    }

    public function reservasi()
    {
        $data['page']="Reservasi";
        $data['galeri'] = $this->galeri->get_by_where(array("is_active" => 1));
        $this->template->layout2('guest/reservasi/reservasi', $data);
    }

    public function create()
    {
        $idUser = $this->session->userdata('id');
   
        $data['page']="Reservasi";
        $data['user'] = $this->user->get_by_where_row(array("id" => $idUser));
        $data['layanan'] = $this->layanan->get_by_where(array("is_active" => 1));
        $data['kabupaten'] = $this->kabupaten->get_by_where(array("is_active" => 1));

        $config = [
            array(
                    'field' => 'kabupaten',
                    'label' => 'Kabupaten',
                    'rules' => 'required',
                    'errors' => array(
                            'required' => '%s harus dipilih',
                    ),
            ),
            array(
                'field' => 'tanggal_reservasi',
                'label' => 'Tanggal Reservasi',
                'rules' => 'required',
                'errors' => array(
                        'required' => '%s harus dipilih',
                ),
            ),
            array(
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => array(
                        'required' => '%s harus diisi',
                ),
            )
        ];

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE)
        {
            $this->template->layout2('guest/reservasi/form', $data);
        }
        else{
            $data = array(
                "id_user"       => $this->session->userdata('id'),
                "tgl_pesan"     => date('Y-m-d', strtotime($this->input->post('tanggal_reservasi'))),
                "alamat"        => $this->input->post('alamat'),
                "acara"         =>$this->input->post('acara'),
                "id_kabupaten"  =>$this->input->post('kabupaten'),
            );

            $this->reservasi->save($data); //mengambil fungsi dari M_User
        }
    }

    public function menu($id = null)
    {
        $data['page']="Layanan";
        $this->template->layout2('guest/reservasi/layanan', $data);
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