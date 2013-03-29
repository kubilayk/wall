<?php include_once('header.php'); ?>
      
      <?php $i=0 ?>
      <?php $e_id=0; ?>
      <?php  foreach($user_comment as $com){ ?>
        
                <div class="row" <?php if ($com->last_comment===0){?>style="display:none"<?php } ?> >
            <?php $e_id=$com->question_id; ?>
            <form action="<?php echo base_url();?>home/rate" id="rate_form_<?php echo $e_id; ?>" method="POST">
                 <div class="span1" <?php if ($com->is_vote===1){?>style="display:none"<?php } ?> style="text-align: right;">
                     <?php if (! $boolean == false): ?>  
                         <input type="hidden" name="like" id="rate_input_<?php echo $e_id; ?>" value="">
                         <input type="hidden" name="entry_id" id="entry_id_<?php echo $e_id; ?>" value="<?php echo $e_id; ?>">
                         <a href="#" onclick="$('#rate_input_<?php echo $e_id; ?>').val('1');$('#rate_form_<?php echo $e_id; ?>').submit();return false;"><i class="icon-thumbs-up"> </i> </a>
                         <a href="#" onclick="$('#rate_input_<?php echo $e_id; ?>').val('0');$('#rate_form_<?php echo $e_id; ?>').submit();return false;"><i class="icon-thumbs-down"></i> </a>
                    <?php endif; ?>
                         <input type ="hidden" name="entry_id" value="<?php echo $e_id ?> ">
                         <small> 
                         Like:<?php echo isset($com->title_like)?($com->title_like):("") ?>
                         </small> 
                 </div>
        
             </form>       
                  <div class="span1" style="text-align: right;">
                      <span> <?php $i=$i+1; echo "$i."; ?> </span>
                  </div>    
                  
                   <?php isset($com->last_comment[0])?($user_id=$com->last_comment[0]->user_id):("") ?>
                   <?php isset($com->user_info[0])?($u_id=$com->user_info[0]->user_id):("") ?>
                   <div class="span5">
                        <a href="entry/<?php echo $com->question_id;?>"><?php echo $com->title;?></a>
                        <small>
                        <span> Last comment:<?php echo isset($com->last_comment[0])?($com->last_comment[0]->comment):("") ?></span>
                        <form action="<?php echo base_url();?>home/user_info" id="user_info_form_<?php echo $user_id; ?>" method="POST">
                            <input type="hidden" name="user_id" id="user_info_form_<?php echo $user_id; ?>" value="<?php echo $com->last_comment[0]->user_id; ?>">
                            <a href="#" onclick="$('#user_info_form_<?php echo $user_id; ?>').submit();return false;"> <?php echo isset($com->last_comment[0])?($com->last_comment[0]->username):("") ?></a>
                        </form>
                        <form action="<?php echo base_url();?>home/user_info" id="user_info_form_<?php echo isset($u_id)?($u_id):("") ?>" method="POST">
                            <input type="hidden" name="user_id" id="user_info_form_<?php echo isset($user_id)?($user_id):("") ?>" value="<?php echo isset($com->user_info[0])?($com->user_info[0]->user_id):("") ?>">
                            created by:<a href="#" onclick="$('#user_info_form_<?php echo isset($u_id)?($u_id):("") ?>').submit();return false;"> <?php echo isset($com->user_info[0])?($com->user_info[0]->username):("") ?></a>
                        </small> 
                        </form>
                   </div>
                
                   <div class="span3" <?php if ($com->last_comment===0){?>style="display:none"<?php } ?>>
                          <span> at: <span> <?php 
                                 
                                        $seconds = strtotime("now") - strtotime($com->last_comment[0]->comment_date)+3600;
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
                                          ?></span> </span>

                       </div>
                </div>
                <?php } ?>
        </div>


  <?php include_once('footer.php'); ?>