<?php

class Template{
    protected $_ci;

    function __construct(){
        $this->_ci = &get_instance();
    } 

    function layout($content, $data = NULL){
        $data['header'] = $this->_ci->load->view('admin/template/header',$data, true);
        $data['navbar'] = $this->_ci->load->view('admin/template/navbar',$data, true);
        $data['sidebar'] = $this->_ci->load->view('admin/template/sidebar',$data, true);
        $data['content'] = $this->_ci->load->view($content,$data,true);

        $this->_ci->load->view('admin/template/index', $data);

    }
    
    function layout2($content, $data = NULL){
        $data['header'] = $this->_ci->load->view('guest/template/header',$data, true);
        $data['content'] = $this->_ci->load->view($content,$data,true);

        $this->_ci->load->view('guest/template/index', $data);

    }
}