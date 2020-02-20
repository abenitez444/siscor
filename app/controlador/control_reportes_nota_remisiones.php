<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_remisiones.php"); 
include_once("../modelo/class_modulosxusuarios.php");


	$Remisiones = new Remisiones();
	$Modulosxusuarios = new Modulosxusuarios();
	$Remisiones->setId_usuario($_SESSION['codigo']);
	$Remisiones->setId_direcciones_user($_SESSION['direcciones_user']);
	$Remisiones->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$Remisiones->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
    $Remisiones->setId_unidades_user($_SESSION['unidades_user']);
	$Remisiones->setId_coordinaciones_user($_SESSION['coordinaciones_user']);	
   	$Modificar = isset($_GET['mod'])? $_GET['mod'] : "modificar";
   	$id = isset($_GET['id'])? $_GET['id'] : "id";
   	$anio = isset($_GET['a'])? $_GET['a'] : "modificar";

	$permiso =$Modulosxusuarios->Existe($Remisiones->getId_usuario(),'in_consultar',"TRUE",9);

if ($_SESSION['perfil']!=1 && $permiso==0)
{
	$_SESSION['estatus_msj']=1;
	$_SESSION['error_autorizacion']="Usted no esta autorizado para realizar esta acción";	
	$url_relativa = "siscor/vista/menu_principal.php";
	header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
	exit;
}
	
//******************************************************************************************consultar
if($_POST['consultar']==true){
$_SESSION['activo']=1;		
$valor= $_POST['tmp_valor'];
$Remisiones->setAnio_remision($_POST['ano_consulta']);
$Remisiones->setAlto_nivel($_POST['alto_nivel']);
$Remisiones->setPrimer_nivel($_POST['primer_nivel']);
$Remisiones->setDirecciones($_POST['direcciones']);
$Remisiones->setUnidad($_POST['unidades']);
$Remisiones->setCoordinaciones($_POST['coordinaciones']);

	switch($valor)
	{
		 case "num_remision": 
		 {
 			unset($_SESSION['respuesta']);	
			$_SESSION['respuesta']=0;		 	
 			unset($_SESSION['titulo']);
			unset($_SESSION['desde']);
			unset($_SESSION['hasta']);
 			$_SESSION['titulo']="Por Correlativo";
			$_SESSION['desde']=$_POST['num_remision_desde'];
			$_SESSION['hasta']=$_POST['num_remision_hasta'];
			if ($_SESSION['perfil']==2)
			{
				$Remisiones->setUnidad($_SESSION['unidades_user']);	
				$parametro="nu_ano_remisiones=".$Remisiones->getAnio_remision()." and cd_unidades = ".$Remisiones->getUnidad()." and cd_remisiones between  ".$_POST['num_remision_desde']." and ".$_POST['num_remision_hasta'];
			}
			else if ($_SESSION['perfil']==3)
			{
				$Remisiones->setUnidad($_SESSION['unidades_user']);	
				$Remisiones->setDirecciones($_SESSION['direcciones_user']);
				$Remisiones->setCoordinaciones($_SESSION['coordinaciones_user']);
				$parametro="nu_ano_remisiones=".$Remisiones->getAnio_remision()." and cd_unidades = ".$Remisiones->getUnidad()." and cd_direcciones= ".$Remisiones->getDirecciones()." and cd_coordinaciones= ".$Remisiones->getCoordinaciones()." and cd_remisiones between  ".$_POST['num_remision_desde']." and ".$_POST['num_remision_hasta'];
			}
		 	If ($parametro=="")
		 	{
		 		$parametro= "nu_ano_remisiones=".$Remisiones->getAnio_remision()." and cd_remisiones between  ".$_POST['num_remision_desde']." and ".$_POST['num_remision_hasta'];	
		 	}
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
				$_SESSION['error_remisiones_consulta']="La Fecha Hasta no puede ser menor a la Fecha Desde";	
				$url_relativa = "siscor/vista/reportes_nota_remisiones.php";
				header("Cache-Control: no-cache");
				header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
			}
			else
			{
			 if ($_SESSION['perfil']==2)
			{
				$Remisiones->setUnidad($_SESSION['unidades_user']);	
				$parametro="cd_unidades = ".$Remisiones->getUnidad();
				//die($parametro."aaa");
			}
			else if ($_SESSION['perfil']==3)
			{
				$Remisiones->setUnidad($_SESSION['unidades_user']);	
				$Remisiones->setDirecciones($_SESSION['direcciones_user']);
				$Remisiones->setCoordinaciones($_SESSION['coordinaciones_user']);
				$parametro="cd_unidades = ".$Remisiones->getUnidad()." and cd_direcciones= ".$Remisiones->getDirecciones()." and cd_coordinaciones= ".$Remisiones->getCoordinaciones();
			}
		 	If ($parametro=="")
		 	{
		 		$fecha_desde=$Remisiones->arregla_fecha($_POST['fecha_desde']);
				$fecha_hasta=$Remisiones->arregla_fecha($_POST['fecha_hasta']);
	    		$parametro= "fe_remisiones BETWEEN to_date('".$fecha_desde."','YYYY.MM.DD') and to_date('".$fecha_hasta."','YYYY.MM.DD')";	
		 	}
		 	else
		 	{
		 		$fecha_desde=$Remisiones->arregla_fecha($_POST['fecha_desde']);
				$fecha_hasta=$Remisiones->arregla_fecha($_POST['fecha_hasta']);
	    		$parametro= $parametro ." and fe_remisiones BETWEEN to_date('".$fecha_desde."','YYYY.MM.DD') and to_date('".$fecha_hasta."','YYYY.MM.DD')";
		 	}
				
			}
			break;
		 } 
	
	}//fin 
	
