<?php

include "conect.php";

session_start();

// pegando os dados do input

// para pegar o valor do input nome
//$nome = $_POST['nome'];

// colocando a variavel nome na session
//$_SESSION['nome'] = $nome;

// vamos imprimir a variavel nome
//echo $_SESSION['nome'] . '<br />';

header("Content-type: text/html; charset=utf-8");

$id = $_GET['id_pessoa'];
$id_visita = $_GET['id_visita'];

$sql1 = "select * from pessoa where id='$id';";
$sql2 = "select * from visitas where id='$id_visita';";
$pessoa = mysql_query($sql1);
$visita = mysql_query($sql2);
$row1 = mysql_fetch_assoc($pessoa);
$row2 = mysql_fetch_assoc($visita);

$txt = $id_visita;
$nome = $row1['nome'];
$img = $row1['img'];

$data_mysql = $row2['entrada'];
$timestamp = strtotime($data_mysql);
$data_entrada = date('d-M-Y H:i:s', $timestamp);

//echo $_SESSION['pessoa'];
//echo $_SESSION['visita'];
//echo $id;
//echo $row1['nome'];
//echo $row2['id'];



echo "
<!DOCTYPE html>
<html>
<head>
<title>Etiqueta</title>
<html>
<head>
  <title>Not Print</title>
  <style type='text/css' media='print'>
      @media print { 
          .notprint { visibility:hidden; } 
      }
</style>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'></script>
<script>
window.onload = function(){
  window.print();
}
</script>

<script type='text/javascript' src='js/jquery.qrcode.js'></script>
<script type='text/javascript' src='js/qrcode.js'></script>


</head>


<body>
<table width='100%' height='100%' border='0'>

<tr>
<td >
<center>
<table border='0'>
<tr>
<td >
<h3>".$nome."</h3>
<center><img  border='1' height='100' src='".$img."'/></center>
</br>
<center><div id='qrcodeCanvas'></div></center>
</td>
</tr>
<tr>
<td>
<center><b>".$data_entrada."</b></center>
</td>
</tr>
</table>
</center>
</td>
</tr>
</table>";

echo "
<script>
	//jQuery('#qrcode').qrcode('this plugin is great');
	jQuery('#qrcodeTable').qrcode({
		render	: \"table\",
		text	: \"$txt\"
	});	
	jQuery('#qrcodeCanvas').qrcode({
		text	: \"$txt\"
	});	
</script>
<center>
<div class='notprint'>
</br></br><a href='home.php'><b>Voltar</b></a>  <a href='home.php' onclick=\"window.print(); return true;\">Reimprimir</a>
</div>
</center>
</body>
</html>";

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

