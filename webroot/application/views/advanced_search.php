<?php include_once('header.php'); ?>
	

		
	<form action="<?php echo base_url();?>home/advanced" method="POST"> 
		 
		 	<div class="row">
				<div class="span2">
					<label for="user_name"><?php echo  $this->lang->line("title_e")?></label>
				</div>
				<div class="span10">
				     <input type="text" id="q_title" name="q_title"/>
			    </div>
			    <div class="span2">
					<label for="email_address"><?php echo  $this->lang->line("desc")?></label>
				</div>
				<div class="span10">
					<input type="text" id="q_description" name="q_description"/>
				</div>
				
				<div class="span12">
					<input type="submit" value="<?php echo  $this->lang->line("subm")?>" />
				</div>
				
			</div>
		
	</form>
	
<?php include_once('footer.php'); ?>