<?php

include "conect.php";

session_start();

$hora = date("H:i:s");
$data = date("d-m-Y");
$status = $_SESSION['status'];
$entrada = date("Y-m-d H:i:s");
$saida = $entrada;

$id = $_SESSION['id'];
$rg = $_SESSION['rg'];
$cpf = $_SESSION['cpf'];
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];
$sexo = $_SESSION['sexo'];



header("Content-type: text/html; charset=utf-8");



if (!empty($rg)):
    $field = "rg";
    $value = $rg;
elseif (!empty($cpf)):
    $field = "cpf";
    $value = $cpf;
else:
    if (!empty($nome)):
        $field = "nome";
        $value = $nome;
    elseif (!empty($email)):
        $field = "email";
        $value = $email;
    else:
        echo "Sem parâmetros para busca!";
        echo "Retornando a página de busca...";
        header("location:index.php");
    endif;
endif;

if (!$link = mysql_connect($host, $username, $password)) {
    echo 'Não foi possível conectar ao mysql';
    exit;
}

if (!mysql_select_db($db, $link)) {
    echo 'Não foi possível selecionar o banco de dados';
    exit;
}

$sql = "SELECT * FROM pessoa where $field like '%$value%';";
$result = mysql_query($sql);

if (!$result) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_assoc($result)) {

    $id = $row ['id'];
    $sql2 = "select * from visitas where id_pessoa=$id order by id desc limit 1;";
    $visita = mysql_query($sql2);
    $row2 = mysql_fetch_assoc($visita);

    $status = $row2['status'];
    $id_visita = $row2['id'];


    $img = $row['id'];



    echo "
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'></script>
            <script type='text/javascript' src='js/jquery.qrcode.js'></script>
            <script type='text/javascript' src='js/qrcode.js'></script>
            <form id='editar' name='editar' method='post' action='editar.php' enctype='multipart/form-data' accept-charset='utf-8' >
		
                <fieldset>       

                    <table width='100%' border='0'>
                        <tr>
                            
                            <td rowspan='2'width='250px'>
                                <img src='" . $row['img'] . "'/>
                            </td>

                            <td>
                           	<b><h3></b> " . $row['nome'] . "</h3>  
                                <b>E-mail:</b> " . $row['email'] . "
                                </br>
                                <b>Sexo:</b> " . $row['sexo'] . "                      
                                <input type='hidden' name='id' value='" . $row['id'] . "'/> 
                            </td>
                           
                            <td> 
                                 
                            </td>                            
                            <td width='50'>
                                <center>
                                    <input name='editar' id='editar' type='submit' value='Editar Atributos'/></br></br>
                                    </form>
                                </center>
                            </td>

                        </tr>
        
                        <tr>
                            
                            <td>
                                <b>Status: </b><a href='visita.php'>" . $status . "</a>
                                </br>
                                <b>Última entrada: </b>" . $row2['entrada'] . "
                                </br>
                                <b>Última saída: </b>" . $row2['saida'] . "
                                </br>
                              
                            </td>
                             <td>
                            </td>
                            <td>";

    if ($status == "Em visita") {
        echo "
                                    <center>
                                        <form id='visita' name='visita' method='post' action='visita.php' enctype='multipart/form-data' accept-charset='utf-8'>
                                        <input type='hidden' name='id' value='" . $row['id'] . "'/>
                                        <input type='hidden' name='status' value='Fora de visita'/>
                                        <input type='hidden' id='saida' name='saida' value='" . $saida . "'/>
                                        <input type='hidden' id='visita' name='visita' value='" . $id_visita . "'/>
                                        <input name='baixa' type='submit' value='Registrar Saída'/></form>
                                    </center>";
    } else {

        echo "
                                    <center>
                                        <form id='visita' name='visita' method='post' action='visita.php' enctype='multipart/form-data' accept-charset='utf-8'>
                                        <input type='hidden' name='id' value='" . $row['id'] . "'/>
                                        <input type='hidden' name='status' value='Em visita'/>
                                        <input type='hidden' id='entrada' name='entrada' value='" . $entrada . "'/>
                                        <input type='hidden' id='visita' name='visita' value='" . $id_visita . "'/>
                                        <input name='registro'  type='submit' value='Registrar Entrada'/></form>
                                    </center>";
    }

    echo "</td>

                            </tr>

                    </table>
                </fieldset>
                <!--<div id='qrcodeCanvas'></div>
                <script>
                    jQuery('#qrcodeCanvas').qrcode({
                    text	: \"wagtono\"
                    });
                </script>-->
                </br>"

    ;
}

echo "<a href='index.php'><b>Voltar</b></a>";

mysql_free_result($result);
