<!DOCTYPE html>
<html>
  <head>
    <title><?php echo (isset($page_title)) ? $page_title : 'Default title text'; ?></title>
    <link rel="SHORTCUT ICON" href="<?php echo base_url();?>bootstrap/img/wall.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>bootstrap/css/style.css" /> 
    <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/jquery-ui.css" />
    <script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/custom.js"></script>
    
   <script type="text/javascript" src="/twitter-bootstrap/twitter-bootstrap-v2/docs/assets/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
   </script>
  
  </head>
  <body>
    <br>
<div class="container">
  <div class="navbar">
    <div class="navbar-inner">
    <ul class="nav">
      <li><a href="<?php echo base_url();?>home">wall</a> </li>
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
        <li><a data-toggle="modal" data-backdrop="true" data-keyboard="true" href="#modal">Login</a></li>
      <?php } ?>
      <?php if (! $boolean == false): ?> 
        <li><a href="<?php echo base_url();?>home/logout">logout</a></li>

      <?php endif; ?>
      <li class="dropdown" id="accountmenu">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">sort by<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url();?>entry/sort_question_rates">question rates</a></li>
                            <li><a href="<?php echo base_url();?>entry/sort_last_questions">last questions</a></li>
                            <li><a href="<?php echo base_url();?>entry/sort_total_comments">total comments</a></li>
                            
              
                        </ul>
                    </li>
                
    </ul>
    <div class="input-append"> 
        <form class="navbar-search pull-left" action="<?php echo base_url();?>home/search" method="GET">  
             <input class="span2" name="search" id="appendedInputButtons" type="text" value="<?php echo isset($search)?($search):("");?>">
             <button class="btn" type="submit">search</button>
             <a href="<?php echo base_url();?>home/advanced_search" class="btn">advance search</a>
        </form>


  <div id="dialog-form" title="Login">
      <p class="validateTips">All form fields are required.</p>
    <form action='<?php echo base_url();?>account/user_login' method='post' id="login_form" >
      
      <fieldset>
        <label for="name">Name</label>
        <input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all" />
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
        <input type="hidden" name="uri" id="uri" value="<?php echo $this->uri->segment(1);?>">
      </fieldset>
    </form>
   </div>
   
                  
    </div>

  </div>
</div>
 <div class="container">

<div id="modal" class="modal hide fade in" style="display: none; ">
            <div class="modal-header">
              <a class="close" data-dismiss="modal">×</a>
              <h3>Login</h3>
            </div>
            <div class="modal-body">
    <form action="<?php echo base_url();?>account/user_login" method="POST" id="login_form" >
      
      <fieldset>
        <label for="name">Name</label>
        <input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all" />
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
        <input type="hidden" name="uri" id="uri" value="<?php echo $this->uri->segment(1);?>">
      </fieldset>
    </form>         
            </div>
            <div class="modal-footer">
              <a href="<?php echo base_url();?>account" class="btn" >Sign up</a>
              <a href="#" id="submitFollow" class="btn btn-success" onclick="$('#login_form').submit(); return false;">Login</a>
            </div>
          </div>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<script src="/twitter-bootstrap/twitter-bootstrap-v2/docs/assets/js/jquery.js"></script>
<script src="/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-modal.js"></script>

<div class="wrapper">
 
            