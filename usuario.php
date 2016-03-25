<?php

include 'conect.php';
session_start();

if ((!isset($_SESSION['login']) == true) and ( !isset($_SESSION['senha']) == true)) {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header('location:index.php');
} $logado = $_SESSION['login'];

$login = $_POST['login'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$action = $_POST['action'];
$id = $_POST['id'];
$delete_id = $_GET['delete_id'];

if ($action == "new"){
mysql_query("INSERT INTO `usuarios` (`usuario` , `nome` , `senha` ) VALUES ( '$login', '$nome', '$senha' )") or die(mysql_error());
header("location:admin.php");
 
} elseif ( $action == "edit" ) {
mysql_query("UPDATE usuarios SET usuario='$login', nome='$nome' where id='$id';") or die(mysql_error());
 header("location:admin.php");
}  else {
mysql_query("delete from usuarios where id='$delete_id';") or die(mysql_error()); 
header("location:admin.php");
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

