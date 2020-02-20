<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_general.php");
include_once("../modelo/class_modulosxusuarios.php");

	
   	$Modulosxusuarios = new Modulosxusuarios();
	$General = new General();
	
	$General->setCd_user($_SESSION['codigo']);
	
 	$General->setCd_direc_user($_SESSION['direcciones_user']);
 	$General->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$General->setPrimer_nivel_user($_SESSION['primer_nivel_user']);

		$permiso =$Modulosxusuarios->Existe($General->getCd_user(),'in_ingresar',"TRUE",1);
		if($permiso==1)
		{
			$_SESSION['ingresar']=1;
		}
		else
		{
			$_SESSION['ingresar']=0;
		}
	
	
	
	$intPermisoConsultar =$Modulosxusuarios->Existe($General->getCd_user(),'in_consultar',"TRUE",1);
		if($intPermisoConsultar==1)
		{
			$_SESSION['eliminar']=1;
		}
		else
		{
			$_SESSION['eliminar']=0;
		}	

	$intPermisoModificar =$Modulosxusuarios->Existe($General->getCd_user(),'in_modificar',"TRUE",1);
		if($intPermisoModificar==1)
		{
			$_SESSION['modificar']=1;
		}
		else
		{
			$_SESSION['modificar']=0;
		}


if ($_SESSION['perfil']==1 && $permiso==1 || $intPermisoConsultar==1 || $intPermisoModificar==1 )
{
	
	$General->setNombre($_POST['nb_prioridades']);
	
	
	//valor de modificar o eliminar	
	$General->setId(isset($_GET['id'])? $_GET['id'] : "");

	
    $boton= $_POST['enviar'];
	$guardar=$_SESSION['boton'];
    $form = isset($_GET['form'])? $_GET['form'] : "insertar";

    
    if ($_POST['regresar']==true){
    	 	unset($_SESSION['nombre_prioridades']);
			unset($_SESSION['id_prioridades']);
			unset($_SESSION['modi']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
    }
    
    
    
    	if ($form == "mod")
	{  
		if ($guardar=="Guardar" || $guardar=="")
		{
			$tabla="vista_mostrar_prioridades";
			$valor="cd_prioridades=".$General->getId();
			$orden="nb_prioridades";
			$existe =$General->CargarDatos($tabla,$valor,$orden);
			$_SESSION['boton']="Modificar";	
			$_SESSION['nombre_prioridades']=$General->getNombre();
			$_SESSION['id_prioridades']=$General->getId();
			$_SESSION['modi']=1;
			$_SESSION['disabled']="disabled";
			
			$url_relativa = "../vista/registrar_prioridades.php";
        	header("Cache-Control: no-cache");
			header("Location: ".$url_relativa);	
		}
		else
		{
			if ($boton=="Modificar")
			{
				$_SESSION['boton']="Guardar";
			}
			else{
				$_SESSION['boton']="Modificar";
				
			}
		}
	}
	else if($form == "eli")
	{
		
	//	$existe=$General->Existencia('vista_mostrar_acciones','cd_acciones',$General->getId(),'cd_direcciones_usuarios',$General->getCd_direc_user(),'cd_alto_nivel_usuarios',$General->getAlto_nivel_user(),'cd_primer_nivel_usuarios',$General->getPrimer_nivel_user());
		
		//if($existe){
		//$_SESSION['estatus_msj']=1;
		//$_SESSION['error_General']="Existe informaci&oacute;n asociada a este registro. No puede ser Eliminado";
		//$_SESSION['boton']="Guardar";
		//}else{
		$mensaje = $General->EjecutarFunciones("funcion_eli_prioridades(".$General->getId().")");
		unset($_SESSION['campoIdPrioridades']);
		unset($_SESSION['campoNombrePrioridades']);
		unset($_SESSION['cantidad']);
		$_SESSION['estatus_msj']=2;
		$_SESSION['error_prioridades']="La Información fue Eliminada con Éxito";
		$_SESSION['boton']="Guardar";		

	//}
	}
	else
	{
		if ($boton=="Modificar")
		{ 				
			$General->setId($_POST['id_prioridades']);
			$mensaje = $General->EjecutarFunciones("funcion_mod_prioridades('".$General->getId()."','".$General->getNombre()."','".$General->getCd_user()."','".$General->getAlto_nivel_user()."','".$General->getPrimer_nivel_user()."','".$General->getCd_direc_user()."')");
			$_SESSION['estatus_msj']=2;
			$_SESSION['error_prioridades']="La Información fue Modificada con Éxito";
		 	unset($_SESSION['nombre_prioridades']);
			unset($_SESSION['id_prioridades']);
			unset($_SESSION['modi']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
		}
		else
		{
			if($_POST['enviar']=="Guardar")
			{
				
				$existe =$General->Existencia('vista_mostrar_prioridades','nb_prioridades',$General->getNombre(),'cd_direcciones_usuarios',$General->getCd_direc_user(),'cd_alto_nivel_usuarios',$General->getAlto_nivel_user(),'cd_primer_nivel_usuarios',$General->getPrimer_nivel_user());
				if ($existe==0)
				{										
					$mensaje = $General->EjecutarFunciones("funcion_insertar_prioridades('".$General->getNombre()."','".$General->getCd_user()."','".$General->getCd_direc_user()."','".$General->getAlto_nivel_user()."','".$General->getPrimer_nivel_user()."')");
					$_SESSION['estatus_msj']=2;
					$_SESSION['error_prioridades']="La Información fue Guardada con Éxito";
				}
				else
				{
              		$_SESSION['estatus_msj']=1;
					$_SESSION['error_prioridades']="El nombre que esta ingresando ya existe en la lista";
				}
				
			}
		}
		$boton = "Guardar";
	}
    
$tabla="vista_mostrar_prioridades";
$orden="nb_prioridades";
$cont = $General->Mostrar(0,$tabla,$orden);
//echo($cant); die;
if ( $cont != 0 ) 
{
	//echo $General->Mostrar(0); die();
	$_SESSION['cantidad'] = $cont;
	//echo $General->Mostrar(0); die();
	//se crea un arreglo donde se alogen los registros necesarios
   	$campoId=array();
   	$campoNombre=array();
	$datos = $General->Mostrar(1,$tabla,$orden);
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
$url_relativa = "../vista/registrar_prioridades.php";
header("Cache-Control: no-cache");
header("Location: ".$url_relativa);	
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