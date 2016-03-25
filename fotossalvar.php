<?php

include "conect.php";

session_start();

$action = $_SESSION['sobrescrever'];
$id_foto = $_SESSION['id_foto'];

function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen($output_file, "wb");
    fwrite($ifp, base64_decode($base64_string));
    fclose($ifp);
    return( $output_file );
}

$sql = mysql_query("SELECT MAX(id) FROM pessoa;") or die(mysql_error());

if ($action == "sim") {
    $img = "img/$id_foto.png";
} else {
    $row = mysql_fetch_array($sql);
    $new_id = $row[0] + 1;
    $id = $new_id;
    $img = "img/$id.png";
}

$imagem = str_replace('data:image/png;base64,', '', $_POST['imagem']);
base64_to_jpeg($imagem, "$img");
unset($_SESSION['sobrescrever']);
unset($_SESSION['id_foto']);
