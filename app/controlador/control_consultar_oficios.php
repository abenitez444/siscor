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

	$intPermisoConsultar =$Modulosxusuarios->Existe($Oficios->getId_usuario(),'in_consultar',"TRUE",4);
	

	$intPermisoModificar =$Modulosxusuarios->Existe($Oficios->getId_usuario(),'in_modificar',"TRUE",4);
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

if ($Modificar == "1")
{

	$Oficios->setId($id);
	$Oficios->setNuanioficio($anio);	
	$Oficios->CargarDatos();
	
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
//	$_SESSION['disabled']="disabled";
	if ($Oficios->getNuanioremitir()!= '0' ){
	$_SESSION['anio_correspondencia_remetir_oficios']=$Oficios->getNuanioremitir();
	}
	else
	{
	$_SESSION['anio_correspondencia_remetir_oficios']="";	
	}
	$_SESSION['responsable_oficios']=$Oficios->getResponsable();
	$_SESSION['ame_respuesta']=$Oficios->getAmeritarespuesta();
	
	$_SESSION['modif']=1;
	
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
	$cont = $Oficios->MostrarValores(0,$tabla,$orden,$valor);
		//echo($cant); die;
		if ( $cont != 0 ) 
		{
			//echo $alto_nivel_corres->Mostrar(0); die();
			$_SESSION['cantidad_primer_nivel_corres'] = $cont;
			//echo $alto_nivel_corres->Mostrar(0); die();
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
}//fin de combo para llenar primer_nivel_corres
		
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
			//echo $alto_nivel_corres->Mostrar(0); die();
			$_SESSION['cantidaddirecciones_corres'] = $cont;
			//echo $alto_nivel_corres->Mostrar(0); die();
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
	
}	
		

//consultar
if($_POST['consultar']==true){
$_SESSION['activo']=1;		
$valor= $_POST['tmp_valor'];
$Oficios->setNuanioficio($_POST['ano_consulta']);
$Oficios->setId($_POST['num_correlativo']);
$Oficios->setId_remitir($_POST['num_remision']);
$Oficios->setDestinatario($_POST['destinatario']);
$Oficios->setAlto_nivel($_POST['alto_nivel']);
$Oficios->setPrimer_nivel($_POST['primer_nivel']);
$Oficios->setDirecciones($_POST['direcciones']);
switch($valor)
	{
		 case "num_correlativo": 
		 {
		
			$parametro= "nu_ano_oficios=".$Oficios->getNuanioficio()." and cd_oficios=".$Oficios->getId() ;
		 	break;		
		 } 
		 case "num_remision": 
		 {
			$parametro= "nu_ano_remitir=".$Oficios->getNuanioficio()." and cd_remitir='".$Oficios->getId_remitir()."'" ;
		     break;
		} 
		case "fecha":
		{

			list($dia,$mes,$ano)=explode('-',$_POST['fecha_desde']);
			list($dia2,$mes2,$ano2)=explode('-',$_POST['fecha_hasta']);
			$fecha_desde2=mktime(0,0,0,$mes,$dia,$ano);
			$fecha_hasta2=mktime(0,0,0,$mes2,$dia2,$ano2);	
			if ($fecha_hasta2 < $fecha_desde2)
			{
				$_SESSION['estatus_msj']=1;
				$_SESSION['error_oficios']="La Fecha Hasta no puede ser menor a la Fecha Desde";	
				$url_relativa = "siscor/vista/consultar_oficios.php";
				header("Cache-Control: no-cache");
				header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
			}
			else
			{
				$fecha_desde=$Oficios->arregla_fecha($_POST['fecha_desde']);
				$fecha_hasta=$Oficios->arregla_fecha($_POST['fecha_hasta']);
	    		$parametro= "fe_envio_oficios BETWEEN to_date('".$fecha_desde."','YYYY.MM.DD') and to_date('".$fecha_hasta."','YYYY.MM.DD')";
			}
			break;
		 } 
		case "destinatarios":
		{
			$parametro= "nb_destinatario_oficios LIKE '%".$Oficios->getDestinatario()."%'";
		    break;
		 }		
		case "direccion":
		{
			$parametro="cd_alto_nivel_corres=".$Oficios->getAlto_nivel()." and cd_primer_nivel_corres=".$Oficios->getPrimer_nivel();
   			if( $_POST['direcciones']!=0)
   			{
   				$parametro=$parametro." and cd_direcciones_corres=".$Oficios->getDirecciones();
   			}
		     break;
	 }
	}//fin 

	$tabla= "vista_mostrar_oficios";
	$orden="fe_envio_oficios";		
	$cont = $Oficios->MostrarConsulta(0,$tabla,$parametro,$orden);
	//echo($cant); die;
	if ( $cont != 0 ) 
	{
		//echo $alto_nivel->Mostrar(0); die();
		$_SESSION['cantidadValor'] = $cont;
		//echo $alto_nivel->Mostrar(0); die();
		//se crea un arreglo donde se alogen los registros necesarios
    	$campoId=array();
    	$campofecha=array();
    	$campoalto_nivel=array();
    	$campoprimer_nivel=array();
    	$campodirecciones=array();
    	$campoasunto=array();
    	$campoano=array();
		$datos = $Oficios->MostrarConsulta(1,$tabla,$parametro,$orden);
		//Carga los registros
    		while ( $row=pg_fetch_array($datos) )
			{ 
				array_push( $campoId , $row["cd_oficios"] );	
				array_push( $campofecha , $row["fe_envio_oficios"] );
				array_push( $campoalto_nivel , $row["nb_alto_nivel_corres"] );	
				array_push( $campoprimer_nivel , $row["nb_primer_nivel_corres"] );
				array_push( $campodirecciones , $row["nb_direcciones_corres"] );	
				array_push( $campoasunto , $row["txt_asunto_oficios"] );
				array_push( $campoano , $row["nu_ano_oficios"] );
			}
    	//Prepara para la comunicacion
		$_SESSION['campoIdOficios'] = $campoId;
    	$_SESSION['campoFecha'] = $campofecha;
    	$_SESSION['oficios_seleccionado']=1;
    	$_SESSION['cd_alto_nivel_corres']=$campoalto_nivel;
    	$_SESSION['cd_primer_nivel_corres']=$campoprimer_nivel;
    	$_SESSION['cd_direcciones_corres']=$campodirecciones;
    	$_SESSION['tx_asunto']=$campoasunto;
    	$_SESSION['anio']=$campoano;
   		
	}
	else
	{
		$_SESSION['oficios_seleccionado']=0;
	}
}//fin consultar





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



$url_relativa = "siscor/vista/consultar_oficios.php";
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