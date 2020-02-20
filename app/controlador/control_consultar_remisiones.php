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


   	$intPermisoConsultar =$Modulosxusuarios->Existe($Remisiones->getId_usuario(),'in_consultar',"TRUE",6);
	

	$intPermisoModificar =$Modulosxusuarios->Existe($Remisiones->getId_usuario(),'in_modificar',"TRUE",6);

	if($intPermisoModificar==1)
		{
			$_SESSION['modificar']=1;
		}
		else
		{
			$_SESSION['modificar']=0;
		}
   	//die($_SESSION['perfil']." a ". $intPermisoConsultar." b ". $intPermisoModificar);
if ($_SESSION['perfil']==1 && $intPermisoConsultar==0 && $intPermisoModificar==0 )
{   	

	$_SESSION['estatus_msj']=1;
	$_SESSION['error_autorizacion']="Usted no esta autorizado para realizar esta acción";	
	$url_relativa = "siscor/vista/menu_principal.php";
	header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
	exit;
}	
   	
   	
   	$id = isset($_GET['id'])? $_GET['id'] : "id";
   	$anio = isset($_GET['a'])? $_GET['a'] : "modificar";
   	
   	
//**********************************************************************************************************Modificar
if ($Modificar == "1")
{

    $Remisiones->setId($id);
    $Remisiones->setAnio_remision($anio);	

    $Remisiones->CargarDatos();

    $_SESSION['id_remisiones']=$Remisiones->getId();
    $_SESSION['anio_remisiones']=$Remisiones->getAnio_remision();
//	$_SESSION['anio_remitir_remision']=$Remisiones->getFeremision();

    $_SESSION['fecha_remision_carga']=$Remisiones->devuelve_fecha($Remisiones->getFeremision());
//	die($_SESSION['fecha_remision_carga']);

    /*$_SESSION['alto_nivel_user']=$Remisiones->getId_alto_nivel_user();
    $_SESSION['primer_nivel_user']=$Remisiones->getPrimer_nivel();
    $_SESSION['direcciones_user']=$Remisiones->getDirecciones();*/
    /********************************************CAMBIOS D EPRUEBA CON REMISION DESPACHO*/

    $_SESSION['alto_nivel_seleccionado_remision']=$Remisiones->getAlto_nivel();
    $_SESSION['primer_nivel_seleccionado_remision']=$Remisiones->getPrimer_nivel();
    $_SESSION['direcciones_seleccionado_remision']=$Remisiones->getDirecciones();
    
    /*$_SESSION['alto_nivel_corres_seleccionado']=$Remisiones->getAlto_nivel();
    $_SESSION['primer_nivel_corres_seleccionado']=$Remisiones->getPrimer_nivel();
    $_SESSION['direcciones_corres_seleccionado']=$Remisiones->getDirecciones();*/    
//die($_SESSION['primer_nivel_seleccionado_remision']." --");


    $_SESSION['Unidades_seleccionado_remision']=$Remisiones->getUnidad();
    $_SESSION['Coordinaciones_seleccionado_remision']=$Remisiones->getCoordinaciones();
    $_SESSION['nombre_responsable_remision']=$Remisiones->getResponsable();
    $_SESSION['prioridades_seleccionado_remision']=$Remisiones->getPrioridad();

    $_SESSION['accion_seleccionado_remision']=$Remisiones->getAcciones();
    $_SESSION['check_amerita_respuesta_remision']=$Remisiones->getAmerita_remisiones();	
    //die($_SESSION['check_amerita_respuesta_remision']);
    $_SESSION['observacion_remision']=$Remisiones->getObservaciones();
    //die($_SESSION['observacion_remision']."a ver");
    $_SESSION['check_r']=$Remisiones->getCheck_respondida_remision();
    //die($_SESSION['check_r']);
    $_SESSION['respondida_observacion_remision']=$Remisiones->getRespondida_remision();
    $_SESSION['id_remitir_remision']=$Remisiones->getId_recibidas();
    $_SESSION['anio_remitir_remision']=$Remisiones->getAnio_recibidas();
    $_SESSION['hora_remision']=$Remisiones->getHora();
    $_SESSION['minuto_remision']=$Remisiones->getMinuto();
    $_SESSION['tiempo_remision']=$Remisiones->getTiempo();
    $_SESSION['fe_paralafirma']=$Remisiones->devuelve_fecha($Remisiones->getFecha_paralafirma());
    $_SESSION['fe_firmada']=$Remisiones->devuelve_fecha($Remisiones->getFecha_firmado());
    $_SESSION['fe_despachada']=$Remisiones->devuelve_fecha($Remisiones->getFecha_despachado());	
    $_SESSION['nb_recibidapor']=$Remisiones->getNombre_recibidapor();
    $_SESSION['fecha_recibidapor_remisiones']=$Remisiones->devuelve_fecha($Remisiones->getFecha_recibidapor());
    $_SESSION['hh_recibidapor']=$Remisiones->getHora_recibidapor();
    $_SESSION['mm_recibidapor']=$Remisiones->getMinuto_recibidapor();
    $_SESSION['tt_recibidapor']=$Remisiones->getTiempo_recibidapor();

    $_SESSION['modif']=1;
	
    $tabla="vista_mostrar_prioridades";
    $orden="nb_prioridades";
    $sw=1;
    $cont = $Remisiones->Mostrar(0,$tabla,$orden,$sw);
    //echo($cant); die;
    if ( $cont != 0 ) 
    {
	$_SESSION['cantidad'] = $cont;
	//se crea un arreglo donde se alogen los registros necesarios
   	$campoId=array();
   	$campoNombre=array();
	$datos = $Remisiones->Mostrar(1,$tabla,$orden,$sw);
	//Carga los registros
	   	while ( $row=pg_fetch_array($datos) )
		{ 
			array_push( $campoId , $row["cd_prioridades"] );	
			array_push( $campoNombre , $row["nb_prioridades"] );				
		}
    	//Prepara para la comunicacion
		$_SESSION['campoIdPrioridades'] = $campoId;
    	$_SESSION['campoNombrePrioridades'] = $campoNombre;
    }


    //carga el combo de acciones
    $tabla="vista_mostrar_acciones";
    $orden="nb_acciones";
    $sw=1;
    $cont = $Remisiones->Mostrar(0,$tabla,$orden,$sw);
    //echo($cant); die;
    if ( $cont != 0 ) 
    {
        //echo $General->Mostrar(0); die();
        $_SESSION['cantidad_acciones'] = $cont;
        //echo $General->Mostrar(0); die();
        //se crea un arreglo donde se alogen los registros necesarios
        $campoId=array();
        $campoNombre=array();
        $datos = $Remisiones->Mostrar(1,$tabla,$orden,$sw);
        //Carga los registros
                while ( $row=pg_fetch_array($datos) )
                { 
                        array_push( $campoId , $row["cd_acciones"] );	
                        array_push( $campoNombre , $row["nb_acciones"] );				
                }
        //Prepara para la comunicacion
                $_SESSION['campoIdAcciones'] = $campoId;
        $_SESSION['campoNombreAcciones'] = $campoNombre;
    }//fin de acciones

    //llena combo de alto nivel
    $tabla= "vista_mostrar_alto_nivel";
    $orden="nb_alto_nivel";		

    if ($_SESSION['primer_nivel_user']==329)
    {
        $sw=2;//$sw=3;
    }
    else
    {
        $sw=0;
    }  

    $cont = $Remisiones->Mostrar(0,$tabla,$orden,$sw);
   
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
        if ($_SESSION['alto_nivel_seleccionado_remision']==3)
        {
            //$valor="cd_alto_nivel=".$_SESSION['alto_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];
            //$valor="cd_alto_nivel=".$_SESSION['alto_nivel_user']." and cd_primer_nivel=".$_SESSION['primer_nivel_user']." or cd_primer_nivel_aux=".$_SESSION['primer_nivel_user'];	
            $valor="cd_alto_nivel_corres=".$_SESSION['alto_nivel_seleccionado_remision']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];	
            $tabla= "vista_mostrar_primer_nivel_corres";	
            $orden="nb_primer_nivel_corres";
        }
        else
        {
            if ($_SESSION['primer_nivel_user']==329)
            {//die($_SESSION['alto_nivel_seleccionado_remision']." --");
                if($_SESSION['alto_nivel_seleccionado_remision']==2)
                {
                    $valor="cd_alto_nivel=2 and cd_primer_nivel < 144";
                }
                else
                {
                    $valor="cd_alto_nivel=".$_SESSION['alto_nivel_seleccionado_remision'];	
                }    
            }
            else
            {
                $valor="cd_alto_nivel=".$_SESSION['alto_nivel_seleccionado_remision'];	
            }
        $tabla= "vista_mostrar_primer_nivel";    
        $orden="nb_primer_nivel";
        }
	//die($valor." --");
	$cont = $Remisiones->MostrarValores(0,$tabla,$orden,$valor);
        //die(" primer");        
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
                if ($_SESSION['alto_nivel_seleccionado_remision']==3)
                {        
                    array_push( $campoId , $row["cd_primer_nivel_corres"] );	
                    array_push( $campoNombre , $row["nb_primer_nivel_corres"] );
                }
                else
                {
                    array_push( $campoId , $row["cd_primer_nivel"] );	
                    array_push( $campoNombre , $row["nb_primer_nivel"] );                            
                }     
            }
            //Prepara para la comunicacion
            $_SESSION['campoIdprimer_nivel'] = $campoId;
            $_SESSION['campoNombreprimer_nivel'] = $campoNombre;			
        }    
        
    }//fin de combo para llenar primer_nivel	
