<?php


class Register extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->library('form_validation');
        $this->load->library('template');
        $this->load->model('M_User', 'user');
        $this->load->helper('All');
    }

    public function index()
    {
        $data['page']="Login";
        $this->load->view('guest/register/index', $data);
    }

    public function store()
    {
        $config = array(
            array(
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'required|is_unique[users.username]'
            ),
            array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'required|min_length[8]',
                    'errors' => array(
                            'required' => 'You must provide a password.',
                    ),
            ),
            array(
                    'field' => 'nama',
                    'label' => 'Nama',
                    'rules' => 'required'
            ),
            array(
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'required'
            ),
            array(
                'field' => 'no_hp',
                'label' => 'No.HP',
                'rules' => 'required'
            ),
            array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required'
            )
        );
    
        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE)
        {
           $this->index();
        }
        else
        {
            $data=array(
                "username" => $this->input->post('username'),
                "password" => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
                "level" => 3, //karena sebagai user=3
                "nama" => $this->input->post('nama'),
                "alamat" => $this->input->post('alamat'),
                "no_hp" =>$this->input->post('no_hp'),
                "email" =>$this->input->post('email'),
                
            );

            $this->user->save($data); //mengambil fungsi dari M_User

        }

        redirect('home');


    }

    function tmail(){
        kirim_email('hendrawankevin97@gmail.com', 'TEST EMAIL', "<p>COBA EMAIL</p>");
    }
}
?>