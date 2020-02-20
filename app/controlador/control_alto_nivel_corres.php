<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_alto_nivel_corres.php");


	$boton=$_POST['enviar'];
	$guardar=$_SESSION['boton'];

	
    $form = isset($_GET['form'])? $_GET['form'] : "";
    $_SESSION['id'] = isset($_GET['id_an'])? $_GET['id_an'] : "";
    $_SESSION['nombre']= isset($_GET['nombre_an'])? $_GET['nombre_an'] : "";  
	
	

	$alto_nivel_corres = new alto_nivel_corres();
    $alto_nivel_corres->setNombre($_POST['nb_alto_nivel']);
	


    $alto_nivel_corres->setCd_user($_SESSION['codigo']);
    $alto_nivel_corres->setCd_direc_user($_SESSION['direcciones_user']);
	$alto_nivel_corres->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$alto_nivel_corres->setPrimer_nivel_user($_SESSION['primer_nivel_user']);

	$alto_nivel_corres->setId($_SESSION['id']);

		if($_SESSION['eliminar']==1)
	{
		$_SESSION['modi']=0;
		$_SESSION['eliminar']=0;
	}
	
	if ($_POST['regresar']==true){
    	 	unset($_SESSION['nombre']);
			unset($_SESSION['id']);
			unset($_SESSION['modi']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
    }
    
	if ($form == "mod_an")
	{  
		if ($guardar=="Guardar" || $guardar=="")
		{
			$_SESSION['boton']="Modificar";	
			$_SESSION['modi']=1;
			
			$url_relativa = "../vista/registrar_alto_nivel_corres.php";
        	header("Cache-Control: no-cache");
			header("Location: ".$url_relativa);	
		}
		else
		{
			if ($boton=="Modificar")
			{
				$_SESSION['boton']="Guardar";
			}
			else
			{
				$_SESSION['boton']="Modificar";
				
			}
		}
	}
	else if($form == "eli_an")
	{
				
		$existe=$alto_nivel_corres->Existencia('vista_mostrar_primer_nivel_corres','cd_alto_nivel_corres',$alto_nivel_corres->getId(),'cd_direcciones_usuarios',$alto_nivel_corres->getCd_direc_user(),'cd_alto_nivel_usuarios',$alto_nivel_corres->getalto_nivel_user(),'cd_primer_nivel_usuarios',$alto_nivel_corres->getPrimer_nivel_user());
		if($existe){
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_alto_nivel_corres']="Existe informaci&oacute;n asociada a este registro. No puede ser Eliminado";
		$_SESSION['eliminar']=1;
		$_SESSION['modi']=1;
		}else{
		$mensaje = $alto_nivel_corres->EjecutarFunciones("funcion_eli_alto_nivel_corres(".$_SESSION['id'].")");
		$_SESSION['estatus_msj']=2;
		$_SESSION['error_alto_nivel_corres']="La Información fue Eliminada con Éxito";
		$_SESSION['eliminar']=1;
		$_SESSION['modi']=1;		
		}
	}
	else
	{
		if ($boton=="Modificar")
		{ 				
			$alto_nivel_corres->setId($_POST['id_alto_nivel_corres']);
			$mensaje = $alto_nivel_corres->EjecutarFunciones("funcion_mod_alto_nivel_corres(".$alto_nivel_corres->getId().",'".$alto_nivel_corres->getNombre()."',".$alto_nivel_corres->getCd_user().",".$alto_nivel_corres->getalto_nivel_user().",".$alto_nivel_corres->getPrimer_nivel_user().",".$alto_nivel_corres->getCd_direc_user().",'".$_SERVER["REMOTE_ADDR"]."')");
			$_SESSION['estatus_msj']=2;
			$_SESSION['error_alto_nivel_corres']="La Información fue Modificada con Éxito";
			$_SESSION['boton']="Guardar";
			
			unset($_SESSION['nombre']);
			unset($_SESSION['id']);
			unset($_SESSION['modi']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
		}
		else
		{
			if($_POST['enviar']=="Guardar")
			{
					$mensaje = $alto_nivel_corres->EjecutarFunciones("funcion_insertar_alto_nivel_corres('".$alto_nivel_corres->getNombre()."',".$alto_nivel_corres->getCd_user().",".$alto_nivel_corres->getCd_direc_user().",".$alto_nivel_corres->getalto_nivel_user().",".$alto_nivel_corres->getPrimer_nivel_user().",'".$_SERVER["REMOTE_ADDR"]."')");
					$_SESSION['estatus_msj']=2;
					$_SESSION['error_alto_nivel_corres']="La Información fue Guardada con Éxito";
				
			}
		}
		$boton = "Guardar";
	}
	$url_relativa = "../vista/registrar_alto_nivel_corres.php";
	header("Cache-Control: no-cache");
	header("Location: ".$url_relativa);	
?>