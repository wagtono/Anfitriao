<?php

include 'conect.php';
session_start();

if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) { 
unset($_SESSION['login']); unset($_SESSION['senha']); 
header('location:index.php'); } $logado = $_SESSION['login'];

$id = $_POST['id'];
$field = "id";
$value = $id;

unset($_SESSION['sobrescrever']);
unset($_SESSION['id_foto']);
$_SESSION['sobrescrever'] = 'sim';

header("Content-type: text/html; charset=utf-8");

$result = mysql_query("SELECT * FROM pessoa where $field='$value';") or die(mysql_error());

$row = mysql_fetch_array($result);

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

       <style>
		canvas { position:absolute; z-index: 9999; border: 1}
		video { position:relative; border: 1 }
	</style>
        

    </head>

    <body data-spy='scroll'>
        <!-- TOP MENU NAVIGATION -->
        <div class='navbar navbar-fixed-top'>
            <div class='navbar-inner'>
                <div class='container'> <a class='brand pull-left' href='home.php'> Anfitrião </a> <a class='btn btn-navbar' data-toggle='collapse' data-target='.nav-collapse'> <span class='icon-bar'></span> <span class='icon-bar'></span> <span class='icon-bar'></span> </a>
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
		
			<form id='edit' name='edit' method='post' action='edit.php' enctype='multipart/form-data' accept-charset='utf-8'>
			<div class='span5 visible-desktop'> 
				
				<div>
                                    <table border='0'>
                                    <tr>
                                    <td>
                                    <div style='position:relative; top:0px; left:0px;'>
                                    <img width='320' height='240' src='" . $row['img'] . "'/>
                                    <div>
                                     <fieldset>
                                        <div style='position:absolute; top:0px; left:0px;'>
                                        <div><canvas id='canvas' width='320' height='240'>Se você visualizar esse texto, seu browser não suporta a tag canvas.</canvas></div>   
                                        <div><video id='video' width='320' height='240' autoplay></video></div>
                                        </div>
                                        <input type='checkbox' id='snap' name='foto' value='ok' />Capturar
                                        <input align='right' type='checkbox' onClick='reload();' id='#' name='#'/>Manter foto
                                    </fieldset>
                                    
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>
                                    <input type='checkbox' id='otafoto' name='foto' value='ok' />Nova foto</br>
                                        <fieldset>
                                            
                                        </fieldset>
                                    </td>
                                    </tr>
                                    </table>
                                   
                                </div>
				
				

</div>

";

$_SESSION['id_foto'] = $row['id'];

if (!empty($row['rg'])){
$rg_lock = "readonly='readonly'";
}
if (!empty($row['cpf'])){
$cpf_lock = "readonly='readonly'";
}
echo "

        <h2>Editar</h2>
	<input name='nome' class='input-xlarge' type='text' id='name' placeholder='Nome do Visitante' value='" . $row['nome'] . "' required name='name' pattern='[a-zA-ZÄÅÁÂÀÃäáâàãÉÊËÈéêëèÍÎÏÌíîïìÖÓÔÒÕöóôòõÜÚÛüúûùÇç\s]+$'/>
	<input name='rg' class='input-xlarge' type='text' id='rg' placeholder='Número do RG' value='" . $row['rg'] . "' ".$rg_lock." maxlength=11 OnKeyPress=\"formatar('###########', this)\" pattern='[0-9]{7,11}$'/>
	<input name='cpf' class='input-xlarge' type='text' id='cpf' placeholder='Número do CPF' value='" . $row['cpf'] . "' ".$cpf_lock." maxlength=11 OnKeyPress=\"formatar('###########', this)\" pattern='[0-9\.\-]{11,11}$'/>
	<input name='email' class='input-xlarge' type='text' id='email' placeholder='E-mail' value='" . $row['email'] . "'pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$' />
        <input name='tel' class='input-xlarge' type='text' id='tel' placeholder='Telefone' value='" . $row['tel'] . "' maxlength=15 OnKeyPress=\"formatar('## ####-####', this)\" pattern='[0-9\-\s]+$' /></br>
       	<input type='hidden' name='action' value='edit'/>
        <input type='hidden' name='sexo' value='" . $row['sexo'] . "'/>
        <input type='hidden' name='id' value='" . $row['id'] . "'/>
        <input type='hidden' name='img' value='img/" . $row['id'] . ".png'/>
        <input align='right' id='save' type='submit' class='btn btn-primary' value='GRAVAR'/>




<script>
		var el = document.querySelector('fieldset');
		el.style.visibility = 'hidden';

document.getElementById( 'otafoto' ).addEventListener( 'change', function(){
    if(this.value === 'ok') {
        el.style.visibility = 'visible';
    } else {
        el.style.visibility = 'hidden';
    }
})

</script>
<script src='js/functions.js'></script>

<h3 class = 'page-title' id = 'scroll_up'><img src = 'img/arrow-top.png' alt = ''> Topo <a href = '#home' class = 'arrow-top'> </a> </h3>
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
