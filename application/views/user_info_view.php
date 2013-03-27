<?php include_once('header.php'); ?>
	

		
		 <div class="container">
		 
		 	<?php  
          if($guest===0)
          {
            echo '<h2>Welcome '.$username.'</h2>';
          }
          else
          {
            echo '<h2>Welcome<a href='.base_url().'account >'.$guest.'</a></h2>';
          }
   			 ?>
   		
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
		</div>
		<?php } ?>
	
	
<?php include_once('footer.php'); ?>