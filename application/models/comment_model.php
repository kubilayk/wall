<?php
class Comment_model extends CI_Model
{
	 function __construct()
     {
         parent::__construct();
         //$this->load->database();//database bağlantısı yapıyoruz.
     }
 
	function get_all_comments($entry_id = 0)
	{
		
		$sql= "SELECT * FROM comment WHERE entry_id = ? ";
		$query = $this->db->query($sql,array((int)$entry_id));//soru tablosundaki bütün verileri çekiyoruz.
		return $query->result();//sonucu return ediyoruz.
	}
	
	function comment_insert($data = array()){

		$session_data = $this->session->userdata('logged_in');
		$data['user_id'] = $session_data['user_id'];
		if ($data):

	    	$data = array(

	    		'entry_id' => (int)$data['entry_id'],
	            'comment'=>$data['comment'],
	            'user_id'=>$data['user_id']

	            );
	    $data['comment']=strip_tags($data['comment']);
	    $sql = "INSERT INTO comment(entry_id, comment, user_id) VALUES (?,?,?)"; 
		$this->db->query($sql, array((int)$data['entry_id'], $data['comment'], $session_data['user_id']));
		$sql = "UPDATE question SET total_comment=total_comment + 1 WHERE question_id= ?"; 
		$this->db->query($sql, array((int)$data['entry_id'])); 
	 

    	endif; 
    
  }
  public function total_comment()
  {
  		$sql="SELECT *, COUNT(c.entry_id) AS total FROM question q JOIN comment c ON c.entry_id = q.question_id GROUP BY c.entry_id ORDER BY total asc";
  		$query = $this->db->query($sql);
  		return $query->result();
  }
  public function last_comments()
  {
  		$query = $this->db->get('question');
		$questions = $query->result();
		$last= null;
		foreach ($questions as $question) {
			
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
			//$sql="SELECT q.question_id, COUNT(c.entry_id) AS total FROM question q JOIN comment c ON c.entry_id = q.question_id GROUP BY c.entry_id ORDER BY total asc";
  		//$query3 = $this->db->query($sql);
  		//$question->total=$query3->result();
			//print_r($last);//print_r($query2->result());
		}
		return $questions;
  }
}
?>