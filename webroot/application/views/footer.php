</div>
</div>
<?php function getUriSegments() {
    return explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
}
 
function getUriSegment($n) {
    $segs = getUriSegments();
	return count($segs)>0&&count($segs)>=($n-1)?$segs[$n]:'';

}
  ?>
<div id=​"footer">​<div id="footer">
      <div class="container">
        <a class="muted credit" href="<?php echo base_url();?>rss/entries">RSS questions</a>
        <a class="muted credit" href="<?php echo base_url();?>rss/comments"> | RSS comments</a>
      <?php $entry_segment=getUriSegment(3);
     // print_r($entry_segment);//$e_id_segment = getUriSegment(4);
      if($entry_segment=="entry"): ?>
      
        <a class="muted credit" href="<?php echo base_url();?>rss/entries/<?php echo $e_id;?>"> | RSS question</a>
      <?php endif; ?>
     </div>
  
</div>

  </body>
</html>