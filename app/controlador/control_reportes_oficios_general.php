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
	
   	$Modificar = isset($_GET['mod'])? $_GET['mod'] : "modificar";
   	$id = isset($_GET['id'])? $_GET['id'] : "id";
   	$anio = isset($_GET['a'])? $_GET['a'] : "modificar";
   	
   	$permiso =$Modulosxusuarios->Existe($Oficios->getId_usuario(),'in_consultar',"TRUE",9);

if ($_SESSION['perfil']==1 && $permiso==1)
{
	

//consultar
if($_POST['consultar']==true){

$_SESSION['activo']=1;		
$valor= $_POST['tmp_valor'];
$Oficios->setNuanioficio($_POST['ano_consulta']);
$Oficios->setAlto_nivel($_POST['alto_nivel']);
if ($Oficios->getAlto_nivel()=="")
{
	$Oficios->setAlto_nivel($_SESSION['alto_nivel_user']);
}
$Oficios->setPrimer_nivel($_POST['primer_nivel']);
$Oficios->setDirecciones($_POST['direcciones']);



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
			$parametro= "nu_ano_oficios=".$Oficios->getNuanioficio()." and cd_oficios between  ".$_POST['num_correlativo_desde']." and ".$_POST['num_correlativo_hasta'];
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
				$_SESSION['error_oficios']="La Fecha Hasta no puede ser menor a la Fecha Desde";	
				$url_relativa = "siscor/vista/reportes_oficios_general.php";
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
			list($dia,$mes,$ano)=explode('-',$_POST['fecha_desde']);
			list($dia2,$mes2,$ano2)=explode('-',$_POST['fecha_hasta']);
			$fecha_desde2=mktime(0,0,0,$mes,$dia,$ano);
			$fecha_hasta2=mktime(0,0,0,$mes2,$dia2,$ano2);	
			if ($fecha_hasta2 < $fecha_desde2)
			{
				$_SESSION['estatus_msj']=1;
				$_SESSION['error_oficios']="La Fecha Hasta no puede ser menor a la Fecha Desde";	
				$url_relativa = "siscor/vista/reportes_oficios_general.php";
				header("Cache-Control: no-cache");
				header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
			}
			else
			{
				$fecha_desde=$Oficios->arregla_fecha($_POST['fecha_desde']);
				$fecha_hasta=$Oficios->arregla_fecha($_POST['fecha_hasta']);			
			
			$parametro="cd_alto_nivel_corres=".$Oficios->getAlto_nivel()." and cd_primer_nivel_corres=".$Oficios->getPrimer_nivel()." and fe_envio_oficios BETWEEN to_date('".$fecha_desde."','YYYY.MM.DD') and to_date('".$fecha_hasta."','YYYY.MM.DD')";
			}
			if( $_POST['direcciones']!=0)
   			{
   				$parametro=$parametro." and cd_direcciones_corres=".$Oficios->getDirecciones();
   			}
		     break;
	 }
	}
	
	$_SESSION['sql']=$parametro;	
	$tabla= "vista_mostrar_oficios";
	$orden="cd_oficios";		
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
		$_SESSION['Oficios_seleccionado']=0;
	}
	
}//fin consultar


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

$url_relativa = "siscor/vista/reportes_oficios_general.php";
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