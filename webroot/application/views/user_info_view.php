<?php include_once('header.php'); ?>
		<?php foreach($user_info as $user){ ?>
		 	<div class="row">
				<div class="span2">
					<label for="user_name">User Name:</label>
				</div>

				<div class="span10">
				     <label ><?php echo $user->username ?></label>
			    </div>

			    <div class="span2">
					<label for="email_address">Your Email:</label>
				</div>

				<div class="span10">
					<label ><?php echo $user->email ?></label>
				</div>

				<div class="span7">
					<form action="<?php echo base_url();?>home/user_question" id="user_question" method="POST">
                            <input type="hidden" name="user_id" id="user_question" value="<?php echo $user->user_id ?>">
                            <a href="#" onclick="$('#user_question').submit();return false;">Question</a>
                    </form>
				</div>

				<div class="span7">
				    <form action="<?php echo base_url();?>home/user_comment" id="user_comment" method="POST">
                            <input type="hidden" name="user_id" id="user_comment" value="<?php echo $user->user_id ?>">
                            <a href="#" onclick="$('#user_comment').submit();return false;">Comment</a>
                    </form>
				</div>
				
		    </div>
		<?php } ?>
	
	
<?php include_once('footer.php'); ?>