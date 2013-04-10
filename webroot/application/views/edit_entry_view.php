<?php include_once('header.php'); ?>


     <form action="<?php echo base_url();?>entry/edit_entry" method="POST">
      <?php $session_data = $this->session->userdata('question');  ?>
      <input type="hidden" name="question_id" id="question_id" value="<?php echo $session_data['question_id']; ?>">
      

      
        <div class="row">
          <div class="span9">
          <label for="user_name">Title:</label>
        </div>
          <div class="span9">
            <input type="text" class="span8" name="title" value="<?php echo isset($session_data['title'])?($session_data['title']):("");?>"/>
          </div>          
                          
        
        
          <div class="span9">
          <label for="user_name">Description:</label>
        </div>
          <div class="span9">
            <textarea name="content_2" id="content_2" ><?php echo isset($session_data['description'])?($session_data['description']):("") ?></textarea>
            <?php echo display_ckeditor($ckeditor_2); ?>
            </textarea>
          </div>
      
        
          <div class="span9">
          <label for="user_name">Link:</label>
        </div>
          <div class="span9">
            <input type="text" class="span8" name="link" value="<?php echo isset($session_data['link'])?($session_data['link']):("") ?>"/>
          </div>
        
        
        <div class="span12" >  
         <?php if(! is_null($msg)) echo $msg ?>
        </div>  
             
        
        
          <div class="span3">
            <button type="submit" class="btn btn-primary">Edit</button>
        </div>   
        </div>


    </form>

   
<?php include_once('header.php'); ?>