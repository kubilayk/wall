<?php include_once('header.php'); ?>
  <?php $i=0; ?>
  <?php $e_id=0; ?>
  
          <?php foreach($question as $quest){ ?>
          
          <div class="row">
            <?php $e_id=$quest->question_id; ?>
            
                 <div class="span1" style="text-align: right;">
                    <form action="<?php echo base_url();?>home/rate" id="rate_form_<?php echo $e_id; ?>" method="POST">
                         <span>
                         <?php if (! $boolean == false): ?>
                         <input type="hidden" name="like" id="rate_input_<?php echo $e_id; ?>" value="">
                         <input type="hidden" name="view" id="rate_input_<?php echo $e_id; ?>" value="entry">
                         <input type="hidden" name="entry_id" id="entry_id_<?php echo $e_id; ?>" value="<?php echo $e_id; ?>">
                          <?php if ($quest->is_vote===0)
                          {

                            echo '<a href="#" onclick="$(\'#rate_input_'.$e_id.'\').val(\'1\');$(\'#rate_form_'.$e_id.'\').submit();return false;"><i class="icon-thumbs-up"> </i> </a>';
                          }
                          else 
                          {
                           
                           echo '<a href="#" onclick="$(\'#rate_input_'.$e_id.'\').val(\'0\');$(\'#rate_form_'.$e_id.'\').submit();return false;"><i class="icon-thumbs-down"></i> </a>';
                          }
                          ?>
                         <?php endif; ?>
                        
                         <small class="label label-info">  Like : <?php echo ( $quest->title_like ? $quest->title_like : 0 ); ?>
                         </small>
                         </span>
                      </form>
                 </div>
                  
            <form action="<?php echo base_url();?>entry/delete_entry" id="question_delete_<?php echo isset($quest->question_id)?($quest->question_id):("") ?>" method="POST">
              <input type="hidden" name="question_id" value="<?php echo isset($quest->question_id)?($quest->question_id):("") ?>">   
              <input type="hidden" name="view" value="entry_comment">
                     
         
             <?php isset($quest->last_vote[0])?($user_id=$quest->last_vote[0]->user_id):("") ?>
             <?php isset($quest->user_info[0])?($u_id=$quest->user_info[0]->user_id):("") ?>
                 <div class="span11">
                        <p><strong><?php echo $quest->title; ?></strong></p>
                        <p><?php echo $quest->description; ?></p>
                   
                        <small>
                        created by:<a href="<?php echo base_url();?>home/user_info/<?php echo $u_id; ?>"> <?php echo isset($quest->user_info[0])?($quest->user_info[0]->username):("") ?></a>
                        | last like by:<a href="<?php echo base_url();?>home/user_info/<?php echo isset($quest->last_vote[0])?($quest->last_vote[0]->user_id):(""); ?>"><?php echo isset($quest->last_vote[0]->username)?($quest->last_vote[0]->username):("") ?></a> | time:<?php 
                     if(isset($quest->last_vote[0]->time))
                                 {  
                                        $seconds = strtotime("now") - strtotime($quest->last_vote[0]->time)+3600;
                                        //echo $seconds;

                                        $minutes = (int)($seconds / 60);
                                        $hours = (int)($minutes / 60);
                                        $days = (int)($hours / 24);
                                        if($seconds <60 && $minutes<60)
                                          {
                                            
                                            echo $seconds  . " seconds ago";
                                          }
                                        else if ( $seconds >= 60 && $minutes< 60 )
                                          {
                                                   
                                                    $seconds = $seconds % 60;
                                                    echo $minutes  . " minutes ";
                                                    echo $seconds  . " seconds ago";
                                          }
                                        else if ( $minutes >= 60 && $hours<24)
                                         {
                                                   
                                                    $minutes = $minutes % 60;
                                                    echo $hours . " hour ";
                                                    echo $minutes  . " minutes ago";
                                          }         
                                        else if ( $hours >= 24 && $days<30 )
                                         {
                                                    
                                                    $hours = $hours % 60;
                                                    echo $days . " days ";
                                                    echo $hours . " hours ago";
                                         }   
                                  }
                                  else
                                  {
                                    echo "not yet";                                  
                                  }                            
                                ?> 
                      </span>
                    
                    
                         <?php   

                                    $session_data = $this->session->userdata('logged_in');
                                    
                                    if($quest->user_info[0]->user_id == $session_data['user_id'])
                                    {
                                      echo '<a href="#" onclick="$(\'#question_delete_'.$quest->question_id.'\').submit();return false;">| delete</a>';
                                    }
                                    else
                                    {
                                      echo"";
                                    } 
                             ?>
                        
                        </small>
                    </form> 
                 </div>
           </div>
           <?php } ?>
    </div> 

    <div class="container">          
        <div class="row">
          
           <h4>Leave your comment !</h4><hr>
           </div>
           <?php foreach($comment as $com){ ?>
           <form action="<?php echo base_url();?>comment/delete_comment" id="comment_delete_<?php echo isset($com->comment_id)?($com->comment_id):("") ?>" method="POST">
           <input type="hidden" name="comment_id" value="<?php echo isset($com->comment_id)?($com->comment_id):("") ?>">
           
          <div class="span12">
            <form action="<?php echo base_url();?>comment/delete_comment" id="comment_delete_<?php echo isset($com->comment_id)?($com->comment_id):("") ?>" method="POST">
            <input type="hidden" name="comment_id" value="<?php echo isset($com->comment_id)?($com->comment_id):("") ?>">
            <input type="hidden" name="view" value="entry_comment">
            <input type="hidden" name="entry_id" value="<?php echo $e_id; ?>">
           
                Time:
                  <?php echo $com->comment_date; ?>
                 <br/>
                Comment:
                  <?php echo $com->comment; ?> <?php   

                                    $session_data = $this->session->userdata('logged_in');
                                    
                                    if($com->user_id == $session_data['user_id'])
                                    {
                                      echo '<a href="#" onclick="$(\'#comment_delete_'.$com->comment_id.'\').submit();return false;"> | delete</a>';
                                    }
                                    else
                                    {
                                      echo"";
                                    } 
                             ?><hr>
                 
              </div>
            </form>
            <?php } ?>
                            
          <form action="<?php echo base_url();?>comment/save_comment" method="POST">
            
              <div class="span6">
                  <input type ="hidden" name="entry_id" value="<?php echo $e_id ?> ">
                  <?php if (! $boolean == false): ?>
                    <textarea class="span8" rows="7" placeholder="enter optional comment" name="comment" id="comment_text"></textarea><br>
                    <button type="submit" class="btn btn-primary">Comment</button>
                  <?php endif; ?>
              </div>
          </form>           
        </div>
<?php include_once('footer.php'); ?>