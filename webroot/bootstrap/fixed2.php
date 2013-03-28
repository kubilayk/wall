<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    
    <link rel="stylesheet" type="text/css" href="css/style.css" />
  
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2'></script>
    <script type="text/javascript" src="js/incrementing.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
	</script>
	<script> 
	     $(document).ready(function()
       {
	        $("#flip").click(function()
          {
	           $("#panel").slideDown("slow");
	       });
	});
	</script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>jQuery Integration Script</title>
<!--Make sure you change "your_library_file.js" to your path-->
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	    <style type="text/css">
	
    </style>
  </head>
  <body>
    <div class="container">
         
          <div class="row">

                 <div class="span1">
                         <form id="ratingicon" method="post" action="fixed2.php"> 
                          <div></div>
                         </form>
                 </div>
                 
                 <div class="span1">
                          <input type="text" id="artirma" value="3"/>
                 </div>

                 <div class="span10">
                         <div id="flip"> span10</a>
                		 </div>
                		 <div id="panel">

                		 </div>
                 
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
<div class="comments">
<?php include_once('comments.php'); ?>
</div>
<div class="comment_form tleft">
<form action="fixed2.php" method="POST">
  <table>
  <tr>  

      <td>
        <textarea name="yorum" id="comment_text"></textarea>
      </td>
      
      <td>
        <input type="submit" id="comment_process" name="process" class="btn" value="post" >
      </td>
  </tr>
  </table>
</form>

</div></div>
 <div class="container">
     <form action="fixed2.php" method="POST">
      
         
                <div class="row">

                       <div class="span6">
                            <textarea name="yorum" id="comment_text"></textarea>
                            <input type="submit" id="comment_process" name="process" class="btn" value="post" >
                       </div>
                       
                       
                </div>
      </form>
         
                
    </div>
   
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>