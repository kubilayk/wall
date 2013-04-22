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
		$password = $this->security->xss_clean($user_info['password']);
		$md5_password = md5($password);
		$query = $this->db->get_where('users',array('username'=>$username, 'password'=>$md5_password));
		//print_r($query->result());
		if($query->num_rows == 1)
		{
			
			$row = $query->row();
			$data = array(
					'user_id' => $row->user_id,
					'username' => $row->username,
					'validated' => true,
					'email' => $row->email
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
	public function update_user($data = array())
	{
		
		$username = $this->security->xss_clean($data['user_name']);
		$email = $this->security->xss_clean($data['email_address']);
		
		//print_r($query->result());
		$session_data = $this->session->userdata('logged_in');
		
		$user_id = $session_data['user_id'];
		//print_r($email);

		$data=array(
			'username'=>$username,
			'email'=>$email
			
			);
		$sql= "UPDATE users SET username = ?, email = ? WHERE user_id= ?";
		$this->db->query($sql, array($username, $email, $user_id));
		$query = $this->db->get_where('users',array('username'=>$username));
		$data=$query->result();
		
			$data = array(
				'user_id' => $data[0]->user_id,
				'username' => $data[0]->username,
				'validated' => true,
				'email' => $data[0]->email
				);
		
		$this->session->set_userdata('logged_in',$data);
		//$this->session->set_userdata('email',$data['email']);

		return true;
	

	}
	public function update_user_password($user_password)
	{
		
		$user_session = $this->session->userdata('email');
		$query = $this->db->get_where('users',array('username'=>$user_session[0]->username));
		if($query->num_rows != 0):

		
			$data=array(
				'user_id'=>$user_session[0]->user_id,
				'password' =>md5($user_password)
				
				);
			
			$sql= "UPDATE users SET password = ? WHERE user_id= ?";
			$this->db->query($sql, array($data['password'],(int)$data['user_id']));
		endif;
	}
	
	public function change_user_password($user_password)
	{

		$user_session = $this->session->userdata('logged_in');
		$query = $this->db->get_where('users',array('username'=>$user_session['username']));
		if($query->num_rows != 0):

		
			$data=array(
				'user_id'=>$user_session['user_id'],
				'password' =>md5($user_password)
				
				);
			$sql= "UPDATE users SET password = ? WHERE user_id= ?";
			$this->db->query($sql, array($data['password'],(int)$data['user_id']));
		endif;
	}

	public function get_user($user_info = array())
	{
		$username = $this->security->xss_clean($user_info['user_name']);
		$email = $this->security->xss_clean($user_info['email_address']);
		$user_session = $this->session->userdata('logged_in');
		//$password = $this->security->xss_clean($user_info['password']);
		//print_r($user_info);
		if($username == $user_session['username'])
		{
			$sql="SELECT * from users WHERE email = ?";
			$query= $this->db->query($sql, array($email));
			if($query->num_rows != 0)
			{
				return true;
			}
		}
		else
		{
			$sql="SELECT * from users WHERE username = ? ";
			$query= $this->db->query($sql, array($username));
			
			if($query->num_rows != 0):
				return true;
			endif;
			$sql="SELECT * from users WHERE email = ?";
			$query= $this->db->query($sql, array($email));
			if($query->num_rows != 0):
				return true;
			endif;	
				
		}

		
		return false;
	}
	/*public function get_user_update($user_info = array())
	{

		$username = $this->security->xss_clean($user_info['user_name']);
		$email = $this->security->xss_clean($user_info['email_address']);
		//print_r($username);
		
		$query = $this->db->get_where('users',array('username'=>$username, 'email'=>$email));
		print_r($query->result());
		if($query->num_rows == 1)
		{
			return true;
		}
		
		return false;
	}*/
	public function get_user_email($user_email)
	{
		
		if(!empty($user_email))
		{
			$sql="SELECT user_id,username,email from users WHERE email = ?";
			$query= $this->db->query($sql, array($user_email));
			if($query->num_rows == 1)
			{
				
				return $query->result();
			}
			else{
			return false;
			}
		}
		
		else
		{
			return false;
		}
	}

	public function get_user_info($user_id)
	{
		$sql="SELECT user_id,username,email from users WHERE user_id = ?";
		$query= $this->db->query($sql, array((int)$user_id));
		return $query->result(); 
	}


	public function get_user_question($id)
	{	
		$this->db->from("question");
		$this->db->where("user_id",$id);
		$this->db->order_by("question_date", "desc");
		$query = $this->db->get();
		$questions = $query->result();
		$last= null;
		foreach ($questions as $question) 
		{
			$sql="SELECT u.username,u.user_id,ur.user_id,ur.entry_id,ur.user_rate_date,ur.user_entry from user_rate ur, users u WHERE ur.entry_id = ? and ur.user_id = u.user_id ORDER BY ur.user_rate_date DESC LIMIT 1"; 
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
		
		$this->db->from("question");
		$this->db->where("user_id",$id);
		$this->db->order_by("question_date", "desc");
		$query = $this->db->get();
		
		$questions = $query->result();
		$last= null;
		
		foreach ($questions as $question) 
		{
			$sql="SELECT c.comment_id, c.comment_date,c.comment,c.user_id, q.title, q.question_id,u.user_id,u.username from comment c, question q, users u WHERE c.entry_id = ? and c.user_id = u.user_id ORDER BY c.comment_date DESC LIMIT 1"; 
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