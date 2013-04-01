<!DOCTYPE html>
<html>
  <head>
    <title><?php echo (isset($page_title)) ? $page_title : 'Default title text'; ?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>bootstrap/css/style.css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/incrementing.js"></script>

    <script> 
        $(document).ready(function(){
          $("#flip").one('click', function(){
            $("#panel").slideToggle("slow");
          });
        });
    </script>
    <script> 
           $(document).ready(function()
           {
              $("#flip").one('click', function()
              {
                 $("#panel").slideDown("slow");
             });
           });
    </script>
     <script>
  $(function() {
    var name = $( "#name" ),
      
      password = $( "#password" ),
      allFields = $( [] ).add( name ).add( password ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
 
    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 300,
      width: 350,
      modal: true,
      buttons: {
        "Login": function() {
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
 
          bValid = bValid && checkLength( name, "username", 3, 16 );
          
          bValid = bValid && checkLength( password, "password", 5, 16 );
 
          bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
          // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
         
          bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
 
          if ( bValid ) {
            $( "#users tbody" ).append( "<tr>" +
              "<td>" + name.val() + "</td>" +
              
              "<td>" + password.val() + "</td>" +
            "</tr>" );
            $( this ).dialog( "close" );
          }
        },
       Signup: function() {
          $( this ).html('').load('base_url();?>account');
        }
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 
    $( "#create-user" )
      .button()
      .click(function() {
        $( "#dialog-form" ).dialog( "open" );
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
      { $session_data = $this->session->userdata('logged_in');
    ?>
        <li><a href="<?php echo base_url();?>home/user_info/<?php echo $session_data['user_id']; ?>"><?php echo ''.$username.'';?></a></li>
      <?php }else{ ?></li>
        <li><a style="display: block;  text-align: right;" href="<?php echo base_url(); ?>account" style="float:right;"><?php echo $guest; ?></a></li>
        <li><a href="<?php echo base_url();?>account/login">Login</a></li>
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
 
            