<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_recibidas.php"); 

if ($_SESSION['perfil']==1)
{
	
	$Recibidas = new Recibidas();
	
	$Recibidas->setId_usuario($_SESSION['codigo']);
	$Recibidas->setId_direcciones_user($_SESSION['direcciones_user']);
	$Recibidas->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$Recibidas->setId_primer_nivel_user($_SESSION['primer_nivel_user']);

//chequea la imagen del capcha para guardar los datos

	$tabla= "vista_mostrar_recibidas";
	$orden="cd_recibidas";		
	$sw=1;
	$Recibidas->setNuano(date("Y"));
	$cont = $Recibidas->MostrarGuardar(0,$tabla,$orden,$sw);

	
	$cont=$Recibidas->getId();
	

	$_SESSION['estatus_msj']=2;
	$_SESSION['error_autorizacion']= "El Ultimo Número de Correlativo Generado es: " . $cont ;

$url_relativa = "siscor/vista/menu_principal.php";
header("Cache-Control: no-cache");
header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
}
else
{
$_SESSION['estatus_msj']=1;
$_SESSION['error_autorizacion']="Usted no esta autorizado para realizar esta acción";	
$url_relativa = "siscor/vista/menu_principal.php";
header("Cache-Control: no-cache");
header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
}
?>