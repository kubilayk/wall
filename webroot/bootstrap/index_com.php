<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>jQuery Integration Script</title>
<!--Make sure you change "your_library_file.js" to your path-->
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
 <link rel="stylesheet" type="text/css" href="css/style.css" />
 <link href="css/bootstrap.css" rel="stylesheet" media="screen">
 <style type="text/css"></style>
 </head>
<body>
<script type="text/javascript">
$(document).ready(function() {
   $("#comment_process").click(function(){

          if($("#comment_text").val() !="") { 
          $.post("comments.php?action=post" ,(comment: $("#comment_text").val() ),function(data){
          $(".comments").html(data);
          $("#comment_text").val(" ");
        }
    });

});
</script>
<h2>leave your message/s</h2><hr>
<div class="comment_container">
			<div class="comments tleft">
						<div class="container">
     
     						 <div class="row">

                       				<div class="span1">
                             	    </div>
                       
                     			    <div class="span1">
                          		    </div>

			                       <div class="span10">
			                               
			                               <?php include_once('comments.php'); ?>

			                       </div>
               				 </div>
						</div>
			</div>
			<div class="comment_form">
						<form action="index_com.php" method="POST">
							<table>
							<tr>	<td>
										<textarea name="yorum" id="comment_text"></textarea>
									</td>
									,
									<td>
										<input type="submit" id="comment_process" name="process" class="btn" value="post" >
									</td>
							</tr>
							</table>
						</form>

			</div>
</div>

</body>
</html>