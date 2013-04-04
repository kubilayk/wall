<?php include_once('header.php'); ?>

      <?php $e_id=0;?>
      <?php $i=0 ?>
      <?php foreach($question as $quest){ ?>

           <div class="row">
              <?php $e_id=$quest->question_id; ?>
             
                   
                   <div class="span1" style="text-align: right;">
                    <?php if (! $boolean == false): ?>   
                      
                     <span> 
                      <form action="<?php echo base_url();?>home/rate" id="rate_form_<?php echo $e_id; ?>" method="POST">
                       <input type="hidden" name="like" id="rate_input_<?php echo $e_id; ?>" value=""> 
                        
                         <input type="hidden" name="view" id="rate_input_<?php echo $e_id; ?>" value="">
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
                      <input type ="hidden" name="entry_id" value="<?php echo $e_id ?> ">
                      <small class="label label-info"> Like : <?php echo ( $quest->title_like ? $quest->title_like : 0 ); ?></small>
                      </form> 
                    </span>                        
                   </div>
                    
                  <form action="<?php echo base_url();?>entry/delete_entry" id="question_delete_<?php echo isset($quest->question_id)?($quest->question_id):("") ?>" method="POST">
                  <input type="hidden" name="question_id" value="<?php echo isset($quest->question_id)?($quest->question_id):("") ?>">   
                         
                    
                
                    <?php isset($quest->last_vote[0])?($user_id=$quest->last_vote[0]->user_id):("") ?>
                    <?php isset($quest->user_info[0])?($u_id=$quest->user_info[0]->user_id):("") ?>
                    <div class="span11" style="text-align: left;">
                      
                        <a class="overtext" href="<?php echo base_url();?>entry/<?php echo $quest->question_id;?>" style="display:block;"><?php echo $quest->title;?></a>
                       <small>  created by:
                        <?php  
                          if($guest===0)
                          { 
                        ?> 
                        <a href="<?php echo base_url();?>home/user_info/<?php echo $u_id; ?>"> <?php echo isset($quest->user_info[0])?($quest->user_info[0]->username):("") ?></a>
                        <?php }else{ ?>
                        <a class="create-user" href="#"><?php echo isset($quest->user_info[0])?($quest->user_info[0]->username):("") ?></a>
                         <?php } ?>
                         </small>   
                            <small> | last like by:
                              <?php  
                                if($guest===0)
                                { 
                              ?> 
                              <a href="<?php echo base_url();?>home/user_info/<?php echo isset($quest->last_vote[0])?($quest->last_vote[0]->user_id):("") ?>"><?php echo isset($quest->last_vote[0]->username)?($quest->last_vote[0]->username):("") ?></a>
                              <?php }else{ ?>
                              <a class="create-user" href="#"><?php echo isset($quest->last_vote[0]->username)?($quest->last_vote[0]->username):("") ?></a>
                              <?php } ?>

                               | time:<?php 
                                 if(isset($quest->question_date))
                                 {  
                                        $seconds = strtotime("now") - strtotime($quest->question_date);
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
                              | <a href="<?php echo base_url();?>entry/<?php echo $quest->question_id;?>"><?php echo isset($quest->total_comment)?($quest->total_comment):(0) ?> comment</a> 
                              <?php   

                                    $session_data = $this->session->userdata('logged_in');
                                    
                                    if($quest->user_info[0]->user_id == $session_data['user_id'])
                                    {
                                      echo '| <a href="#" onclick="$(\'#question_delete_'.$quest->question_id.'\').submit();return false;"> delete</a>';
                                    }
                                    else
                                    {
                                      echo"";
                                    } 
                             ?>




                            
                        </form> 
                        </small>                          
                        </small>
                        
                  </div>  
                  
            </div>
            
      <?php } ?>


<?php include_once('footer.php'); ?>