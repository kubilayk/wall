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
					
                            
                            <a href="<?php echo base_url();?>home/user_question/<?php echo $user->user_id; ?>">Questions</a>
                    
				</div>

				<div class="span7">
				    
                            <a href="<?php echo base_url();?>home/user_comment/<?php echo $user->user_id; ?>">Comments</a>
                   
				</div>
				
		    </div>
		<?php } ?>
	
	
<?php include_once('footer.php'); ?>