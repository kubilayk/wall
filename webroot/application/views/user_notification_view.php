<?php include_once('header.php'); ?>

       <?php $e_id=0;?>
      <?php $i=0 ?>
      <?php //print_r($user_notification);
      foreach($user_notification as $user_not){ ?>
      <?php  //print_r($user_not); ?>
           <div class="row">
              <?php $e_id=$user_not->notification[0]->ref_id; ?>
             
                   
                   <div class="span1" style="text-align: right;">
                    <?php if (! $boolean == false): ?>   
                      
                     <span> 
                      <form action="<?php echo base_url();?>home/rate" id="rate_form_<?php echo $e_id; ?>" method="POST">
                       <input type="hidden" name="like" id="rate_input_<?php echo $e_id; ?>" value=""> 
                        
                         <input type="hidden" name="view" id="rate_input_<?php echo $e_id; ?>" value="">
                         <input type="hidden" name="entry_id" id="entry_id_<?php echo $e_id; ?>" value="<?php echo $e_id; ?>">
                          
                        <?php if ($user_not->is_vote===0)
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
                      <small class="label label-info"> <?php echo  $this->lang->line("like_k")?> : <?php echo ( $user_not->notification[0]->title_like ? $user_not->notification[0]->title_like : 0 ); ?></small>
                      </form> 
                    </span>                        
                   </div>
                    

                    <div class="span11" style="text-align: left;">
                    <?php if(isset($user_not->notification[0])) {?> 
                        <a class="overtext" href="<?php echo base_url();?>entry/<?php echo isset($user_not->notification[0])?($user_not->notification[0]->ref_id):("");?>" style="display:block;"><?php echo isset($user_not->notification[0])?($user_not->notification[0]->title):("");?></a>
                       <?php if($user_not->notification[0]->type=="like"){ ?>
                            <small>  liked by:</small>
                       <?php }else if($user_not->notification[0]->type=="comment") { ?>
                            <small>commented by:</small>
                      <?php } else{?>
                            <small>created by:</small>
                      <?php } ?>
                       <?php  
                          if($user_not===0)
                          {  
                        ?> 
                        <a href="#">
                         <?php echo isset($user_not->notification[0])?($user_not->notification[0]->username):("") ?></a>
                        <?php }else{ ?>
                        <a class="create-user" href="<?php echo base_url();?>home/user_info/<?php echo isset($user_not->notification[0])?($user_not->notification[0]->from):(""); ?>"><?php echo isset($user_not->notification[0])?($user_not->notification[0]->username):("") ?></a>
                         <?php } ?>
                         </small>   
                         
                        <?php } ?>
                        | time:<?php 
                                 if(isset($user_not->u_not_date))
                                 {  
                                        $seconds = strtotime("now") - strtotime($user_not->u_not_date);
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
                      </div> 
                      
            </div>

            
      <?php } ?>
<?php print_r($links);?>

<?php include_once('footer.php'); ?>