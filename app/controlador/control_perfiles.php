<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_perfiles.php");

	
	$perfiles = new perfiles();
    $perfiles->setNombre($_POST['nb_perfiles']);
	
    $_SESSION['id'] = isset($_GET['id_an'])? $_GET['id_an'] : "";
    $_SESSION['nombre']= isset($_GET['nombre_an'])? $_GET['nombre_an'] : "";  
	

    $perfiles->setCd_user($_SESSION['codigo']);
    $perfiles->setCd_direc_user($_SESSION['direcciones_user']);
	$perfiles->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$perfiles->setPrimer_nivel_user($_SESSION['primer_nivel_user']);
    

    $perfiles->setId($_SESSION['id']);
    $boton= $_POST['enviar'];
	$guardar=$_SESSION['boton'];
    $form = isset($_GET['form'])? $_GET['form'] : "insertar";

	
	if ($form == "mod_an")
	{  
		
		if ($guardar=="Guardar")
		{
			
			$_SESSION['boton']="Modificar";	
			$url_relativa = "../vista/registrar_perfiles.php";
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
	else if($form == "eli_an")
	{
				
		$existe=$perfiles->Existencia('vista_usuarios','cd_perfiles_fk',$perfiles->getId(),'cd_direcciones_usuarios_carga',$perfiles->getCd_direc_user(),'cd_alto_nivel_usuarios_cargas',$perfiles->getAlto_nivel_user(),'cd_primer_nivel_usuarios_cargas',$perfiles->getPrimer_nivel_user());
		if($existe){
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_perfiles']="Existe informaci&oacute;n asociada a este registro. No puede ser Eliminado";
		$_SESSION['boton']="Guardar";
		}else{
		$mensaje = $perfiles->EjecutarFunciones("funcion_eli_perfiles(".$_SESSION['id'].")");
		$_SESSION['estatus_msj']=2;
		$_SESSION['error_perfiles']="La Información fue Eliminada con Éxito";
		$_SESSION['boton']="Guardar";	
		}
	}
	else
	{
		if ($boton=="Modificar")
		{ 				
			$perfiles->setId($_POST['id_perfiles']);
			$mensaje = $perfiles->EjecutarFunciones("funcion_mod_perfiles(".$perfiles->getId().",'".$perfiles->getNombre()."',".$perfiles->getCd_user().",".$perfiles->getAlto_nivel_user().",".$perfiles->getPrimer_nivel_user().",".$perfiles->getCd_direc_user().")");
			$_SESSION['estatus_msj']=2;
			$_SESSION['error_perfiles']="La Información fue Modificada con Éxito";
			$_SESSION['boton']="Guardar";
		}
		else
		{
			if($_POST['enviar']=="Guardar")
			{
				
				$existe =$perfiles->Existencia('vista_perfiles','nb_perfiles',$perfiles->getNombre(),'cd_direcciones_usuarios',$perfiles->getCd_direc_user(),'cd_alto_nivel_usuarios',$perfiles->getAlto_nivel_user(),'cd_primer_nivel_usuarios',$perfiles->getPrimer_nivel_user());
				if ($existe==0)
				{										
					$mensaje = $perfiles->EjecutarFunciones("funcion_insertar_perfiles('".$perfiles->getNombre()."',".$perfiles->getCd_user().",".$perfiles->getCd_direc_user().",".$perfiles->getAlto_nivel_user().",".$perfiles->getPrimer_nivel_user().")");
					$_SESSION['estatus_msj']=2;
					$_SESSION['error_perfiles']="La Información fue Guardada con Éxito";
				}else{
              		$_SESSION['estatus_msj']=1;
					$_SESSION['error_perfiles']="El nombre que esta ingresando ya existe en la lista";
					
				}
				
			}
		}
		$boton = "Guardar";
	}
	$url_relativa = "../vista/registrar_perfiles.php";
	header("Cache-Control: no-cache");
	header("Location: ".$url_relativa);	
?>