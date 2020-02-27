<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_oficios.php"); 
date_default_timezone_set('UTC');

if ($_SESSION['perfil']==1)
{
	
	$Oficios = new Oficios();
	
	$Oficios->setId_usuario($_SESSION['codigo']);
	$Oficios->setId_direcciones_user($_SESSION['direcciones_user']);
	$Oficios->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$Oficios->setId_primer_nivel_user($_SESSION['primer_nivel_user']);

//chequea la imagen del capcha para guardar los datos

	$tabla= "vista_mostrar_oficios";
	$orden="cd_oficios";		
	$sw=1;
	$Oficios->setNuanioficio(date("Y"));
	$cont = $Oficios->MostrarGuardar(0,$tabla,$orden,$sw);
	$cont=$Oficios->getId();
	

	$_SESSION['estatus_msj']=2;
	$_SESSION['error_autorizacion']= "El Ultimo Número de Correlativo Enviado es: " . $cont ;

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