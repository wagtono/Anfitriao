<?php

include "conect.php";

session_start();

$id = $_POST['id'];
$status = $_POST['status'];
$entrada = $_POST['entrada'];
$saida = $_POST['saida'];
$id_visita = $_POST['visita'];
$saida = date("Y-m-d H:i:s");

$_SESSION['pessoa'] = $id;
$_SESSION['visita'] = $id_visita;



$entrada = (!empty($entrada)) ?"'".$entrada."'" : "NULL";
$saida = (!empty($saida)) ?"'".$saida."'" : "NULL";

header("Content-type: text/html; charset=utf-8");

if ($entrada == 'NULL'){
$sql = "UPDATE visitas SET saida=$saida, status='$status' where id='$id_visita';";
}

else {
$sql = "insert into visitas (status, id_pessoa, entrada) values ('$status', '$id', $entrada );";    
}

mysql_query($sql)or die(mysql_error());


$sql2 = "SELECT * FROM visitas where status='Em visita' order by id desc;";

$visita = mysql_query($sql2)or die(mysql_error());

$sql3 = "SELECT * FROM visitas where id='$id_visita' and status='Em visita' order by id desc;";
$result = mysql_query($sql3);
$num_rows = mysql_num_rows($result);

if ($num_rows == 0){
header("location:lista_visita.php");
}else{
header("location:lista_visita.php?id_busca=$id_visita");
}

//sleep(10);



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

