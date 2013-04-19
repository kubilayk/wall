
<?php include_once('header.php'); ?>

	<div id='forget_form'>
		<form action='<?php echo base_url();?>account/send_email' method='post' name='process'>
			<div class="container">
		 	<div class="row">
				<div class="span12">
					<h2>Forget Password</h2>
				</div>
				<div id="msg"class="span12">	
					<?php if(! is_null($msg)) echo $msg;?>	
				</div>	
				<div class="span12">	
					<label for='username'>Enter your E-mail:</label>
				</div>
				<div class="span12">
					<input type='text' name='email' id='email' size='25' value="" />
				</div>			
				<div class="span12">
					<input type='Submit' class="btn btn-success" value='Send' />
				</div>
				
		</form>


	</div>
<?php include_once('footer.php'); ?>