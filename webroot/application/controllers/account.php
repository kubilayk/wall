<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('entry_model');
		if (isset($_SERVER['HTTP_REFERER']))
 {
 $this->session->set_userdata('previous_page', $_SERVER['HTTP_REFERER']);
 }
 else
 {
 $this->session->set_userdata('previous_page', base_url());
 }
	}
	
	public function index()
	{
		$data['boolean']=$this->entry_model->is_logged_in();
			
			if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
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
			
			if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
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
				//$uri= $this->input->post('uri');
				//print_r($_SERVER['HTTP_REFERER']);
				if($_SERVER['HTTP_REFERER'] == base_url().'account')
				{
					redirect(base_url().'home');
				}
				else if($_SERVER['HTTP_REFERER'] == base_url().'account/user_login')
				{
					redirect(base_url().'home');
				}
				else
				{
				
				redirect($this->session->userdata('previous_page'));
				}
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
	public function change_password($msg = NULL)
	{
		$id_u= $this->uri->segment(3);
		$data['boolean']=$this->entry_model->is_logged_in();
			
			if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{
				
				$session_data = $this->session->userdata('logged_in');
				//print_r($msg);
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				$data['user_info']=$this->user_model->get_user_info($id_u);
		     	$data['page_title']="User Profile Information";	
				$data['msg'] = $msg;
				$data['page_title']="User Login";
				//print_r($data['msg']);
				//print_r($session_data['user_id']);
				if($session_data['user_id'] == $data['user_info'][0]->user_id)
				{
					$this->load->view('update_user_pass_view', $data);
				}
				else
				{
					redirect(base_url().'home');
				}
				
			}
			
	}
	public function change_password_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]xss_clean');
		$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');
		$result = $this->user_model->login($this->input->post());
		//print_r($this->input->post());
		//print_r($result);
		if($this->form_validation->run() == FALSE || !$result)
		{
			//echo "false";
			$msg = 'Invalid password.<br />';
			$this->change_password($msg);
		}
		else
		{
			$id_u= $this->uri->segment(3);
		$data['boolean']=$this->entry_model->is_logged_in();
			
			if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{
				
				$session_data = $this->session->userdata('logged_in');
				//print_r($msg);
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				$data['user_info']=$this->user_model->get_user_info($id_u);
		     	$data['page_title']="User Profile Information";	
				$data['msg'] = "";
				$data['page_title']="Change Password";
				//print_r($data['msg']);
				//print_r($session_data['user_id']);
				if($session_data['user_id'] == $data['user_info'][0]->user_id)
				{
					$this->load->view('change_user_pass_view', $data);
				}
				else
				{
					redirect(base_url().'home');
				}
				
			}
		}


	}
	public function change_password_user()
	{
		$id_u= $this->uri->segment(3);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]xss_clean');
		$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');
		
		//print_r($this->input->post());
		//print_r($result);
		if($this->form_validation->run() == FALSE )
		{
			//echo "false";
			
			$this->change_password_user_validate();
		}
		else
		{
			$user_password = $this->input->post('password');
			$this->user_model->change_user_password($user_password);
			redirect(base_url().'home');
			//$this->user_model->update_user_password($user_password);
			//$this->login();
		}


	}
	public function change_password_user_validate()
	{
		$data['boolean']=$this->entry_model->is_logged_in();
			
			if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{
				
				$session_data = $this->session->userdata('logged_in');
				//print_r($session_data['user_id']);
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
		     	$data['page_title']="Change Password";	
				$this->load->view('change_user_pass_view', $data);
			}
	}

	public function profile_info()
	{
		$id_u= $this->uri->segment(3);
		$data['boolean']=$this->entry_model->is_logged_in();
			
			if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{
				
				$session_data = $this->session->userdata('logged_in');
				//print_r($session_data['user_id']);
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				$data['user_info']=$this->user_model->get_user_info($id_u);
		     	$data['page_title']="User Profile Information";	
				$data['msg'] = "";
				if($session_data['user_id'] == $data['user_info'][0]->user_id)
				{
					$this->load->view('update_user_info_view', $data);
				}
				else
				{
					redirect(base_url().'home');
				}
			}
			
	}

	public function update_profile_validate()
	{
		
		
		$tags =$this->input->post('user_name');
		$session_data = $this->session->userdata('logged_in');
		$data['username'] = $session_data['username'];
		//print_r($session_data);
		$data['email'] = $session_data['email'];
		$data['user_id'] = $session_data['user_id'];
		
		if($data['username'] == $this->input->post('user_name') && $data['email']==$this->input->post('email_address') )
		{
			//echo "ayni";
			redirect(base_url().'home');
		}
		else
		{
			if(empty($tags))
			{
				//echo "tags boş";
				$msg = '<font color=red>Fill username and/or email.</font><br />';
				$this->update_profile($msg);
			}
		else{
			$result = $this->user_model->get_user_update($this->input->post());
			if($result)
			{		
				//echo "!result";
				$msg = '<font color=red> Username and/or email is taken.</font><br />';
				$this->update_profile($msg);;
			}
		
			else
			{
				//echo "result";
				//$uri= $this->input->post('uri');
				//print_r($_SERVER['HTTP_REFERER']);
				//print_r($result);
				$this->user_model->update_user($this->input->post());
				redirect(base_url().'home/user_info/'.$data['user_id'],'location');
				
			}
		}
			}

			
		
		
	}

	public function update_profile($msg = NULL)
	{
			$data['boolean']=$this->entry_model->is_logged_in();
			//echo "update_profile";
			if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{
				
				$session_data = $this->session->userdata('logged_in');
				//print_r($session_data);
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
		     	$data['page_title']="User Profile Update";	
				$data['msg'] = $msg;
				
				$this->load->view('update_user_info_view', $data);
			}
			
	}
	public function forget_password($msg = NULL)
	{			
		$data['boolean']=$this->entry_model->is_logged_in();
			
			if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{
				
				$session_data = $this->session->userdata('logged_in');
				//print_r($session_data['user_id']);
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
		     	$data['page_title']="User Login";	
				$data['msg'] = $msg;
				$data['page_title']="User Login";
				$this->load->view('forget_password_view', $data);
			}
			else
			{
				$data['guest'] = "Sign up";
		   		$this->load->model('entry_model');
		   		$data['msg'] = $msg;
				$data['page_title']="User Login";
				$this->load->view('forget_password_view', $data);
			}


			
	}

	public function send_email()
	{
		
		
		$tags =$this->input->post('email');
		//print_r($tags);
		
		if(empty($tags))
			{
				$msg = '<font color=red>Fill email field.</font><br />';
				$this->forget_password($msg);
			}
		else{
			$result = $this->user_model->get_user_email($this->input->post('email'));
			if(!$result)
			{	
				
				$msg = '<font color=red>Invalid e-mail.</font><br />';
				$this->forget_password($msg);
			}
		
			else
			{
				//$uri= $this->input->post('uri');
				//print_r($_SERVER['HTTP_REFERER']);
				//print_r($result);
				$this->session->set_userdata('email',$result);
				redirect(base_url().'email');
				
			}
		}	
	}
}
?>