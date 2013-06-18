<?php
// All code was wrote by Tim Kipp @ TimKippTutorials.com - January 3, 2011

// This code will allow you to connect to a MySQL database using PHP script.
define("BASEPATH",__DIR__ . "../");
include __DIR__ . "/config/database.php";

// your host may be "localhost" but some hosts may be different
$db_host = $db['default']['hostname'];
// your username will be the one you specify when you create your database on your server
$db_username = $db['default']['username'];
// your password that you specify when you create your database on your server
$db_pass = $db['default']['password']; 
// your db_name will be to database name that you used when creating your database
$db_name = $db['default']['database'];

// ----------------------------DO NOT CHANGE BELOW HERE-----------------------------

// db_connection runs the "mysql_connect" function that uses all your information
// from above and tries to connect to your personal database on your server
//$db_connection = mysql_connect($db_host, $db_username, $db_pass, $db_name) or die (mysql_error());
$mysqli = new mysqli($db_host, $db_username, $db_pass, $db_name) or die($mysqli->error()); 
if ($mysqli) {
	echo ("Connection is succeed");
}
 else {
	echo ("Connection is fail");
}
$mysqli->select_db("comment_system");
$result = $mysqli->query("SELECT * FROM notification")
or die($mysqli->error());  

// store the record of the "example" table into $row
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
	print_r($row['not_date']);
	
		$sql_insert= "insert ignore into user_notification (status,u_not_date,user_id,not_id) values ('0','".$row['not_date']."',".$row['to'].",".$row['not_id'].")";
		$mysqli->query($sql_insert);

	
}


?>
