<?php include_once('header.php'); ?>
  <?php $i=0; ?>
  <?php $e_id=0; ?>
  
      <h2>Questions</a></h2>
          <?php foreach($question as $quest){ ?>
          
          <div class="row">
            <?php $e_id=$quest->question_id; ?>
            
                 <div class="span1" <?php if ($quest->is_vote===1){?>style="display:none"<?php } ?> style="text-align: right;">
                    <form action="<?php echo base_url();?>home/rate" id="rate_form_<?php echo $e_id; ?>" method="POST">
                         <span>
                         <?php if (! $boolean == false): ?>
                         <input type="hidden" name="like" id="rate_input_<?php echo $e_id; ?>" value="">
                         <input type="hidden" name="view" id="rate_input_<?php echo $e_id; ?>" value="entry">
                         <input type="hidden" name="entry_id" id="entry_id_<?php echo $e_id; ?>" value="<?php echo $e_id; ?>">
                         <a href="#" onclick="$('#rate_input_<?php echo $e_id; ?>').val('1');$('#rate_form_<?php echo $e_id; ?>').submit();return false;"><i class="icon-thumbs-up"> </i> </a>
                         <a href="#" onclick="$('#rate_input_<?php echo $e_id; ?>').val('0');$('#rate_form_<?php echo $e_id; ?>').submit();return false;"><i class="icon-thumbs-down"></i> </a>
                         <?php endif; ?>
                         <input type ="hidden" name="entry_id" value="<?php echo $e_id ?> ">
                         <small>  Like:<?php echo $quest->title_like; ?>
                         </small>
                         </span>
                      </form>
                 </div>
                  
                 
         
             <?php isset($quest->last_vote[0])?($user_id=$quest->last_vote[0]->user_id):("") ?>
             <?php isset($quest->user_info[0])?($u_id=$quest->user_info[0]->user_id):("") ?>
                 <div class="span7">
                    <div id="flip">
                        <?php echo $quest->title; ?></a>
                    </div>
                    <div id="panel">
                        <?php echo $quest->description; ?>
                    </div>
                    <form action="<?php echo base_url();?>home/user_info" id="user_info_form_<?php echo isset($user_id)?($user_id):("") ?>" method="POST">
                        <small>
                        <input type="hidden" name="user_id" id="user_info_form_<?php echo isset($user_id)?($user_id):("") ?>" value="<?php echo isset($quest->last_vote[0])?($quest->last_vote[0]->user_id):("") ?>">
                        last like by:<a href="#" onclick="$('#user_info_form_<?php echo isset($user_id)?($user_id):("") ?>').submit();return false;"><?php echo isset($quest->last_vote[0]->username)?($quest->last_vote[0]->username):("") ?></a> time:<?php echo isset($quest->last_vote[0]->time)?($quest->last_vote[0]->time):("") ?> </span>
                    </form>
                    <form action="<?php echo base_url();?>home/user_info" id="user_info_form_<?php echo isset($u_id)?($u_id):("") ?>" method="POST">
                        <input type="hidden" name="user_id" id="user_info_form_<?php echo isset($user_id)?($user_id):("") ?>" value="<?php echo isset($quest->user_info[0])?($quest->user_info[0]->user_id):("") ?>">
                        created by:<a href="#" onclick="$('#user_info_form_<?php echo isset($u_id)?($u_id):("") ?>').submit();return false;"> <?php echo isset($quest->user_info[0])?($quest->user_info[0]->username):("") ?></a>
                        </small>
                    </form>
                 </div>
           </div>
           <?php } ?>
    </div> 

    <div class="container">          
        <div class="row">
           <div class="span12">
                  <h2>Leave your comment !</h2><hr>
           </div>
           <?php foreach($comment as $com){ ?>
             <div class="span12">
                Time:
                  <?php echo $com->comment_date; ?>
                 <br/>
                Comment:
                  <?php echo $com->comment; ?><p></p><p></p><hr>
              </div>
            <?php } ?>
        
          <form action="<?php echo base_url();?>comment/save_comment" method="POST">
              <div class="span6">
                  <input type ="hidden" name="entry_id" value="<?php echo $e_id ?> ">
                  <?php if (! $boolean == false): ?>
                    <textarea name="comment" id="comment_text"></textarea><br>
                    <button type="submit" class="btn btn-primary">Comment</button>
                  <?php endif; ?>
              </div>
          </form>           
        </div>
<?php include_once('footer.php'); ?>