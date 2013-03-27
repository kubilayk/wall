<?php 

include_once("connect.php");
if (isset($_POST['yorum'])){

	postComments($_POST['yorum']);


}
function getComments() {

$comments = " ";
$sql = mysql_query( "SELECT * FROM `comment`") or die ('could not connect');
if ( mysql_num_rows($sql) == 0 )
 {

$comments = "<div class= 'each_comment'> There are no comments. </div>";
} 

else {
while($row = mysql_fetch_assoc($sql)){
$comments .="<div class='each_comment'>Zaman:<small><em>".$row['comment_date']."</em></small><br />Yorum:".$row['comment']."<p></p><p></p><hr></div>";
}
}


return $comments;
}

function postComments($comment)
{
		$comment = mysql_real_escape_string(strip_tags($comment));
		$sql = ("INSERT INTO `comment` (comment, comment_date) VALUES ('".$comment."', NOW())");
		$result = mysql_query($sql);
		return true;
}

if((isset($_GET['action'])) && ($_GET['action'] == "post")) {
postComments($_POST['comment']);
}

echo getComments();
?>