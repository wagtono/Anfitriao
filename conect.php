<?php
$host = "127.0.0.1"; 
$username = "root"; 
$password = "123123"; 
$db = "anfitriao";
mysql_connect($host,$username,$password) or die(mysql_error()); 
	@mysql_select_db($db) or die(mysql_error()); 
?>
