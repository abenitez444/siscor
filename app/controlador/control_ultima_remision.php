<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_remisiones.php"); 

if ($_SESSION['perfil']==1)
{
	
	$Remisiones = new Remisiones();
	
	$Remisiones->setId_usuario($_SESSION['codigo']);
	$Remisiones->setId_direcciones_user($_SESSION['direcciones_user']);
	$Remisiones->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$Remisiones->setId_primer_nivel_user($_SESSION['primer_nivel_user']);

//chequea la imagen del capcha para guardar los datos

	$tabla= "vista_mostrar_remisiones";
	$orden="cd_remisiones";		
	$sw=1;
	$Remisiones->setAnio_remision(date("Y"));
	$cont = $Remisiones->MostrarGuardar(0,$tabla,$orden,$sw);
	$cont=$Remisiones->getId();
	

	$_SESSION['estatus_msj']=2;
	$_SESSION['error_autorizacion']= "El Ultimo Número de Correlativo de Remisi&oacute;n es: " . $cont ;

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