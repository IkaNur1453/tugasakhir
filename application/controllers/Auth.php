<?php

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->library('form_validation');
        $this->load->model('M_User', 'user');
    }

    public function login($param)
    {
        $config = [
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required',
                'error' => array(
                    'requred' =>'Form %s harus diisi',
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'error' => array(
                    'required' => 'Form %s harus diisi',
                ),
            )
        ];

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE)
        {
            if($param == 'administrator')
            {
                $this->load->view('admin/auth/login');
            }
            else{

            }
        }
        else{
            $this->_proses_login();
        }
    }
    private function _proses_login()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        $level = $this->input->post('level', true);

        $checkLogin = $this->user->get_by_where_row(array("username" => $username));

        if($checkLogin)
        {
            if(password_verify($password, $checkLogin->password))
            {
                if($level == $checkLogin->level){
                    $data = [
                        'id'           => $checkLogin->id,
                        'username'     => $checkLogin->username,
                        'level'        => $checkLogin->level,
                        'is_logged_in' => true
                    ];
                    $this->session->set_userdata($data);

                    redirect('dashboard','refresh');
                    //echo "login berhasil";
                }
                else{
                    $this->session->set_flashdata('fail', ' <div class="alert alert-danger" role="alert">Maaf Level anda tidak bisa mengakses ini !</div>');

                    redirect('admin');
                }
            }
            else{
                $this->session->set_flashdata('fail', ' <div class="alert alert-danger" role="alert">Maaf password anda salah !</div>');

                redirect('admin');
            }
        }
        else{
            $this->session->set_flashdata('fail', ' <div class="alert alert-danger" role="alert">Maaf akun anda tidak ada disini !</div>');

            redirect('admin');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('is_logged_in');
        $this->session->unset_userdata('nama');
        $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible"><button type "button" class="close" data-dismiss="alert"><span>&times;</span></button> Akun anda berhasil logout !!!</div>');

        redirect('home');
    }
}
?>