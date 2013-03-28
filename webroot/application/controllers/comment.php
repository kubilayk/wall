<?php
 
class Comment extends CI_Controller 
{
    function __construct()
    {
      parent::__construct();
      $this->load->model('comment_model');
    }
  

    public function save_comment()
    {
      $this->load->helper('url');
      if($this->input->post('comment')) 
        {
            $this->comment_model->comment_insert($this->input->post());
        } 
      
      $entry_id=(int)$this->input->post("entry_id");
      if(filter_var($entry_id, FILTER_VALIDATE_INT))
        {
            redirect(base_url().'entry/'.(int)$entry_id,'refresh');  
        }
      else
        {
            redirect(base_url().'home','location');
        }

    }

  
}

?>