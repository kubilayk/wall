<?php include_once('header.php'); ?>

      <?php $e_id=0;?>
      <?php $i=0 ?>

      <?php $k=0;
      foreach($question_info as $quest){ ?>
          
           <div class="row">
              <?php $e_id=$quest->question_id; ?>
              
                   
                   <div class="span1" style="text-align: right;">
                    <span> 
                    <form action="<?php echo base_url();?>home/rate" id="rate_form_<?php echo $e_id; ?>" method="POST">
                      <?php if (! $boolean == false): ?> 
                          <input type="hidden" name="like" id="rate_input_<?php echo $e_id; ?>" value="">
                          <input type="hidden" name="entry_id" id="entry_id_<?php echo $e_id; ?>" value="<?php echo $e_id; ?>">
                          <input type="hidden" name="view" value="search">
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
                      <small>Like:<?php echo $quest->title_like; ?>
                      </small>
                    </form> 
                    </span>
                  </div>
                    
                  
<form action="<?php echo base_url();?>entry/delete_entry" id="question_delete_<?php echo isset($quest->question_id)?($quest->question_id):("") ?>" method="POST">
<input type="hidden" name="question_id" value="<?php echo isset($quest->question_id)?($quest->question_id):("") ?>">
<input type="hidden" name="view" value="">
       
                
                    <?php isset($quest->last_vote[0])?($user_id=$quest->last_vote[0]->user_id):("") ?>
                    <?php isset($quest->user_info[0])?($u_id=$quest->user_info[0]->user_id):("") ?>
                    <div class="span8">

       
                        <a class="overtext"href="entry/<?php echo $quest->question_id;?>"><?php echo $quest->title;?></a><small>created by:<a href="<?php echo base_url();?>home/user_info/<?php echo $u_id; ?>"> <?php echo isset($quest->user_info[0])?($quest->user_info[0]->username):("") ?></a>
                        
                            
                            last like by:<a href="<?php echo base_url();?>home/user_info/<?php echo isset($quest->last_vote[0])?($quest->last_vote[0]->user_id):("") ?>" ><?php echo isset($quest->last_vote[0]->username)?($quest->last_vote[0]->username):("") ?></a> time:<?php 
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
                                    echo "";                                  
                                  }                            
                                ?> </span>

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
                    <div class="span3">
                         <span> <?php 
                                 
                                        $seconds = strtotime("now") - strtotime($quest->question_date)+3600;
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
                                ?>
                            </span>
                               
                  </div>
                  
            </div>
<?php $k++;; ?>
      <?php } ?>
      <span><?php echo "$k"; ?> sonuç bulundu</span>


<?php include_once('footer.php'); ?>