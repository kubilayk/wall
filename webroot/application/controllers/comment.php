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
    function delete_comment()
      {
        $data['comment_id'] = $this->input->post('comment_id');
        $data['entry_id'] = $this->input->post('entry_id');
        $session_data = $this->session->userdata('logged_in');
        $data['user_id'] = $session_data['user_id'];
        //print_r($this->input->post());
        
       if($session_data && $data['user_id'])
        {
          $this->comment_model->comment_drop($data);
          if($this->input->post('view')=="entry_comment")
          {
            redirect(base_url().'entry/'.$data['entry_id'],'refresh');
          }
          else if($this->input->post('view')=="user_comment")
            {
              redirect(base_url().'home/user_comment/'.$data['user_id'], 'refresh');
            }
          else if($this->input->post('view')=="last_comment")
            {
              redirect(base_url().'home/last_comments', 'refresh');
            }
          else
          {
            redirect(base_url().'home','refresh');
          }
        }
       else
       {
          redirect(base_url().'home','refresh');
       } 
      }

  
}

?>