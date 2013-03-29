<!DOCTYPE html>
<html>
  <head>
    <title><?php echo (isset($page_title)) ? $page_title : 'Default title text'; ?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>bootstrap/css/style.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2'></script>
    <script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/incrementing.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script> 
        $(document).ready(function(){
          $("#flip").click(function(){
            $("#panel").slideToggle("slow");
          });
        });
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
  </head>
  <body>
    <br>
<div class="container">
  <div class="navbar">
    <div class="navbar-inner">
    <ul class="nav">
      <li><a href="<?php echo base_url();?>home">WriteWall</a> </li>
      <li><a href="<?php echo base_url();?>home/last_comments">comments</a></li>
      <?php if (! $boolean == false): ?> 
        <li><a href="<?php echo base_url();?>entry/new_entry">write on wall</a></li>
      <?php endif; ?>
      <?php  
      if($guest===0)
      { ?>
        <li><a href='#'><?php echo ''.$username.'';?></a></li>
      <?php }else{ ?></li>
        <li><a style="display: block;  text-align: right;" href="<?php echo base_url(); ?>account" style="float:right;"><?php echo $guest; ?></a></li>
      <?php } ?>
      <?php if (! $boolean == false): ?> 
        <li><a href="<?php echo base_url();?>home/logout">logout</a></li>

      <?php endif; ?>
    </ul>
    <div class="input-append"> 
        <form class="navbar-search pull-left" action="<?php echo base_url();?>home/search" method="POST">  
             <input class="span2" name="search" id="appendedInputButtons" type="text">
             <button class="btn" type="submit">Search</button>
             <a href="<?php echo base_url();?>home/advanced_search" class="btn">Advance Search</a>
        </form>
    </div>
  </div>
</div>
 
            