<?php include_once('header.php'); ?>
	

		<?php echo validation_errors('<p class="error">'); ?>
	<?php echo form_open(base_url()."account/update_profile_validate"); ?>
		 
		 	<div class="row">
		 		<div id="msg"class="span12">	
					<?php if(! is_null($msg)) echo $msg;?>	
				</div>	
				<div class="span2">
					<label for="user_name">User Name:</label>
				</div>
				<div class="span10">
				     <input type="text" id="user_name" name="user_name" value="<?php echo isset($user_info[0]->username)?($user_info[0]->username):("") ?><?php echo set_value('user_name'); ?>" />
			    </div>
			    <div class="span2">
					<label for="email_address">Your Email:</label>
				</div>
				<div class="span10">
					<input type="text" id="email_address" name="email_address" value="<?php echo isset($user_info[0]->email)?($user_info[0]->email):("")?><?php echo set_value('email_address'); ?>" />
				</div>
				
				
				<div class="span12">
					<input type="submit" value="Update" class="btn btn-primary"/> &nbsp; &nbsp; &nbsp;
				</div>
			
			</div>
		
	<?php echo form_close(); ?>
	


<?php include_once('footer.php'); ?>