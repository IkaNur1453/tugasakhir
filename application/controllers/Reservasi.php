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

        $this->load->helper('all');
    }

    public function index()
    {
        $data['page'] = "Reservasi";
        $this->template->layout('admin/reservasi/index', $data);
    }

    public function reservasi()
    {
        $data['page']="Reservasi";
        $data['galeri'] = $this->galeri->get_by_where(array("is_active" => 1));
        $this->template->layout2('guest/reservasi/reservasi', $data);
    }

    public function ajax_list()
    {
        $list = $this->reservasi->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $reservasi) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $reservasi->nama;
            $row[] = $reservasi->acara;
            $row[] = $reservasi->tgl_pesan;
            $row[] = $reservasi->nama_kabupaten;
            $row[] = $reservasi->alamat;
            $row[] = "Rp.".number_format($reservasi->dp).",00";

            if($reservasi->status == "dibatalkan" || $reservasi->status == "expire")
            {
                $row[] = '<i class="text-danger fas fa-circle"></i> '.$reservasi->status;
            }
            else if($reservasi->status == "belum")
            {
                $row[] = '<i class="text-warning fas fa-circle"></i> '.$reservasi->status;
            }
            else if($reservasi->status == "sudah")
            {
                $row[] = '<i class="text-success fas fa-circle"></i> '.$reservasi->status;
            }
            else if($reservasi->status == "menunggu")
            {
                $row[] = '<i class="text-warning fas fa-circle"></i> '.$reservasi->status;
            }
        
            //add html for action
            $row[] = '<a class="btn btn-outline-success" href="'.base_url('reservasi/detail/'.$reservasi->id).'"> Detail </a>';
         
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->reservasi->count_all(),
            "recordsFiltered" => $this->reservasi->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
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
            ),
        ];

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE)
        {
            $this->template->layout2('guest/reservasi/form', $data);
        }
        else{
            $data = array(
                "id_user"                       => $this->session->userdata('id'),
                "tgl_pesan"                     => date('Y-m-d', strtotime($this->input->post('tanggal_reservasi'))),
                "tanggal_berakhir_pembayaran"   => date('Y-m-d H:i:s', strtotime('+1 day', time())),
                "alamat"                        => $this->input->post('alamat'),
                "acara"                         => $this->input->post('acara'),
                "dp"                            => $this->input->post('dp', true),
                "status_pembayaran"             => $this->input->post('pembayaran'),
                "id_kabupaten"                  =>$this->input->post('kabupaten'),
                "invoice"                       => random_strings(16)
            );

            $reservasi = $this->reservasi->save($data); //mengambil fungsi dari M_User

            $layanan = $this->input->post('layanan', true);

            foreach($layanan as $layanan)
            {
                $dataLayanan = [
                    "id_reservasi"  => $reservasi,
                    "id_layanan"    => $layanan,
                ];

                $detailReservasi = $this->reservasi->saveDetail($dataLayanan);
            }
            
            $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">
            Reservasi Berhasil disimpan. Silahkan menunggu konfirmasi dari kami.Terimakasih!
          </div>');
            redirect('reservasi/checkout/'.$reservasi,'refresh');
            
        }
    }

    /**
     * Menu Checkout menggunakan id reservasi guna mengambil dana 
     */

    public function checkout($id)
    {
        if($this->session->userdata('is_logged_in') != true)
        {
            redirect('home');
        }

        $data['page']= "Pembayaran";
        $data['user'] = $this->user->get_by_where_row(array("id" => $this->session->userdata('id')));
        $data['reservasi'] = $this->reservasi->get_by_where_row(array("id" => $id));
        $data['detailReservasi'] = $this->reservasi->getDetailByIdReservasi($id);

        $totalBayarReservasi = 0;

        foreach($data['detailReservasi'] as $row){
            $totalBayarReservasi += $row->harga;
        }

        $data['totalPembayaran'] = $totalBayarReservasi +  $data['reservasi']->harga;

        /**
         * Rules form disimpan kedalam variable $config
         * berfungsi sebagai validasi dari form tersebut
         */

        $config = [
            array(
                'field' => 'pembayaran',
                'label' => 'Metode Pembayaran',
                'rules' => 'required',
                'errors' => array(
                        'required' => '%s harus diisi',
                ),
            ),
        ];

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() === FALSE)
        {
            $this->template->layout2('guest/reservasi/checkout', $data);
        }
        else 
        {
            $data = [
                "status_pembayaran" => $this->input->post("pembayaran", true),
                "dp"                => $this->input->post("dp", true)
            ];

            $this->reservasi->update(array("id" => $id), $data);       
            redirect('reservasi/info/'.$id,'refresh');
        }

    }

    public function getReservasiByInvoice()
    {
        $invoice = $this->input->post('invoice', true);
        $getReservasi= $this->reservasi->get_by_where_row(array("invoice" => $invoice));

        if($getReservasi)
        {
            echo json_encode(array("status" => 201, "data" => $getReservasi));
        }
        else{
            echo json_encode(array("status" => 404, "message" => "Not Found"));
        }
    }

    public function detail($id)
    {
        $data['page'] = 'Detail Reservasi';
        $data['reservasi'] = $this->reservasi->get_by_where_row(array("id" => $id));
        $data['detailReservasi'] = $this->reservasi->getDetailByIdReservasi($id);
        $data['konfirmasi'] = $this->reservasi->getKonfirmasiPembayaranByIdReservasi($id);
        $this->template->layout('admin/reservasi/detail', $data);
    }

    public function info($id)
    {
        $data['page'] = 'Infromasi Reservasi';
        $data['reservasi'] = $this->reservasi->get_by_where_row(array("id" => $id));

        $this->template->layout2('guest/reservasi/info', $data);
    }

    /**
     * =======================================================
     * Langkah logika pembabilan data sampai dengan transaksi
     * =======================================================
     * 1. Ambil data Reservasi menggunakan id reservasi yang disimpan didalam variable $id
     * 2. Menampilkan halaman konfirmasi pembayaran 
     * 3. Cek proses Waktu pembayaran apakah masih ada waktu pembayaran
     * 4. Jika sudah tidak bisa maka tidak bisa muncul pesan timeout pembayaran
     * 5. Jika masih bisa melakukan konfimasi pembayaran pembayaran
     * 6. Selesai 
     * 
    */

    public function konfirmasiPembayaran()
    {	
        if($this->session->userdata('is_logged_in') != true)
        {
            redirect('home');
        }

        $data['page']= "Konfimasi Pembayaran";
      

        $this->template->layout2('guest/reservasi/konfirmasiPembayaran', $data);
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

    public function prosesKonfirmasi()
    {
        $config = [
            array(
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => array(
                    "required" => "Form %s harus diisi"
                )
            ),
            array(
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'required',
                'errors' => array(
                    "required" => "Form %s harus diisi"
                )
            ),
            array(
                'field' => 'tanggal_pembayaran',
                'label' => 'Tanggal Pembayaran',
                'rules' => 'required',
                'errors' => array(
                    "required" => "Form %s harus diisi"
                )
            ),
            array(
                'field' => 'jumlah',
                'label' => 'Jumlah',
                'rules' => 'required',
                'errors' => array(
                    "required" => "Form %s harus diisi"
                )
            ),
            array(
                'field' => 'bank_tujuan',
                'label' => 'Bank Tujuan',
                'rules' => 'required',
                'errors' => array(
                    "required" => "Form %s harus diisi"
                )
            ),
            array(
                'field' => 'namaRek',
                'label' => 'Nama Rekening',
                'rules' => 'required',
                'errors' => array(
                    "required" => "Form %s harus diisi"
                )
            ),
            array(
                'field' => 'invoice',
                'label' => 'Invoice',
                'rules' => 'required',
                'errors' => array(
                    "required" => "Form %s harus diisi"
                )
            ),
            array(
                'field' => 'pesan',
                'label' => 'Pesan',
                'rules' => 'required',
                'errors' => array(
                    "required" => "Form %s harus diisi"
                )
            ),
            array(
                'field' => 'bukti',
                'label' => '',
                'rules' => 'callback_checkFileBuktiBayar',
            ),
        ];
      
           
        $this->form_validation->set_rules($config);

        if($this->form_validation->run() === FALSE)
        {
            $this->konfirmasiPembayaran();
        }
        else{
            $invoice = $this->input->post('invoice', true);

            $getReservasi = $this->reservasi->get_by_where_row(array("invoice" => $invoice));

            if($getReservasi)
            {
                $data = [
                    "nama"                  => $this->input->post('nama'),
                    "id_reservasi"          => $getReservasi->id,
                    "email"                 => $this->input->post('email'),
                    "tanggal_pembayaran"    => date('Y-m-d'),
                    "jumlah"                => $this->input->post('jumlah'),
                    "bank"                  => $this->input->post('bank_tujuan'),
                    "nama_rek"              => $this->input->post('namaRek'),
                    "no_invoice"            => $invoice,
                    "pesan"                 => $this->input->post('pesan'),    
                ];
    
                if(!empty($_FILES['bukti']['name']))
                {
                    $uploadBukti= $this->_uploadBuktiBayar();
                    $data['bukti_pembayaran'] = $uploadBukti;
                }
    
                $this->reservasi->saveKonfirmasiPembayaran($data);
                
                $reservasi['status'] = "menunggu";
                
                $this->reservasi->update(array("id" => $getReservasi->id), $reservasi);

                redirect('reservasi/finish/'.$getReservasi->id);
            }
            else{
                $this->konfirmasiPembayaran();
            }
        }
    }

    public function prosesPembatalan($id)
    {
        $data = [
            "status"            => "dibatalkan",
            "tgl_pembatalan"    => date('Y-m-d'),
            "alasan_pembatalan" => $this->input->post('pembatalan')
        ]; 

        $this->reservasi->update(array("id" => $id), $data);

        echo json_encode(array("status" => 201));
    }

    public function updateKonfirmasi($id)
    {
        $data['status'] = $this->input->post('status_pembayaran', true);

        $this->reservasi->update(array('id' => $id), $data);

        echo json_encode(array('status' => 201));
    }

    public function finish($id)
    {
        $getReservasi = $this->reservasi->get_by_where_row(array("id" => $id, "status" => "menunggu"));
        $data['page']= "Finish";

        if($getReservasi)
        {
            $data['pesan'] = '<h2>Terimakasih atas pembayaran anda </h2><p>Silahkan menunggu proses konfirmasi dari admin kami. Kami akan segera menghubungin melalui e-mail yang anda kirimkan.Terimakasih.</p>';
        }
        else
        {
            $data["pesan"] = '<h1 class="text-danger">MAAF RESERVASI ANDA SUDAH TIDAK TERSEDIA LAGI !!!</h1>';
        }

        $this->template->layout2('guest/reservasi/terimakasih', $data);
    }

    private function _uploadBuktiBayar()
    {
        $config['file_name']   = date('dmYHisu');
		$config['upload_path'] = './uploads/bukti_bayar/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size'] = '6000';
		$this->load->library('upload', $config, 'bukti'); // Custom Upload Sertifikat Keahlian
		$this->bukti->initialize($config);

		if ($this->bukti->do_upload('bukti')) {
			return $this->bukti->data('file_name');
		}
		else{
			return " ";
		}
    }

    public function checkFileBuktiBayar($str)
    {
        $check = TRUE;   
	    if (isset($_FILES['bukti']) && $_FILES['bukti']['size'] != 0) {
	        $allowedExts = array("jpg", "png", "JPG", "PNG");
	        $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG);
	        $extension = pathinfo($_FILES["bukti"]["name"], PATHINFO_EXTENSION);
	        $detectedType = exif_imagetype($_FILES['bukti']['tmp_name']);
	        $type = $_FILES['bukti']['type'];
	        if (!in_array($detectedType, $allowedTypes)) {
	            $this->form_validation->set_message('checkFileBuktiBayar', 'File yang diupload berupa image/gambar');
	            $check = FALSE;
	        }
	        if(filesize($_FILES['bukti']['tmp_name']) > 500000) {
	            $this->form_validation->set_message('checkFileBuktiBayar', 'Batas Upload denah masksiman 5 mb');
	            $check = FALSE;
	        }
	        if(!in_array($extension, $allowedExts)) {
	            $this->form_validation->set_message('checkFileBuktiBayar', "Invalid file extension {$extension}");
	            $check = FALSE;
	        }
	    }
	    else{
	    	$this->form_validation->set_message('checkFileBuktiBayar', "Bukti Pembayaran harus diisi");
	            $check = FALSE;
	    }
	    return $check;
    }
}
?>