<!DOCTYPE html>
<html>
  <head>
    <title><?php echo (isset($page_title)) ? $page_title : 'Default title text'; ?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>bootstrap/css/style.css" />
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
  </head>
  <body>
    <tr>​
<tr>
  <td bgcolor="#ff6600">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding:2px">
    <tbody>
      <tr>
        <td style="line-height:12pt; height:10px;">
            <span class="pagetop">
              <b><a href="<?php echo base_url();?>home">WriteWall|
              </a></b>
              <a href="<?php echo base_url();?>home">wall</a> | 
               
              <a href="<?php echo base_url();?>home/last_comments">comments</a> | 
              
             <?php if (! $boolean == false): ?> 
              <a href="<?php echo base_url();?>entry/new_entry">write on wall</a>
            <?php endif; ?></span>
          </td>
          <td style="text-align:right;padding-right:4px;">
            <span class="pagetop">
              <?php  
          if($guest===0)
          {
            echo ''.$username.'';
          }
          else
          {
            echo '<a href='.base_url().'account >'.$guest.'</a>';
          }
    ?>
<?php if (! $boolean == false): ?> 
              <a href="<?php echo base_url();?>home/logout">logout</a>
<?php endif; ?>
            </span>
          </td>
      </tr>
    </tbody>
      </table>
  </td>
</tr>