<?php include_once('header.php'); ?>
	

		<?php echo validation_errors('<p class="error">'); ?>
	<?php echo form_open(base_url()."account/sign_up"); ?>
		 
		 	<div class="row">
				<div class="span2">
					<label for="user_name">User Name:</label>
				</div>
				<div class="span10">
				     <input type="text" id="user_name" name="user_name" value="<?php echo set_value('user_name'); ?>" />
			    </div>
			    <div class="span2">
					<label for="email_address">Your Email:</label>
				</div>
				<div class="span10">
					<input type="text" id="email_address" name="email_address" value="<?php echo set_value('email_address'); ?>" />
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
					<input type="submit" value="Submit" class="btn btn-primary"/> &nbsp; &nbsp; &nbsp; <a href="<?php echo base_url();?>account/login" class="btn btn-success">Login</a>&nbsp; &nbsp; &nbsp;
				</div>
				<div class="span12">

				</div>
			</div>
		
	<?php echo form_close(); ?>
	<div id="dialog-form" title="Login">
		  <p class="validateTips">All form fields are required.</p>
		 
		  <form>
		  <fieldset>
		    <label for="name">Name</label>
		    <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
		    
		    <label for="password">Password</label>
		    <input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
		  </fieldset>
		  </form>
   </div>
 
 <button id="create-user">Create new user</button>



<?php include_once('footer.php'); ?>