//combo para llenar direcciones
    if ($_SESSION['direcciones_seleccionado_remision']!="")
    {
        if ($_SESSION['alto_nivel_seleccionado_remision']==3)
        {
            $valor="cd_primer_nivel_corres=".$_SESSION['primer_nivel_seleccionado_remision'];
            $tabla= "vista_mostrar_direcciones_corres";
            $orden="nb_direcciones_corres";
        }
        else
        {
            $valor="cd_primer_nivel=".$_SESSION['primer_nivel_seleccionado_remision'];
            $tabla= "vista_mostrar_direcciones";
            $orden="nb_direcciones";
        }
        
        $cont = $Remisiones->MostrarValores(0,$tabla,$orden,$valor);
        //die();
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
                if ($_SESSION['alto_nivel_seleccionado_remision']==3)
                {
                    array_push( $campoId , $row["cd_direcciones_corres"] );	
                    array_push( $campoNombre , $row["nb_direcciones_corres"] );				                    
                }
                else
                {
                    array_push( $campoId , $row["cd_direcciones"] );	
                    array_push( $campoNombre , $row["nb_direcciones"] );				                    
                }    

            }
            //Prepara para la comunicacion
            $_SESSION['campoIddirecciones'] = $campoId;
            $_SESSION['campoNombredirecciones'] = $campoNombre;		
        }
    }
