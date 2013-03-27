<!DOCTYPE html>
<html>
  <head>
    <title>Entry_view</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>bootstrap/css/style.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	  <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2'></script>
    <script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/incrementing.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script> 
           $(document).ready(function()
           {
              $("#flip").click(function()
              {
                 $("#panel").slideDown("slow");
             });
           });
    </script>
  </head>
<body>
  <?php $i=0; ?>
  <?php $e_id=0; ?>
    <div class="container">
      <h2>Questions</a></h2>
          <?php foreach($question as $quest){ ?>
          <?php if (! $boolean == false): ?>
          <div class="row">
            <?php $e_id=$quest->question_id; ?>
            <form action="<?php echo base_url();?>home/rate" id="rate_form_<?php echo $e_id; ?>" method="POST">
                 <div class="span1" <?php if ($quest->is_vote===1){?>style="display:none"<?php } ?>>
                         <input type="hidden" name="like" id="rate_input_<?php echo $e_id; ?>" value="">
                         <input type="hidden" name="view" id="rate_input_<?php echo $e_id; ?>" value="entry">
                         <input type="hidden" name="entry_id" id="entry_id_<?php echo $e_id; ?>" value="<?php echo $e_id; ?>">
                         <a href="#" onclick="$('#rate_input_<?php echo $e_id; ?>').val('1');$('#rate_form_<?php echo $e_id; ?>').submit();return false;"><i class="icon-thumbs-up"> </i> </a>
                         <a href="#" onclick="$('#rate_input_<?php echo $e_id; ?>').val('0');$('#rate_form_<?php echo $e_id; ?>').submit();return false;"><i class="icon-thumbs-down"></i> </a>
                 </div>
                 </form>  
                 <div class="span3">
                                <input type ="hidden" name="entry_id" value="<?php echo $e_id ?> ">
                                <span> Like:<?php echo $quest->title_like; ?>Dislike:<?php echo $quest->title_dislike; ?></span>
                 </div>
         <?php endif; ?>
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
                        <input type="hidden" name="user_id" id="user_info_form_<?php echo isset($user_id)?($user_id):("") ?>" value="<?php echo isset($quest->last_vote[0])?($quest->last_vote[0]->user_id):("") ?>">
                        last like by:<a href="#" onclick="$('#user_info_form_<?php echo isset($user_id)?($user_id):("") ?>').submit();return false;"><?php echo isset($quest->last_vote[0]->username)?($quest->last_vote[0]->username):("") ?></a> time:<?php echo isset($quest->last_vote[0]->time)?($quest->last_vote[0]->time):("") ?> </span>
                    </form>
                    <form action="<?php echo base_url();?>home/user_info" id="user_info_form_<?php echo isset($u_id)?($u_id):("") ?>" method="POST">
                         <input type="hidden" name="user_id" id="user_info_form_<?php echo isset($user_id)?($user_id):("") ?>" value="<?php echo isset($quest->user_info[0])?($quest->user_info[0]->user_id):("") ?>">
                         created by:<a href="#" onclick="$('#user_info_form_<?php echo isset($u_id)?($u_id):("") ?>').submit();return false;"> <?php echo isset($quest->user_info[0])?($quest->user_info[0]->username):("") ?></a>
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
                Zaman:
                  <?php echo $com->comment_date; ?>
                 <br/>
                Yorum:
                  <?php echo $com->comment; ?><p></p><p></p><hr>
              </div>
            <?php } ?>
        
          <form action="<?php echo base_url();?>comment/save_comment" method="POST">
              <div class="span6">
                  <input type ="hidden" name="entry_id" value="<?php echo $e_id ?> ">
                  <?php if (! $boolean == false): ?>
                    <textarea name="comment" id="comment_text"></textarea>
                    <input type="submit" id="comment_process" name="process" class="btn" value="Comment" >
                  <?php endif; ?>
              </div>
          </form>           
        </div>
      </div>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>