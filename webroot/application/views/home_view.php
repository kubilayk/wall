<?php include_once('header.php'); ?>


    <div class="container">
   
      <?php $e_id=0;?>
      <?php $i=0 ?>
      <?php foreach($question as $quest){ ?>
         <?php if (! $boolean == false): ?>  
           <div class="row">
              <?php $e_id=$quest->question_id; ?>
              <form action="<?php echo base_url();?>home/rate" id="rate_form_<?php echo $e_id; ?>" method="POST">
                   <div class="span1">
                    <span> <?php $i=$i+1; echo "$i"; ?> </span>
                   </div>
                   <div class="span2" <?php if ($quest->is_vote===1){?>style="display:none"<?php } ?>>
                      <input type="hidden" name="like" id="rate_input_<?php echo $e_id; ?>" value="">
                      <input type="hidden" name="entry_id" id="entry_id_<?php echo $e_id; ?>" value="<?php echo $e_id; ?>">
                           <a href="#" onclick="$('#rate_input_<?php echo $e_id; ?>').val('1');$('#rate_form_<?php echo $e_id; ?>').submit();return false;"><i class="icon-thumbs-up"> </i> </a>
                           <a href="#" onclick="$('#rate_input_<?php echo $e_id; ?>').val('0');$('#rate_form_<?php echo $e_id; ?>').submit();return false;"><i class="icon-thumbs-down"></i> </a>
           </div>
              </form>       
                  
                    <div class="span2">
                       <input type ="hidden" name="entry_id" value="<?php echo $e_id ?> ">
                       <span> Like:<?php echo $quest->title_like; ?>Dislike:<?php echo $quest->title_dislike; ?></span>
                    </div>
       <?php endif; ?>
                
          <?php isset($quest->last_vote[0])?($user_id=$quest->last_vote[0]->user_id):("") ?>
          <?php isset($quest->user_info[0])?($u_id=$quest->user_info[0]->user_id):("") ?>
                    <div class="span5">
                        <a href="entry/<?php echo $quest->question_id;?>"><?php echo $quest->title;?></a>
                        <form action="<?php echo base_url();?>home/user_info" id="user_info_form_<?php echo isset($user_id)?($user_id):("") ?>" method="POST">
                            <input type="hidden" name="user_id" id="user_info_form_<?php echo isset($user_id)?($user_id):("") ?>" value="<?php echo isset($quest->last_vote[0])?($quest->last_vote[0]->user_id):("") ?>">
                            last like by:<a href="#" onclick="$('#user_info_form_<?php echo isset($user_id)?($user_id):("") ?>').submit();return false;"><?php echo isset($quest->last_vote[0]->username)?($quest->last_vote[0]->username):("") ?></a> time:<?php echo isset($quest->last_vote[0]->time)?($quest->last_vote[0]->time):("") ?> </span>
                        </form>
                        <form action="<?php echo base_url();?>home/user_info" id="user_info_form_<?php echo isset($u_id)?($u_id):("") ?>" method="POST">
                            <input type="hidden" name="user_id" id="user_info_form_<?php echo isset($user_id)?($user_id):("") ?>" value="<?php echo isset($quest->user_info[0])?($quest->user_info[0]->user_id):("") ?>">
                            created by:<a href="#" onclick="$('#user_info_form_<?php echo isset($u_id)?($u_id):("") ?>').submit();return false;"> <?php echo isset($quest->user_info[0])?($quest->user_info[0]->username):("") ?></a>
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
                                            
                                            echo "Seconds:".$seconds;
                                          }
                                        else if ( $seconds >= 60 && $minutes< 60 )
                                          {
                                                   
                                                    $seconds = $seconds % 60;
                                                    echo "Minutes:".$minutes;
                                                    echo "Seconds:".$seconds;
                                          }
                                        else if ( $minutes >= 60 && $hours<24)
                                         {
                                                   
                                                    $minutes = $minutes % 60;
                                                    echo "Hour:".$hours;
                                                    echo "Minutes:".$minutes;
                                          }         
                                        else if ( $hours >= 24 && $days<30 )
                                         {
                                                    
                                                    $hours = $hours % 60;
                                                    echo "Days:".$days;
                                                    echo "Hours:".$hours;
                                         }                               
                                ?>
                            </span>
                               
                  </div>
                  
            </div>
      <?php } ?>
  </div>


<?php include_once('footer.php'); ?>