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
		
		$sql= "SELECT * FROM comment WHERE entry_id = ? ORDER BY comment_date DESC";
		$query = $this->db->query($sql,array((int)$entry_id));
		$comments = $query->result();
		foreach ($comments as $com) {
			$sql="SELECT user_id,username FROM users WHERE user_id=? ";
			$query2 = $this->db->query($sql,array((int)$com->user_id));
			$com->user_comment= $query2->result();
		}
		return $comments;//sonucu return ediyoruz.
	}
	function get_comment($comment_id = 0)
	{
		
		$sql= "SELECT c.*, q.title,q.description,q.question_id FROM comment c, question q WHERE c.comment_id = ? and q.question_id = c.entry_id ";
		$query = $this->db->query($sql,array((int)$comment_id));
		
		$comments = $query->result();
		return $comments;//sonucu return ediyoruz.
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
  public function last_comments( $u_id = 0 )
  {

		$session_data = $this->session->userdata('logged_in');
		$user_id = $session_data['user_id'];

  		$sql = "SELECT DISTINCT c1.comment_id, c1.comment, c1.comment_date, c1.entry_id, q1.title, q1.question_id, q1.title_like, u1.username, u1.user_id, 
  				IF( ".(int)$user_id." IN ( SELECT rn.user_id FROM user_rate rn WHERE rn.entry_id = c1.entry_id), 1, 0) as is_vote
				FROM comment c1
				LEFT JOIN question q1 ON q1.question_id = c1.entry_id
				LEFT JOIN users u1 ON u1.user_id = c1.user_id
				".( $u_id ? "WHERE c1.user_id = '".$u_id."' " : "" )."
				ORDER BY c1.comment_date DESC
				LIMIT 15";

  		$query = $this->db->query($sql);

		return $query->result();

  }
  public function comment_drop($data)
	{
		if($data):
			$data = array(
				'entry_id' => (int)$data['entry_id'],
				'comment_id' => (int)$data['comment_id'],
				'user_id' => (int)$data['user_id']

				);
		endif;
		$sql="DELETE FROM comment WHERE user_id = ? AND comment_id = ?";
		$this->db->query($sql, array((int)$data['user_id'], (int)$data['comment_id']));
		$sql2 = "UPDATE question SET total_comment=total_comment - 1 WHERE question_id= ?"; 
		$this->db->query($sql2, array((int)$data['entry_id']));



	}
}
?>