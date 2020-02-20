<?php
session_start();
extract($_POST);
extract($_GET);

if ($_SESSION['tipo_user']=="") {
	header("Location: ../index.php");
	$_SESSION['estatus_msj']=2;
	$_SESSION['error_inicio']="Acceso Denegado!!";
	exit();
}
?>
