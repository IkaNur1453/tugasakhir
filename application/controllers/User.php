<?php 

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_User', 'user');
        $this->load->library('template');
    }

    public function index()
    {
        $data['page'] = 'Pelanggan';
        $this->template->layout('admin/pelanggan/index', $data);
    }

    public function ajax_list()
    {
        $list = $this->user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $user->nama;
            $row[] = $user->no_hp;
            $row[] = $user->alamat;
            $row[] = $user->email;
            $row[] = $user->username;
           
			//add html for action
            $row[] = '<a class="btn btn-sm btn-outline-success" target="_blank" href="'.base_url('user/detail/'.$user->id).'">Detail</a>';
            
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user->count_all(),
            "recordsFiltered" => $this->user->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
		
    public function detail($id)
    {
        $data['page'] = 'Detail Pelanggan';
        $data['user'] = $this->user->get_by_where_row(array("id" => $id));
        $this->template->layout('admin/pelanggan/detail', $data);
    } 
}