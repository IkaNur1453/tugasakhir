<?php


class Login extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();

        $this->load->library('form_validation');
        $this->load->library('template');
        $this->load->model('M_User','user');
    }

    public function index()
    {
        $data['page']="Login";

        $config = [
            array(
                'field' => 'email',
                'label' => 'E-mail',
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
                $this->load->view('guest/login/index', $data);
        }
        else{
            $this->_proses_login();
        }
        
    }
   
    private function _proses_login()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $level = $this->input->post('level', true);

        $checkLogin = $this->user->get_by_where_row(array("email" => $email));

        if($checkLogin)
        {
            if(password_verify($password, $checkLogin->password))
            {
                if($level == $checkLogin->level){
                    $data = [
                        'id'           => $checkLogin->id,
                        'level'        => $checkLogin->level,
                        'nama'         => $checkLogin->nama,
                        'is_logged_in' => true
                    ];
                    $this->session->set_userdata($data);

                    redirect('home','refresh');
                    //echo "login berhasil";
                }
                else{
                    $this->session->set_flashdata('fail', ' <div class="alert alert-danger" role="alert">Maaf Level anda tidak bisa mengakses ini !</div>');

                    redirect('login');
                }
            }
            else{
                $this->session->set_flashdata('fail', ' <div class="alert alert-danger" role="alert">Maaf password anda salah !</div>');

                redirect('login');
            }
        }
        else{
            $this->session->set_flashdata('fail', ' <div class="alert alert-danger" role="alert">Maaf akun anda tidak ada disini !</div>');

            redirect('login');
        }
    }
}
?>