<?php

include "conect.php";

session_start();

$nome = $_POST['nome'];
$email = $_POST['email'];
$sexo = $_POST['sexo'];
$id = $_POST['id'];
$tel = $_POST['tel'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$img = $_POST['img'];




mysql_query("UPDATE pessoa SET nome='$nome', email='$email', sexo='$sexo', tel='$tel', cpf='$cpf', rg='$rg' where id='$id';") or die(mysql_error());

//echo $nome;
//echo $email;
//echo $sexo;
//echo $id;
//echo $tel;

header("location:lista_pessoa.php?id_busca=$id");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

