<?php
class Notification_model extends CI_Model
{
	 function __construct()
     {
         parent::__construct();
         //$this->load->database();//database bağlantısı yapıyoruz.
     }
 
	function get_user_notification($user_id = 0)
	{
		
		
		$sql= "SELECT COUNT(*) AS total_not FROM user_notification WHERE user_id = ? and status != ?";
		$query = $this->db->query($sql,array((int)$user_id, '1'));
		return $query->result();//sonucu return ediyoruz.*/
	}
	function notification($limit= null, $start=null, $user_id = 0)
	{
		$this->db->limit($limit, $start);
		$this->db->from("user_notification");
		$this->db->where('user_id',$user_id);
		$this->db->order_by("u_not_date", "desc");
		$query = $this->db->get();
		   
		$user_notification = $query->result();

		/*$sql= "SELECT * FROM user_notification WHERE user_id = ? ORDER BY u_not_date DESC";
		$query = $this->db->query($sql,array((int)$user_id));
		$user_notification = $query->result();*/
		//print_r($user_notification);
		foreach ($user_notification as $user_not) {
			$sql="SELECT n.type,n.from,n.not_date,n.to,n.ref_id,q.title,u.username,q.title_like FROM notification n,question q, users u WHERE not_id = ? and q.question_id=n.ref_id and u.user_id=n.from  ";
			$query = $this->db->query($sql,array((int)$user_not->not_id));
			$user_not->notification= $query->result();
			$sql="SELECT u.username,u.user_id,ur.user_id,ur.entry_id,ur.user_rate_date,ur.user_entry from user_rate ur, users u WHERE ur.entry_id = ? and ur.user_id = u.user_id ORDER BY ur.user_rate_date DESC LIMIT 1"; 
			$query2 = $this->db->query($sql,array((int)$user_not->notification[0]->ref_id));
			$user_not->last_vote= $query2->result();
			$session_data = $this->session->userdata('logged_in');
			$data['user_id'] = $session_data['user_id'];
			$sql2="SELECT * from user_rate WHERE user_id= ? and entry_id=?";
			$query3 = $this->db->query($sql2,array($data['user_id'],(int)$user_not->notification[0]->ref_id));
			
			if((int)$query3->num_rows == 0)
			{
				
				$user_not->is_vote= 0;
			}
		
			else 
			{
				$user_not->is_vote=1;
			}
		}
		
	foreach ($user_notification as $user_not) {
			
			}
		//print_r($user_notification);
		return $user_notification;
	}
	public function record_count($user_id = 0)
	{
		$sql="SELECT * FROM user_notification WHERE user_id = ? and status != ? ";
		$query = $this->db->query($sql,array((int)$user_id, 'all'));
		/*$this->db->from("user_notification");
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();*/
		$count = $query->num_rows();
		return $count;
	}
	function change_user_status($user_id = 0)
	{
		
		"UPDATE question SET title_like = ? WHERE question_id= ?";
		$sql = "UPDATE user_notification SET status = (?) WHERE user_id = (?) and status != ?;";
		$this->db->query($sql, array('1',(int)$user_id, 'all'));
		//$sql = "DELETE FROM notification WHERE `to` = (?);";
		//$this->db->query($sql, array((int)$user_id));

		
	}
	
}
?>