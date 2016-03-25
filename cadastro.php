<?php

include "conect.php";

session_start();

$rg = $_POST ["rg"];
$cpf = $_POST ["cpf"];
$nome = $_POST ["nome"]; //atribuição do campo "nome" vindo do formulário para variavel	
$email = $_POST ["email"]; //atribuição do campo "email" vindo do formulário para variavel
$sexo = $_POST ["sexo"]; //atribuição do campo "sexo" vindo do formulário para variavel
$tel = $_POST ["tel"];

$action = $_POST ["action"];
$foto = $_POST ["foto"];


header("Content-type: text/html; charset=utf-8");

if ($action == "search") {


    //$_SESSION['nome'] = $nome;
    //$_SESSION['email'] = $email;
    //$_SESSION['rg'] = $rg;
    //$_SESSION['cpf'] = $cpf;

    header("location:lista_pessoa.php");
} else {
    if ($action == "edit") {
        echo $action;
    } else {
        if ($action == "new") {

            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $email;
            $_SESSION['rg'] = $rg;
            $_SESSION['cpf'] = $cpf;
            $_SESSION['tel'] = $tel;


            if ($foto != NULL) {

                $sql = mysql_query("SELECT MAX(id) FROM pessoa;") or die(mysql_error());
                $row = mysql_fetch_array($sql);

                $new_id = $row[0] + 1;
                $id = $new_id;
                $img = "img/$id.png";

                mysql_query("INSERT INTO `pessoa` (`nome` , `email` , `sexo` , `img`, `rg`, `cpf`, `tel` ) VALUES ('$nome', '$email', '$sexo', '$img', '$rg', '$cpf', '$tel')") or
                        $mysql_error = mysql_error();
                $eception = "'cpf'$";
                if (ereg($eception, $mysql_error)) {
                    echo "Este CPF já está cadastrado!";
                    echo "</br></br><a  href='' onClick=\"history.go(-1)\" >VOLTAR</a>";
                    exit;
                } elseif (ereg("'rg'$", $mysql_error)) {
                    echo "Este RG já está cadastrado!";
                    echo "</br></br><a  href='' onClick=\"history.go(-1)\" >VOLTAR</a>";
                    exit;
                } else {
                    header("location:lista_pessoa.php?id_busca=$id");
                }
            } else {
                echo "Cadê a foto?";
            }
        }
    }
}
