<?php

include 'conect.php';
session_start();

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
    </head>

    <body data-spy='scroll'>
        <!-- TOP MENU NAVIGATION -->
        <div class='navbar navbar-fixed-top'>
            <div class='navbar-inner'>
                <div class='container'> <a class='brand pull-left' href='#'> Anfitrião </a> <a class='btn btn-navbar' data-toggle='collapse' data-target='.nav-collapse'> <span class='icon-bar'></span> <span class='icon-bar'></span> <span class='icon-bar'></span> </a>
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
	<h2>Não há visita em aberto para esta chave!</h2>
	</br>
	<form><a class='btn btn-primary' onclick=\"window.location.href='home.php'\">Voltar</a></form>


</div>

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
