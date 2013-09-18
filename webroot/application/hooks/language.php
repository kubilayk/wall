<?php

class language{
    private $CI;

    function __construct() {
        $this->CI =& get_instance();
    }
    function select_language(){
        if (isset($_GET['lang']) && $_GET['lang'] == "tr"){
            $this->CI->session->set_userdata(array('lang'=>"tr"));
        }else if (isset($_GET['lang']) && $_GET['lang'] == "en"){
            $this->CI->session->set_userdata(array('lang'=>"en"));
        }

        if ($this->CI->session->userdata('lang') == "tr"){
            $this->CI->lang->load("turkish", "turkish");
            $this->CI->config->set_item('language', 'turkish');
        }else{
            $this->CI->lang->load("english", "english");
            $this->CI->config->set_item('language', 'english');
        }
    }
}