<?php include_once('header.php'); ?>
	

		<?php echo validation_errors('<p class="error">'); ?>
	<?php echo form_open(base_url()."account/change_password_user/".$session_data['user_id'] ); ?>
		 
		 	<div class="row">
		 		<div class="span12">
					<h2>Change Password</h2>
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