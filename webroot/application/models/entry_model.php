<?php
class Entry_model extends CI_Model
{
	 function __construct()
     {
         parent::__construct();
     }
 
	public function get_all_question($limit= null, $start=null)
	{
		$this->db->limit($limit, $start);
		$this->db->from("question");
		$this->db->order_by("question_date", "desc");
		$query = $this->db->get();
		   
		$questions = $query->result();
		//print_r($questions);
		$last= null;
		foreach ($questions as $question)
		 {
			$sql="SELECT * from user_rate ur, users u WHERE ur.entry_id = ? and ur.user_id = u.user_id ORDER BY ur.user_rate_date DESC LIMIT 1"; 
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
	public function get_question_rate($limit= null, $start=null)
	{
		$this->db->limit($limit, $start);
		$this->db->from("question");
		$this->db->order_by("title_like", "desc");
		$query = $this->db->get();
		   
		$questions = $query->result();
		//print_r($questions);
		$last= null;
		foreach ($questions as $question)
		 {
			$sql="SELECT * from user_rate ur, users u WHERE ur.entry_id = ? and ur.user_id = u.user_id ORDER BY ur.user_rate_date DESC LIMIT 1"; 
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
	public function get_question_total_comment($limit= null, $start=null)
	{
		$this->db->limit($limit, $start);
		$this->db->from("question");
		$this->db->order_by("total_comment", "desc");
		$query = $this->db->get();
		   
		$questions = $query->result();
		//print_r($questions);
		$last= null;
		foreach ($questions as $question)
		 {
			$sql="SELECT * from user_rate ur, users u WHERE ur.entry_id = ? and ur.user_id = u.user_id ORDER BY ur.user_rate_date DESC LIMIT 1"; 
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


	public function record_count()
	{
		return $this->db->count_all("question");
	}
	public function get_id_question($id_q,$id_u=NULL)
	{
		
		if(empty($id_u))
		{
			$query = $this->db->get_where('question',array('question_id'=>$id_q));
		}
		else
		{
			$query = $this->db->get_where('question',array('question_id'=>$id_q, 'user_id'=>$id_u));
		}
		
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
	            'content_2'=>$data['content_2'],
	            'user_id'=>$data['user_id'],
	            'link'=>$data['link']

	            );

	    	$data['title']=strip_tags($data['title'],'<p><a><br />');
	    	$data['content_2']=strip_tags($data['content_2'],'<p><a><br />');
	    	//$data['link']=strip_tags($data['link']);
	    	print_r($data);
	    	$sql = "INSERT IGNORE INTO question(title,description,user_id,link) VALUES (?,?,?,?);";
			$this->db->query($sql, array($data['title'], $data['content_2'], (int)$data['user_id'], $data['link']) );
			/*$sql = "SELECT question_id FROM question WHERE user_id= ? ORDER BY question_date DESC LIMIT 1 ";
			$query=$this->db->query($sql, array((int)$data['user_id']));
			$entry_id=$query->result();
			//print_r($entry_id);
	    	$sql = "INSERT IGNORE INTO notification(type,`from`,ref_id) VALUES (?,?,?);";
	    	$this->db->query($sql, array("entry",(int)$data['user_id'],$entry_id[0]->question_id) );*/
	    	//$sql = "INSERT IGNORE INTO user_notification(status) VALUES (?);";
	    	//$this->db->query($sql, array(0));
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

	    		'rate_count' => (int)$data['rate_count']

	            );
	    endif;  	
	     print_r($data['rate_count']);
	    
    	$sql= "UPDATE question SET title_like = ? WHERE question_id= ?";
		$this->db->query($sql, array((int)$data['rate_count'],(int)$data['entry_id']));
		
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
	function search($key){
		
		
		$key = '%'.$key.'%';

		$query_str = "SELECT * FROM question 
					  WHERE ( title LIKE ? )  
					  ORDER BY question_date";	
		$query = $this->db->query($query_str,Array($key));
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
	function advanced_search($key){
		
		
		$title=$key['q_title'];
		$description=$key['q_description'];
	   	$title = '%'.$title.'%';
	    $description = '%'.$title.'%';

		$query_str = "SELECT * FROM question 
					  WHERE ( title LIKE ? or description LIKE ? )  
					  ORDER BY question_date";
		$query = $this->db->query($query_str,array($title,$description));
		$questions = $query->result();
		
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
		 //print_r($questions);
		return $questions;//sonucu return ediyoruz.
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
public function user_rate($data)
	{
		if ($data):

	    	$data = array(

	    		'entry_id' => (int)$data['entry_id'],
	            'like'=>$data['like']

	            );
	    
	    endif; 
	    if($data['like']==1)
	    {
		$user_info= $this->session->userdata('logged_in');
		$sql = "INSERT IGNORE INTO user_rate(entry_id, user_id,user_entry) VALUES (?,?,?);";
		$this->db->query($sql, array((int)$data['entry_id'], (int)$user_info['user_id'],"".(int)$data['entry_id']."".(int)$user_info['user_id']) );
		$sql = "SELECT u.user_id FROM users u, question q WHERE q.user_id=u.user_id and q.question_id= ?";
		$query = $this->db->query($sql, array((int)$data['entry_id']) );
		$to=$query->result();
		//print_r($query->result()[0]->user_id);
		if($user_info['user_id']!=$to[0]->user_id):
		$sql = "INSERT IGNORE INTO notification(type,`from`,`to`,ref_id) VALUES (?,?,?,?);";
	    $this->db->query($sql, array("like",(int)$user_info['user_id'],(int)$to[0]->user_id,(int)$data['entry_id']));
	    endif;
		}
		else
		{
			$user_info= $this->session->userdata('logged_in');
			$sql = "DELETE FROM user_rate WHERE user_entry = (?);";
			$this->db->query($sql, array("".(int)$data['entry_id']."".(int)$user_info['user_id']));
			$sql = "DELETE FROM notification WHERE `from` = (?) and type = ?;";
			$this->db->query($sql, array((int)$user_info['user_id'], "like"));

		}	
	}
	public function rate_count($data)
	{
		//print_r($data);
		if ($data):

	    	$data = array(

	    		'entry_id' => (int)$data['entry_id'],

	            );
	    
	    endif; 
	    $sql= "SELECT count(entry_id) as count FROM user_rate WHERE entry_id= ?";
	    $query = $this->db->query($sql, array((int)$data['entry_id']));
		
		$rate_count = $query->result();
		//print_r($rate_count[0]->count);
		return $rate_count[0]->count;
	}
public function title_drop($data)
	{
		if($data):
			$data = array(
				'question_id' => (int)$data['question_id'],
				'user_id' => (int)$data['user_id']

				);
		endif;
		$sql="DELETE FROM question WHERE user_id = ? AND question_id = ?";
		$this->db->query($sql, array((int)$data['user_id'], (int)$data['question_id']));
		$sql2="DELETE FROM comment WHERE entry_id = ?";
		$this->db->query($sql2, array((int)$data['question_id']));
		$sql3="SELECT not_id FROM notification WHERE ref_id = ?";
		$query = $this->db->query($sql3, array((int)$data['question_id']));
		$notification = $query->result();
		foreach ($notification as $not)
		 {
			$sql5="DELETE FROM user_notification WHERE not_id = ? ";
			$this->db->query($sql5, array((int)$not->not_id));
		 }
		$sql4="DELETE FROM notification WHERE ref_id = ? ";
		$this->db->query($sql4, array((int)$data['question_id']));
		//$sql = "DELETE FROM notification WHERE `from` = (?) and type = ?;";
		//$this->db->query($sql, array((int)$data['user_id'], "entry"));
	
	}
public function title_edit($data)
	{
		$session_data = $this->session->userdata('logged_in');
		$data['user_id'] = $session_data['user_id'];
		if ($data):

	    	$data = array(

	    		'question_id' => $data['question_id'],
	    		'title' => $data['title'],
	            'content_2'=>$data['content_2'],
	            'user_id'=>$data['user_id'],
	            'link'=>$data['link']

	            );
//print_r($data);
	    	$data['title']=strip_tags($data['title'],'<p><a><br />');
	    	$data['content_2']=strip_tags($data['content_2'],'<p><a><br />');
	    	//$data['link']=strip_tags($data['link']);
	    	
	    	$sql="UPDATE question SET title = ?, description = ?, link = ? WHERE user_id = ? and question_id = ?";
			$this->db->query($sql, array($data['title'], $data['content_2'],  $data['link'], (int)$data['user_id'], (int)$data['question_id']));
	    

    	endif; 

/*

		if($data):
			$data = array(
				'question_id' => (int)$data['question_id'],
				'description' => $data['description'],
				'title' => $data['title'],
				'user_id' => (int)$data['user_id']

				);
		endif;
		
		$sql="UPDATE question SET title = ?, description = ? WHERE user_id = ? and question_id = ?";
		$this->db->query($sql, array((int)$data['user_id'], (int)$data['question_id']));

*/

	}

	public function get_question_rss()
	{
		$this->db->order_by("question_date", "desc");
		$query = $this->db->get('question');
		   
		$questions = $query->result();
		
		
        
		return $questions;//sonucu return ediyoruz.

	}
	

}
	


?>