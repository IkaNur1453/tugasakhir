<?php 

function htmlMail($emailCompany, $subject, $message, $attachment = null){
    $CI = &get_instance();

    //setup SMTP configurion
    $config = Array(    
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.gmail.com',
        'smtp_user' => 'hendrawankevin97@gmail.com',
        'smtp_pass' => 'kxodjfyersoxofgk',
        'smtp_port' => 465,
        'mailtype' => 'html',
        'charset' => 'utf-8',
        'newline' => "\r\n",
    );

    $CI->load->library('email', $config); // Load email template
    // $CI->email->set_newline("\r\n");
    $CI->email->from('hendrawankevin97@gmail.com', 'NOT-REPLY');

    $CI->email->to($emailCompany); // replace it with receiver email id
    $CI->email->subject($subject); // replace it with email subject

    $CI->email->message($message); 
    $CI->email->send();

    if ($CI->email->send()) {
        # code...
        return true;
    }
}

function is_login()
{
    if(!$this->session->userdata('is_logged_in'))
    {
        redirect('admin');
    }
}

function is_admin()
{
    if($this->session->userdata('level') != 1)
    {
        redirect('home');
    }
}

function random_strings($length_of_string) 
{ 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
    return substr(str_shuffle($str_result),0, $length_of_string); 
} 