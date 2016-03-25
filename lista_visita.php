<?php

include "conect.php";
session_start();

if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) { 
unset($_SESSION['login']); unset($_SESSION['senha']); 
header('location:index.php'); } $logado = $_SESSION['login'];

$id = $_POST['id'];
$status = $_POST['status'];
$entrada = $_POST['entrada'];
$saida = $_POST['saida'];
$id_visita = $_POST['visita'];
$id_busca = $_GET['id_busca'];
$saida = date("Y-m-d H:i:s");

$_SESSION['pessoa'] = $id;
$_SESSION['visita'] = $id_visita;

if (empty($id_busca)){
	if (!$_SESSION['qr_id'] == 0){
	$id_busca = $_SESSION['qr_id'];
	unset($_SESSION['qr_id']);
	}
}

$entrada = (!empty($entrada)) ? "'" . $entrada . "'" : "NULL";
$saida = (!empty($saida)) ? "'" . $saida . "'" : "NULL";

header("Content-type: text/html; charset=utf-8");

if (empty($id_busca)) {
$sql = "select visitas.id, visitas.id_pessoa, visitas.entrada, visitas.saida, visitas.status, pessoa.nome, pessoa.email, pessoa.tel, pessoa.rg, pessoa.cpf, pessoa.sexo, pessoa.img from visitas inner join pessoa on (visitas.id_pessoa=pessoa.id) where visitas.status='Em visita';";
} else {
$sql = "select visitas.id, visitas.id_pessoa, visitas.entrada, visitas.saida, visitas.status, pessoa.nome, pessoa.email, pessoa.tel, pessoa.rg, pessoa.cpf, pessoa.sexo, pessoa.img from visitas inner join pessoa on (visitas.id_pessoa=pessoa.id) where visitas.id='$id_busca' and visitas.status='Em visita' ;";
}

$visita = mysql_query($sql)or die(mysql_error());

echo "

<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Anfitrião</title>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width'>
        <link href='font/stylesheet.css' rel='stylesheet' type='text/css'>
        <link href='css/bootstrap.min.css' rel='stylesheet' type='text/css'>
        <link href='css/bootstrap-responsive.min.css' rel='stylesheet' type='text/css'>
        <link href='css/styles.css' rel='stylesheet' type='text/css'>
        <link href='css/media-queries.css' rel='stylesheet' type='text/css'>
        <link href='fancybox/jquery.fancybox-1.3.4.css' rel='stylesheet' type='text/css' media='screen'>
        <link href='img/favicon.ico' rel='shortcut icon' type='image/x-icon'>
        <link href='http://fonts.googleapis.com/css?family=Exo:400,800' rel='stylesheet' type='text/css'>

        <!--[if lt IE 9]>
        <script src='js/css3-mediaqueries.js'></script>
        <script src='js/html5.js'></script>
        <![endif]-->
        <script type='text/javascript' src='js/main.js'></script>
        <script type='text/javascript' src='js/llqrcode.js'></script>
    </head>

    <body data-spy='scroll'>
        <!-- TOP MENU NAVIGATION -->
        <div class='navbar navbar-fixed-top'>
            <div class='navbar-inner'>
                <div class='container'> <a class='brand pull-left' href='index.php'> Anfitrião </a> <a class='btn btn-navbar' data-toggle='collapse' data-target='.nav-collapse'> <span class='icon-bar'></span> <span class='icon-bar'></span> <span class='icon-bar'></span> </a>
                    <div class='nav-collapse collapse'>
                        <!--<ul id='nav-list' class='nav pull-right'>
                          <li><a href='#home'>Home</a></li>
                          <li><a href='#about'>About</a></li>
                          <li><a href='#updates'>Updates</a></li>
                          <li><a href='#screenshots'>Screenshots</a></li>
                          <li><a href='#contact'>Contact</a></li>
                        </ul>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- MAIN CONTENT -->
        <div class='container content container-fluid' id='home'>
           <!-- SCREENSHOTS -->
            <h3>Visitas ativas:</h3></br>
            <div class='row-fluid' id='screenshots'>
            <ul>";
