<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$title?></title>
</head>
 
<body>
<?php echo $header ?>
 
<table border="1">
<tr><th>İsim</th><th>Pizza</th><th>İnce Kenar</th><th>Adet</th><th>Adres</th><th>Tip</th><th>Fiyat</th></tr>
<?php foreach($orders as $row){ ?>
<tr>
<td>
<?php echo $row->name;?>
</td>
<td>
<?php echo $row->pizza;?>
</td>
<td>
<?php if($row->thin_edge)
{
	echo "Evet";
}
else
{
	echo "Hayır";
}
?>
</td>
<td>
<?php echo $row->unit;?>
</td>
<td>
<?php echo $row->address;?>
</td>
<td>
<?php 
if($row->type=="1")
{
	echo "Küçük";
}
else if($row->type=="2")
{
	echo "Normal";
}
else if($row->type=="3")
{
	echo "Büyük";
}
?>
</td>
<td>
<?php echo $row->cost;?>
</td>
</tr>
<?php } ?>
 
</table>
</body>
</html>