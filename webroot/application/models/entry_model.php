<?php
class Entry_model extends CI_Model
{
	 function __construct()
     {
         parent::__construct();
     }
 
	public function get_all_question()
	{
		$query = $this->db->get('question');
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
			//print_r($query3->num_rows);
			if((int)$query3->num_rows == 0)
			{
				$question->is_vote= 0;
			}
			else 
			{
				$question->is_vote=1;
			}
			//$sql="SELECT q.question_id, COUNT(c.entry_id) AS total FROM question q JOIN comment c ON c.entry_id = q.question_id GROUP BY c.entry_id ORDER BY total asc";
  			//$query3 = $this->db->query($sql);
  			//$question->total=$query3->result();
			//print_r($last);//print_r($query2->result());
		}
		return $questions;//sonucu return ediyoruz.

	}
	public function get_id_question($id)
	{
		
		$query = $this->db->get_where('question',array('question_id'=>$id));
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
			//$sql="SELECT q.question_id, COUNT(c.entry_id) AS total FROM question q JOIN comment c ON c.entry_id = q.question_id GROUP BY c.entry_id ORDER BY total asc";
  			//$query3 = $this->db->query($sql);
  			//$question->total=$query3->result();
			//print_r($last);//print_r($query2->result());
		}
		return $questions;

	}
	public function title_insert($data = array())
	{

		$session_data = $this->session->userdata('logged_in');
		$data['user_id'] = $session_data['user_id'];
		if ($data):

	    	$data = array(

	    		'title' => $data['title'],
	            'description'=>$data['description'],
	            'user_id'=>$data['user_id']

	            );
	    	$data['title']=strip_tags($data['title']);
	    	$data['description']=strip_tags($data['description']);

	    	$this->db->insert('question',$data);

    	endif; 
    
    }
	public function get_vote_nb($id)
	{
		$sql= "SELECT total_votes, vote_like  FROM ratings WHERE entry_id = ?";
		$query = $this->db->query($sql,array((int)$id));
		return $query->result();
		
		
	}

	public function rate_insert($data = array())
	{

		
		if ($data):

	    	$data = array(

	    		'entry_id' => (int)$data['entry_id'],
	            'like'=>$data['like']

	            );
	    endif;  	
		$sql="SELECT entry_id FROM ratings WHERE entry_id = ?";
		$is_empty=$this->db->query($sql,array((int)$data['entry_id']));
		if($is_empty->num_rows == 1)
		{
			$sql = "UPDATE ratings SET vote_like=vote_like + ?, total_votes=total_votes + 1 WHERE entry_id= ?"; 
			$this->db->query($sql, array((int)$data['like'], (int)$data['entry_id']));
	 
		}
		else
		{
	   		$vote_value=1;
			$sql = "INSERT INTO ratings(total_votes,vote_like,entry_id) VALUES (?,?,?);";
			$this->db->query($sql, array((int)$vote_value, (int)$data['like'], (int)$data['entry_id']));	
		}
    	
    
    }

public function set_title_rate($data)
	{
		if ($data):

	    	$data = array(

	    		'question_id' => (int)$data['question_id'],
	            'like'=>$data['like'],
	            'dislike'=>$data['dislike']

	            );
	    
	    endif; 
		$sql= "UPDATE question SET title_like = ?, title_dislike = ? WHERE question_id= ?";
		$this->db->query($sql, array((int)$data['like'], (int)$data['dislike'], (int)$data['question_id']));
	
	}

public function is_logged_in()
	{
		$user_info= $this->session->userdata('logged_in');
		if($user_info['user_id'] !=0)
			{
				return true;
			}
		else
			{	
				return false;
			}


	}
public function user_rate($q_id)
	{
		$user_info= $this->session->userdata('logged_in');
		$sql = "INSERT INTO user_rate(entry_id, user_id) VALUES (?,?);";
		$this->db->query($sql, array((int)$q_id, (int)$user_info['user_id']));
	}
	

}
	


?>