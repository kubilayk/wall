<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function login($user_info = array())
	{

		$username = $this->security->xss_clean($user_info['username']);
		$password = $this->security->xss_clean($user_info['pass']);
		$md5_password = md5($password);
		$query = $this->db->get_where('users',array('username'=>$username, 'password'=>$md5_password));
		if($query->num_rows == 1)
		{
			
			$row = $query->row();
			$data = array(
					'user_id' => $row->user_id,
					'username' => $row->username,
					'validated' => true
					);
			
			$this->session->set_userdata('logged_in',$data);
			return true;
		}
		
		return false;
	}


	public function add_user($data = array())
	{
		$username = $this->security->xss_clean($data['user_name']);
		$email = $this->security->xss_clean($data['email_address']);
		$password = $this->security->xss_clean($data['password']);
		$query = $this->db->get_where('users',array('username'=>$username));
		//print_r($query);
		//print_r($data);
		if($query->num_rows == 0)

		{
			$data=array(
				'username'=>$username,
				'email'=>$email,
				'password'=> md5($password)
				);
			$this->db->insert('users',$data);
			return false;
		}
		else
		{
			return true;
		}

	}

	public function get_user($user_info = array())
	{
		$username = $this->security->xss_clean($user_info['username']);
		$email = $this->security->xss_clean($this->input->post('email_address'));
		$password = $this->security->xss_clean($user_info['password']);
		$query = $this->db->get_where('users',array('username'=>$username));
		if($query->num_rows == 1)
		{
			
			false;
		}
		
		return true;
	}

	public function get_user_info($user_id)
	{
		$sql="SELECT user_id,username,email from users WHERE user_id = ?";
		$query= $this->db->query($sql, array((int)$user_id));
		return $query->result(); 
	}


	public function get_user_question($id)
	{	
		$query = $this->db->get_where('question',array('user_id'=>$id));
		$questions = $query->result();
		$last= null;
		foreach ($questions as $question) 
		{
			$sql="SELECT * from user_rate ur, users u WHERE ur.entry_id = ? and ur.user_id = u.user_id ORDER BY ur.`time` DESC LIMIT 1"; 
			$query2 = $this->db->query($sql,array((int)$question->question_id));
			$question->last_vote= $query2->result();
			$session_data = $this->session->userdata('logged_in');
			$data['user_id'] = $session_data['user_id'];
			$sql2="SELECT * from user_rate WHERE user_id= ? and entry_id=?";
			$query3 = $this->db->query($sql2,array($data['user_id'],(int)$question->question_id));
			$sql3="SELECT user_id,username,email FROM users WHERE user_id=? ";
			$query4 = $this->db->query($sql3,array((int)$question->user_id));
			$question->user_info= $query4->result();
			if((int)$query3->num_rows == 0)
			{
				
				$question->is_vote= 0;
			}
		
			else 
			{
				$question->is_vote=1;
			}
			
		}
		return $questions;
	}

	public function get_user_comment($id)
	{
		
		$query = $this->db->get_where('question',array('user_id'=>$id));
		$questions = $query->result();
		$last= null;
		
		foreach ($questions as $question) 
		{
			$sql="SELECT * from comment c, question q, users u WHERE c.entry_id = ? and c.user_id = u.user_id ORDER BY c.comment_date DESC LIMIT 1"; 
			$query2 = $this->db->query($sql,array((int)$question->question_id));
			$question->last_comment= $query2->result();
			
			if(empty($question->last_comment)):
				$question->last_comment=0;
			endif;
			$session_data = $this->session->userdata('logged_in');
			$data['user_id'] = $session_data['user_id'];
			$sql2="SELECT * from user_rate WHERE user_id= ? and entry_id=?";
			$query3 = $this->db->query($sql2,array($data['user_id'],(int)$question->question_id));
			$sql3="SELECT user_id,username,email FROM users WHERE user_id=? ";
			$query4 = $this->db->query($sql3,array((int)$question->user_id));
			$question->user_info= $query4->result();
			
			if((int)$query3->num_rows == 0)
			{
				
				$question->is_vote= 0;
			}
		
			else 
			{
				$question->is_vote=1;
			}
			
		}

		return $questions;

	}
}
?>