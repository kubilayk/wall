<?php


class Autocomplete_Model extends CI_Model
{
    function GetAutocomplete($options = array())
    {
	    $this->db->select('person');
	    $this->db->like('name', $options['keyword'], 'after');
   		$query = $this->db->get('person');
		return $query->result();
    }
}
?>