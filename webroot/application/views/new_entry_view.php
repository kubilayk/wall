<?php include_once('header.php'); ?>


     <form action="<?php echo base_url();?>entry/save_question" method="POST">
        <div class="row">
          <div class="span9">
            <input type="text" class="span8" name="title" placeholder="title"/>
          </div>          
                          
        </div>
        <div class="row">
          <div class="span9">
            <textarea name="content_2" id="content_2" placeholder="write description"></textarea>
            <?php echo display_ckeditor($ckeditor_2); ?>
            </textarea>
          </div>
        </div>
        <div class="row">
          <div class="span9">
            <input type="text" class="span8" name="link" placeholder="link"/>
          </div>
        </div>
        
        <div class="span12" >  
         <?php if(! is_null($msg)) echo $msg ?>
        </div>  
             
        
        <div class="row">
          <div class="span3">
            <button type="submit" class="btn btn-primary">Write on wall</button>
        </div>   
        </div>


    </form>

   
<?php include_once('header.php'); ?>