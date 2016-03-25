<?php

include 'conect.php';
session_start();

if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) { 
unset($_SESSION['login']); unset($_SESSION['senha']); 
header('location:index.php'); } $logado = $_SESSION['login'];

$id = $_POST['id'];
$status = $_POST['status'];
$entrada = $_POST['entrada'];
$saida = $_POST['saida'];
$id_visita = $_POST['visita'];
$saida = date("Y-m-d H:i:s");

$_SESSION['pessoa'] = $id;
$_SESSION['visita'] = $id_visita;

if ($logado !== 'admin'){
    header("location:home.php");
}

$entrada = (!empty($entrada)) ? "'" . $entrada . "'" : "NULL";
$saida = (!empty($saida)) ? "'" . $saida . "'" : "NULL";

header("Content-type: text/html; charset=utf-8");

$sql = "UPDATE visitas SET saida=$saida, status='$status' where id='$id_visita';";
mysql_query($sql)or die(mysql_error());

$sql2 = "select visitas.id, visitas.id_pessoa, visitas.entrada, visitas.saida, visitas.status, pessoa.nome, pessoa.email, pessoa.tel, pessoa.rg, pessoa.cpf, pessoa.sexo, pessoa.img from visitas inner join pessoa on (visitas.id_pessoa=pessoa.id) where visitas.status='Em visita' order by id desc limit 50;";
$visita = mysql_query($sql2)or die(mysql_error());



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
        <!--TOP MENU NAVIGATION -->
        <div class='navbar navbar-fixed-top'>
            <div class='navbar-inner'>
                <div class='container'> <a class='brand pull-left' href='#'> Anfitrião </a> <a class='btn btn-navbar' data-toggle='collapse' data-target='.nav-collapse'> <span class='icon-bar'></span> <span class='icon-bar'></span> <span class='icon-bar'></span> </a>
                    <div class='nav-collapse collapse'>
                        <ul id='nav-list' class='nav pull-right'>
                          <li><a href='lista_pessoa.php'>Visitantes</a></li>
                          <li><a href='lista_visita.php'>Visitas</a></li>
                          <li><a title='Indisponível na versão beta' href='#ocorrencias'>Livro de ocorrências</a></li>
                          <li><a title='Indisponível na versão beta' href='#historico'>Histórico de visitas</a></li>
                          <li><a title='Você está logado como ".$_SESSION['login']."' href='index.php' >Sair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- MAIN CONTENT -->
        <div class='container content container-fluid' id='home'>
            <!-- HOME -->
            <div class='row-fluid'>
                <!-- PHONES IMAGE FOR DESKTOP MEDIA QUERY -->
                <div class='span5 visible-desktop'> 
			
                    <fieldset title='' id='snap' name='foto' rel='gallery' class='thumbnail'>

                        <link rel='stylesheet' type='text/css' href='css/style.css'>
                        <script type='text/javascript' src='js/main.js'></script>
                        <script type='text/javascript' src='js/llqrcode.js'></script>
                        
				
			<div style='display:none'></div>
                        <div onclick='setwebcam()' align='left' ><img width='130' id='qr' src='img/qr.png'/></div>
                        <div align='right' ></div>
                        <a title='Verificar etiqueta' onClick='reload();' href='#'' rel='gallery' class='thumbnail'>
			<center id='mainbody'><div id='outdiv'></div></center></a>
                        <canvas id='qr-canvas'></canvas>
			
		

                        <script type='text/javascript'>load();</script>
                        <script src='js/jquery-1.11.2.min.js'></script>
                        
                    </fieldset> 


                    <!-- VERSION -->
                    <div> <span title='Contempla apenas funcionalidades básicas do sistema. Realizando mapeamento de bugs.' class='version-top label label-inverse'>Beta</span> </div>
                    
           
                </div>
                <!-- APP DETAILS -->
                <div class='span7'>
                    <!-- ICON
                    <div class='visible-desktop' id='icon'> <img src='img/app_icon.png' alt=''> </div>
                    <!-- APP NAME
                    <div id='app-name'>
                      <h1>FlexApp</h1>
                    </div>
                    
                    <!-- TAGLINE -->

                    <!-- PHONES IMAGE FOR TABLET MEDIA QUERY -->
                    <div class='hidden-desktop' id='phones'> 

                        <a title='Clique para fotografar' id='snap' name='foto' href='teste/teste.php?busca=odim' rel='gallery' class='thumbnail'>

                            <link rel='stylesheet' type='text/css' href='css/style.css'>
                            <script type='text/javascript' src='js/main.js'></script>
                            <script type='text/javascript' src='js/llqrcode.js'></script>
                            <div style='display:none' id='result'></div>
                            <div class='selector' id='webcamimg' onclick='setwebcam()' align='left' ></div>
                            <div class='selector' id='qrimg' onclick='setimg()' align='right' ></div>
                            <center id='mainbody'><div id='outdiv'></div></center>
                            <canvas id='qr-canvas'></canvas>
                            <script type='text/javascript'>load();</script>
                            <script src='js/jquery-1.11.2.min.js'></script>

                            <!--<img src='img/screenshot.jpg' alt=''>--> 
                        </a> 

                    </div>
                    <!-- DESCRIPTION
                    <div id='description'> FlexApp is a free, fully responsive website template for marketing your mobile application. The design uses CSS3 to scale the content proportionally to whatever device is being used. Give it a try by resizing your browser! </div>
                    <!-- FEATURES -->
                    <div rel='gallery' class='thumbnail'>
                    <form action='lista_pessoa.php' class='#' id='cadastro' name='cadastro' method='post'  enctype='multipart/form-data' accept-charset='utf-8'>
                        <fieldset>
                            <h2 title='Preencha qualquer um dos campos abaixo para realizar uma busca por visitante.'>Busca:</h2></br>
                            
                            <input type='hidden' name='action' value='search'/>
                            <fieldset>
                                <input name='nome' title='Apenas letras.' class='input-xlarge' type='text' id='name' placeholder='Nome do Visitante'  pattern='[a-zA-ZÄÅÁÂÀÃäáâàãÉÊËÈéêëèÍÎÏÌíîïìÖÓÔÒÕöóôòõÜÚÛüúûùÇç\s]+$'/>
                                <input name='rg' title='Apenas números.' class='input-xlarge' type='text' id='rg' placeholder='Número do RG' maxlength=11 OnKeyPress=\"formatar('#######', this)\" pattern='[0-9]{0,}$'/>
                                <input name='cpf' title='Apenas números.'class='input-xlarge' type='text' id='cpf' placeholder='Número do CPF' maxlength=14 OnKeyPress=\"formatar('###.###.###-##', this)\" pattern='[0-9\.\-]{0,}$'/>
                                <input name='email' title='Deve conter no e-mail.' class='input-xlarge' type='text' id='email' placeholder='E-mail'/>
                                <div class='#'>
                                <button type='submit' class='btn btn-primary'>BUSCAR</button>
				<form><a href='home.php' onClick='reload();' class='btn btn-primary'>LIMPAR</a></form>
                                <!--<button class='btn btn-primary' onclick=\"window.location.href='/visita.php'\">Cadastrar Visitante</button>-->
                                </div>
                        </fieldset>
                    </form>
                    </div>

                    
                </div>
            </div>
            <!-- ABOUT & UPDATES -->

            <!-- SCREENSHOTS -->
            </br><h3>Visitas em aberto:</h3>
            <div class='row-fluid' id='screenshots'>
            <ul>";



