<?php
 
class Rss extends CI_Controller 
{
      function __construct()
      {
          parent::__construct();
          
          $this->load->model('entry_model');
          $this->load->model('comment_model');
          
          $this->load->helper('xml');
      }

      function index()
      {
          $data['boolean']=$this->entry_model->is_logged_in();
          if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
          {
            $session_data = $this->session->userdata('logged_in');
            //print_r($session_data['user_id']);
            $data['username'] = $session_data['username'];
           /* $config = array();
            $config['base_url'] = base_url() . "/home";
            $config['total_rows'] = $this->entry_model->record_count();
            $config['per_page'] = 15;
            $config['uri_segment'] = 2;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;*/
            $data['guest'] =0;
            
            
            //$data['comment']=$this->comment_model->last_comments();
            //$data['question']=$this->entry_model->get_all_question($config['per_page'],$page);
            $data['page_title']="RSS";
           //print_r($data['comment']);
           $this->load->view('rss_view',$data);
          }
          else
          {
            $data['guest'] = "Sign up";
            
            $data['comment']=$this->comment_model->last_comments();
            $data['question']=$this->entry_model->get_all_question();
            $data['page_title']="RSS";
            $this->load->view('rss_view',$data);
          }


        

      }

       function entries()
      {
        
        $id_q= $this->uri->segment(3);
        if($id_q==null)
        {
        $data['posts']=$this->entry_model->get_question_rss();
        $data['feed_url'] = base_url();
        //echo "id_q is null";
        $data['encoding'] = 'utf-8';
        $data['feed_name'] = 'entries';
        
        $data['page_description'] = 'wall question rss';
        $data['page_language'] = 'en-ca';
        $data['creator_email'] = '';
        //$data[''] = $this->posts_model->getRecentPosts();    
        header("Content-Type: application/atom+xml");
        //print_r($data);
        $this->load->view('question_rss', $data);
        }
        else {
         $data['posts']= $this->entry_model->get_id_question($id_q);
          $data['comments']=$this->comment_model->get_all_comments($id_q);
         $data['feed_url'] = base_url()."entry/".$id_q;
         //echo "id_q is not null";
         $data['encoding'] = 'utf-8';
        $data['feed_name'] = 'entries';
        
        $data['page_description'] = 'wall question rss';
        $data['page_language'] = 'en-ca';
        $data['creator_email'] = '';
        //$data[''] = $this->posts_model->getRecentPosts();    
        header("Content-Type: application/atom+xml");
        //print_r($data);
        $this->load->view('question_comment_rss', $data);
        }
      // print_r($data['posts']);
        

        

      }

    function comments()
      {
        

        $data['posts']=$this->comment_model->last_comments();
        //print_r($data['posts']);
        $data['encoding'] = 'utf-8';
        $data['feed_name'] = 'comments';
        $data['feed_url'] = base_url().'home/last_comments';
        $data['page_description'] = 'wall comment rss';
        $data['page_language'] = 'en-ca';
        $data['creator_email'] = '';
        //$data[''] = $this->posts_model->getRecentPosts();    
        header("Content-Type: application/atom+xml");
        //print_r($data);
       $this->load->view('comment_rss', $data);

        

      }

      
}

?>