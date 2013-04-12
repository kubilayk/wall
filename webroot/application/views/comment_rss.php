<?php echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";?>
<rss version="2.0"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
xmlns:admin="http://webns.net/mvcb/"
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:content="http://purl.org/rss/1.0/modules/content/">
<channel>
<title><?php echo $feed_name; ?></title>
<link><?php echo $feed_url; ?></link>
<description><?php echo $page_description; ?></description>
<dc:language><?php echo $page_language; ?></dc:language>
<dc:creator><?php echo $creator_email; ?></dc:creator>
<dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
<admin:generatorAgent rdf:resource="http://www.vivekalab.com/" />
<?php foreach($posts as $com): ?>
<item>
<comment><?php echo xml_convert($com->comment); ?></comment>
<pubDate><?php echo $com->comment_date;?></pubDate>
<link><?php echo base_url().'comm/'.$com->question_id; ?></link>
<guid><?php echo base_url().'entry/'.$com->question_id; ?></guid>
<title><?php echo xml_convert($com->title); ?></title>
<description>
<?php echo $com->description; ?></description>
</item>
<?php endforeach; ?>
</channel>
</rss>