//die("paso");

    if ($_SESSION['direcciones_user']!=0)
    {

        $tabla="vista_mostrar_unidades";
        $orden="nb_unidades";
        $where="where cd_direcciones=".$_SESSION['direcciones_user']."";
        $cont = $Remisiones->MostrarUnidades(0,$tabla,$orden,$where);
        //echo($cant); die;
        if ( $cont != 0 ) 
        {
            //echo $General->Mostrar(0); die();
            $_SESSION['cantidadUnidades'] = $cont;
            //se crea un arreglo donde se alogen los registros necesarios
            $campoId=array();
            $campoNombre=array();
            $datos = $Remisiones->MostrarUnidades(1,$tabla,$orden,$where);
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

if ($_SESSION['Unidades_seleccionado_remision']!=0)
{
$tabla="vista_mostrar_coordinaciones";
$orden="nb_coordinaciones";
$where="where cd_unidades=".$_SESSION['Unidades_seleccionado_remision']."";
$cont = $Remisiones->MostrarUnidades(0,$tabla,$orden,$where);
//echo($cant); die;
if ( $cont != 0 ) 
{
	//echo $General->Mostrar(0); die();
	$_SESSION['cantidadCoordinaciones'] = $cont;
	//echo $General->Mostrar(0); die();
	//se crea un arreglo donde se alogen los registros necesarios
   	$campoId=array();
   	$campoNombre=array();
	$datos = $Remisiones->MostrarUnidades(1,$tabla,$orden,$where);
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
$url_relativa = "siscor/vista/registrar_remisiones.php";
header("Cache-Control: no-cache");
header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
exit;
}
		

//******************************************************************************************consultar
if($_POST['consultar']==true){
	
$_SESSION['activo']=1;		
$valor= $_POST['tmp_valor'];
$Remisiones->setAnio_remision($_POST['ano_consulta']);
$Remisiones->setAnio_recibidas($_POST['ano_consulta']);
$Remisiones->setId($_POST['num_remision']);
$Remisiones->setId_recibidas($_POST['num_remitida']);
$Remisiones->setAlto_nivel($_POST['alto_nivel']);
$Remisiones->setPrimer_nivel($_POST['primer_nivel']);
$Remisiones->setDirecciones($_POST['direcciones']);
$Remisiones->setUnidad($_POST['unidades']);
$Remisiones->setCoordinaciones($_POST['coordinaciones']);

	switch($valor)
	{
		case "num_remision": 
		{ 
			if ($_SESSION['perfil']==2)
			{
				$Remisiones->setUnidad($_SESSION['unidades_user']);	
				$parametro="cd_unidades = ".$Remisiones->getUnidad();
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
		 		$parametro= "nu_ano_remisiones=".$Remisiones->getAnio_remision()." and cd_remisiones=".$Remisiones->getId() ;	
		 	}
		 	else
		 	{
		 		$parametro= $parametro ." and nu_ano_remisiones=".$Remisiones->getAnio_remision()." and cd_remisiones=".$Remisiones->getId() ;
		 	}
	
		break;		
		} 
		case "num_remitida": 
		{

		 	if ($_SESSION['perfil']==2)
		 	{
		 		$Remisiones->setUnidad($_SESSION['unidades_user']);	
				$parametro="cd_unidades = ".$Remisiones->getUnidad();
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
		 		$parametro= "nu_ano_recibidas=".$Remisiones->getAnio_recibidas()." and cd_recibidas='".$Remisiones->getId_recibidas()."'" ;	
		 	}
		 	else
		 	{
		 		$parametro= $parametro ." and nu_ano_recibidas=".$Remisiones->getAnio_recibidas()." and cd_recibidas='".$Remisiones->getId_recibidas()."'" ;
		 	}
	
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
				$_SESSION['error_remisiones_consulta']="La Fecha Hasta no puede ser menor a la Fecha Desde";	
				$url_relativa = "siscor/vista/consultar_remisiones.php";
				header("Cache-Control: no-cache");
				header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
			}
			else
			{
				
			 if ($_SESSION['perfil']==2)
			{
				$Remisiones->setUnidad($_SESSION['unidades_user']);	
				$parametro="cd_unidades = ".$Remisiones->getUnidad();
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
		case "direccion":
		{

			if ($_SESSION['direcciones_user']==0)
			{
				if ($Remisiones->getId_primer_nivel_user()!= $_POST['primer_nivel'] )
				{
					$parametro="cd_alto_nivel=".$Remisiones->getId_alto_nivel_user()." and cd_primer_nivel=".$_POST['primer_nivel'];	
				}
				else
				{
					$parametro="cd_alto_nivel=".$Remisiones->getId_alto_nivel_user()." and cd_primer_nivel=".$Remisiones->getId_primer_nivel_user();
				}
				
				
	
				if ($Remisiones->getDirecciones()!="")
				{
				$parametro=$parametro." and cd_direcciones=".$Remisiones->getDirecciones();	
				}			
			}
		
			else 
			{
				if ($_SESSION['perfil']==1)
				{
					if ($_SESSION['direcciones_user']==0)
					{
						
						$Remisiones->setDirecciones($_POST['direcciones']);
						$Remisiones->setPrimer_nivel($_POST['primer_nivel']);	
					}
					else
					{
						$Remisiones->setDirecciones($_SESSION['direcciones_user']);
						$Remisiones->setPrimer_nivel($_SESSION['primer_nivel_user']);					
					}
						$parametro="cd_alto_nivel=".$Remisiones->getId_alto_nivel_user()." and cd_primer_nivel=".$Remisiones->getPrimer_nivel()." and cd_direcciones=".$Remisiones->getDirecciones();
						//die($parametro);
						if($Remisiones->getUnidad()!="")
						{
							$parametro=$parametro." and cd_unidades=".$Remisiones->getUnidad();
						}
				}
				elseif ($_SESSION['perfil']==2)
				{
					$Remisiones->setId_unidades_user($_SESSION['unidades_user']);
					$parametro="cd_alto_nivel=".$Remisiones->getId_alto_nivel_user()." and cd_primer_nivel=".$Remisiones->getId_primer_nivel_user()." and cd_direcciones=".$Remisiones->getId_direcciones_user()." and cd_unidades=".$Remisiones->getId_unidades_user();
					if( $Remisiones->getCoordinaciones()!=0)
   				{
   					$parametro=$parametro." and cd_coordinaciones=".$Remisiones->getCoordinaciones();
   				}
				}
				else
				{ 
					$parametro="cd_alto_nivel=".$Remisiones->getId_alto_nivel_user()." and cd_primer_nivel=".$Remisiones->getId_primer_nivel_user()." and cd_direcciones=".$Remisiones->getId_direcciones_user()." and cd_unidades=".$Remisiones->getId_unidades_user()." and cd_coordinaciones=".$Remisiones->getId_coordinaciones_user();
				}
			}
				list($dia,$mes,$ano)=explode('-',$_POST['fecha_desde']);
				list($dia2,$mes2,$ano2)=explode('-',$_POST['fecha_hasta']);
				$fecha_desde2=mktime(0,0,0,$mes,$dia,$ano);
				$fecha_hasta2=mktime(0,0,0,$mes2,$dia2,$ano2);	
				if ($fecha_hasta2 < $fecha_desde2)
				{
					$_SESSION['estatus_msj']=1;
					$_SESSION['error_remisiones_consulta']="La Fecha Hasta no puede ser menor a la Fecha Desde";	
					$url_relativa = "siscor/vista/consultar_remisiones.php";
					header("Cache-Control: no-cache");
					header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
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
			
		    break;
                }
	}//fin 





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
            //echo $alto_nivel->Mostrar(0); die();
            //se crea un arreglo donde se alogen los registros necesarios
            $campoId=array();
            $campofecha=array();
            /*
            $campoalto_nivel=array();
            $campoprimer_nivel=array();
            $campodirecciones=array();
            */
            $camporecibidas=array();
            $campounidad=array();
            $campocoordinacion=array();
            $campoprioridades=array();
            $campoanioremision=array();
            $campoaniorecibida=array();
            $campoobservacion=array();
            $datos = $Remisiones->MostrarConsulta(1,$tabla,$parametro,$orden);
		
		
		//Carga los registros
    		while ( $row=pg_fetch_array($datos) )
			{ 

		    	array_push( $campoId, $row['cd_remisiones'] );
		    	array_push( $campofecha , $row['fe_remisiones'] );
		    	/*
		    	array_push( $campoalto_nivel=array();
		    	array_push( $campoprimer_nivel=array();
		    	array_push( $campodirecciones=array();
		    	*/
		    	array_push( $camporecibidas , $row['cd_recibidas'] );
		    	array_push( $campounidad , $row['nb_unidades'] );
		    	array_push( $campocoordinacion , $row['nb_coordinaciones']);
		    	array_push( $campoprioridades , $row['nb_prioridades']);
		    	array_push( $campoanioremision , $row['nu_ano_remisiones']);
		    	array_push( $campoaniorecibida , $row['nu_ano_recibidas']);
		    	array_push( $campoobservacion , $row['tx_observacion_remisiones']);	
			}
    	//Prepara para la comunicacion
        		$_SESSION['campoIdRemisiones'] = $campoId;
		    	$_SESSION['campoIdFecha'] =$campofecha;
		    	/*
		    	array_push( $campoalto_nivel=array();
		    	array_push( $campoprimer_nivel=array();
		    	array_push( $campodirecciones=array();
		    	*/
		    	$_SESSION['campoIdRecibidas'] = $camporecibidas;
		    	$_SESSION['campoIdUnidad'] = $campounidad;
		    	$_SESSION['campoIdCoordinacion'] = $campocoordinacion;
		    	$_SESSION['campoIdPrioridades'] = $campoprioridades;
		    	$_SESSION['campoAnioRemision'] = $campoanioremision;
		    	$_SESSION['campoAnioRecibidas'] = $campoaniorecibida;
		    	$_SESSION['campoObservacion'] = $campoobservacion;	
		    	
			}
			else
			{
				
				$_SESSION['Remisiones_seleccionado']=0;
			}
	}//fin consultar
    //llena combo de alto nivel
    if ($_SESSION['alto_nivel_seleccionado_remision']==3)
    {
        $tabla= "vista_mostrar_alto_nivel_corres";
        $orden="nb_alto_nivel_corres";		        
    }
    else
    {
        $tabla= "vista_mostrar_alto_nivel";
        $orden="nb_alto_nivel";		        
    }    
    if ($_SESSION['primer_nivel_user']==329)
    {
        $sw=2;
    }
    else
    {
        $sw=0;
    }
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
                    if ($_SESSION['alto_nivel_seleccionado_remision']==3)
                    {        
                        array_push( $campoId , $row["cd_alto_nivel_corres"] );	
                        array_push( $campoNombre , $row["nb_alto_nivel_corres"] );
                    }
                    else
                    {
                        array_push( $campoId , $row["cd_alto_nivel"] );	
                        array_push( $campoNombre , $row["nb_alto_nivel"] );                            
                    }  
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
        if ($_SESSION['alto_nivel_user']==3)
        {
            $valor="cd_alto_nivel=".$_SESSION['alto_nivel_user']." and cd_primer_nivel=".$_SESSION['primer_nivel_user']." or cd_primer_nivel_aux=".$_SESSION['primer_nivel_user'];	
            $tabla= "vista_mostrar_primer_nivel";
            $orden="nb_primer_nivel";   
        }
        else
        {
            if ($_SESSION['primer_nivel_user']==329)
            {   
                if($_SESSION['alto_nivel_seleccionado_remision']==3)
                {
                    //$valor="cd_alto_nivel_corres=".$_SESSION['alto_nivel_seleccionado_remision'];
                    $valor="cd_alto_nivel_corres=".$_SESSION['alto_nivel_seleccionado_remision']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];	
                    $tabla= "vista_mostrar_primer_nivel_corres";
                    $orden="nb_primer_nivel_corres";
                }
                else if($_SESSION['alto_nivel_seleccionado_remision']==2)
                {
                    $valor="cd_alto_nivel=2 and cd_primer_nivel < 144";
                    $tabla= "vista_mostrar_primer_nivel";
                    $orden="nb_primer_nivel";                                     
                }
                else
                {
                    $valor="cd_alto_nivel=".$_SESSION['alto_nivel_seleccionado_remision'];
                    $tabla= "vista_mostrar_primer_nivel";
                    $orden="nb_primer_nivel";                                       
                }  
                /*if($_SESSION['alto_nivel_seleccionado_remision']=="")
                {
                    $valor="cd_alto_nivel=2 and cd_primer_nivel < 144";
                }
                else
                {
                    $valor="cd_alto_nivel=".$_SESSION['alto_nivel_seleccionado_remision']." and cd_primer_nivel < 14";
                }*/    
            }   
            else
            {//usuario unidad
                //$valor="cd_alto_nivel=".$_SESSION['alto_nivel_user']." and cd_primer_nivel=".$_SESSION['primer_nivel_user']." or cd_primer_nivel_aux=".$_SESSION['primer_nivel_user'];
                $valor="cd_alto_nivel_corres=".$_SESSION['alto_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];	
               
                $tabla= "vista_mostrar_primer_nivel_corres";
                $orden="nb_primer_nivel_corres";
                $_SESSION['alto_nivel_seleccionado_remision']=3;                  
            }
        }	

        $cont = $Remisiones->MostrarValores(0,$tabla,$orden,$valor);
        //die("comb");	//echo($cont); die;
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
                        if($_SESSION['alto_nivel_seleccionado_remision']==3)
                        {             
                            array_push( $campoId , $row["cd_primer_nivel_corres"] );	
                            array_push( $campoNombre , $row["nb_primer_nivel_corres"] );				
                        }
                        else
                        {
                            array_push( $campoId , $row["cd_primer_nivel"] );	
                            array_push( $campoNombre , $row["nb_primer_nivel"] );				                            
                        }  				
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
	
	$valor="cd_alto_nivel=".$_SESSION['alto_nivel_user']." and cd_primer_nivel = ".$_SESSION['primer_nivel_user'];	
	
	
	}
	else 
	{
		
	//$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];		
	$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user'];
	}
	
	//die($valor);
	$tabla= "vista_mostrar_direcciones";
	$orden="nb_direcciones";
	$cont = $Remisiones->MostrarValores(0,$tabla,$orden,$valor);
	//echo($cont); die;
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
		$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_direcciones=".$_SESSION['direcciones_user'];	
	}
	else 
	{
	//$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user']." and cd_unidades= ".$_SESSION['unidades_user'];		
		$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_direcciones=".$_SESSION['direcciones_user']." and cd_unidades= ".$_SESSION['unidades_user'];
	//	die($valor);
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
    if ($_SESSION['coordinaciones_user']==0)
    {
        $valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_direcciones=".$_SESSION['direcciones_user']." and cd_unidades= ".$_SESSION['unidades_user'];	
    }
    else 
    {
        //$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user']." and cd_unidades= ".$_SESSION['unidades_user']." and cd_coordinaciones=".$_SESSION['coordinaciones_user'];		
        $valor="cd_coordinaciones=".$_SESSION['coordinaciones_user'];
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

$url_relativa = "siscor/vista/consultar_remisiones.php";
header("Cache-Control: no-cache");
header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
?>