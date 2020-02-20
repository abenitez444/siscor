<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_oficios.php"); 
include_once("../modelo/class_respuesta_oficios.php");
include_once("../modelo/class_modulosxusuarios.php");

	$Oficios = new Oficios();
   	$Modulosxusuarios = new Modulosxusuarios();

   	$Oficios->setId_usuario($_SESSION['codigo']);
	$Oficios->setId_direcciones_user($_SESSION['direcciones_user']);
	$Oficios->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$Oficios->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
   	
	$permiso =$Modulosxusuarios->Existe($Oficios->getId_usuario(),'in_ingresar',"TRUE",4);
	
	
if ($_SESSION['perfil']==1 && $permiso==1)
{
	
	


//chequea la imagen del capcha para guardar los datos
if($_POST['guardar']==true)
{
	
	$Oficios->setNuanioficio(date("Y"));
	$Oficios->setId_remitir($_POST['num_correspondencia_remitir']);
	$Oficios->setFeenvio($_POST['fecha_envio']);
	$Oficios->setHorahhentrada($_POST['hora']);
	$Oficios->setHorammentrada($_POST['minuto']);
	$Oficios->setHorattentrada($_POST['tiempo']);	
	$Oficios->setDestinatario($_POST['destinatario']);
	$Oficios->setResponsable($_POST['responsable']);
	$Oficios->setAlto_nivel($_POST['alto_nivel']);
	if ($Oficios->getAlto_nivel()==""){
		$Oficios->setAlto_nivel($_SESSION['alto_nivel_user']);
	}	
	$Oficios->setPrimer_nivel($_POST['primer_nivel']);
	$Oficios->setDirecciones($_POST['direcciones']);	
	$Oficios->setNuanioremitir($_POST['anio_remitir']);
	$Oficios->setAmeritarespuesta($_POST['amerita_respuesta']);		
	if(	$Oficios->getAmeritarespuesta()=="on")
	{
		$Oficios->setAmeritarespuesta("true");
	}
	else
	{
		$Oficios->setAmeritarespuesta("false");
	}
	$Oficios->setOficiorespondido("false");
	$Oficios->setAsunto($_POST['asunto']);
	$Oficios->setId_recibidas($_POST['num_correspondencia_responder']);
	$Oficios->setNuaniorecibidas($_POST['anio_recibida_responder']);
	if ($Oficios->getDirecciones()=="")
	{
		$Oficios->setDirecciones(0);
	}
	if ($Oficios->getNuanioremitir()=="")
	{
		$Oficios->setNuanioremitir(0);
	}	
	
	
	$tabla= "vista_mostrar_oficios";
	$orden="cd_oficios";		
	$sw=1;
	$cont = $Oficios->MostrarGuardar(0,$tabla,$orden,$sw);
	$cont=$Oficios->getId();
	if ( $cont == 0 ) 
	{
		$cont="1";
	}
	else
	{
		$cont="$cont"+"1";
	}
	
	$fecha=$Oficios->arregla_fecha($Oficios->getFeenvio());
	$mensaje = $Oficios->EjecutarFunciones("funcion_insertar_oficios('".$cont."','".$Oficios->getNuanioficio()."','".$Oficios->getId_remitir()."','".$fecha."','".$Oficios->getHorahhentrada()."','".$Oficios->getHorammentrada()."','".$Oficios->getHorattentrada()."','".$Oficios->getDestinatario()."','".$Oficios->getResponsable()."','".$Oficios->getAlto_nivel()."','".$Oficios->getPrimer_nivel()."','".$Oficios->getDirecciones()."','".$Oficios->getId_usuario()."','".$Oficios->getNuanioremitir()."','".$Oficios->getAmeritarespuesta()."','".$Oficios->getId_direcciones_user()."','".$Oficios->getOficiorespondido()."','".$Oficios->getAsunto()."','".$Oficios->getId_alto_nivel_user()."','".$Oficios->getId_primer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
	$_SESSION['estatus_msj']=2;
	$_SESSION['error_oficios']="La Información fue Guardada con Éxito";
	$_SESSION['correlativo']= "Número de Correlativo Generado: " . $cont ;
}//fin de guardar


//modificar
if($_POST['modificar']==true){

	$Oficios->setid($_POST['id']);
	$Oficios->setNuanioficio($_POST['anio']);
	$Oficios->setId_remitir($_POST['num_correspondencia_remitir']);
	$Oficios->setFeenvio($_POST['fecha_envio']);
	$Oficios->setHorahhentrada($_POST['hora']);
	$Oficios->setHorammentrada($_POST['minuto']);
	$Oficios->setHorattentrada($_POST['tiempo']);	
	$Oficios->setDestinatario($_POST['destinatario']);
	$Oficios->setResponsable($_POST['responsable']);
	$Oficios->setAlto_nivel($_POST['alto_nivel']);
	if ($Oficios->getAlto_nivel()==""){
		$Oficios->setAlto_nivel($_SESSION['alto_nivel_user']);
	}	
	$Oficios->setPrimer_nivel($_POST['primer_nivel']);
	$Oficios->setDirecciones($_POST['direcciones']);
	$Oficios->setNuanioremitir($_POST['anio_remitir']);
	$Oficios->setAmeritarespuesta($_POST['amerita_respuesta']);		
	if(	$Oficios->getAmeritarespuesta()=="on")
	{
		$Oficios->setAmeritarespuesta("true");
	}
	else
	{
		$Oficios->setAmeritarespuesta("false");
	}
	
	//$Oficios->setOficiorespondido("false");
	
	$Oficios->setAsunto($_POST['asunto']);
	$Oficios->setId_recibidas($_POST['num_correspondencia_responder']);
	$Oficios->setNuaniorecibidas($_POST['anio_recibida_responder']);
	if ($Oficios->getDirecciones()=="")
	{
		$Oficios->setDirecciones(0);
	}
	if ($Oficios->getNuanioremitir()=="")
	{
		$Oficios->setNuanioremitir(0);
	}
	$fecha=$Oficios->arregla_fecha($Oficios->getFeenvio());
	//$mensaje = $Oficios->EjecutarFunciones("funcion_mod_oficios('".$Oficios->getId()."','".$Oficios->getNuanioficio()."','".$Oficios->getId_remitir()."','".$fecha."','".$Oficios->getHorahhentrada()."','".$Oficios->getHorammentrada()."','".$Oficios->getHorattentrada()."','".$Oficios->getDestinatario()."','".$Oficios->getResponsable()."','".$Oficios->getAlto_nivel()."','".$Oficios->getPrimer_nivel()."','".$Oficios->getDirecciones()."','".$Oficios->getId_usuario()."','".$Oficios->getNuanioremitir()."','".$Oficios->getAmeritarespuesta()."','".$Oficios->getId_direcciones_user()."','".$Oficios->getOficiorespondido()."','".$Oficios->getAsunto()."','".$Oficios->getId_alto_nivel_user()."','".$Oficios->getId_primer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
	$mensaje = $Oficios->EjecutarFunciones("funcion_mod_oficios('".$Oficios->getId()."','".$Oficios->getNuanioficio()."','".$Oficios->getId_remitir()."','".$fecha."','".$Oficios->getHorahhentrada()."','".$Oficios->getHorammentrada()."','".$Oficios->getHorattentrada()."','".$Oficios->getDestinatario()."','".$Oficios->getResponsable()."','".$Oficios->getAlto_nivel()."','".$Oficios->getPrimer_nivel()."','".$Oficios->getDirecciones()."','".$Oficios->getId_usuario()."','".$Oficios->getNuanioremitir()."','".$Oficios->getAmeritarespuesta()."','".$Oficios->getId_direcciones_user()."','".$Oficios->getAsunto()."','".$Oficios->getId_alto_nivel_user()."','".$Oficios->getId_primer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
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
	unset($_SESSION['modif']);

	
	$_SESSION['estatus_msj']=2;
	$_SESSION['error_oficios']="La Información fue Modificada con Éxito";
	$url_relativa = "siscor/controlador/control_consultar_oficios.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
}//fin modificar


//modificar respuesta a oficio
if($_POST['modificarespuestaoficio']==true){

	$Oficios->setid($_POST['id']);
	$Oficios->setNuanioficio($_POST['anio']);
	$Oficios->setId_recibidas($_POST['id_recibidas_mod']);
	$Oficios->setNuanio_recibidas($_POST['anio_oficios_mod']);	

	$Oficios->EjecutarFunciones("funcion_mod_consul_respuesta_oficios('".$Oficios->getId_recibidas()."','".$Oficios->getNuanio_recibidas()."','".$Oficios->getId()."','".$Oficios->getNuanioficio()."','".$Oficios->getId_usuario()."','".$Oficios->getId_direcciones_user()."','".$Oficios->getId_alto_nivel_user()."','".$Oficios->getId_primer_nivel_user()."')");
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
	unset($_SESSION['modif']);
	unset($_SESSION['ConsultarRespuesta']);
	unset($_SESSION['bloquear_remetir_oficios']);
	$_SESSION['estatus_msj']=2;
	$_SESSION['error_oficios']="La Información fue Modificada con Éxito";
	$url_relativa = "siscor/vista/consultar_respuesta_oficios.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
}//fin modificar
//fin de modificar respuesta oficio



//boton regresar
if ($_POST['regresar']==true){

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
	if ($_SESSION['consul_oficio']==1)
	{
		unset($_SESSION['consul_oficio']);
		$url_relativa = "siscor/controlador/control_respuesta_oficios.php";
	    header("Cache-Control: no-cache");
		header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
		exit;
	}
	else
	{
	unset($_SESSION['modif']);
	$url_relativa = "siscor/controlador/control_consultar_oficios.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
	}
		
}


//regresar respuesta oficio
if ($_POST['regresarespuestaoficio']==true)
{

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
	unset($_SESSION['bloquear_remetir_oficios']);
	if($_SESSION['ConsultarRespuesta']==1)
	{
		//unset($_SESSION['ConsultarResp']);
		unset($_SESSION['ConsultarRespuesta']);
		$url_relativa = "siscor/vista/consultar_respuesta_oficios.php";
	}
	else
	{
		$url_relativa = "siscor/controlador/control_respuesta_oficios.php";
	}
	header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
}//regresar de respuesta oficio


if ($_POST['regresarespuestarecibida']==true){

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
	$url_relativa = "siscor/controlador/control_respuesta_oficios.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
}

if ($_POST['cancelar']==true){
	
	
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
	$url_relativa = "siscor/controlador/control_respuesta_oficios.php";
	header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
		
}

if ($_POST['cancelarespuestaoficio']==true){

	unset($_SESSION['id_oficios']);
	unset($_SESSION['anio_oficios']);
	unset($_SESSION['fecha_envio_oficios']);
	unset($_SESSION['hora_oficios']);
	unset($_SESSION['minuto_oficios']);
	unset($_SESSION['tiempo_oficios']);
	unset($_SESSION['destinatario_oficios']);
	unset($_SESSION['alto_nivel_corres_corres_seleccionado']);
	unset($_SESSION['primer_nivel_corres_seleccionado']);
	unset($_SESSION['direcciones_corres_corres_seleccionado']);
	unset($_SESSION['scanner']);
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
	unset($_SESSION['alto_nivel_corres_seleccionado']);
	unset($_SESSION['primer_nivel_corres_seleccionado']);
	unset($_SESSION['direcciones_corres_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['RespuestaOfic']);
	
	$url_relativa = "siscor/controlador/control_respuesta_recibidas.php?Resp_ofi=act";
	header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
}

if($_POST['siguiente']==true){
	
	$url_relativa = "siscor/controlador/control_respuesta_recibidas.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
	
}

if ($_POST['finalizar']==true){
		
	$RespuestaOficios = New RespuestaOficios;
	
	$RespuestaOficios->setId_recibida($_SESSION['id_recibidas']);
	$RespuestaOficios->setNuanio_recibida($_SESSION['anio_recibidas']);
	$RespuestaOficios->setId_oficio($_POST['id']);
	$RespuestaOficios->setNuanio_oficios($_POST['anio']);
	$RespuestaOficios->setId_usuario($_SESSION['codigo']);
	$RespuestaOficios->setId_direcciones_user($_SESSION['direcciones_user']);
	$RespuestaOficios->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$RespuestaOficios->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
	
	//$mensaje = $RespuestaOficios->EjecutarFunciones("funcion_insertar_respuesta_oficios('".$RespuestaOficios->getId_recibida()."','".$RespuestaOficios->getNuanio_recibida()."','".$RespuestaOficios->getId_oficio()."','".$RespuestaOficios->getNuanio_oficios()."','".$RespuestaOficios->getId_usuario()."','".$RespuestaOficios->getId_direcciones_user()."','".$RespuestaOficios->getId_alto_nivel_user()."','".$RespuestaOficios->getId_primer_nivel_user()."')");
	$mensaje = $RespuestaOficios->EjecutarFunciones("funcion_insertar_respuesta_recibidas('".$RespuestaOficios->getId_recibida()."','".$RespuestaOficios->getNuanio_recibida()."','".$RespuestaOficios->getId_oficio()."','".$RespuestaOficios->getNuanio_oficios()."','".$RespuestaOficios->getId_usuario()."','".$RespuestaOficios->getId_direcciones_user()."','".$RespuestaOficios->getId_alto_nivel_user()."','".$RespuestaOficios->getId_primer_nivel_user()."')");

	$RespuestaOficios->EjecutarFunciones("funcion_mod_recibidas_respondidos('".$RespuestaOficios->getId_recibida()."','".$RespuestaOficios->getNuanio_recibida()."','true','".$RespuestaOficios->getId_usuario()."','".$RespuestaOficios->getId_direcciones_user()."','".$RespuestaOficios->getId_alto_nivel_user()."','".$RespuestaOficios->getId_primer_nivel_user()."')");
	
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
	unset($_SESSION['scanner']);
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
	unset($_SESSION['RespuestaOfic']);
	$_SESSION['estatus_msj']=2;
	$_SESSION['error_recibidas']="La Información fue Guardada con Éxito";
	$url_relativa = "siscor/controlador/control_respuesta_recibidas.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
}

//llena el combo tipo usuarios
$tabla= "vista_mostrar_clasificacion_documentos";
$orden="nb_clasificacion_documentos";
$sw=1;
$cont = $Oficios->Mostrar(0,$tabla,$orden,$sw);
	//echo($cant); die;
if ( $cont != 0 ) 
{
	//echo $alto_nivel->Mostrar(0); die();
	$_SESSION['cantidad'] = $cont;
	//echo $alto_nivel->Mostrar(0); die();
	//se crea un arreglo donde se alogen los registros necesarios
    $campoId=array();
    $campoNombre=array();
	$datos = $Oficios->Mostrar(1,$tabla,$orden,$sw);
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
$tabla= "vista_mostrar_alto_nivel_corres";
$orden="nb_alto_nivel_corres";		
$sw=0;
$cont = $Oficios->Mostrar(0,$tabla,$orden,$sw);
//echo($cant); die;
if ( $cont != 0 ) 
{
	//echo $alto_nivel_corres->Mostrar(0); die();
	$_SESSION['cantidad_alto_nivel_corres'] = $cont;
	//echo $alto_nivel_corres->Mostrar(0); die();
	//se crea un arreglo donde se alogen los registros necesarios
    $campoId=array();
    $campoNombre=array();
	$datos = $Oficios->Mostrar(1,$tabla,$orden,$sw);
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

if ($Oficios->getId_primer_nivel_user()!="")
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
	$cont = $Oficios->MostrarValores(0,$tabla,$orden,$valor);
		//echo($cont); 
		
		if ( $cont != 0 ) 
		{
			//echo $alto_nivel->Mostrar(0); die();
			$_SESSION['cantidad_primer_nivel_corres'] = $cont;
			//echo $alto_nivel->Mostrar(0); die();
			//se crea un arreglo donde se alogen los registros necesarios
	    	$campoId=array();
	    	$campoNombre=array();
			$datos = $Oficios->MostrarValores(1,$tabla,$orden,$valor);
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





$url_relativa = "siscor/vista/registrar_oficios.php";
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