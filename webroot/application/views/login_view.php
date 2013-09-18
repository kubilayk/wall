
<?php include_once('header.php'); ?>

	<div id='login_form'>
		<form action='<?php echo base_url();?>account/user_login' method='post' name='process'>
			<div class="container">
		 	<div class="row">
				<div class="span12">
					<h2><?php echo  $this->lang->line("user_lo")?></h2>
				</div>
				<div id="msg"class="span12">	
					<?php if(! is_null($msg)) echo $msg;?>	
				</div>	
				<div class="span12">
					<label for='username'><?php echo  $this->lang->line("user_n")?></label>
				</div>
				<div class="span12">
					<input type='text' name='username' id='username' size='25' value="" />
				</div>
				<div class="span12">
					<label for='password'><?php echo  $this->lang->line("pass_w")?></label>
				</div>
				<div class="span12">
					<input type='password' name='password' id='password' size='25' value="" />
				</div>
				<div class="span12">
					<a href="<?php echo base_url();?>account/forget_password"><?php echo  $this->lang->line("for_pass")?></a>
				</div>							
				<div class="span12">
					<br>
					<input type='Submit' class="btn btn-success" value='Login' />
				</div>
				
		</form>


	</div>
<?php include_once('footer.php'); ?>