<?php
 
class Entry extends CI_Controller 
{
      public $data     =     array();
      function __construct()
      {
          parent::__construct();
          $this->load->model('entry_model');
          $this->load->model('comment_model');
         $this->load->helper('url'); //You should autoload this one ;)
    $this->load->helper('ckeditor');
 
 
    //Ckeditor's configuration
    $this->data['ckeditor'] = array(
 
      //ID of the textarea that will be replaced
      'id'  =>  'content',
      'path'  =>  'js/ckeditor',
 
      //Optionnal values
      'config' => array(
        'toolbar'   =>  "Full",   //Using the Full toolbar
        'width'   =>  "550px",  //Setting a custom width
        'height'  =>  '100px',  //Setting a custom height
 
      ),
 
      //Replacing styles from the "Styles tool"
      'styles' => array(
 
        //Creating a new style named "style 1"
        'style 1' => array (
          'name'    =>  'Blue Title',
          'element'   =>  'h2',
          'styles' => array(
            'color'   =>  'Blue',
            'font-weight'   =>  'bold'
          )
        ),
 
        //Creating a new style named "style 2"
        'style 2' => array (
          'name'  =>  'Red Title',
          'element'   =>  'h2',
          'styles' => array(
            'color'     =>  'Red',
            'font-weight'     =>  'bold',
            'text-decoration' =>  'underline'
          )
        )       
      )
    );
 
    $this->data['ckeditor_2'] = array(
 
      //ID of the textarea that will be replaced
      'id'  =>  'content_2',
      'path'  =>  'js/ckeditor',
 
      //Optionnal values
      'config' => array(
        'width'   =>  "550px",  //Setting a custom width
        'height'  =>  '100px',  //Setting a custom height
        'toolbar'   =>  array(  //Setting a custom toolbar
          array('Bold', 'Italic'),
          array('Underline', 'Strike', 'FontSize'),
          array('Smiley'),
          '/'
        )
      ),
 
      //Replacing styles from the "Styles tool"
      'styles' => array(
 
        //Creating a new style named "style 1"
        'style 3' => array (
          'name'    =>  'Green Title',
          'element'   =>  'h3',
          'styles' => array(
            'color'   =>  'Green',
            'font-weight'   =>  'bold'
          )
        )
 
      )
    );

      }

      function index()
      {
          
          $id_q= $this->uri->segment(2);
          $data['boolean']=$this->entry_model->is_logged_in();
          if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
          {
            $session_data = $this->session->userdata('logged_in');
            //print_r($session_data['user_id']);
            $data['username'] = $session_data['username'];
            $data['guest'] =0;
            
            
            $data['comment']=$this->comment_model->get_all_comments($id_q);
            $data['question']=$this->entry_model->get_id_question($id_q);
            $data['page_title']="Questions";
            $this->load->view('entry_view',$data);
          }
          else
          {
            $data['guest'] = "Sign up";
            
            $data['comment']=$this->comment_model->get_all_comments($id_q);
            $data['question']=$this->entry_model->get_id_question($id_q);
            $data['page_title']="Questions";
            $this->load->view('entry_view',$data);
          }

      }

      function new_entry()
      {
          $data['boolean']=$this->entry_model->is_logged_in();
          if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN)):
          
            
            $session_data = $this->session->userdata('logged_in');
            //print_r($session_data['user_id']);
            $data['username'] = $session_data['username'];
            $data['guest'] =0;
            $data['msg']="";
            $data['page_title']="Create Questions";
            $data = array_merge($data, $this->data);
            $this->load->view('new_entry_view',$data);
          endif;
         
      }

      function save_question()
      {
          
          $data['link']=$this->input->post('link');
          $data['boolean']=$this->entry_model->is_logged_in();
          if(filter_var($data['boolean'], FILTER_VALIDATE_BOOLEAN))
          {
            $session_data = $this->session->userdata('logged_in');
            //print_r($session_data['user_id']);
            $data['username'] = $session_data['username'];
            $data['guest'] =0;
            
            $data['page_title']="Save new question";
            if(filter_var($data['link'], FILTER_VALIDATE_URL) || $data['link']=="" ) 
            {
            
                
                $this->entry_model->title_insert($this->input->post());
                redirect(base_url().'home','location');
           }
          else 
            {
              
              $data['msg']='<font color=red>URL is not a properly formatted. Please enter a properly formatted URL.</font><br/>';              

              $this->load->view('new_entry_view',$data);
            } 
          }


          
           
      }
      function delete_entry()
      {
        $data['question_id'] = $this->input->post('question_id');
        $session_data = $this->session->userdata('logged_in');
        $data['user_id'] = $session_data['user_id'];
        //print_r($data);
        if($session_data && filter_var($data['user_id'], FILTER_VALIDATE_INT))
        { 
          $this->entry_model->title_drop($data);
          if($this->input->post('view')=="entry_comment")
            {
              redirect(base_url().'entry/'.$data['question_id'], 'location');
            }
          else if($this->input->post('view')=="user_question")
            {
              redirect(base_url().'home/user_question/'.$data['user_id'], 'location');
            }
          else
            { 
              redirect(base_url().'home','location');
            }        
        }
       else
       {
          redirect(base_url().'home','location');
       } 
      }
  
}

?>