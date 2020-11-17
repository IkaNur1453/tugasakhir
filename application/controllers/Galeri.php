<?php

class Galeri extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_Galeri', 'galeri');

        $this->load->library('template');
    }

    public function index()
    {
        $data['page'] = "Galeri";
        $this->template->layout('admin/galeri/index', $data);
    }

    public function ajax_list()
    {
        $list = $this->galeri->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $galeri) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $galeri->judul;
            $row[] = $galeri->deskripsi;
            $row[] = '<img src="'.base_url('uploads/galeri/'.$galeri->file).'" class="img-thumbnail">';
            //add html for action
            $row[] = '<a class="btn btn-outline-warning btn-sm" href="javascript:void(0)" title="Edit" onclick="editForm('."'".$galeri->id."'".')">Edit</a>
                  <a class="btn btn-outline-danger btn-sm" href="javascript:void(0)" title="Hapus" onclick="deleteData('."'".$galeri->id."'".')">Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->galeri->count_all(),
            "recordsFiltered" => $this->galeri->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_add()
    {
        $this->_validate();
        $data = array(
            'deskripsi'    => $this->input->post('deskripsi', true),
            'judul'        => $this->input->post('judul', true),
        );

        if(!empty($_FILES['gambar']['name']))
        {
            $upload = $this->_do_upload();
            $data['file'] = $upload;
        }

        $insert = $this->galeri->save($data);
        echo json_encode(array("status" => TRUE, "msg" => "suceess"));
    }

    public function ajax_edit($id)
    {
        $data = $this->galeri->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {  
        $this->_validate();
        $data = array(
            'deskripsi'    => $this->input->post('deskripsi', true),
            'judul'        => $this->input->post('judul', true),
        );

        if(!empty($_FILES['gambar']['name']))
        {
            $upload = $this->_do_upload();
             
            //delete file
            $galeri = $this->galeri->get_by_id($this->input->post('id'));
            if(file_exists('uploads/galeri/'.$galeri->file) && $galeri->file)
                unlink('uploads/galeri/'.$galeri->file);
 
            $data['file'] = $upload;
        }

        $this->galeri->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE, "msg" => "suceess"));
        
    }

    public function ajax_soft_delete($id)
    {
        //delete file
        $data['is_active'] = "0";
        $this->galeri->update(array('id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload()
    {
        $config['upload_path']          = 'uploads/galeri/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 5000; //set max size allowed in Kilobyte
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
 
        if(!$this->upload->do_upload('gambar')) //upload and validate
        {
            $data['inputerror'][] = 'gambar';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('deskripsi') == '')
        {
            $data['inputerror'][] = 'deskripsi';
            $data['error_string'][] = 'Deskripsi Barang harus diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('judul') == '')
        {
            $data['inputerror'][] = 'judul';
            $data['error_string'][] = 'Judul harus diisi';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}