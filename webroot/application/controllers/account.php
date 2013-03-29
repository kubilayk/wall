<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('entry_model');
	}
	
	public function index()
	{
		$data['boolean']=$this->entry_model->is_logged_in();
			
			if($data['boolean'])
			{
				
				$session_data = $this->session->userdata('logged_in');
				//print_r($session_data['user_id']);
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
		     	$data['page_title']="Registration";	
				$this->load->view('registration_view', $data);
			}
			else
			{
				$data['guest'] = "Sign up";
		   		$this->load->model('entry_model');
				$data['page_title']="Registration";
				$this->load->view('registration_view', $data);
			}
	}
	public function login($msg = NULL)
	{
		$data['boolean']=$this->entry_model->is_logged_in();
			
			if($data['boolean'])
			{
				
				$session_data = $this->session->userdata('logged_in');
				//print_r($session_data['user_id']);
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
		     	$data['page_title']="User Login";	
				$data['msg'] = $msg;
				$data['page_title']="User Login";
				$this->load->view('login_view', $data);
			}
			else
			{
				$data['guest'] = "Sign up";
		   		$this->load->model('entry_model');
		   		$data['msg'] = $msg;
				$data['page_title']="User Login";
				$this->load->view('login_view', $data);
			}
	}
	
	public function user_login()
	{
		
		
		$tags =$this->input->post('username');
		$result = $this->user_model->login($this->input->post());
		if(! $result)
			{	$msg = '<font color=red>Invalid username and/or password.</font><br />';
				$this->login($msg);
			}
		else
		{

				
		if(empty($tags))
			{
				$msg = '<font color=red>Fill username and/or password.</font><br />';
				$this->login($msg);
			}
		else
			{
			
			redirect(base_url().'home');
			}
		}		
	}
	public function sign_up()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean|is_unique[users.username]');
		$this->form_validation->set_rules('email_address', 'Your Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]xss_clean');
		$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');

		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{

			$this->user_model->add_user($this->input->post());
			$this->login();
		}


	}
}
?>