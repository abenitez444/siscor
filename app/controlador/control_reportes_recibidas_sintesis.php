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
	
   	$Modificar = isset($_GET['mod'])? $_GET['mod'] : "modificar";
   	$id = isset($_GET['id'])? $_GET['id'] : "id";
   	$anio = isset($_GET['a'])? $_GET['a'] : "modificar";
   	
   	$permiso =$Modulosxusuarios->Existe($Recibidas->getId_usuario(),'in_consultar',"TRUE",9);


if ($_SESSION['perfil']==1 && $permiso==1)
{
	
	

//consultar
if($_POST['consultar']==true){
$_SESSION['activo']=1;		
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
$Recibidas->setRespondida($_POST['respuesta']);

	switch($valor)
	{
		 case "num_correlativo": 
		 {
			unset($_SESSION['respuesta']);
			$_SESSION['respuesta']=0;		 	
 			unset($_SESSION['titulo']);
			unset($_SESSION['desde']);
			unset($_SESSION['hasta']);
 			$_SESSION['titulo']="Por Correlativo";
			$_SESSION['desde']=$_POST['num_correlativo_desde'];
			$_SESSION['hasta']=$_POST['num_correlativo_hasta'];
			$parametro= "nu_ano_recibidas=".$Recibidas->getNuano()." and cd_recibidas between  ".$_POST['num_correlativo_desde']." and ".$_POST['num_correlativo_hasta'];
		 	break;		
		 } 
		case "fecha":
		{
			unset($_SESSION['respuesta']);
			$_SESSION['respuesta']=0;			
			unset($_SESSION['titulo']);
			$_SESSION['titulo']="Por Fecha";
			unset($_SESSION['desde']);
			unset($_SESSION['hasta']);
			$_SESSION['desde']=$_POST['fecha_desde'];
			$_SESSION['hasta']=$_POST['fecha_hasta'];
			list($dia,$mes,$ano)=explode('-',$_POST['fecha_desde']);
			list($dia2,$mes2,$ano2)=explode('-',$_POST['fecha_hasta']);
			$fecha_desde2=mktime(0,0,0,$mes,$dia,$ano);
			$fecha_hasta2=mktime(0,0,0,$mes2,$dia2,$ano2);	
			if ($fecha_hasta2 < $fecha_desde2)
			{
				$_SESSION['estatus_msj']=1;
				$_SESSION['error_recibidas']="La Fecha Hasta no puede ser menor a la Fecha Desde";	
				$url_relativa = "siscor/vista/reportes_recibidas_sintesis.php";
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
		case "direccion":
		{
			unset($_SESSION['respuesta']);
			$_SESSION['respuesta']=0;
			unset($_SESSION['titulo']);
			unset($_SESSION['desde']);
			unset($_SESSION['hasta']);
			$_SESSION['desde']=$_POST['fecha_desde'];
			$_SESSION['hasta']=$_POST['fecha_hasta'];
			$_SESSION['titulo']="Por Fecha";
			$parametro="cd_alto_nivel_corres=".$Recibidas->getAlto_nivel()." and cd_primer_nivel_corres=".$Recibidas->getPrimer_nivel();
   			if( $_POST['direcciones']!=0)
   			{
   				$parametro=$parametro." and cd_direcciones_corres=".$Recibidas->getDirecciones();
   			}
		     break;
	 }
		case "documentos":
		 {
			unset($_SESSION['respuesta']);
			$_SESSION['respuesta']=0;		 	
			unset($_SESSION['titulo']);
			$_SESSION['titulo']="Por Fecha";
			unset($_SESSION['desde']);
			unset($_SESSION['hasta']);
			$_SESSION['desde']=$_POST['fecha_desde'];
			$_SESSION['hasta']=$_POST['fecha_hasta'];   
		 	list($dia,$mes,$ano)=explode('-',$_POST['fecha_desde']);
			list($dia2,$mes2,$ano2)=explode('-',$_POST['fecha_hasta']);
			$fecha_desde2=mktime(0,0,0,$mes,$dia,$ano);
			$fecha_hasta2=mktime(0,0,0,$mes2,$dia2,$ano2);	
			if ($fecha_hasta2 < $fecha_desde2)
			{
				$_SESSION['estatus_msj']=1;
				$_SESSION['error_recibidas']="La Fecha Hasta no puede ser menor a la Fecha Desde";	
				$url_relativa = "siscor/vista/reportes_recibidas_sintesis.php";
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
			case "respuesta":
		{
			unset($_SESSION['respuesta']);
			$_SESSION['respuesta']=1;
			unset($_SESSION['titulo']);
			unset($_SESSION['desde']);
			unset($_SESSION['hasta']);
			$_SESSION['desde']=$_POST['fecha_desde'];
			$_SESSION['hasta']=$_POST['fecha_hasta'];
			$_SESSION['titulo']="Por Fecha";
			if ($Recibidas->getRespondida()=="SI")
			{
				$Recibidas->setRespondida('true');
			}
			else
			{
				$Recibidas->setRespondida('false');
			}
			$fecha_desde=$Recibidas->arregla_fecha($_POST['fecha_desde']);
			$fecha_hasta=$Recibidas->arregla_fecha($_POST['fecha_hasta']);
			$parametro="in_respuesta_recibidas=".$Recibidas->getRespondida()." and fe_entrada_recibidas BETWEEN to_date('".$fecha_desde."','YYYY.MM.DD') and to_date('".$fecha_hasta."','YYYY.MM.DD')";
	     	break;
	 	}  
	}//fin 
//die($parametro);
	$_SESSION['sql']=$parametro;	
	$tabla= "vista_mostrar_recibidas";
	$orden="cd_recibidas";		
	$cont = $Recibidas->MostrarConsulta(0,$tabla,$parametro,$orden);
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
//echo($cant); die;
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
}//fin de llena combo de alto nivel


$url_relativa = "siscor/vista/reportes_recibidas_sintesis.php";
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