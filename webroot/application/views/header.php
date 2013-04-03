<!DOCTYPE html>
<html>
  <head>
    <title><?php echo (isset($page_title)) ? $page_title : 'Default title text'; ?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>bootstrap/css/style.css" /> 
    <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/jquery-ui.css" />
    <script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/custom.js"></script>
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
      { $session_data = $this->session->userdata('logged_in');
    ?>
        <li><a href="<?php echo base_url();?>home/user_info/<?php echo $session_data['user_id']; ?>"><?php echo ''.$username.'';?></a></li>
      <?php }else{ ?></li>
        <li><a style="display: block;  text-align: right;" href="<?php echo base_url(); ?>account" style="float:right;"><?php echo $guest; ?></a></li>
        <li><a class="create-user" href="#">Login</a></li>
      <?php } ?>
      <?php if (! $boolean == false): ?> 
        <li><a href="<?php echo base_url();?>home/logout">logout</a></li>

      <?php endif; ?>
    </ul>
    <div class="input-append"> 
        <form class="navbar-search pull-left" action="<?php echo base_url();?>home/search" method="GET">  
             <input class="span2" name="search" id="appendedInputButtons" type="text">
             <button class="btn" type="submit">Search</button>
             <a href="<?php echo base_url();?>home/advanced_search" class="btn">Advance Search</a>
        </form>
  <div id="dialog-form" title="Login">
      <p class="validateTips">All form fields are required.</p>
    <form action='<?php echo base_url();?>account/user_login' method='post' id="login_form" 
      
      <fieldset>
        <label for="name">Name</label>
        <input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all" />
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />

      </fieldset>
    </form>
   </div>
 

    </div>
  </div>
</div>
 
            