$_SESSION['respuesta']=1;
$_SESSION['sql']=$parametro;
//die($_SESSION['sql']."aaaaaaaaaaaaaaaaaaaaaaa");
	$tabla= "vista_mostrar_remisiones";
	$orden="fe_remisiones";		
	//die($parametro);
	$cont = $Remisiones->MostrarConsulta(0,$tabla,$parametro,$orden);
	//echo($cont); die;
	if ( $cont != 0 ) 
	{

		//echo $alto_nivel->Mostrar(0); die();
		$_SESSION['cantidadValor'] = $cont;
		$_SESSION['Remisiones_seleccionado']=1;

		//se crea un arreglo donde se alogen los registros necesarios
    	$campoId=array();
    	$campofecha=array();
    	$camporecibidas=array();
    	$campoprimer_nivel=array();
    	$campodirecciones=array();
    	$campounidad=array();
    	$campocoordinacion=array();
    	$campoprioridades=array();
    	$campoanioremision=array();
    	$campoaniorecibida=array();
    	$campoobservacion=array();
    	$campofecha_recibidas=array();
    	$campoacciones=array();
    	
    	$campodestinatario=array();
    	$campoprimer_nivel_destinatario=array();
    	$campodirecciones_destinatario=array();
    	$campounidades_destinatario=array();
    	
    	$camponbremitenteprimer=array();
    	$camponbcargoremitenteprimer=array();
    	$camponbremitentedirecciones=array();
    	$camponbcargoremitentedirecciones=array();
    	$campotx_asuntorecibida=array();
    	
		$datos = $Remisiones->MostrarConsulta(1,$tabla,$parametro,$orden);

		//Carga los registros
    		while ( $row=pg_fetch_array($datos) )
			{ 

		    	array_push( $campoId, $row['cd_remisiones'] );
		    	array_push( $campofecha , $row['fe_remisiones'] );
		    	array_push( $camporecibidas , $row['cd_recibidas'] );
		    	
		    	array_push( $campoprimer_nivel , $row['nb_primer_nivel'] );
		    	array_push( $campodirecciones , $row['nb_direcciones']);
		    	
		    	array_push( $campounidad , $row['nb_unidades'] );
		    	array_push( $campocoordinacion , $row['nb_coordinaciones']);
		    	array_push( $campoprioridades , $row['nb_prioridades']);
		    	array_push( $campoanioremision , $row['nu_ano_remisiones']);
		    	array_push( $campoaniorecibida , $row['nu_ano_recibidas']);
		    	array_push( $campoobservacion , $row['tx_observacion_remisiones']);	
		    	
		    	array_push( $campofecha_recibidas , $row['fe_entrada_recibidas']);
		    	array_push( $campoacciones , $row['nb_acciones']);
		    	
		    	array_push( $camponbremitenteprimer , $row['nb_remitente_primer_nivel']);
		    	array_push( $camponbcargoremitenteprimer , $row['nb_cargoremitente_primer_nivel']);
		    	array_push( $camponbremitentedirecciones , $row['nb_remitente_direcciones']);
		    	array_push( $camponbcargoremitentedirecciones , $row['nb_cargoremitente_direcciones']);		    			    	
		    	
		    	array_push( $campodestinatario , $row['nb_responsable_remisiones']);
		    	array_push( $campoprimer_nivel_destinatario , $row['nb_primer_nivel_destinatario'] );
		    	array_push( $campodirecciones_destinatario , $row['nb_direcciones_destinatario']);		    	
		    	array_push( $campounidades_destinatario , $row['nb_unidades_destinatario'] );
		    	
		    	array_push( $campotx_asuntorecibida , $row['tx_asunto_recibidas']);
		    	
		    	
			}
    	//Prepara para la comunicacion
        		$_SESSION['campoIdRemisiones'] = $campoId;
		    	$_SESSION['campoIdFecha'] =$campofecha;
		    	$_SESSION['campoIdRecibidas'] = $camporecibidas;
		    	
		    	$_SESSION['campoIdPrimer_nivel'] = $campoprimer_nivel;
		    	$_SESSION['campoIdDirecciones'] = $campodirecciones;
		    	
		    	$_SESSION['campoIdUnidad'] = $campounidad;
		    	$_SESSION['campoIdCoordinacion'] = $campocoordinacion;
		    	$_SESSION['campoIdPrioridades'] = $campoprioridades;
		    	$_SESSION['campoAnioRemision'] = $campoanioremision;
		    	$_SESSION['campoAnioRecibidas'] = $campoaniorecibida;
		    	$_SESSION['campoObservacion'] = $campoobservacion;	
		    	$_SESSION['campoFechaRecibidas']=$campofecha_recibidas;
		    	$_SESSION['campoAcciones']=$campoacciones;
		    	
		    	$_SESSION['campoNbremitente_primer_nivel']=$camponbremitenteprimer;
		    	$_SESSION['campoNb_cargoremitente_primer_nivel']=$camponbcargoremitenteprimer;		    	
		    	$_SESSION['campoNbremitente_direcciones']=$camponbremitentedirecciones;
		    	$_SESSION['campoNb_cargoremitnete_direcciones']=$camponbcargoremitentedirecciones;	

		    	$_SESSION['campoDestinatario']=$campodestinatario;
		    	$_SESSION['campoNb_primer_nivel_destinatario']=$campoprimer_nivel_destinatario;
		    	
		    	
		    	$_SESSION['campoNb_direcciones_destinatario']=$campodirecciones_destinatario;
		    	$_SESSION['campoNb_unidades_destinatario']=$campounidades_destinatario;    	

		    	
		    	$_SESSION['campoAsunto']=$campotx_asuntorecibida;	
		    	
			}
			else
			{
				
				$_SESSION['Remisiones_seleccionado']=0;
			}
	}//fin consultar


