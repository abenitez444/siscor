<?php
session_start();
/*error_reporting(E_ALL);
ini_set("display_errors", 1);*/

include('../controlador/script.php');
include_once("../modelo/class_recibidas.php");
include_once("../modelo/class_respuesta_recibidas.php");
include_once("../modelo/class_respuesta_remisiones.php");
include_once("../modelo/class_modulosxusuarios.php");

$Recibida_user = isset($_GET['User_dire'])? $_GET['User_dire'] : "respuesta";

   	$Recibidas = new Recibidas();
   	$Modulosxusuarios = new Modulosxusuarios();
   	
  	$Recibidas->setId_usuario($_SESSION['codigo']);
	$Recibidas->setId_direcciones_user($_SESSION['direcciones_user']);
	$Recibidas->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$Recibidas->setId_primer_nivel_user($_SESSION['primer_nivel_user']); 	
   	  	
   	
   	if ($Recibida_user=="1")
   	{
   		$_SESSION['Registrar_recibidas']=1;	
   	}

if ($_SESSION['Registrar_recibidas']==1)
{


	$imagen=$_POST['tmptxt'];	

	$permiso =$Modulosxusuarios->Existe($Recibidas->getId_usuario(),'in_ingresar',"TRUE",2);
	
	$archivador =$Modulosxusuarios->Existe($Recibidas->getId_usuario(),'in_ingresar',"TRUE",8);
	
	if($archivador==1)
	{
		$_SESSION['$archivador_in']=1;
	}
	else
	{
		$_SESSION['$archivador_in']=0;
	}
	
if ($_SESSION['perfil']==1 && $permiso==1 )
{
//chequea la imagen del capcha para guardar los datos
if($_POST['guardar']==true)
{
	$Recibidas->setNuano(date("Y"));
	$Recibidas->setFeentrada($_POST['fecha_oficio']);
	$Recibidas->setFecarta($_POST['fecha_carta']);
	$Recibidas->setHorahhentrada($_POST['hora']);
	$Recibidas->setHorammentrada($_POST['minuto']);
	$Recibidas->setHorattentrada($_POST['tiempo']);	
	$Recibidas->setClasificacion_documento($_POST['clasificacion_documentos']);
	$Recibidas->setAsunto($_POST['asunto']);
	$Recibidas->setRemitente($_POST['remitente']);
	$Recibidas->setUbicacion($_POST['ubicacion']);
	$Recibidas->setAlto_nivel($_POST['alto_nivel']);
	if ($Recibidas->getAlto_nivel()==""){
		$Recibidas->setAlto_nivel($_SESSION['alto_nivel_user']);
	}	
	$Recibidas->setPrimer_nivel($_POST['primer_nivel']);
	$Recibidas->setDirecciones($_POST['direcciones']);
	$Recibidas->setNuexterno($_POST['num_externo']);
	$Recibidas->setCedremitente($_POST['ced_remitente']);
	$Recibidas->setNuexterno($_POST['num_externo']);
	$Recibidas->setAmerita_respuesta($_POST['amerita_respuesta']);
	if(	$Recibidas->getAmerita_respuesta()=="on")
	{
		$Recibidas->setAmerita_respuesta("true");
	}
	else
	{
		$Recibidas->setAmerita_respuesta("false");
	}
	$Recibidas->setRespondida('false');		
	if ($Recibidas->getDirecciones()=="")
	{
		$Recibidas->setDirecciones(0);
	}
	if ($Recibidas->getClasificacion_documento()=="")
	{
		$Recibidas->setClasificacion_documento(0);
	}
	$tabla= "vista_mostrar_recibidas";
	$orden="cd_recibidas";		
	$sw=1;
	$cont = $Recibidas->MostrarGuardar(0,$tabla,$orden,$sw);
	$cont=$Recibidas->getId();
	
	if ( $cont == 0 ) 
	{
		$cont="1";
	}
	else
	{
		$cont="$cont"+"1";
	}

	$fecha_cart=$Recibidas->arregla_fecha($Recibidas->getFecarta());
	$fecha_entra=$Recibidas->arregla_fecha($Recibidas->getFeentrada());
	
	$foto=$_FILES['documento'];
	
 	if (($_FILES['documento']['name'])<>"") //si hay fotos agregadas, entra y continua
    {
    		
      $tipo=($HTTP_POST_FILES['documento']['type']);// funcion q capta el tipo de la foto
      if (!($tamano = $HTTP_POST_FILES['documento']['size']==0)) // si el tamaño de la foto es <> a cero, entra y continua
  	  {  
  		//filtra que tipo de imagen permite: jpg,gif y png
   		//if (($tipo=="image/jpeg") or ($tipo=="image/gif") or ($tipo=="image/png") or ($tipo=="image/jpg")or ($tipo=="image/pjpeg") or ($tipo=="image/tiff")) 
      //	{
			$nombre_archivo = $HTTP_POST_FILES['documento']['name']; //funcion que determina el nombre de la foto
       		$explode = explode(" ", $nombre_archivo);//busca los espacios en blancos en el nombre de la imagen 
			$conteo_final=count ($explode);//cuenta los espacios es blancos 
			$conteo_final=$conteo_final-1; //resta los espacios -1
			$i=0;
			$union=0;
			$union_=0;
			while ($i<=$conteo_final)
     		{
				$palabra=$explode[$i];
				if (!(empty ($union)))
  					$union="$union_$palabra";
				else
  					$union="$palabra";
 				$i++;
      		}
			$Recibidas->setDocumento('img'.date('Y').'_'.$Recibidas->getId_alto_nivel_user().$Recibidas->getId_primer_nivel_user().$Recibidas->getId_direcciones_user().'_'.$union);
       		// sql para insertar la imagen en la bd
      		$destino = '../assets/imgescanner'; // nombre de la carpeta del servidor
       	    move_uploaded_file ( $_FILES ['documento'][ 'tmp_name' ], $destino . '/' .$Recibidas->getDocumento());// mueve la foto a la carpeta de archivos

  	  }
	  else 
   	  {
   	  	$_SESSION['estatus_msj']=2;
		$_SESSION['error_recibidas']="La Im\u00e1gen debe pesar menos de 2 mb";
		$url_relativa = "siscor/vista/registrar_recibidas.php";
		header("Cache-Control: no-cache");
		header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
		
      	exit;
   	  }
   }
   else 
   {

   	$Recibidas->setDocumento("");

   }
    
	$mensaje = $Recibidas->EjecutarFunciones("funcion_insertar_recibidas('".$cont."','".$Recibidas->getNuano()."','".$fecha_entra."','".$fecha_cart."','".$Recibidas->getHorahhentrada()."','".$Recibidas->getHorattentrada()."','".$Recibidas->getClasificacion_documento()."','".$Recibidas->getHorammentrada()."','".$Recibidas->getAsunto()."','".$Recibidas->getRemitente()."','".$Recibidas->getUbicacion()."','".$Recibidas->getAlto_nivel()."','".$Recibidas->getPrimer_nivel()."','".$Recibidas->getDirecciones()."','".$Recibidas->getId_usuario()."','".$Recibidas->getNuexterno()."','".$Recibidas->getCedremitente()."','".$Recibidas->getId_direcciones_user()."','".$Recibidas->getId_alto_nivel_user()."','".$Recibidas->getId_primer_nivel_user()."','".$Recibidas->getAmerita_respuesta()."','".$Recibidas->getRespondida()."','".$Recibidas->getDocumento()."','".$_SERVER["REMOTE_ADDR"]."')");
	
	$_SESSION['estatus_msj']=2;
	$_SESSION['correlativo']= "Número de Correlativo Generado: " . $cont ;
}//fin de guardar
}
else
{
	//Die("error");
	//echo ($_SESSION['perfil']);
$_SESSION['estatus_msj']=1;
$_SESSION['error_autorizacion']="Usted no esta autorizado para realizar esta acción";
header("Cache-Control: no-cache");	
$url_relativa = "siscor/vista/menu_principal.php";
header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
exit;
}
}

