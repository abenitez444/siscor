<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_recibidas.php");
include_once("../modelo/class_modulosxusuarios.php"); 

	$Recibidas = new Recibidas();
	$Modulosxusuarios = new Modulosxusuarios();
	
	$Recibidas->setId_usuario($_SESSION['codigo']);
	$Recibidas->setId_direcciones_user($_SESSION['direcciones_user']);
	$Recibidas->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$Recibidas->setId_primer_nivel_user($_SESSION['primer_nivel_user']);	

$permiso =$Modulosxusuarios->Existe($Recibidas->getId_usuario(),'in_ingresar',"TRUE",3);

	
if ($_SESSION['perfil']==1 && $permiso==1)
{
	

	
   	$RespuestaOficio = isset($_GET['Resp_ofi'])? $_GET['Resp_ofi'] : "act";

   	
   	
   	if ($RespuestaOficio=="act")
   	{
   		//die($RespuestaOficio."paso");
   		
   		$_SESSION['RespuestaOficio']=1;

   		
   	}
   	/*elseif ($RespuestaOficio=="cons"){
   		$_SESSION['RespuestaOficio']=2;
   	}*/
   	
if($_POST['consultar']==true)
{

	$Recibidas->setNuano($_POST['ano_consulta']);
	$Recibidas->setId($_POST['num_correlativo']);
	$resp=$Recibidas->CargarDatos();

	if ($resp==FALSE)
	{
	$_SESSION['estatus_msj']=1;
	$_SESSION['error_recibidas']="El N&uacute;mero de Correlativo No Existe";	
	$url_relativa = "siscor/vista/registrar_respuesta_recibidas.php";
	header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
	}
	else
	{

		//si es el modulo de repuesta oficio entra como diferente a 1 
	if ($_SESSION['consul_oficio']!=1 )
	{
		//valida si el oficio fue mercado con amerita respuesta
		$existe=$Recibidas->ExisteRespuestaOficio('vista_mostrar_recibidas','cd_recibidas',$Recibidas->getId(),'nu_ano_recibidas',$Recibidas->getNuano(),'cd_direcciones_usuarios',$Recibidas->getId_direcciones_user(),'cd_alto_nivel_usuarios',$Recibidas->getId_alto_nivel_user(),'cd_primer_nivel_usuarios',$Recibidas->getId_primer_nivel_user(),'in_amerita_respuesta_recibidas',"true");
		if(!$existe)
		{
			$_SESSION['estatus_msj']=1;
			$_SESSION['error_recibidas']="Este N&uacute;mero de Oficio No Amerita Respuesta";
			$url_relativa = "siscor/vista/registrar_respuesta_recibidas.php";
			header("Cache-Control: no-cache");
			header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
			exit;
		}// fin valida si el oficio fue mercado con amerita respuesta
		else
		{
			//valida si el oficio ya fue respondido
			$existe=$Recibidas->ExisteRespuestaOficio('vista_mostrar_recibidas','cd_recibidas',$Recibidas->getId(),'nu_ano_recibidas',$Recibidas->getNuano(),'cd_direcciones_usuarios',$Recibidas->getId_direcciones_user(),'cd_alto_nivel_usuarios',$Recibidas->getId_alto_nivel_user(),'cd_primer_nivel_usuarios',$Recibidas->getId_primer_nivel_user(),'in_respuesta_recibidas',"false");
			if(!$existe)
			{	

				if($_SESSION['RespuestaOfic']!=1 && $_SESSION['consul_oficio']!=1 )
				{
					$_SESSION['estatus_msj']=1;
					$_SESSION['error_recibidas']="Este N&uacute;mero de Oficio Ya Fue Respondido";
					$url_relativa = "siscor/vista/registrar_respuesta_recibidas.php";	
					header("Cache-Control: no-cache");
					header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
					exit;
				}
			}// fin valida si el oficio ya fue respondido
			/*else 
			{
		
			}*/
		}
		
	}

	
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
if ($_SESSION['alto_nivel_corres_seleccionado']==3){
	$valor="cd_alto_nivel_corres=".$_SESSION['alto_nivel_corres_seleccionado']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];	
}
else{
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
		
//combo para llenar direcciones
if ($_SESSION['direcciones_corres_seleccionado']!="")
{
	$valor="cd_primer_nivel_corres=".$_SESSION['primer_nivel_corres_seleccionado']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];
	
	$tabla= "vista_mostrar_direcciones_corres";
	$orden="nb_direcciones_corres";
	$cont = $Recibidas->MostrarValores(0,$tabla,$orden,$valor);
	//echo($cant); die;
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
////////////////////////////////////////////////////////******************************************



if ($_SESSION['consul_oficio']==1 )
{
	$_SESSION['consul']=1;	

}
else if ($_SESSION['RespuestaOficio']==1) 
{
	

	$_SESSION['RespuestaOfic']=1;
	unset($_SESSION['RespuestaOficio']);

}
else if ($_SESSION['RespuestaOficio']==2)
{
	
	$_SESSION['RespuestaOfic']=2;
	unset($_SESSION['RespuestaOficio']);
	
}
	}
	$url_relativa = "../vista/registrar_recibidas.php";
   	header("Cache-Control: no-cache");
	header("Location: ".$url_relativa);	
   	exit;
}//	fin consultar

if($_POST['cancelar_recibidas']==true)
{
	unset($_SESSION['id_oficios']);
	unset($_SESSION['anio_oficios']);
	unset($_SESSION['fecha_envio_oficios']);
	unset($_SESSION['hora_oficios']);
	unset($_SESSION['minuto_oficios']);
	unset($_SESSION['tiempo_oficios']);
	unset($_SESSION['num_remision']);
	unset($_SESSION['destinatario_oficios']);
	unset($_SESSION['cedula_oficios']);
	unset($_SESSION['alto_nivel_corres_seleccionado']);
	unset($_SESSION['primer_nivel_corres_seleccionado']);
	unset($_SESSION['direcciones_corres_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_oficios']);
	unset($_SESSION['num_correspondencia_remetir_oficios']);
	unset($_SESSION['anio_correspondencia_remetir_oficios']);
	unset($_SESSION['responsable_oficios']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['consul_oficio']);
	unset($_SESSION['consul']);
	$url_relativa = "siscor/controlador/control_respuesta_oficios.php";
	header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
	exit;	
	
}

$url_relativa = "siscor/vista/registrar_respuesta_recibidas.php";
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