//llena combo de alto nivel
$tabla= "vista_mostrar_alto_nivel";
$orden="nb_alto_nivel";		
$sw=0;
$cont = $Remisiones->Mostrar(0,$tabla,$orden,$sw);
//echo($cant); die;
if ( $cont != 0 ) 
{
	//echo $alto_nivel->Mostrar(0); die();
	$_SESSION['cantidad_alto_nivel'] = $cont;
	//echo $alto_nivel->Mostrar(0); die();
	//se crea un arreglo donde se alogen los registros necesarios
    $campoId=array();
    $campoNombre=array();
	$datos = $Remisiones->Mostrar(1,$tabla,$orden,$sw);
	//Carga los registros
	    while ( $row=pg_fetch_array($datos) )
		{ 
			array_push( $campoId , $row["cd_alto_nivel"] );	
			array_push( $campoNombre , $row["nb_alto_nivel"] );				
		}
    //Prepara para la comunicacion
	$_SESSION['campoIdAltoNivel'] = $campoId;
    $_SESSION['campoNombreAltoNivel'] = $campoNombre;		
}//fin de llena combo de alto nivel



	$Remisiones->setId_direcciones_user($_SESSION['direcciones_user']);
	$Remisiones->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$Remisiones->setId_primer_nivel_user($_SESSION['primer_nivel_user']);


