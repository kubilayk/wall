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
		//echo "email controller";
		$user_session = $this->session->userdata('email');
		//print_r($user_session);
		
		$user['email'] = $user_session[0]->email;
		function randomPassword() {
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
    	return implode($pass); //turn the array into a string
		}
		$user_password=randomPassword();
		//print_r($user_password);
		$this->user_model->update_user_password($user_password);
		//$user_info=$this->user_model->get_user_info($user_session[0]->user_id);
		//print_r($user_info[0]->username);
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
		$this->email->to($user_session[0]->email);
		$this->email->subject("Viveka Wall Kullanıcı Bilgileri");
		//$pass = $this->user_model->login($this->input->post());
		$this->email->message("Username=".$user_session[0]->username." Email=".$user_session[0]->email." Password=".$user_password);
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