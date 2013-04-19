<?php
 
class Email extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	
	}
	
	
	 function index(){			
		// Email configuration
		$config = Array(
			  'protocol' => "smtp",
			  'smtp_host' => 'ssl://smtp.googlemail.com',
			  'smtp_port' => 465,
			  'smtp_user' => "wall.vivekalab@gmail.com", // change it to yours
			  'smtp_pass' => "wall.vivekalab.com", // change it to yours
			  'mailtype' => "html",
			  'charset' => "iso-8859-1",
			  'wordwrap' => TRUE
		);	
	
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$this->email->from("wall.vivekalab@gmail.com", "Ali Mert Çelik");
		$this->email->to("celik.alimert@hotmail.com");
		$this->email->subject("Viveka Wall Parola Hatırlatma");
		//$pass = $this->user_model->login($this->input->post());
		$this->email->message("Parolanız");
		 if($this->email->send())
        {
            echo 'your email was sent, fool';
        }
        else {
        show_error($this->email->print_debugger());
        }
		 				
			
	}

}
?>