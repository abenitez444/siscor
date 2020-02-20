<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_oficios.php"); 
include_once("../modelo/class_modulosxusuarios.php");

	$Oficios = new Oficios();
	$Modulosxusuarios = new Modulosxusuarios();
	
	$Oficios->setId_usuario($_SESSION['codigo']);
	$Oficios->setId_direcciones_user($_SESSION['direcciones_user']);
	$Oficios->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$Oficios->setId_primer_nivel_user($_SESSION['primer_nivel_user']);

	
	$intPermisoConsultar =$Modulosxusuarios->Existe($Oficios->getId_usuario(),'in_consultar',"TRUE",5);
	

	$intPermisoModificar =$Modulosxusuarios->Existe($Oficios->getId_usuario(),'in_modificar',"TRUE",5);
		if($intPermisoModificar==1)
		{
			$_SESSION['modificar']=1;
		}
		else
		{
			$_SESSION['modificar']=0;
		}


if ($_SESSION['perfil']==1 && $intPermisoConsultar==1 || $intPermisoModificar==1)
{
	
	
   	$Modificar = isset($_GET['mod'])? $_GET['mod'] : "modificar";
   	$id = isset($_GET['id'])? $_GET['id'] : "id";
   	$anio = isset($_GET['a'])? $_GET['a'] : "modificar";
 
   	
   	

if($_POST['consultar']==true)
{

	
	
	$Oficios->setNuanioficio($_POST['ano_consulta']);
	$Oficios->setId($_POST['num_correlativo']);
	$Resp=$Oficios->CargarDatos();
	if($Resp == False)
	{ 
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_oficios']="El N&uacute;mero de Correlativo No Existe";	
		$url_relativa = "siscor/vista/consultar_respuesta_oficios.php";
		header("Cache-Control: no-cache");
		header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
		exit;
	}
	else 
	{
	
	
	//si es el modulo de repuesta oficio entra como diferente a 1 y asigna a $_sesscio['consul_ofico']=1

		//valida si el oficio fue mercado con amerita respuesta
		$existe=$Oficios->ExisteRespuestaOficio('vista_mostrar_oficios','cd_oficios',$Oficios->getId(),'nu_ano_oficios',$Oficios->getNuanioficio(),'cd_direcciones_usuarios',$Oficios->getId_direcciones_user(),'cd_alto_nivel_usuarios',$Oficios->getId_alto_nivel_user(),'cd_primer_nivel_usuarios',$Oficios->getId_primer_nivel_user(),'in_amerita_respuesta_oficios',"true");
		if(!$existe)
		{
			$_SESSION['estatus_msj']=1;
			$_SESSION['error_oficios']="Este N&uacute;mero de Oficio No Amerita Respuesta";
			$url_relativa = "siscor/vista/consultar_respuesta_oficios.php";
			header("Cache-Control: no-cache");
			header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
			exit;
		}// fin valida si el oficio fue mercado con amerita respuesta
		else
		{
			//valida si el oficio ya fue respondido
			$existe=$Oficios->ExisteRespuestaOficio('vista_mostrar_oficios','cd_oficios',$Oficios->getId(),'nu_ano_oficios',$Oficios->getNuanioficio(),'cd_direcciones_usuarios',$Oficios->getId_direcciones_user(),'cd_alto_nivel_usuarios',$Oficios->getId_alto_nivel_user(),'cd_primer_nivel_usuarios',$Oficios->getId_primer_nivel_user(),'in_respondida_oficios',"false");
			
			if($existe)
			{	
				$_SESSION['estatus_msj']=1;
				unset($_SESSION['ConsultarRespuesta']);
				$_SESSION['error_oficios']="Este N&uacute;mero de Oficio no se le ha asignado una Respuesta";
				$url_relativa = "siscor/vista/consultar_respuesta_oficios.php";	
				header("Cache-Control: no-cache");
				header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
				exit;					
			}//fin valida si el oficio ya fue respondido para poder modificarlo
			else
			{
				$_SESSION['ConsultarRespuesta']=1;	
			}
			}	
		}
	
	
	
	//fin de modulo de respuesta oficio valor de consul_oficio	
	$_SESSION['id_oficios']=$Oficios->getId();
	$_SESSION['anio_oficios']=$Oficios->getNuanioficio();
	$_SESSION['fecha_envio_oficios']=$Oficios->devuelve_fecha($Oficios->getFeenvio());
	$_SESSION['hora_oficios']=$Oficios->getHorahhentrada();
	$_SESSION['minuto_oficios']=$Oficios->getHorammentrada();
	$_SESSION['tiempo_oficios']=$Oficios->getHorattentrada();
	$_SESSION['num_remision']=$Oficios->getId_remitir();
	$_SESSION['destinatario_oficios']=$Oficios->getDestinatario();
	$_SESSION['alto_nivel_corres_seleccionado']=$Oficios->getAlto_nivel();
	$_SESSION['primer_nivel_corres_seleccionado']=$Oficios->getPrimer_nivel();
	$_SESSION['direcciones_corres_seleccionado']=$Oficios->getDirecciones();
	$_SESSION['asunto_oficios']=$Oficios->getAsunto();
	$_SESSION['num_correspondencia_remetir_oficios']=$Oficios->getId_remitir();
	$_SESSION['bloquear_remetir_oficios']=1;
	$Num_recibida=$Oficios->CargarDatosRespuestaOficio();
	$_SESSION['id_recibidas']=$Oficios->getId_recibidas();
	$_SESSION['anio_recibidas']=$Oficios->getNuanio_recibidas();	

	if ($Oficios->getNuanioremitir()!= '0' )
	{
		$_SESSION['anio_correspondencia_remetir_oficios']=$Oficios->getNuanioremitir();
	}
	else
	{
		$_SESSION['anio_correspondencia_remetir_oficios']="";	
	}
	$_SESSION['responsable_oficios']=$Oficios->getResponsable();
	$_SESSION['ame_respuesta']=$Oficios->getAmeritarespuesta();
	
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
		
		
		
		
		
	$tabla= "vista_mostrar_primer_nivel_corres";
	$orden="nb_primer_nivel_corres";
	$cont = $Oficios->MostrarValores(0,$tabla,$orden,$valor);
		//echo($cant); die;
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
		
//combo para llenar direcciones
if ($_SESSION['direcciones_corres_seleccionado']!="")
{
	$valor="cd_primer_nivel_corres=".$_SESSION['primer_nivel_corres_seleccionado'];
	
	$tabla= "vista_mostrar_direcciones_corres";
	$orden="nb_direcciones_corres";
	$cont = $Oficios->MostrarValores(0,$tabla,$orden,$valor);
	//echo($cant); die;
		if ( $cont != 0 ) 
		{
			//echo $alto_nivel->Mostrar(0); die();
			$_SESSION['cantidaddirecciones_corres'] = $cont;
			//echo $alto_nivel->Mostrar(0); die();
			//se crea un arreglo donde se alogen los registros necesarios
		    $campoId=array();
		    $campoNombre=array();
			$datos = $Oficios->MostrarValores(1,$tabla,$orden,$valor);
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
	$url_relativa = "../vista/registrar_oficios.php";
   	header("Cache-Control: no-cache");
	header("Location: ".$url_relativa);	
   	exit;	
	
	
}//fin de combo para llenar primer_nivel


$url_relativa = "siscor/vista/consultar_respuesta_oficios.php";
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