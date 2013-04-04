<?php include_once('header.php'); ?>
      
      <?php $i=0 ?>
      <?php $e_id=0; ?>
      <?php  foreach($user_comment as $com){ ?>
        
                <div class="row" <?php if ($com->last_comment===0){?>style="display:none"<?php } ?> >
            <?php $e_id=$com->question_id;
                  $u_id =$com->user_id; 
            ?>
           
                 <div class="span1" style="text-align: right;">
                    <span>
                     <form action="<?php echo base_url();?>home/rate" id="rate_form_<?php echo $e_id; ?>" method="POST">
                     <?php if (! $boolean == false): ?>  
                         <input type="hidden" name="like" id="rate_input_<?php echo $e_id; ?>" value="">
                         <input type="hidden" name="entry_id" id="entry_id_<?php echo $e_id; ?>" value="<?php echo $e_id; ?>">
                         <input type="hidden" name="view" value="user_comment">
                         <input type="hidden" name="user" value="<?php echo $u_id; ?>">
                         <?php if ($com->is_vote===0)
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
                         Like:<?php echo isset($com->title_like)?($com->title_like):("") ?>
                         </small> 
                      </form>
                    </span>
                 </div>
        
<form action="<?php echo base_url();?>comment/delete_comment" id="comment_delete_<?php echo isset($com->last_comment[0])?($com->last_comment[0]->comment_id):("") ?>" method="POST">
<input type="hidden" name="comment_id" value="<?php echo isset($com->last_comment[0])?($com->last_comment[0]->comment_id):("") ?>">
<input type="hidden" name="view" value="user_comment">
<input type="hidden" name="user_id" value="<?php echo $com->user_info[0]->user_id; ?>">                   
                  
                   <?php isset($com->last_comment[0])?($user_id=$com->last_comment[0]->user_id):("") ?>
                   <?php isset($com->user_info[0])?($u_id=$com->user_info[0]->user_id):("") ?>
                   <div class="span11">
                        
                        
                      <small><span> Last comment:<?php echo isset($com->last_comment[0])?($com->last_comment[0]->comment):("") ?> </span>
                        <br/> created by:<a href="<?php echo base_url();?>home/user_info/<?php echo $u_id; ?>"> <?php echo isset($com->user_info[0])?($com->user_info[0]->username):("") ?></a>
                        | time: <span> <?php 
                                 
                                        $seconds = strtotime("now") - strtotime($com->last_comment[0]->comment_date);
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
                          <?php   

                                    $session_data = $this->session->userdata('logged_in');
                                    
                                    if($com->user_info[0]->user_id == $session_data['user_id'])
                                    {
                                      echo '<a href="#" onclick="$(\'#comment_delete_'.$com->last_comment[0]->comment_id.'\').submit();return false;">| delete</a>';
                                    }
                                    else
                                    {
                                      echo"";
                                    } 
                             ?>
                          
                              
                        <span><br/>on:<a class="overtext"href="<?php echo base_url();?>entry/<?php echo $com->question_id;?>"><?php echo $com->title;?></a></span>
                        </small>
                   </div>
                
                   
                </div>
                <?php } ?>
        </div>


  <?php include_once('footer.php'); ?>