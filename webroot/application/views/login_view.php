
<?php include_once('header.php'); ?>

	<div id='login_form'>
		<form action='<?php echo base_url();?>account/user_login' method='post' name='process'>
			<div class="container">
		 	<div class="row">
				<div class="span12">
					<h2>User Login</h2>
				</div>
				<div id="msg"class="span12">	
					<?php if(! is_null($msg)) echo $msg;?>	
				</div>	
				<div class="span12">	
					<label for='username'>Username</label>
				</div>
				<div class="span12">
					<input type='text' name='username' id='username' size='25' value="" />
				</div>
				<div class="span12">
					<label for='password'>Password</label>
				</div>
				<div class="span12">
					<input type='password' name='password' id='password' size='25' value="" />
				</div>							
				<div class="span12">
					<input type='Submit' class="btn btn-success" value='Login' />
				</div>
				<div class="span12">
					<a href="<?php echo base_url();?>account/forget_password">Parolamı unuttum</a>
				</div>
		</form>


	</div>
<?php include_once('footer.php'); ?>