while ($row = mysql_fetch_assoc($visita)) {

    $data_mysql = $row['entrada'];
    $timestamp = strtotime($data_mysql);
    $data_entrada = date('d-M-Y H:i:s', $timestamp);
    $id_visita = $row['id'];

header("Content-type: text/html; charset=utf-8");
    echo" 
        <div>
        <li id='lista' class='#'>
                <a rel='gallery' class='thumbnail'>
                <table width='100%' border = '0'>
                    <tr >
                        <td width='170'>
                            <a title='Exibir Informações do visitante' href = 'lista_pessoa.php?id_busca=" . $row['id_pessoa'] . "' rel='gallery' class='thumbnail'><img id='foto' width = '150px' src = '". $row['img'] ."' /></a>
                        </td>
                        <td>
                        <center>
                        <a  >
                        <div >
                        
                  
                                <div align='left' class='input-xlarge'>
                                    <h3>" . $row['nome'] . "</h3>
                                    <!--<label><b>E-mail: </b>" . $row['email'] . "</label>
                                    <label><b>Telefone: </b>" . $row['telefone'] . "</label>-->
                                    <h3>" . $row['status'] . "</h3>
                                    <h3>" . $data_entrada . "</h3>
             
                                <input type='hidden' name='id' value='" . $row['id'] . "'/>
                        
                        </div>
                        </td>
                        <td  >
                        <div>
                        <a  title='Imprimir etiqueta de visita' href = 'etiqueta.php?id_visita=" . $row['id'] . "&id_pessoa=" . $row['id_pessoa'] . "' rel='gallery' class='thumbnail'>    
                            <img  width='50' src='img/impressora.png' />
                        </a>
                        </div>
                        <center>
                        </td>
                        <td>
                        <div align='right'>                           
                                            <center>
                                            <form id='visita' name='visita' method='post' action='visita.php' enctype='multipart/form-data' accept-charset='utf-8'>
                                            <input type='hidden' name='id' value='" . $row['id_pessoa'] . "'/>
                                            <input type='hidden' name='status' value='Fora de visita'/>
                                            <input type='hidden' id='saida' name='saida' value='" . $saida . "'/>
                                            <input type='hidden' id='visita' name='visita' value='" . $id_visita . "'/>
                                            <input title='Clique para dar baixa nesta visita' class='btn btn-primary' name='baixa' type='submit' value='Registrar Saída'/></form>
                                            </center>
                        </div>
                        </td>
                    </tr>
                </table>
                
                </a>
        </li>
        </div>";
}

echo "</table>


</ul>
</div>
</br>
<div>
<button class='btn btn-primary' onclick=\"window.location.href='home.php'\">Voltar</button>
</div>

<h3 class = 'page-title' id = 'scroll_up'><img src = 'img/arrow-top.png' alt = ''> Topo <a href = '#home' class = 'arrow-top'> </a> </h3>


<!--FOOTER -->
<div class = 'footer container container-fluid'>


<!--COPYRIGHT - EDIT HOWEVER YOU WANT!-->
<div id = 'copyright'>&copy;
Copyright 2016 <a href = 'http://www.mantenedor.com.br'>Mantenedor</a>. Todos os Direitos Reservados</div>


<!--CREDIT - PLEASE LEAVE THIS LINK!-->

<div id = 'credits'>Anfitrião <a target = '_blank' href = '#'>Versão 1.0</a></div>
</div>
<script src = 'js/jquery-1.7.2.min.js'></script>
<script src='js/bootstrap.min.js'></script>
<script src='js/bootstrap-collapse.js'></script>
<script src='js/bootstrap-scrollspy.js'></script>
<script src='fancybox/jquery.mousewheel-3.0.4.pack.js'></script>
<script src='fancybox/jquery.fancybox-1.3.4.pack.js'></script>
<script src='js/init.js'></script>
</body>
</html>
";


//header("location:exibir.php");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
