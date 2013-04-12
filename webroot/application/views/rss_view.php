<?php include_once('header.php'); ?>

      <?php $e_id=0;?>
      <?php $i=1 ?>
      <?php $j=1 ?>
      

           
                 
               <div class="tabbable tabs-left">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#lA" data-toggle="tab">questions</a></li>
                <li><a href="#lB" data-toggle="tab">comments</a></li>
                
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="lA">
                  <?php foreach($question as $quest){ ?>
                      <div class="span1" style="text-align: left;">
                        <?php echo $i++."."; ?>
                      </div> 
                      <a class="overtext" href="<?php echo base_url();?>rss/entries/<?php echo $quest->question_id;?>" style="display:block;"><?php echo $quest->title;?></a>
                  <?php } ?>
                </div>
                <div class="tab-pane" id="lB">
                  <?php foreach($comment as $com){ ?>
                  <div class="span1" style="text-align: left;">
                        <?php echo $j++."."; ?>
                   </div>
                  
                  <a class="overtext" href="<?php echo base_url();?>rss/comments/<?php echo $com->comment_id;?>" style="display:block;"><?php echo $com->comment ?></a>
                  <div class="span1" style="text-align: left;">
                        
                   </div>
                  <small>on:<?php echo $com->title;?></small></br>
                  <?php } ?>
                </div>
                
            </div>
                  
           </div>
            
      



<?php include_once('footer.php'); ?>