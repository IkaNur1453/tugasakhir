<?php

class Layanan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Layanan', 'layanan');

        // library
        $this->load->library("template");

    }

    public function index()
    {
        $data['page'] = "Layanan";
        $this->template->layout('admin/layanan/index', $data);
    } 

    public function ajax_list()
    {
        $list = $this->layanan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $layanan) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $layanan->nama_layanan;
            $row[] = number_format($layanan->harga);
            //add html for action
            $row[] = '<a class="btn btn-outline-warning btn-sm" href="javascript:void(0)" title="Edit" onclick="editForm('."'".$layanan->id_layanan."'".')">Edit</a>
                  <a class="btn btn-outline-danger btn-sm" href="javascript:void(0)" title="Hapus" onclick="deleteData('."'".$layanan->id_layanan."'".')">Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->layanan->count_all(),
            "recordsFiltered" => $this->layanan->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_add()
    {
        $category = $this->layanan->get_by_where(array("nama_layanan" => strtoupper($this->input->post('layanan'))));

        if($category){
            echo json_encode(array("status" => TRUE, "msg" => "fail"));
        }
        else
        {
            $data = array(
                    'nama_layanan'  => strtoupper($this->input->post('layanan', true)),
                    'harga'           => $this->input->post('harga', true),
                );
    
            $insert = $this->layanan->save($data);
            echo json_encode(array("status" => TRUE, "msg" => "suceess"));
        }

    }

    public function ajax_edit($id)
    {
        $data = $this->layanan->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {  
        $data = array(
            'nama_layanan' 		=> strtoupper($this->input->post('layanan')),
            'harga'                 => $this->input->post('harga'),
        );

        $this->layanan->update(array('id_layanan' => $this->input->post('id_layanan')), $data);
        echo json_encode(array("status" => TRUE, "msg" => "suceess"));
        
    }

    public function ajax_soft_delete($id)
    {
        //delete file
        $data['is_active'] = "0";
        $this->layanan->update(array('id_layanan' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function getAll()
    {
        $layanan = $this->layanan->get_by_where(array("is_active" => 1));
        
        echo json_encode($layanan);
    }

    public function getById($id)
    {
        $layanan = $this->layanan->get_by_id($id);

        echo json_encode($layanan);
    }

}