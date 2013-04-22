<?php include_once('header.php'); ?>
	

		<?php echo validation_errors('<p class="error">'); ?>
	<?php echo form_open(base_url()."account/change_password_validate/".$session_data['user_id'] ); ?>
		 
		 	<div class="row">
		 		<div id="msg"class="span12">	
						<?php if(! is_null($msg)) echo $msg; else{echo "";}?>
				</div>
				<div class="span2">
					<label for="user_name">User Name:</label>
				</div>
				<div class="span10">
				     <input type="text" id="username" name="username" value="<?php echo isset($user_info[0]->username)?($user_info[0]->username):("") ?><?php echo set_value('user_name'); ?>" />
			    </div>
			    <div class="span2">
					<label for="email">Your Email:</label>
				</div>
				<div class="span10">
					<input type="text" id="email" name="email" value="<?php echo isset($user_info[0]->email)?($user_info[0]->email):("")?><?php echo set_value('email_address'); ?>" />
				</div>
				<div class="span2">
					<label for="password">Password:</label>
				</div>
				<div class="span10">
					<input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
				</div>
				<div class="span2">
					<label for="con_password">Confirm Password:</label>
				</div>
				<div class="span10">
					<input type="password" id="con_password" name="con_password" value="<?php echo set_value('con_password'); ?>" />
				</div>
				<div class="span12">
					<input type="submit" value="Submit" class="btn btn-primary"/> &nbsp; &nbsp; &nbsp;
				</div>
				
			</div>
		
	<?php echo form_close(); ?>
	


<?php include_once('footer.php'); ?>