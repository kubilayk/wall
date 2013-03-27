<?php
 
class Entry extends CI_Controller 
{
      function __construct()
      {
          parent::__construct();
          $this->load->model('entry_model');
          $this->load->model('comment_model');
      }

      function index()
      {
          $id_q= $this->uri->segment(2);
          $data['boolean']=$this->entry_model->is_logged_in();
          $data['comment']=$this->comment_model->get_all_comments($id_q);
          $data['question']=$this->entry_model->get_id_question($id_q);
          $data['page_title']="Questions";
          $this->load->view('entry_view',$data);

      }

      function new_entry()
      {
          $data['page_title']="Create Questions";
          $this->load->view('new_entry_view',$data);
      }

      function save_question()
      {
          $this->load->helper('url');
          if($this->input->post('title')) 
            {

             $this->entry_model->title_insert($this->input->post());
            } 
          
          redirect(base_url().'home','refresh'); 
      }
  
}

?>