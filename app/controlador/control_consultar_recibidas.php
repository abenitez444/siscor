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

	$intPermisoConsultar =$Modulosxusuarios->Existe($Recibidas->getId_usuario(),'in_consultar',"TRUE",2);
	
	$intPermisoModificar =$Modulosxusuarios->Existe($Recibidas->getId_usuario(),'in_modificar',"TRUE",2);
		if($intPermisoModificar==1)
		{
			$_SESSION['modificar']=1;
		}
		else
		{
			$_SESSION['modificar']=0;
		}
	
    $archivador =$Modulosxusuarios->Existe($Recibidas->getId_usuario(),'in_ingresar',"TRUE",8);
	
	if($archivador==1)
	{
		$_SESSION['$archivador_in']=1;
	}
	else
	{
		$_SESSION['$archivador_in']=0;
	}
	
	$archivador =$Modulosxusuarios->Existe($Recibidas->getId_usuario(),'in_modificar',"TRUE",8);
	
	if($archivador==1)
	{
		$_SESSION['$archivador_mo']=1;
	}
	else
	{
		$_SESSION['$archivador_mo']=0;
	}	
	
	
if ($_SESSION['perfil']==1 && $intPermisoConsultar==1 || $intPermisoModificar==1)
{
	
	$Modificar = isset($_GET['mod'])? $_GET['mod'] : "modificar";
   	$id = isset($_GET['id'])? $_GET['id'] : "id";
   	$anio = isset($_GET['a'])? $_GET['a'] : "modificar";
   	
if ($Modificar == "1")
{

	$Recibidas->setId($id);
	$Recibidas->setNuano($anio);	
	$Recibidas->CargarDatos();
	
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
	
	$_SESSION['id_recibidas']=$Recibidas->getId();
	$_SESSION['anio_recibidas']=$Recibidas->getNuano();
	$_SESSION['fecha_entrada_recibidas']=$Recibidas->getFeentrada();
	$_SESSION['fecha_entrada_recibidas']=$Recibidas->devuelve_fecha($Recibidas->getFeentrada());
	$_SESSION['fecha_carta_recibidas']=$Recibidas->devuelve_fecha($Recibidas->getFecarta());
	$_SESSION['hora_recibidas']=$Recibidas->getHorahhentrada();
	$_SESSION['minuto_recibidas']=$Recibidas->getHorammentrada();
	$_SESSION['tiempo_recibidas']=$Recibidas->getHorattentrada();
	$_SESSION['num_externo_recibidas']=$Recibidas->getNuexterno();
	$_SESSION['remitente_recibidas']=$Recibidas->getRemitente();
	$_SESSION['cedula_recibidas']=$Recibidas->getCedremitente();
	$_SESSION['alto_nivel_corres_seleccionado']=$Recibidas->getAlto_nivel();

//die($_SESSION['alto_nivel_corres_seleccionado']."Prueba del servidor");

	$_SESSION['primer_nivel_corres_seleccionado']=$Recibidas->getPrimer_nivel();
	$_SESSION['direcciones_corres_seleccionado']=$Recibidas->getDirecciones();
	$_SESSION['clasificacion_documentos_seleccionado']=$Recibidas->getClasificacion_documento();
	$_SESSION['asunto_recibidas']=$Recibidas->getAsunto();
	$_SESSION['ubicacion_recibidas']=$Recibidas->getUbicacion();
	$_SESSION['ame_respuesta']=$Recibidas->getAmerita_respuesta();
	$_SESSION['scanner']=$Recibidas->getDocumento();
	$_SESSION['modif']=1;


	
//llena combo de alto nivel
$tabla= "vista_mostrar_alto_nivel_corres";
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
	
	$valor="cd_primer_nivel_corres=".$_SESSION['primer_nivel_corres_seleccionado'];
	//die($valor);
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
	header("Cache-Control: no-cache");
	$url_relativa = "../vista/registrar_recibidas.php";
   	header("Location: ".$url_relativa);	
   	exit;
	
}	
		

//consultar
if ($_POST['consultar']==true)
{
$_SESSION['activo']=1;	
//die($_SESSION['activo']." valor");	
$valor= $_POST['tmp_valor'];
$Recibidas->setNuano($_POST['ano_consulta']);
$Recibidas->setId($_POST['num_correlativo']);
$Recibidas->setNuexterno($_POST['num_externo']);
$Recibidas->setRemitente($_POST['remitente']);
$Recibidas->setCedremitente($_POST['ced_remitente']);
$Recibidas->setAlto_nivel($_POST['alto_nivel']);
$Recibidas->setPrimer_nivel($_POST['primer_nivel']);
$Recibidas->setDirecciones($_POST['direcciones']);
$Recibidas->setClasificacion_documento($_POST['clasificacion_documentos']);

	switch($valor)
	{
		 case "num_correlativo": 
		 {
			$parametro= "nu_ano_recibidas=".$Recibidas->getNuano()." and cd_recibidas=".$Recibidas->getId() ;
		 	break;		
		 } 
		 case "num_externo": 
		 {
			$parametro= "nu_ano_recibidas=".$Recibidas->getNuano()." and nu_externo_recibidas='".$Recibidas->getNuexterno()."'" ;
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
				$_SESSION['error_recibidas']="La Fecha Hasta no puede ser menor a la Fecha Desde";	
				$url_relativa = "siscor/vista/consultar_recibidas.php";
				header("Cache-Control: no-cache");
				header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
			}
			else
			{
				$fecha_desde=$Recibidas->arregla_fecha($_POST['fecha_desde']);
				$fecha_hasta=$Recibidas->arregla_fecha($_POST['fecha_hasta']);
	    		$parametro= "fe_entrada_recibidas BETWEEN to_date('".$fecha_desde."','YYYY.MM.DD') and to_date('".$fecha_hasta."','YYYY.MM.DD')";
			}
			break;
		 } 
		case "remitente":
		{
			$parametro= "nb_remitente_recibidas LIKE '%".$Recibidas->getRemitente()."%'";
		    break;
		 }		
		case "cedula":
		{
			$parametro= "ds_cedula_remitente_recibidas='".$Recibidas->getCedremitente()."'";
		    break;
		}
		case "direccion":
		{
			$parametro="cd_alto_nivel_corres=".$Recibidas->getAlto_nivel()." and cd_primer_nivel_corres=".$Recibidas->getPrimer_nivel();
   			if( $_POST['direcciones']!=0)
   			{
   				$parametro=$parametro." and cd_direcciones_corres=".$Recibidas->getDirecciones();
   			}
		     break;
	 }
		case "documentos":
		 {
/*		$parametro="cd_clasificacion_documentos=".$Recibidas->getClasificacion_documento();
		     break;*/
		     
		 	list($dia,$mes,$ano)=explode('-',$_POST['fecha_desde']);
			list($dia2,$mes2,$ano2)=explode('-',$_POST['fecha_hasta']);
			$fecha_desde2=mktime(0,0,0,$mes,$dia,$ano);
			$fecha_hasta2=mktime(0,0,0,$mes2,$dia2,$ano2);	
			if ($fecha_hasta2 < $fecha_desde2)
			{
				$_SESSION['estatus_msj']=1;
				$_SESSION['error_recibidas']="La Fecha Hasta no puede ser menor a la Fecha Desde";	
				$url_relativa = "siscor/vista/consultar_recibidas.php";
				header("Cache-Control: no-cache");
				header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
			}
			else
			{
				$fecha_desde=$Recibidas->arregla_fecha($_POST['fecha_desde']);
				$fecha_hasta=$Recibidas->arregla_fecha($_POST['fecha_hasta']);
	    		$parametro= "cd_clasificacion_documentos=".$Recibidas->getClasificacion_documento()." and fe_entrada_recibidas BETWEEN to_date('".$fecha_desde."','YYYY.MM.DD') and to_date('".$fecha_hasta."','YYYY.MM.DD')";
			}
			break;        
		     
		 } 
	}//fin 
	//die($parametro);
	$tabla= "vista_mostrar_recibidas";
	$orden="fe_entrada_recibidas, cd_recibidas";		
	$cont = $Recibidas->MostrarConsulta(0,$tabla,$parametro,$orden);
	//echo($cont); die;
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
		$datos = $Recibidas->MostrarConsulta(1,$tabla,$parametro,$orden);
		//Carga los registros
    		while ( $row=pg_fetch_array($datos) )
			{ 
				array_push( $campoId , $row["cd_recibidas"] );	
				array_push( $campofecha , $row["fe_entrada_recibidas"] );
				array_push( $campoalto_nivel , $row["nb_alto_nivel_corres"] );	
				array_push( $campoprimer_nivel , $row["nb_primer_nivel_corres"] );
				array_push( $campodirecciones , $row["nb_direcciones_corres"] );	
				array_push( $campoasunto , $row["tx_asunto_recibidas"] );
				array_push( $campoano , $row["nu_ano_recibidas"] );
			}
			
    	//Prepara para la comunicacion
		$_SESSION['campoIdRecibidas'] = $campoId;
    	$_SESSION['campoFecha'] = $campofecha;
    	$_SESSION['Recibidas_seleccionado']=1;
    	$_SESSION['cd_alto_nivel_corres']=$campoalto_nivel;
    	$_SESSION['cd_primer_nivel_corres']=$campoprimer_nivel;
    	$_SESSION['cd_direcciones_corres']=$campodirecciones;
    	$_SESSION['tx_asunto']=$campoasunto;
    	$_SESSION['anio']=$campoano;
   	//die("año");
	}
	else
	{
		$_SESSION['Recibidas_seleccionado']=0;
	}
}//fin consultar


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
$tabla= "vista_mostrar_alto_nivel_corres";
$orden="nb_alto_nivel_corres";		
$sw=0;
$cont = $Recibidas->Mostrar(0,$tabla,$orden,$sw);
//echo($cont); die;
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
   // die('sssss'.$_SESSION['activo']);
   	
}//fin de llena combo de alto nivel
header("Cache-Control: no-cache");
$url_relativa = "siscor/vista/consultar_recibidas.php";
header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	

}
else
{
$_SESSION['estatus_msj']=1;
$_SESSION['error_autorizacion']="Usted no esta autorizado para realizar esta acción";	
header("Cache-Control: no-cache");
$url_relativa = "siscor/vista/menu_principal.php";
header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
}
?>