if ($Remisiones->getId_primer_nivel_user()!="")
{
if ($_SESSION['alto_nivel_user']==3){
	$valor="cd_alto_nivel=".$_SESSION['alto_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];	
}
else{
	$valor="cd_alto_nivel=".$_SESSION['alto_nivel_user'];
}
	$tabla= "vista_mostrar_primer_nivel";
	$orden="nb_primer_nivel";
	$cont = $Remisiones->MostrarValores(0,$tabla,$orden,$valor);
		//echo($cant); die;
		if ( $cont != 0 ) 
		{
			//echo $alto_nivel->Mostrar(0); die();
			$_SESSION['cantidad_primer_nivel'] = $cont;
			//echo $alto_nivel->Mostrar(0); die();
			//se crea un arreglo donde se alogen los registros necesarios
	    	$campoId=array();
	    	$campoNombre=array();
			$datos = $Remisiones->MostrarValores(1,$tabla,$orden,$valor);
			//Carga los registros
		    	while ($row=pg_fetch_array($datos))
				{ 
					array_push( $campoId , $row["cd_primer_nivel"] );	
					array_push( $campoNombre , $row["nb_primer_nivel"] );				
				}
    	//Prepara para la comunicacion
			$_SESSION['campoIdprimer_nivel'] = $campoId;
			$_SESSION['campoNombreprimer_nivel'] = $campoNombre;		
		}
}//fin de combo para llenar primer_nivel
		
//combo para llenar direcciones
if ($_SESSION['direcciones_user']!="")
{
	if ($_SESSION['direcciones_user']==0){
	$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user'];	
	}
	else 
	{
	$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];		
	}
	//die("$valor");
	$tabla= "vista_mostrar_direcciones";
	$orden="nb_direcciones";
	$cont = $Remisiones->MostrarValores(0,$tabla,$orden,$valor);
	//echo($cant); die;
		if ( $cont != 0 ) 
		{
			//echo $alto_nivel->Mostrar(0); die();
			$_SESSION['cantidaddirecciones'] = $cont;
			//echo $alto_nivel->Mostrar(0); die();
			//se crea un arreglo donde se alogen los registros necesarios
		    $campoId=array();
		    $campoNombre=array();
			$datos = $Remisiones->MostrarValores(1,$tabla,$orden,$valor);
			//Carga los registros
			    while ( $row=pg_fetch_array($datos) )
				{ 
					array_push( $campoId , $row["cd_direcciones"] );	
					array_push( $campoNombre , $row["nb_direcciones"] );				
				}
			    //Prepara para la comunicacion
			$_SESSION['campoIddirecciones'] = $campoId;
			$_SESSION['campoNombredirecciones'] = $campoNombre;		
		}
		
}

if ($_SESSION['unidades_user']!="")
{
	if ($_SESSION['unidades_user']==0){
	$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];	
	}
	else 
	{
	$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user']." and cd_unidades= ".$_SESSION['unidades_user'];		

	}
$tabla="vista_mostrar_unidades";
$orden="nb_unidades";
$cont = $Remisiones->MostrarValores(0,$tabla,$orden,$valor);
//echo($cant); die;
if ( $cont != 0 ) 
{
	//echo $alto_nivel->Mostrar(0); die();
	$_SESSION['cantidadUnidades'] = $cont;
	//echo $alto_nivel->Mostrar(0); die();
	//se crea un arreglo donde se alogen los registros necesarios
    $campoId=array();
    $campoNombre=array();
	$datos = $Remisiones->MostrarValores(1,$tabla,$orden,$valor);
	//Carga los registros
	    while ( $row=pg_fetch_array($datos) )
		{ 
			array_push( $campoId , $row["cd_unidades"] );	
			array_push( $campoNombre , $row["nb_unidades"] );				
		}
	    //Prepara para la comunicacion
	$_SESSION['campoIdUnidades'] = $campoId;
	$_SESSION['campoNombreUnidades'] = $campoNombre;		
}

}
if($_SESSION['perfil']!=1)

if ($_SESSION['coordinaciones_user']!="")
{
	if ($_SESSION['coordinaciones_user']==0){
	$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user']." and cd_unidades= ".$_SESSION['unidades_user'];	
	}
	else 
	{
	$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user']." and cd_unidades= ".$_SESSION['unidades_user']." and cd_coordinaciones=".$_SESSION['coordinaciones_user'];		
	}
$tabla="vista_mostrar_coordinaciones";
$orden="nb_coordinaciones";
$cont = $Remisiones->MostrarValores(0,$tabla,$orden,$valor);
//echo($cant); die;
if ( $cont != 0 ) 
{
	//echo $alto_nivel->Mostrar(0); die();
	$_SESSION['cantidadCoordinaciones'] = $cont;
	//echo $alto_nivel->Mostrar(0); die();
	//se crea un arreglo donde se alogen los registros necesarios
    $campoId=array();
    $campoNombre=array();
	$datos = $Remisiones->MostrarValores(1,$tabla,$orden,$valor);
	//Carga los registros
	    while ( $row=pg_fetch_array($datos) )
		{ 
			array_push( $campoId , $row["cd_coordinaciones"] );	
			array_push( $campoNombre , $row["nb_coordinaciones"] );				
		}
	    //Prepara para la comunicacion
	$_SESSION['campoIdCoordinaciones'] = $campoId;
	$_SESSION['campoNombreCoordinaciones'] = $campoNombre;		
}

}

$url_relativa = "siscor/vista/reportes_nota_remisiones.php";
header("Cache-Control: no-cache");
header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
?>