//modificar
if($_POST['modificar']==true){

	
	$Recibidas->setId($_POST['id']);
	$Recibidas->setNuano($_POST['anio']);
	$Recibidas->setFeentrada($_POST['fecha_oficio']);
	$Recibidas->setFecarta($_POST['fecha_carta']);
	$Recibidas->setHorahhentrada($_POST['hora']);
	$Recibidas->setHorammentrada($_POST['minuto']);
	$Recibidas->setHorattentrada($_POST['tiempo']);
	$Recibidas->setClasificacion_documento($_POST['clasificacion_documentos']);
	$Recibidas->setAsunto($_POST['asunto']);
	$Recibidas->setRemitente($_POST['remitente']);
	$Recibidas->setUbicacion($_POST['ubicacion']);
	$Recibidas->setAlto_nivel($_POST['alto_nivel']);
	if ($Recibidas->getAlto_nivel()==""){
		$Recibidas->setAlto_nivel($_SESSION['alto_nivel_user']);
	}
	$Recibidas->setPrimer_nivel($_POST['primer_nivel']);
	$Recibidas->setDirecciones($_POST['direcciones']);
	$Recibidas->setNuexterno($_POST['num_externo']);
	$Recibidas->setCedremitente($_POST['ced_remitente']);
	$Recibidas->setAmerita_respuesta($_POST['amerita_respuesta']);
	
	if(	$Recibidas->getAmerita_respuesta()=="on")
	{
		$Recibidas->setAmerita_respuesta("true");
	}
	else
	{
		$Recibidas->setAmerita_respuesta("false");
	}	
	if ($Recibidas->getDirecciones()=="")
	{
		$Recibidas->setDirecciones(0);
	}
	if ($Recibidas->getClasificacion_documento()=="")
	{
		$Recibidas->setClasificacion_documento(0);
	}
	$fecha_cart=$Recibidas->arregla_fecha($Recibidas->getFecarta());
	$fecha_entra=$Recibidas->arregla_fecha($Recibidas->getFeentrada());
	
	$Recibidas->setDocumento($_SESSION['scanner']);

	if($Recibidas->getDocumento()=="")
	{
	
	$foto=$_FILES['documento'];
	
 	if (($_FILES['documento']['name'])<>"") //si hay fotos agregadas, entra y continua
    {
    	
      $tipo=($HTTP_POST_FILES['documento']['type']);// funcion q capta el tipo de la foto
//      if (!($tamano = $HTTP_POST_FILES['documento']['size']==0)) // si el tamaño de la foto es <> a cero, entra y continua
//  	  { 
  		//filtra que tipo de imagen permite: jpg,gif y png
   		//if (($tipo=="image/jpeg") or ($tipo=="image/gif") or ($tipo=="image/png") or ($tipo=="image/jpg")or ($tipo=="image/pjpeg") or ($tipo=="image/tiff")) 
      //	{
			$nombre_archivo = $HTTP_POST_FILES['documento']['name']; //funcion que determina el nombre de la foto
       		$explode = explode(" ", $nombre_archivo);//busca los espacios en blancos en el nombre de la imagen 
			$conteo_final=count ($explode);//cuenta los espacios es blancos 
			$conteo_final=$conteo_final-1; //resta los espacios -1
			$i=0;
			while ($i<=$conteo_final)
     		{
				$palabra=$explode[$i];
				if (!(empty ($union)))
  					$union="$union_$palabra";
				else
  					$union="$palabra";
 				$i++;
      		}
			$Recibidas->setDocumento('img'.date('Y').'_'.$Recibidas->getId_alto_nivel_user().$Recibidas->getId_primer_nivel_user().$Recibidas->getId_direcciones_user().'_'.$union);
		
			// sql para insertar la imagen en la bd
      		$destino = '../assets/imgescanner'; // nombre de la carpeta del servidor
       	    move_uploaded_file ( $_FILES ['documento'][ 'tmp_name' ], $destino . '/' .$Recibidas->getDocumento());// mueve la foto a la carpeta de archivos

//  	  }
//	  else 
//   	  {
//   	  	$_SESSION['estatus_msj']=2;
//		$_SESSION['error_recibidas']="La Im&aacute;gen debe pesar menos de 2 mb";
//		$url_relativa = "siscor/controlador/control_consultar_recibidas.php";
//    	header("Cache-Control: no-cache");
//		header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);		
//      	exit;
//   	  }
   }
   else 
   {
   		$Recibidas->setDocumento("");
   }
   }
   if ($_POST['eli_img']=="on")
   {
		//die("paso");
		$archivo = $_SESSION['scanner'];
		$ruta = '../assets/imgescanner/'.$archivo;
		//die($ruta);
		unlink($ruta);
		$Recibidas->setDocumento("");
	}
//$mensaje = $Recibidas->EjecutarFunciones("funcion_mod_recibidas('".$Recibidas->getId()."','".$Recibidas->getNuano()."','".$fecha_entra."','".$fecha_cart."','".$Recibidas->getHorahhentrada()."','".$Recibidas->getHorattentrada()."','".$Recibidas->getClasificacion_documento()."','".$Recibidas->getHorammentrada()."','".$Recibidas->getAsunto()."','".$Recibidas->getRemitente()."','".$Recibidas->getUbicacion()."','".$Recibidas->getAlto_nivel()."','".$Recibidas->getPrimer_nivel()."','".$Recibidas->getDirecciones()."','"."1"."','".$Recibidas->getNuexterno()."','".$Recibidas->getCedremitente()."','"."4"."','"."2"."','"."46"."','".$Recibidas->getAmerita_respuesta()."','".$Recibidas->getDocumento()."')");
    
	$mensaje = $Recibidas->EjecutarFunciones("funcion_mod_recibidas('".$Recibidas->getId()."','".$Recibidas->getNuano()."','".$fecha_entra."','".$fecha_cart."','".$Recibidas->getHorahhentrada()."','".$Recibidas->getHorattentrada()."','".$Recibidas->getClasificacion_documento()."','".$Recibidas->getHorammentrada()."','".$Recibidas->getAsunto()."','".$Recibidas->getRemitente()."','".$Recibidas->getUbicacion()."','".$Recibidas->getAlto_nivel()."','".$Recibidas->getPrimer_nivel()."','".$Recibidas->getDirecciones()."','".$Recibidas->getId_usuario()."','".$Recibidas->getNuexterno()."','".$Recibidas->getCedremitente()."','".$Recibidas->getId_direcciones_user()."','".$Recibidas->getId_alto_nivel_user()."','".$Recibidas->getId_primer_nivel_user()."','".$Recibidas->getAmerita_respuesta()."','".$Recibidas->getDocumento()."','".$_SERVER["REMOTE_ADDR"]."')");

	unset($_SESSION['modif']);
	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['alto_nivel_corres_seleccionado']);
	unset($_SESSION['primer_nivel_corres_seleccionado']);
	unset($_SESSION['direcciones_corres_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['scanner']);
	$_SESSION['estatus_msj']=2;
	$_SESSION['error_recibidas']="La Información fue Modificada con Éxito";
	$url_relativa = "siscor/controlador/control_consultar_recibidas.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;

	
}//fin modificar

//boton regresar
if ($_POST['regresar']==true){

	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['alto_nivel_corres_seleccionado']);
	unset($_SESSION['primer_nivel_corres_seleccionado']);
	unset($_SESSION['direcciones_corres_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['scanner']);
	if ($_SESSION['consul']==1)
	{
		unset($_SESSION['consul']);
		$url_relativa = "siscor/controlador/control_respuesta_recibidas.php";
		header("Cache-Control: no-cache");
		header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
		exit;
	}
	else if ($_SESSION['modif']==1)
	{
		unset($_SESSION['modif']);
		$url_relativa = "siscor/controlador/control_consultar_recibidas.php";
	    header("Cache-Control: no-cache");
		header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
		exit;
	}
	else if($_SESSION['ConsulRespuestaRemisiones']==1)
	{
		$url_relativa = "siscor/controlador/control_consultar_recibidas.php";
	    header("Cache-Control: no-cache");
		header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
		exit;
	}

}
//regresar respuesta_oficio
if ($_POST['regresarespuestaoficio']==true){

	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['alto_nivel_corres_seleccionado']);
	unset($_SESSION['primer_nivel_corres_seleccionado']);
	unset($_SESSION['direcciones_corres_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['RespuestaOfic']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['scanner']);
	$url_relativa = "siscor/controlador/control_respuesta_recibidas.php?Resp_ofi=act";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;


}
if ($_POST['regresaremision']==true){
	
	$_Session['regreso']=1;

/*****************************nuevo*****************/	
	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['alto_nivel_corres_seleccionado']);
	unset($_SESSION['primer_nivel_corres_seleccionado']);
	unset($_SESSION['direcciones_corres_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['RespuestaOfic']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['scanner']);
	unset($_SESSION['nombre_responsable_remision']);
/*********************************************************************/	
	unset($_SESSION['consul_remision']);
	$url_relativa = "../siscor/controlador/control_remisiones.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
/************************************************************************************************************************/
}

if ($_POST['regresar_remisionies']==true)
{

	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['alto_nivel_corres_seleccionado']);
	unset($_SESSION['primer_nivel_corres_seleccionado']);
	unset($_SESSION['direcciones_corres_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['RespuestaOfic']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['scanner']);
	unset($_SESSION['nombre_responsable_remision']);
	$url_relativa = "../siscor/controlador/control_consul_respuesta_remisiones_recibidas.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;

}

if ($_POST['regresarconsul']==true){

	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['alto_nivel_corres_seleccionado']);
	unset($_SESSION['primer_nivel_corres_seleccionado']);
	unset($_SESSION['direcciones_corres_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['RespuestaOfic']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['scanner']);
	unset($_SESSION['bloqueo_consulta']);
	$url_relativa = "siscor/controlador/control_consul_respuesta_recibidas.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;


}
if ($_POST['cancelar_recibidas']==true){
	
	unset($_SESSION['id_oficios']);
	unset($_SESSION['anio_oficios']);
	unset($_SESSION['fecha_envio_oficios']);
	unset($_SESSION['hora_oficios']);
	unset($_SESSION['minuto_oficios']);
	unset($_SESSION['tiempo_oficios']);
	unset($_SESSION['destinatario_oficios']);
	unset($_SESSION['alto_nivel_corres_seleccionado']);
	unset($_SESSION['primer_nivel_corres_seleccionado']);
	unset($_SESSION['direcciones_corres_seleccionado']);
	unset($_SESSION['asunto_oficios']);
	unset($_SESSION['num_correspondencia_remetir_oficios']);
	unset($_SESSION['anio_correspondencia_remetir_oficios']);
	unset($_SESSION['responsable_oficios']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['consul_oficio']);
	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['consul']);
	unset($_SESSION['consul_oficio']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['scanner']);
	$url_relativa = "siscor/controlador/control_respuesta_oficios.php";
	header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
	
}


if ($_POST['cancelar_remisiones']==true){
	
	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['alto_nivel_corres_seleccionado']);
	unset($_SESSION['primer_nivel_corres_seleccionado']);
	unset($_SESSION['direcciones_corres_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['RespuestaOfic']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['id_remisiones']);
	unset($_SESSION['anio_remisiones']);
	unset($_SESSION['anio_remitir_remision']);
	unset($_SESSION['Unidades_seleccionado_remision']);
	unset($_SESSION['Coordinaciones_seleccionado_remision']);
	unset($_SESSION['nombre_responsable_remision']);
	unset($_SESSION['prioridades_seleccionado_remision']);
	unset($_SESSION['accion_seleccionado_remision']);
	unset($_SESSION['check_amerita_respuesta_remision']);	
	unset($_SESSION['observacion_remision']);
	unset($_SESSION['respondida_observacion_remision']);
	unset($_SESSION['id_remitir_remision']);
	unset($_SESSION['anio_remitir_remision']);
	unset($_SESSION['hora_remision']);
	unset($_SESSION['minuto_remision']);
	unset($_SESSION['tiempo_remision']);
	unset($_SESSION['RespuestaRemisiones']);
	unset($_SESSION['consul_oficio']);//agregada de prueba
	unset($_SESSION['alto_nivel_corres_seleccionado_remision']);
	unset($_SESSION['primer_nivel_corres_seleccionado_remision']);
	unset($_SESSION['direcciones_corres_seleccionado_remision']);
	unset($_SESSION['scanner']);
	$url_relativa = "siscor/controlador/control_respuesta_remisiones.php";
	header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
}

if ($_POST['siguiente']==true){
	
	$url_relativa = "siscor/controlador/control_respuesta_oficios.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
	
}

if ($_POST['finalizar']==true){
		
	$RespuestaRecibidas = New RespuestaRecibidas;
	
	$RespuestaRecibidas->setId_recibida($_POST['id']);
	$RespuestaRecibidas->setNuanio_recibida($_POST['anio']);
	$RespuestaRecibidas->setId_oficio($_SESSION['id_oficios']);
	$RespuestaRecibidas->setNuanio_oficios($_SESSION['anio_oficios']);
	$RespuestaRecibidas->setId_usuario($_SESSION['codigo']);
	$RespuestaRecibidas->setId_direcciones_user($_SESSION['direcciones_user']);
	$RespuestaRecibidas->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$RespuestaRecibidas->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
	
	$RespuestaRecibidas->EjecutarFunciones("funcion_insertar_respuesta_oficios('".$RespuestaRecibidas->getId_recibida()."','".$RespuestaRecibidas->getNuanio_recibida()."','".$RespuestaRecibidas->getId_oficio()."','".$RespuestaRecibidas->getNuanio_oficios()."','".$RespuestaRecibidas->getId_usuario()."','".$RespuestaRecibidas->getId_direcciones_user()."','".$RespuestaRecibidas->getId_alto_nivel_user()."','".$RespuestaRecibidas->getId_primer_nivel_user()."')");
	$RespuestaRecibidas->EjecutarFunciones("funcion_mod_oficios_respondidos('".$RespuestaRecibidas->getId_oficio()."','".$RespuestaRecibidas->getNuanio_oficios()."','true','".$RespuestaRecibidas->getId_usuario()."','".$RespuestaRecibidas->getId_direcciones_user()."','".$RespuestaRecibidas->getId_alto_nivel_user()."','".$RespuestaRecibidas->getId_primer_nivel_user()."')");
	
	unset($_SESSION['id_oficios']);
	unset($_SESSION['anio_oficios']);
	unset($_SESSION['fecha_envio_oficios']);
	unset($_SESSION['hora_oficios']);
	unset($_SESSION['minuto_oficios']);
	unset($_SESSION['tiempo_oficios']);
	unset($_SESSION['destinatario_oficios']);
	unset($_SESSION['alto_nivel_corres_seleccionado']);
	unset($_SESSION['primer_nivel_corres_seleccionado']);
	unset($_SESSION['direcciones_corres_seleccionado']);
	unset($_SESSION['asunto_oficios']);
	unset($_SESSION['num_correspondencia_remetir_oficios']);
	unset($_SESSION['anio_correspondencia_remetir_oficios']);
	unset($_SESSION['responsable_oficios']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['consul_oficio']);
	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['consul']);
	unset($_SESSION['RespuestaOficio']);
	unset($_SESSION['RespuestaOfic']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['consul_oficio']);
	unset($_SESSION['scanner']);
	$_SESSION['estatus_msj']=2;
	$_SESSION['error_recibidas']="La Información fue Guardada con Éxito";
	$url_relativa = "siscor/controlador/control_respuesta_oficios.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
}

if ($_POST['finalizar_remisiones']==true){
		
	$RespuestaRemisiones = New RespuestaRemisiones;
	
	$RespuestaRemisiones->setId_recibida($_POST['id']);
	$RespuestaRemisiones->setNuanio_recibida($_POST['anio']);
	$RespuestaRemisiones->setId_Remisiones($_SESSION['id_remisiones']);
	$RespuestaRemisiones->setNuanio_remisiones($_SESSION['anio_remisiones']);
	$RespuestaRemisiones->setId_usuario($_SESSION['codigo']);
	$RespuestaRemisiones->setId_direcciones_user($_SESSION['direcciones_user']);
	$RespuestaRemisiones->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$RespuestaRemisiones->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
	
	//$mensaje = $RespuestaRemisiones->EjecutarFunciones("funcion_insertar_respuesta_recibidas('".$RespuestaRemisiones->getId_recibida()."','".$RespuestaRemisiones->getNuanio_recibida()."','".$RespuestaRemisiones->getId_oficio()."','".$RespuestaRemisiones->getNuanio_oficios()."','".$RespuestaRemisiones->getId_usuario()."','".$RespuestaRemisiones->getId_direcciones_user()."','".$RespuestaRemisiones->getId_alto_nivel_user()."','".$RespuestaRemisiones->getId_primer_nivel_user()."')");
	$RespuestaRemisiones->EjecutarFunciones("funcion_insertar_respuesta_remisiones_recibidas('".$RespuestaRemisiones->getId_recibida()."','".$RespuestaRemisiones->getNuanio_recibida()."','".$RespuestaRemisiones->getId_Remisiones()."','".$RespuestaRemisiones->getNuanio_remisiones()."','".$RespuestaRemisiones->getId_usuario()."','".$RespuestaRemisiones->getId_direcciones_user()."','".$RespuestaRemisiones->getId_alto_nivel_user()."','".$RespuestaRemisiones->getId_primer_nivel_user()."')");
    //$RespuestaRemisiones->EjecutarFunciones("funcion_mod_oficios_respondidos('".$RespuestaRemisiones->getId_oficio()."','".$RespuestaRemisiones->getNuanio_oficios()."','true','".$RespuestaRemisiones->getId_usuario()."','".$RespuestaRemisiones->getId_direcciones_user()."','".$RespuestaRemisiones->getId_alto_nivel_user()."','".$RespuestaRemisiones->getId_primer_nivel_user()."')");
	 

	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['alto_nivel_corres_seleccionado']);
	unset($_SESSION['primer_nivel_corres_seleccionado']);
	unset($_SESSION['direcciones_corres_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['RespuestaOfic']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['id_remisiones']);
	unset($_SESSION['anio_remisiones']);
	unset($_SESSION['anio_remitir_remision']);
	unset($_SESSION['Unidades_seleccionado_remision']);
	unset($_SESSION['Coordinaciones_seleccionado_remision']);
	unset($_SESSION['nombre_responsable_remision']);
	unset($_SESSION['prioridades_seleccionado_remision']);
	unset($_SESSION['accion_seleccionado_remision']);
	unset($_SESSION['check_amerita_respuesta_remision']);	
	unset($_SESSION['observacion_remision']);
	unset($_SESSION['respondida_observacion_remision']);
	unset($_SESSION['id_remitir_remision']);
	unset($_SESSION['anio_remitir_remision']);
	unset($_SESSION['hora_remision']);
	unset($_SESSION['minuto_remision']);
	unset($_SESSION['tiempo_remision']);
	unset($_SESSION['RespuestaRemisiones']);
	unset($_SESSION['scanner']);
	unset($_SESSION['consul_oficio']);//agregada de prueba
	unset($_SESSION['alto_nivel_corres_seleccionado_remision']);
	unset($_SESSION['primer_nivel_corres_seleccionado_remision']);
	unset($_SESSION['direcciones_corres_seleccionado_remision']);
	$_SESSION['estatus_msj']=2;
	$_SESSION['error_remisiones']="La Información fue Guardada con Éxito";
	$url_relativa = "siscor/controlador/control_respuesta_remisiones.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
}


if ($_POST['modificarconsul']==true){
		
	$RespuestaRecibidas = New RespuestaRecibidas;
	$RespuestaRecibidas->setId_recibida($_POST['id']);
	$RespuestaRecibidas->setNuanio_recibida($_POST['anio']);
	$RespuestaRecibidas->setId_oficio($_POST['id_oficios']);
	$RespuestaRecibidas->setNuanio_oficios($_POST['anio_oficios']);
	$RespuestaRecibidas->setId_usuario($_SESSION['codigo']);
	$RespuestaRecibidas->setId_direcciones_user($_SESSION['direcciones_user']);
	$RespuestaRecibidas->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$RespuestaRecibidas->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
	
	$mensaje = $RespuestaRecibidas->EjecutarFunciones("funcion_mod_consul_respuesta_recibidas('".$RespuestaRecibidas->getId_recibida()."','".$RespuestaRecibidas->getNuanio_recibida()."','".$RespuestaRecibidas->getId_oficio()."','".$RespuestaRecibidas->getNuanio_oficios()."','".$RespuestaRecibidas->getId_usuario()."','".$RespuestaRecibidas->getId_direcciones_user()."','".$RespuestaRecibidas->getId_alto_nivel_user()."','".$RespuestaRecibidas->getId_primer_nivel_user()."')");

	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['alto_nivel_corres_seleccionado']);
	unset($_SESSION['primer_nivel_corres_seleccionado']);
	unset($_SESSION['direcciones_corres_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['consul']);
	unset($_SESSION['RespuestaOficio']);
	unset($_SESSION['RespuestaOfic']);
	unset($_SESSION['ame_respuesta']);	
	unset($_SESSION['scanner']);
	unset($_SESSION['bloqueo_consulta']);	
	$_SESSION['estatus_msj']=2;
	$_SESSION['error_recibidas']="La Información fue Modificada con Éxito";
	$url_relativa = "siscor/vista/consultar_respuesta_recibidas.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
}

//llena el combo tipo usuarios
$tabla= "vista_mostrar_clasificacion_documentos";
$orden="nb_clasificacion_documentos";
$sw=1;
$cont = $Recibidas->Mostrar(0,$tabla,$orden,$sw);
	//echo($cant); die;
if ( $cont != 0 ) 
{
	//echo $alto_nivel->Mostrar(0); die();
	$_SESSION['cantidad'] = $cont;
	//echo $alto_nivel->Mostrar(0); die();
	//se crea un arreglo donde se alogen los registros necesarios
    $campoId=array();
    $campoNombre=array();
	$datos = $Recibidas->Mostrar(1,$tabla,$orden,$sw);
	//Carga los registros
    while ( $row=pg_fetch_array($datos) )
	{ 
		array_push( $campoId , $row["cd_clasificacion_documentos"] );	
		array_push( $campoNombre , $row["nb_clasificacion_documentos"] );				
	}
    //Prepara para la comunicacion
	$_SESSION['campoIdClasificacionDocumentos'] = $campoId;
	$_SESSION['campoNombreClasificacionDocumentos'] = $campoNombre;		
}//fin de llena el combo tipo usuarios

//llena combo de alto nivel
$tabla="vista_mostrar_alto_nivel_corres";
$orden="nb_alto_nivel_corres";
$sw=0;
$cont = $Recibidas->Mostrar(0,$tabla,$orden,$sw);
//echo($cant); die;
if ( $cont != 0 ) 
{
	//echo $alto_nivel->Mostrar(0); die();
	$_SESSION['cantidad_alto_nivel_corres'] = $cont;
	//echo $alto_nivel->Mostrar(0); die();
	//se crea un arreglo donde se alogen los registros necesarios
    $campoId=array();
    $campoNombre=array();
	$datos = $Recibidas->Mostrar(1,$tabla,$orden,$sw);
	//Carga los registros
	    while ( $row=pg_fetch_array($datos) )
		{ 
			array_push( $campoId , $row["cd_alto_nivel_corres"] );	
			array_push( $campoNombre , $row["nb_alto_nivel_corres"] );				
		}
    //Prepara para la comunicacion
	$_SESSION['campoIdAltoNivelCorres'] = $campoId;
    $_SESSION['campoNombreAltoNivelCorres'] = $campoNombre;		
}//fin de llena combo de alto nivel


if ($Recibidas->getId_primer_nivel_user()!="")
{
if ($_SESSION['alto_nivel_user']>=25)
{
	$valor="cd_alto_nivel_corres=".$_SESSION['alto_nivel_user']; 
	//$valor="cd_alto_nivel=".$_SESSION['alto_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];	
}	
else{
	$valor="cd_alto_nivel_corres=0";
}
	$tabla= "vista_mostrar_primer_nivel_corres";
	$orden="nb_primer_nivel_corres";
	$cont = $Recibidas->MostrarValores(0,$tabla,$orden,$valor);
		//echo($cont); 
		
		if ( $cont != 0 ) 
		{
			//echo $alto_nivel->Mostrar(0); die();
			$_SESSION['cantidad_primer_nivel_corres'] = $cont;
			//echo $alto_nivel->Mostrar(0); die();
			//se crea un arreglo donde se alogen los registros necesarios
	    	$campoId=array();
	    	$campoNombre=array();
			$datos = $Recibidas->MostrarValores(1,$tabla,$orden,$valor);
			//Carga los registros
		    	while ($row=pg_fetch_array($datos))
				{ 
					array_push( $campoId , $row["cd_primer_nivel_corres"] );	
					array_push( $campoNombre , $row["nb_primer_nivel_corres"] );				
				}
    	//Prepara para la comunicacion
			$_SESSION['campoIdprimer_nivel_corres'] = $campoId;
			$_SESSION['campoNombreprimer_nivel_corres'] = $campoNombre;		
		}
}//fin de combo para llenar primer_nivel




$url_relativa = "siscor/vista/registrar_recibidas.php";
header("Cache-Control: no-cache");
header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
?>
