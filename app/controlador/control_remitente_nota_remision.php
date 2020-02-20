<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_primer_nivel.php");
include_once("../modelo/class_direcciones.php");
include_once("../modelo/class_modulosxusuarios.php");

	$primer_nivel = new primer_nivel();
	$direcciones = new direcciones();
	$Modulosxusuarios = new Modulosxusuarios();
	
	//datos del usuario que esta ingrensando

	$direcciones->setCd_user($_SESSION['codigo']);
	$direcciones->setCd_direc_user($_SESSION['direcciones_user']);
	$direcciones->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$direcciones->setPrimer_nivel_user($_SESSION['primer_nivel_user']);
	
	$permiso =$Modulosxusuarios->Existe($direcciones->getCd_user(),'in_ingresar',"TRUE",1);
		if($permiso==1)
		{
			$_SESSION['ingresar']=1;
		}
		else
		{
			$_SESSION['ingresar']=0;
		}
	
	$intPermisoModificar =$Modulosxusuarios->Existe($direcciones->getCd_user(),'in_modificar',"TRUE",1);
		if($intPermisoModificar==1)
		{
			$_SESSION['modificar']=1;
		}
		else
		{
			$_SESSION['modificar']=0;
		}
	
	
	
	if ($_SESSION['perfil']==1  && $permiso==1 || $intPermisoModificar==1)
	{	
	
		if ($direcciones->getCd_direc_user()==0)
		{
			$primer_nivel->setId($_SESSION['primer_nivel_user']);
			$primer_nivel->CargarDatos();
			$_SESSION['nombre_remitente']=$primer_nivel->getRemitente();
	     	$_SESSION['nombre_cargo']=$primer_nivel->getCargo_remitente();
	     	$_SESSION['boton']="Modificar";
		}
		else
		{
			$direcciones->setId($_SESSION['direcciones_user']);
			$direcciones->CargarDatos();
			$_SESSION['nombre_remitente']=$direcciones->getRemitente();
	     	$_SESSION['nombre_cargo']=$direcciones->getCargo_remitente();
	     	$_SESSION['boton']="Modificar";		
		}
		
		if($_SESSION['nombre_remitente']=="")
		{
			$_SESSION['boton']="Guardar";
		}
	

		if($_POST['enviar']=="Guardar" || $_POST['enviar']=="Modificar" )
		{
			if($direcciones->getCd_direc_user()==0)
			{
				$primer_nivel->setRemitente($_POST['nb_remitente']);
   	            $primer_nivel->setCargo_remitente($_POST['nb_cargo']);
				$mensaje = $primer_nivel->EjecutarFunciones("funcion_mod_primer_nivel_nota_remision('".$primer_nivel->getId()."','".$primer_nivel->getRemitente()."','".$primer_nivel->getCargo_remitente()."','".$direcciones->getCd_user()."','".$direcciones->getCd_direc_user()."','".$direcciones->getAlto_nivel_user()."','".$direcciones->getPrimer_nivel_user()."')");
				$_SESSION['nombre_remitente']=$primer_nivel->getRemitente();
     			$_SESSION['nombre_cargo']=$primer_nivel->getCargo_remitente();
			}
			else
			{
				$direcciones->setRemitente($_POST['nb_remitente']);
   	            $direcciones->setCargo_remitente($_POST['nb_cargo']);
				$mensaje = $direcciones->EjecutarFunciones("funcion_mod_direcciones_nota_remision('".$direcciones->getId()."','".$direcciones->getRemitente()."','".$direcciones->getCargo_remitente()."','".$direcciones->getCd_user()."','".$direcciones->getCd_direc_user()."','".$direcciones->getAlto_nivel_user()."','".$direcciones->getPrimer_nivel_user()."')");
				$_SESSION['nombre_remitente']=$direcciones->getRemitente();
     			$_SESSION['nombre_cargo']=$direcciones->getCargo_remitente();
			}
			if($_POST['enviar']=="Guardar")
		    {
				$_SESSION['estatus_msj']=2;
				$_SESSION['error_remitente']="La Información fue Guardada con Éxito";			    	
		    }				
			elseif($_POST['enviar']=="Modificar" )
		    {
    			$_SESSION['estatus_msj']=2;
				$_SESSION['error_remitente']="La Información fue Modificada con Éxito";
		    }
		    
		    
		}
		$url_relativa = "../vista/registrar_remitente.php";
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