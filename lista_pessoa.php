<?php

include "conect.php";
session_start();

if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) { 
unset($_SESSION['login']); unset($_SESSION['senha']); 
header('location:index.php'); } $logado = $_SESSION['login'];

$hora = date("H:i:s");
$data = date("d-m-Y");
$status = $_SESSION['status'];
$entrada = date("Y-m-d H:i:s");
$saida = $entrada;

$id = $_POST['id'];
$rg = $_POST['rg'];
$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$sexo = $_POST['sexo'];

$id_busca = $_GET['id_busca'];


header("Content-type: text/html; charset=utf-8");


if (!empty($nome)) {
    $field = "nome";
    $value = $nome;
} elseif (!empty($cpf)) {
    $field = "cpf";
    $value = $cpf;
} else {
    if (!empty($email)) {
        $field = "email";
        $value = $email;
    } elseif (!empty($rg)) {
        $field = "rg";
        $value = $rg;
    } else {
        $field = "id";
        $value = $id_busca;
    }
}

if (!$link = mysql_connect($host, $username, $password)) {
    echo 'Não foi possível conectar ao mysql';
    exit;
}

if (!mysql_select_db($db, $link)) {
    echo 'Não foi possível selecionar o banco de dados';
    exit;
}

$sql = "SELECT * FROM pessoa where $field like '%$value%' order by id desc limit 50;";
$result = mysql_query($sql);

$num_rows = mysql_num_rows($result);

if (!$result) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

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
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'></script>
        <script type='text/javascript' src='js/jquery.qrcode.js'></script>
        <script type='text/javascript' src='js/qrcode.js'></script>
        <![endif]-->
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
        <h3>Informações do visitante:</h3></br>

	
	";

if ( $num_rows == 0 ){
	echo "<h2>Visitante não encontrado!</h2>
		<h3>Gostaria de cadastrar um novo visitante?</h3>
	</br>
	<table>
	<tr>
	<td width='70'>
		<form><a class='btn btn-primary' onclick=\"window.location.href='novo.php'\">Sim</a></form>
	</td>
	<td>		
	<form><a class='btn btn-primary' onclick=\"window.location.href='home.php'\">Não</a></form>
	</td>
	</table>";	
	}else{

while ($row = mysql_fetch_assoc($result)) {

    $id = $row ['id'];
    $sql2 = "select * from visitas where id_pessoa=$id order by id desc limit 1;";
    $visita = mysql_query($sql2);
    $row2 = mysql_fetch_assoc($visita);

    $status = $row2['status'];
    $id_visita = $row2['id'];


    $img = $row['id'];

    echo " 
        <form id='editar' name='editar' method='post' action='editar.php' enctype='multipart/form-data' accept-charset='utf-8' >
        <div>
            <li id='lista' class='#'>
                <fieldset rel='gallery' class='thumbnail'>
                <table width='100%' border = '0'>
                    <tr >
                        <td width='200'>
                            <div rel='gallery' class='thumbnail'>
                            <img  id='foto' width='150px' src='" . $row['img'] . "'/>
                            </div>
                        </td>
                        <td >
                        <center>
                        <div  rel='gallery' class='thumbnail'>
                        
                  
                                <div align='left' class='input-xlarge'>
                                    <h3>" . $row['nome'] . "</h3>
                                    <label><b>E-mail: </b>" . $row['email'] . "</label>
                                    <label><b>Telefone: </b>" . $row['tel'] . "</label>
                                    <label><b>RG: </b>" . $row['rg'] . "</label>
                                    <label><b>CPF: </b>" . $row['cpf'] . "</label>
                                <input type='hidden' name='id' value='" . $row['id'] . "'/>
                                    
                        
                        </div>
                        </center>            
             
                        
                        </div>
                        
                        </td>
                        <td width='200'>                                         
                       <div >
                       
                        <center><input class='btn btn-primary' name='editar' id='editar' type='submit' value=' Editar  Atributos '/></br></br>
                        
        </form>                        

";

    if ($status == "Em visita") {
	
	
        echo "
                                    
                                        <form id='visita' name='visita' method='post' action='visita.php' enctype='multipart/form-data' accept-charset='utf-8'>
                                        <input type='hidden' name='id' value='" . $row['id'] . "'/>
                                        <input type='hidden' name='status' value='Fora de visita'/>
                                        <input type='hidden' id='saida' name='saida' value='" . $saida . "'/>
                                        <input type='hidden' id='visita' name='visita' value='" . $id_visita . "'/>
                                        <input name='baixa' type='submit' class='btn btn-primary'  value=' Registrar  Saída '/>
                                        </form>
                                    </center>";
    } else {

        echo "
                                    
                                        <form id='visita' name='visita' method='post' action='visita.php' enctype='multipart/form-data' accept-charset='utf-8'>
                                        <input type='hidden' name='id' value='" . $row['id'] . "'/>
                                        <input type='hidden' name='status' value='Em visita'/>
                                        <input type='hidden' id='entrada' name='entrada' value='" . $entrada . "'/>
                                        <input type='hidden' id='visita' name='visita' value='" . $id_visita . "'/>
                                        <input name='registro'  type='submit' class='btn btn-primary'  value='Registrar Entrada'/>
                                        </form>
                                    </center>";
    }
    echo " 
                        
                        </div>
                        </td>
                    </tr>
                </table>
                </fieldset>
            </li>
        </div>";
}

mysql_free_result($result);

}

echo "
</br>
<!--<form><a class='btn btn-primary' onclick=\"window.location.href='home.php'\">Voltar</a></form>-->
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
