<?php
 
class Home extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('entry_model');
		$this->load->model('comment_model');
		$this->load->model('user_model');
		$this->load->model('notification_model');
		$this->load->library('pagination');
		if (isset($_SERVER['HTTP_REFERER']))
         {
            $this->session->set_userdata('previous_page', $_SERVER['HTTP_REFERER']);
         }
         else
         {
            $this->session->set_userdata('previous_page', base_url());
         }
  
		
	}

	function index()
	{

            $data['boolean']=$this->entry_model->is_logged_in();
			if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{
				$config = array();
		        $config['base_url'] = base_url() . "/home";
		        $config['total_rows'] = $this->entry_model->record_count();
		        $config['per_page'] = 15;
		        $config['uri_segment'] = 2;
		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		        $session_data = $this->session->userdata('logged_in');
				//print_r($session_data['user_id']);
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
		     	$data['page_title']="Home";		
				$data['question']=$this->entry_model->get_all_question($config['per_page'],$page);
				$data['links'] = $this->pagination->create_links();
				$data['notification']=$this->notification_model->get_user_notification($session_data['user_id']);
				//print_r($data['notification'][0]->total_not);
				//print_r($data['question']);
				//foreach($data['question'] as $question)
					//echo  $question->last_vote[0]->username; 
				//$data['total_comment'] = $this->comment_model->total_comment($data['question']);

				$this->load->view('home_view',$data);

			}
			  else

		    {
		   		$config = array();
		        $config['base_url'] = base_url() . "/home";
		        $config['total_rows'] = $this->entry_model->record_count();
		        $config['per_page'] = 12;
		        $config['uri_segment'] = 2;
		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		   		$data['guest'] = "Sign up";
		   		$this->load->model('entry_model');
				$data['page_title']="Home";		
				$data['question']=$this->entry_model->get_all_question($config['per_page'],$page);
				$data['links'] = $this->pagination->create_links();
				$this->load->view('home_view',$data);

   			}


   	}

	

	function rate()
	{
		$data['entry_id']=$this->input->post('entry_id');

		//print_r($data);
		
		
		$this->entry_model->user_rate($this->input->post());
		$data['rate_count']= $this->entry_model->rate_count($this->input->post());
	   	$this->entry_model->rate_insert($data);
	   	//print_r($this->input->post());
	  	 redirect($this->session->userdata('previous_page'));
		/*if($this->input->post('view')=="entry"){
				redirect(base_url().'entry/'.$data['entry_id'], 'location');
		}else if($this->input->post('view')=="comment"){
				redirect(base_url().'home/last_comments', 'location');
		}else if($this->input->post('view')=="user_question"){
				redirect(base_url().'home/user_question/'.$this->input->post('user'), 'location');
		}else if($this->input->post('view')=="user_comment"){
				redirect(base_url().'home/user_comment/'.$this->input->post('user'), 'location');
		}else if($this->input->post('view')=="search"){
				redirect(base_url().'home/search?search='.$this->input->post('search'), 'location');		
		}else{
				redirect(base_url().'home', 'location');
		}*/
	}	 

			  	 
	function last_comments()
	{
		
	    
	    $data['boolean']=$this->entry_model->is_logged_in(); 
	    if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{ 
			    $session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				$data['page_title']="Last Comments";		
				$data['notification']=$this->notification_model->get_user_notification($session_data['user_id']);
				$data['comment']=$this->comment_model->last_comments();
				$this->load->view('comment_view',$data);
			}
		else

		   {	$data['guest'] = "Sign up";
				$data['page_title']="Last Comments";		
				
				$data['comment']=$this->comment_model->last_comments();
				//print_r($data['comment']);
				$this->load->view('comment_view',$data);
			}
	}	
		
	function user_info()
	{
		
		$id_u= $this->uri->segment(3);
		
		$data['boolean']=$this->entry_model->is_logged_in();

		if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{ 
			    $session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				
	    		$data['user_info']= $this->user_model->get_user_info(filter_var($id_u, FILTER_VALIDATE_INT));
	    		$data['notification']=$this->notification_model->get_user_notification($session_data['user_id']);
	    		$data['page_title']="".$data['user_info'][0]->username."'s info";
	    		$this->load->view('user_info_view', $data);
	    	}
	    else
	    {
	    		$data['guest'] = "Sign up";
				$data['page_title']="User info";
				$data['user_info']= $this->user_model->get_user_info(filter_var($id_u, FILTER_VALIDATE_INT));
				
	    		$this->load->view('user_info_view', $data);

	    }
	}
	function notification()
	{	
		$id_u = $this->uri->segment(3);
		$data['boolean']=$this->entry_model->is_logged_in();
		$session_data = $this->session->userdata('logged_in');
		if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{ 
			    $config = array();
		        $config['base_url'] = base_url() . "/home";
		        $config['total_rows'] = $this->notification_model->record_count($session_data['user_id']);
		        //print_r($config['total_rows']);
		        $config['per_page'] = 15;
		        $config['uri_segment'] = 2;
		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			    $session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				$data['user_notification']= $this->notification_model->notification($config['per_page'],$page,$session_data['user_id']);

				$data['links'] = $this->pagination->create_links();
				//print_r($data['user_notification']);
				//$data['page_title']="".$data['user_info'][0]->username."'s info";
				$data['notification']=$this->notification_model->get_user_notification($session_data['user_id']);
	    		$this->load->view('user_notification_view', $data);
	    		$this->notification_model->change_user_status(filter_var($session_data['user_id'], FILTER_VALIDATE_INT));
	    		
	    	}

	}
	function my_info()
	{
		$data['boolean']=$this->entry_model->is_logged_in();
		$session_data = $this->session->userdata('logged_in');
		if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{ 
			    $session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				$data['user_info']= $this->user_model->get_user_info(filter_var($session_data['user_id'], FILTER_VALIDATE_INT));
				$data['notification']=$this->notification_model->get_user_notification($session_data['user_id']);
				$data['page_title']="".$data['user_info'][0]->username."'s info";

	    		$this->load->view('user_info_view', $data);
	    	}
	    else
	    {
	    		$data['guest'] = "Sign up";
				$data['page_title']="User info";
				$data['user_info']= $this->user_model->get_user_info(filter_var($session_data['user_id'], FILTER_VALIDATE_INT));
	    		$this->load->view('user_info_view', $data);

	    }
	   }
	    
	function user_comment()
	{
		$id_u = $this->uri->segment(3);
		$data['boolean']=$this->entry_model->is_logged_in(); 
	    if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{ 
			    $session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				$data['comment']= $data['comment'] = $this->comment_model->last_comments((int)$id_u);
	    		$data['page_title']="".isset($data['user_comment'][0]->user_info[0])?($data['user_comment'][0]->user_info[0]->username):("User")."'s question";
	    		$data['notification']=$this->notification_model->get_user_notification($session_data['user_id']);
	   			$this->load->view('comment_view', $data);

	   		}
	   		else
		   	{		
	   	 		$data['guest'] = "Sign up";
				$data['page_title']="User comment";
				$data['comment'] = $this->comment_model->last_comments((int)$id_u);
	   			$this->load->view('comment_view', $data);
	   		}
	}
	function user_question()
	{
		$id_u= $this->uri->segment(3);
		
		$data['boolean']=$this->entry_model->is_logged_in(); 
	    if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{ 
			    $session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
						
	    		$data['user_question']= $this->user_model->get_user_question(filter_var($id_u, FILTER_VALIDATE_INT));
	    		$data['page_title']="".isset($data['user_question'][0]->user_info[0])?($data['user_question'][0]->user_info[0]->username):("User")."'s question";
	    		$data['notification']=$this->notification_model->get_user_notification($session_data['user_id']);
	   			$this->load->view('user_question_view', $data);
	   		}
	   		else
	   		{		
	   	 		$data['guest'] = "Sign up";
				$data['page_title']="User question view";
				$data['user_question']= $this->user_model->get_user_question(filter_var($id_u, FILTER_VALIDATE_INT));

	   			$this->load->view('user_question_view', $data);
	   		}
	}
	
	

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url().'account', 'location');

	}
	function search()

	{
		
		$q = $this->input->get('search');
		
		$data['boolean']=$this->entry_model->is_logged_in();
		if (trim($q) != ''){
		 
			if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{ 
			    $session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				$data['search']=$q;
				$data['page_title']="Search";		
				$data['notification']=$this->notification_model->get_user_notification($session_data['user_id']);
	    		$data['question_info']= $this->entry_model->search($q);
	   			$this->load->view('search_view', $data);
	   		}
	   		else
	   		{		
	   	 		$data['guest'] = "Sign up";
				$data['page_title']="Search";
				$data['search']=$q;
				$data['question_info']= $this->entry_model->search($q);
	   			$this->load->view('search_view', $data);
	   		}
	   	}else{
	   		 redirect(base_url().'home/advanced_search','location');

	   	}
	}

	function advanced_search()
	{
		$data['boolean']=$this->entry_model->is_logged_in();
			//print_r($_POST);
			if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{
				
				$session_data = $this->session->userdata('logged_in');
				//print_r($session_data['user_id']);
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
		     	$data['page_title']="Advanced Search";
		     	$data['notification']=$this->notification_model->get_user_notification($session_data['user_id']);		
				$this->load->view('advanced_search', $data);

			}
			  else

		    {
		   		
		   		$data['guest'] = "Sign up";
		   		$this->load->model('entry_model');
				$data['page_title']="Advanced Search";		
				$this->load->view('advanced_search', $data);

   			}

		
	}
	function advanced()
	{
		//print_r($this->input->post());
		if ($_POST['q_title']!='' || $_POST['q_description']!='')
		{
		$data['boolean']=$this->entry_model->is_logged_in(); 
		 if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
			{ 
			    $session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				$data['page_title']="Search";		
	    		$data['question_info']= $this->entry_model->advanced_search($this->input->post());
	    		//print_r($data['question_info']);
	   			$this->load->view('search_view', $data);
	   		}
	   		else
	   		{		
	   	 		$data['guest'] = "Sign up";
				$data['page_title']="Search";		
	    		$data['question_info']= $this->entry_model->advanced_search($this->input->post());
	    		//print_r($data['question_info']);
	   			$this->load->view('search_view', $data);
	   		}
	   	}
	   	else 
	   	{
	   
	   		 redirect(base_url().'home/advanced_search','location');

	   }
	}
	
}

?>