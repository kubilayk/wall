<?php include_once('header.php'); ?>

      
      <?php $e_id=0; ?>
      <?php $i=0 ?>
      <?php foreach($comment as $com){ ?>
         <?php $u_id=$com->user_id ?>
              <div class="row">
                 <?php $e_id = $com->question_id; ?>
                  <div class="span1" < style="text-align: right;">
                         <?php if (! $boolean == false): ?>   
                         <span>
                           <form action="<?php echo base_url();?>home/rate" id="rate_form_<?php echo $e_id; ?>" method="POST">
                           
                               <input type="hidden" name="like" id="rate_input_<?php echo $e_id; ?>" value="">
                               <input type="hidden" name="view" id="rate_input_<?php echo $e_id; ?>" value="comment">
                               <input type="hidden" name="entry_id" id="entry_id_<?php echo $e_id; ?>" value="<?php echo $e_id; ?>">
                               <?php if ($com->is_vote == 0)
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
                              <small class="label label-info">
                              Like : <?php echo isset($com->title_like)?($com->title_like):(0) ?>
                              </small>
                          </form> 
                          </span>
                    </div>
                    <div class="span11">
                      <form action="<?php echo base_url();?>comment/delete_comment" id="comment_delete_<?php echo $com->comment_id ?>" method="POST">
                      <input type="hidden" name="comment_id" value="<?php echo $com->comment_id ?>">               
                      <input type="hidden" name="view" value="last_comment">                           
                                      
                        <span> Last comment : <?php echo $com->comment ?></span>
                        <small> <br/> created by : 
                          <?php  
                          if($guest===0)
                          { 
                          ?> 
                          <a href="<?php echo base_url();?>home/user_info/<?php echo $u_id; ?>"> <?php echo $com->username ?></a>
                          <?php }else{ ?>
                          <a class="create-user" href="#"> <?php echo $com->username ?></a>
                          <?php } ?>
                          | time : 
                          <?php 
                            if(isset($com->comment_date))
                             {  
                                    $seconds = strtotime("now") - strtotime($com->comment_date);
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
                          
                          ?> 

                          <?php   

                                    $session_data = $this->session->userdata('logged_in');
                                    
                                    if($u_id == $session_data['user_id'])
                                    {
                                      echo '| <a href="#" onclick="$(\'#comment_delete_'.$com->comment_id.'\').submit();return false;"> delete</a>';
                                    }
                                    else
                                    {
                                      echo"";
                                    } 
                          ?>
                          <span><br/>on:<a href="<?php echo base_url();?>entry/<?php echo $com->question_id;?>"><?php echo $com->title;?></a></span>
                          </small>

                        </form>
                      </div>
              </div>
<?php } ?>

    
  <?php include_once('footer.php'); ?>