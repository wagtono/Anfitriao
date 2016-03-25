<?php $host = "mysgbd"; 
$username = "recepchones"; 
$password = "recepchones@iti"; 
$db = "recepchones"; 
$PicNum = $_GET["PicNum"]; 


mysql_connect($host,$username,$password) or die("Impossível conectar ao banco."); 

@mysql_select_db($db) or die("Impossível conectar ao banco."); 

$result=mysql_query("SELECT * FROM pessoa WHERE id=$PicNum") or die("Impossível executar a query "); $row=mysql_fetch_assoc($result); 

header( "Content-type: image/gif"); 


echo $row['img'];

?>
