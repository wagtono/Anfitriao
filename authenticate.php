<?php

include "conect.php";

    session_start();

$_SESSION['qr_id'] = 0;
$id = $_POST['credential'];

$sql = "select * from visitas where id=$id and status='Em visita';";
$visita = mysql_query($sql)or die(mysql_error());
$row = mysql_fetch_assoc($visita);

	if(isset($_POST['send'])){

		$arr= array();

		if($id == $row['id']){
			$_SESSION['logged_in'] = true;
			$_SESSION['qr_id'] = $id;
			$arr['success'] = true;
		} else {
			
                        $arr['success'] = false;
		}

		echo json_encode($arr);
	}

