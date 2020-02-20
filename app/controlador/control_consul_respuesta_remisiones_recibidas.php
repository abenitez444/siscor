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

if($_POST['consultar']==true)
{

	$Recibidas->setNuano($_POST['ano_consulta']);
	$Recibidas->setId($_POST['num_correlativo']);
	$resp=$Recibidas->CargarDatos();

	if ($resp==FALSE)
	{
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_recibidas']="El N&uacute;mero de Correlativo No Existe";	
		$url_relativa = "siscor/vista/consultar_respuesta_remisiones_recibidas.php";
		header("Cache-Control: no-cache");
		header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
		exit;
	}
	else
	{

		$_SESSION['id_recibidas']=$Recibidas->getId();
		$_SESSION['anio_recibidas']=$Recibidas->getNuano();
		$_SESSION['fecha_entrada_recibidas']=$Recibidas->getFeentrada();
		$_SESSION['fecha_carta_recibidas']=$Recibidas->getFecarta();
		$_SESSION['hora_recibidas']=$Recibidas->getHorahhentrada();
		$_SESSION['minuto_recibidas']=$Recibidas->getHorammentrada();
		$_SESSION['tiempo_recibidas']=$Recibidas->getHorattentrada();
		$_SESSION['num_externo_recibidas']=$Recibidas->getNuexterno();
		$_SESSION['remitente_recibidas']=$Recibidas->getRemitente();
		$_SESSION['cedula_recibidas']=$Recibidas->getCedremitente();
		$_SESSION['alto_nivel_corres_seleccionado']=$Recibidas->getAlto_nivel();
		$_SESSION['primer_nivel_corres_seleccionado']=$Recibidas->getPrimer_nivel();
		$_SESSION['direcciones_corres_seleccionado']=$Recibidas->getDirecciones();
		$_SESSION['clasificacion_documentos_seleccionado']=$Recibidas->getClasificacion_documento();
		$_SESSION['asunto_recibidas']=$Recibidas->getAsunto();
		$_SESSION['ubicacion_recibidas']=$Recibidas->getUbicacion();
		$_SESSION['ame_respuesta']=$Recibidas->getAmerita_respuesta();
		$Num_recibida=$Recibidas->CargarDatosRespuestaRecibidas();
		$_SESSION['id_oficio_consul']=$Recibidas->getId_oficios();
		$_SESSION['anio_oficio_onsul']=$Recibidas->getAnio_oficios();		
		$_SESSION['scanner']=$Recibidas->getDocumento();
	
		$tabla= "vista_mostrar_alto_nivel_corres";
		$orden="nb_alto_nivel_corres";		
		$sw=0;
		$cont = $Recibidas->Mostrar(0,$tabla,$orden,$sw);
	//	echo($cant); die;
		if ( $cont != 0 ) 
		{
			//echo $alto_nivel_corres->Mostrar(0); die();
			$_SESSION['cantidad_alto_nivel_corres'] = $cont;
			//echo $alto_nivel_corres->Mostrar(0); die();
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
		}	
		if ($_SESSION['primer_nivel_corres_seleccionado']!="")
		{
			if ($_SESSION['alto_nivel_corres_seleccionado']==3)
			{
				$valor="cd_alto_nivel_corres=".$_SESSION['alto_nivel_corres_seleccionado']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];	
			}
			else
			{
				$valor="cd_alto_nivel_corres=".$_SESSION['alto_nivel_corres_seleccionado'];
			}
	
			$tabla= "vista_mostrar_primer_nivel_corres";
			$orden="nb_primer_nivel_corres";
			$cont = $Recibidas->MostrarValores(0,$tabla,$orden,$valor);
			//echo($cant); die;
			if ( $cont != 0 ) 
			{
				//echo $alto_nivel_corres->Mostrar(0); die();
				$_SESSION['cantidad_primer_nivel_corres'] = $cont;
				//echo $alto_nivel_corres->Mostrar(0); die();
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
		}//fin de combo para llenar primer_nivel_corres
		
		//combo para llenar direcciones_corres
		if ($_SESSION['direcciones_corres_seleccionado']!="")
		{
			$valor="cd_primer_nivel_corres=".$_SESSION['primer_nivel_corres_seleccionado']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];
			$tabla= "vista_mostrar_direcciones_corres";
			$orden="nb_direcciones_corres";
			$cont = $Recibidas->MostrarValores(0,$tabla,$orden,$valor);
			//	echo($cant); die;
			if ( $cont != 0 ) 
			{
				//echo $alto_nivel->Mostrar(0); die();
				$_SESSION['cantidaddirecciones_corres'] = $cont;
				//echo $alto_nivel->Mostrar(0); die();
				//se crea un arreglo donde se alogen los registros necesarios
			    $campoId=array();
			    $campoNombre=array();
				$datos = $Recibidas->MostrarValores(1,$tabla,$orden,$valor);
				//Carga los registros
			    while ( $row=pg_fetch_array($datos) )
				{ 
					array_push( $campoId , $row["cd_direcciones_corres"] );	
					array_push( $campoNombre , $row["nb_direcciones_corres"] );				
				}
			    //Prepara para la comunicacion
				$_SESSION['campoIddirecciones_corres'] = $campoId;
				$_SESSION['campoNombredirecciones_corres'] = $campoNombre;		
			}
		}

	}
$url_relativa = "../vista/registrar_recibidas.php";
header("Cache-Control: no-cache");
header("Location: ".$url_relativa);	
exit;
}	

if($_POST['cancelar_recibidas']==true)
{
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
	unset($_SESSION['consul_oficio']);//agregada de prueba
	
	unset($_SESSION['alto_nivel_seleccionado_remision']);
	unset($_SESSION['primer_nivel_seleccionado_remision']);
	unset($_SESSION['direcciones_seleccionado_remision']);
	unset($_SESSION['RespuestaRemisiones']);
	
	
	
	$url_relativa = "siscor/controlador/control_respuesta_remisiones.php";
	header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
	exit;	
}

$url_relativa = "siscor/vista/consultar_respuesta_remisiones_recibidas.php";
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