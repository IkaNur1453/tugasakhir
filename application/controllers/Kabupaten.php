<?php

class Kabupaten extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Kabupaten', 'kabupaten');

        // library
        $this->load->library("template");

    }

    public function index()
    {
        $data['page'] = "Kabupaten";
        $this->template->layout('admin/kabupaten/index', $data);
    } 

    public function ajax_list()
    {
        $list = $this->kabupaten->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $kabupaten) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $kabupaten->nama_kabupaten;
            $row[] = number_format($kabupaten->harga);
            //add html for action
            $row[] = '<a class="btn btn-outline-warning btn-sm" href="javascript:void(0)" title="Edit" onclick="editForm('."'".$kabupaten->id_kabupaten."'".')">Edit</a>
                  <a class="btn btn-outline-danger btn-sm" href="javascript:void(0)" title="Hapus" onclick="deleteData('."'".$kabupaten->id_kabupaten."'".')">Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->kabupaten->count_all(),
            "recordsFiltered" => $this->kabupaten->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_add()
    {
        $category = $this->kabupaten->get_by_where(array("nama_kabupaten" => strtoupper($this->input->post('kabupaten'))));

        if($category){
            echo json_encode(array("status" => TRUE, "msg" => "fail"));
        }
        else
        {
            $data = array(
                    'nama_kabupaten'  => strtoupper($this->input->post('kabupaten', true)),
                    'harga'           => $this->input->post('harga', true),
                );
    
            $insert = $this->kabupaten->save($data);
            echo json_encode(array("status" => TRUE, "msg" => "suceess"));
        }

    }

    public function ajax_edit($id)
    {
        $data = $this->kabupaten->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {  
        $data = array(
            'nama_kabupaten' 		=> strtoupper($this->input->post('kabupaten')),
            'harga'                 => $this->input->post('harga'),
        );

        $this->kabupaten->update(array('id_kabupaten' => $this->input->post('id_kabupaten')), $data);
        echo json_encode(array("status" => TRUE, "msg" => "suceess"));
        
    }

    public function ajax_soft_delete($id)
    {
        //delete file
        $data['is_active'] = "0";
        $this->kabupaten->update(array('id_kabupaten' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

}