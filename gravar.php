<?php 

$imagem = $_FILES["imagem"]; 
$host = "mysgbd.in.iti.gov.br"; 
$username = "recepchones"; 
$password = "recepchones@iti"; 
$db = "recepchones"; 

if($imagem != NULL) { 
	$nomeFinal = time().'.jpg'; 
	if (move_uploaded_file($imagem['tmp_name'], $nomeFinal)) { 
		$tamanhoImg = filesize($nomeFinal); 
		$mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg)); 
		mysql_connect($host,$username,$password) or die("Impossível Conectar"); 
		@mysql_select_db($db) or die("Impossível Conectar"); 
		mysql_query("INSERT INTO clientes (img) VALUES ('$mysqlImg')") or die("O sistema não foi capaz de executar a query"); 
		unlink($nomeFinal);
		header("location:exibir.php");
 		} 
} 

else { 
	echo "Você não realizou o upload de forma satisfatória."; 
} 

?>
