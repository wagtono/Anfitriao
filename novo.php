<?php

include 'conect.php';
session_start();

if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) { 
unset($_SESSION['login']); unset($_SESSION['senha']); 
header('location:index.php'); } $logado = $_SESSION['login'];

echo "
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Novo</title>
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
	<script src='js/jquery-1.11.0.min.js'></script>
	<style>
		canvas { position:absolute; z-index: 9999; border: 1}
		video { position:relative; border: 1 }
	</style>
        <script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}
    </script>
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
		
			<form id='cadastro' name='cadastro' method='post' action='cadastro.php' enctype='multipart/form-data' accept-charset='utf-8'>
			<div class='span5 visible-desktop'> 
				<div><canvas id='canvas' width='320' height='240'>Se você visualizar esse texto, seu browser não suporta a tag canvas.</canvas></div>   
				<div><video id='video' width='320' height='240' autoplay></video></div>
				<input type='checkbox' id='snap' name='foto' value='ok' />Capturar
		   		<input type='checkbox' onClick='reload();' id='#' name='#'/>Outra foto    	
			</div>
	


<fieldset>
	<input name='nome' title='Apenas letras.' class='input-xlarge' type='text' id='name' placeholder='Nome do Visitante' required name='name' pattern='[a-zA-ZÄÅÁÂÀÃäáâàãÉÊËÈéêëèÍÎÏÌíîïìÖÓÔÒÕöóôòõÜÚÛüúûùÇç\s]+$'/>
	<input name='rg' title='Apenas números.' class='input-xlarge' type='text' id='rg' placeholder='Número do RG' maxlength=11 OnKeyPress=\"formatar('###########', this)\" required pattern='[0-9]{7,11}$'/>
	<input name='cpf' title='Apenas números'class='input-xlarge' type='text' id='cpf' placeholder='Número do CPF' maxlength=11 OnKeyPress=\"formatar('###########', this)\" min='11' pattern='[0-9\.\-]{11,}$'/>
	<input name='email' title='Digite um e-mail válido.' class='input-xlarge' type='text' id='email' placeholder='E-mail' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$' />
        <input name='tel' title='Apenas números' class='input-xlarge' type='text' id='tel' placeholder='Telefone para contato' maxlength=15 OnKeyPress=\"formatar('## ####-####', this)\" pattern='[0-9\-\s]+$' /></br>
	<input name='sexo' type='radio' value='Masculino' checked='checked' />
        Masculino
        <input name='sexo' type='radio' value='Feminino' />
        Feminino </br>
	
	<input type='hidden' name='action' value='new'/>
      
     <input align='right' id='save' type='submit' class='btn btn-primary' value='GRAVAR'/>
     <form><a class='btn btn-primary' onclick=\"window.location.href='index.php'\">CANCELAR</a></form>
</fieldset>
<script src='js/functions.js'></script>


	<script>
		var el = document.querySelector('fieldset');
		el.style.visibility = 'hidden';

document.getElementById( 'snap' ).addEventListener( 'change', function(){
    if(this.value === 'ok') {
        el.style.visibility = 'visible';
    } else {
        el.style.visibility = 'hidden';
    }
});

</script>

</div>

</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
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
"
;
