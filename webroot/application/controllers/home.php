<?php
 
class Home extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('entry_model');
		$this->load->model('comment_model');
		$this->load->model('user_model');
		
	}

	function index()
	{
			
			$data['boolean']=$this->entry_model->is_logged_in();
			
			if($data['boolean'])
			{
				
				$session_data = $this->session->userdata('logged_in');
				//print_r($session_data['user_id']);
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
		     	$data['page_title']="Home_view";		
				$data['question']=$this->entry_model->get_all_question();
				//print_r($data['question']);
				//foreach($data['question'] as $question)
					//echo  $question->last_vote[0]->username; 
				//$data['total_comment'] = $this->comment_model->total_comment($data['question']);
				$this->load->view('home_view',$data);

			}
			  else

		    {
		   		
		   		$data['guest'] = "Sign up";
		   		$this->load->model('entry_model');
				$data['page_title']="Home_view";		
				$data['question']=$this->entry_model->get_all_question();
				$this->load->view('home_view',$data);

   			}

   	}

	

	function rate()
	{
		//echo "rate";
		$data=$this->input->post();
		//print_r($data);
		$this->entry_model->rate_insert($data);
		
		$this->entry_model->user_rate($this->input->post());
	   
		if($this->input->post('view')=="entry")
			{
				redirect(base_url().'entry/'.$data['entry_id'], 'refresh');
			}
		else if($this->input->post('view')=="comment")
			{
				redirect(base_url().'home/last_comments', 'refresh');
			}
		else if($this->input->post('view')=="user_question")
			{
				redirect(base_url().'home/user_question/'.$data['user'], 'refresh');
			}
		else if($this->input->post('view')=="user_comment")
			{
				redirect(base_url().'home/user_comment/'.$data['user'], 'refresh');
			}

		else
			{
				redirect(base_url().'home', 'refresh');
			}
	}	 

			  	 
	function last_comments()
	{
		
	    
	    $data['boolean']=$this->entry_model->is_logged_in(); 
	    if($data['boolean'])
			{ 
			    $session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				$data['page_title']="Comment_view";		
				
				$data['comment']=$this->comment_model->last_comments();
				$this->load->view('comment_view',$data);
			}
		else

		   {	$data['guest'] = "Sign up";
				$data['page_title']="Comment_view";		
				
				$data['comment']=$this->comment_model->last_comments();
				//print_r($data['comment']);
				$this->load->view('comment_view',$data);
			}
	}	
		
	function user_info()
	{
		
		$id_u= $this->uri->segment(3);
		
		$data['boolean']=$this->entry_model->is_logged_in();

		if($data['boolean'])
			{ 
			    $session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				$data['page_title']="User_info_view";
	    		$data['user_info']= $this->user_model->get_user_info($id_u);
	    		$this->load->view('user_info_view', $data);
	    	}
	    else
	    {
	    		$data['guest'] = "Sign up";
				$data['page_title']="User_info_view";
				$data['user_info']= $this->user_model->get_user_info($id_u);
	    		$this->load->view('user_info_view', $data);

	    }
	}
	function my_info()
	{
		$data['boolean']=$this->entry_model->is_logged_in();
		$session_data = $this->session->userdata('logged_in');
		if($data['boolean'])
			{ 
			    $session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				$data['page_title']="User_info_view";
				$data['user_info']= $this->user_model->get_user_info($session_data['user_id']);
	    		$this->load->view('user_info_view', $data);
	    	}
	    else
	    {
	    		$data['guest'] = "Sign up";
				$data['page_title']="User_info_view";
				$data['user_info']= $this->user_model->get_user_info($session_data['user_id']);
	    		$this->load->view('user_info_view', $data);

	    }
	   }
	    
	function user_comment()
	{
		$id_u = $this->uri->segment(3);
		$data['boolean']=$this->entry_model->is_logged_in(); 
	    if($data['boolean'])
			{ 
			    $session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				$data['page_title']="User_comment_view";		
	    		$data['user_comment']= $this->user_model->get_user_comment($id_u);
	   			$this->load->view('user_comment_view', $data);
	   		}
	   		else
		   	{		
	   	 		$data['guest'] = "Sign up";
				$data['page_title']="User_comment_view";
				$data['user_comment']= $this->user_model->get_user_comment($id_u);
	   			$this->load->view('user_comment_view', $data);
	   		}
	}
	function user_question()
	{
		$id_u= $this->uri->segment(3);
		
		$data['boolean']=$this->entry_model->is_logged_in(); 
	    if($data['boolean'])
			{ 
			    $session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				$data['page_title']="User_question_view";		
	    		$data['user_question']= $this->user_model->get_user_question($id_u);
	   			$this->load->view('user_question_view', $data);
	   		}
	   		else
	   		{		
	   	 		$data['guest'] = "Sign up";
				$data['page_title']="User_question_view";
				$data['user_question']= $this->user_model->get_user_question($id_u);
	   			$this->load->view('user_question_view', $data);
	   		}
	}
	
	

	 function logout()

	{
		$this->session->unset_userdata('logged_in');
		redirect(base_url().'account', 'refresh');

	}
	function search()

	{
		
		//print_r($_POST);
		$data['boolean']=$this->entry_model->is_logged_in();
		if ($_POST['search']!='')
		{
		 
		 if($data['boolean'])
			{ 
			    $session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
				$data['page_title']="Search";		
	    		$data['question_info']= $this->entry_model->search($this->input->post('search'));
	   			$this->load->view('search_view', $data);
	   		}
	   		else
	   		{		
	   	 		$data['guest'] = "Sign up";
				$data['page_title']="Search";		
	    		$data['question_info']= $this->entry_model->search($this->input->post('search'));
	   			$this->load->view('search_view', $data);
	   		}
	   	}
	   	else 
	   	{
	   
	   		 redirect(base_url().'home/advanced_search','refresh');

	   	}
	}

	function advanced_search()
	{
		$data['boolean']=$this->entry_model->is_logged_in();
			//print_r($_POST);
			if($data['boolean'])
			{
				
				$session_data = $this->session->userdata('logged_in');
				//print_r($session_data['user_id']);
				$data['username'] = $session_data['username'];
				$data['guest'] =0;
		     	$data['page_title']="Advanced Search";		
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
		 if($data['boolean'])
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
	   
	   		 redirect(base_url().'home/advanced_search','refresh');

	   }
	}
	
}

?>