while ($row = mysql_fetch_assoc($visita)) {

    $data_mysql = $row['entrada'];
    $timestamp = strtotime($data_mysql);
    $data_entrada = date('H:i:s', $timestamp);
    $id_visita = $row['id'];

    echo" 
        <div>
        <li class='span3'>
                <a class = 'thumbnail' href = 'lista_visita.php?id_busca=" . $id_visita . "' rel='gallery' class='thumbnail'>
                <table border = '0'>
                    <tr >
                        <td>
                            <img id='#' width = '100px' src = '" . $row['img'] . "' />
                        </td>
                        <td >
                            <h3>" . $row['status'] . "</h3>
                            <h3>Entrada: " . $data_entrada . "</h3>
                        </td>
                    </tr>
                </table>
                </a>
        </li>
        </div>";
}

echo "




</ul>
</div>
<div>
</br><h3>Usuários:</h3>
<div>
        <table width='100%' border='1'>
        <tr align='center'>
        <td><b>ID</b></td><td><b>USUÁRIO</b></td><td><b>NOME</b></td><td><b>DATA DE CRIAÇÃO</b></td><td><b>SENHA</b></td><td><b>AÇÃO</b></td>
        </tr>




";


$sql3 = "select * from usuarios;";
$users = mysql_query($sql3)or die(mysql_error());


while ($row = mysql_fetch_assoc($users)) {

    $data_mysql = $row['criado'];
    $timestamp = strtotime($data_mysql);
    $criado = date('d-m-Y H:i:s', $timestamp);
    
   
    echo" 
        
        <tr align='center'>
        <td>
       ".$row['id']."
        </td>
        <td>
        ".$row['usuario']."
        </td>
        <td>
        ".$row['nome']."
        </td>
        <td>
        ".$criado."
        </td>
        <td>
        <a title='Alterar senha' href='altera_senha.php'>ALTERAR</a>
        </td>
        <td>
        <a title='Editar usuário' href='editar_usuario.php?id=".$row['id']."' >EDITAR<a/>&nbsp;
        <a title='Excluir usuário' href='usuario.php?delete_id=".$row['id']."' >EXCLUIR<a/>
        </td>
        </tr>";
        
}




echo " 


</table>
</br></br>
<center>
<button class='btn btn-primary' onclick=\"window.location.href='novo_usuario.php'\">NOVO USUÁRIO</button>
</center>

</div>            

</div>
<h3 class = 'page-title' id = 'scroll_up'><img src = 'img/arrow-top.png' alt = ''> Topo <a href = '#home' class = 'arrow-top'> </a> </h3>


<!--FOOTER -->
<div class = 'footer container container-fluid'>


<!--COPYRIGHT - EDIT HOWEVER YOU WANT!-->
<div id = 'copyright'>&copy;
Copyright 2016 <a href = 'http://www.mantenedor.com.br'>Mantenedor</a>. Todos os Direitos Reservados</div>


<!--CREDIT - PLEASE LEAVE THIS LINK!-->

<div id = 'credits'>Anfitrião <a target = '_blank' href = '#'>Beta</a></div>
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


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

