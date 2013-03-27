<?php
class Pizza_model extends CI_Model
{
	 function __construct()
     {
         parent::__construct();
         $this->load->database();//database bağlantısı yapıyoruz.
     }
 
	function get_all_orders()
	{
		$query = $this->db->get('pizza');//pizza tablosundaki bütün verileri çekiyoruz.
		return $query->result();//sonucu return ediyoruz.
	}
}
?>