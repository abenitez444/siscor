<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_alto_nivel_corres.php");
include_once("../modelo/class_entes_externos.php");
include_once("../modelo/class_modulosxusuarios.php");

	$entes_externos = new entes_externos();
   	$Modulosxusuarios = new Modulosxusuarios();

    $entes_externos->setCd_user($_SESSION['codigo']);
 	$entes_externos->setCd_direc_user($_SESSION['direcciones_user']);
 	$entes_externos->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$entes_externos->setPrimer_nivel_user($_SESSION['primer_nivel_user']);
	
	$permiso =$Modulosxusuarios->Existe($entes_externos->getCd_user(),'in_ingresar',"TRUE",1);
		if($permiso==1)
		{
			$_SESSION['ingresar']=1;
		}
		else
		{
			$_SESSION['ingresar']=0;
		}
	
	
	
	$intPermisoConsultar =$Modulosxusuarios->Existe($entes_externos->getCd_user(),'in_consultar',"TRUE",1);
		if($intPermisoConsultar==1)
		{
			$_SESSION['eliminar']=1;
		}
		else
		{
			$_SESSION['eliminar']=0;
		}	

	$intPermisoModificar =$Modulosxusuarios->Existe($entes_externos->getCd_user(),'in_modificar',"TRUE",1);
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
	

	
	$entes_externos->setNombre($_POST['nb_entes_externos']);
	$entes_externos->setCd_alto_nivel(3);
	$entes_externos->setUbicacion($_POST['ubicacion_entes_externos']);
	$entes_externos->setEdificio($_POST['edificio_entes_externos']);
	$entes_externos->setPiso($_POST['piso_entes_externos']);
	$entes_externos->setTelefono($_POST['telefono_entes_externos']);
	$entes_externos->setObservacion($_POST['observacion_entes_externos']);
	//datos del usuario que esta ingrensando

	
 	
	//valor de modificar o eliminar	
	$entes_externos->setId(isset($_GET['id'])? $_GET['id'] : "");
	
	
	
    $boton= $_POST['enviar'];
	$guardar=$_SESSION['boton'];
    $form = isset($_GET['form'])? $_GET['form'] : "";
	$form = $_GET['form'];

    if ($_POST['regresar']==true){
  			unset($_SESSION['alto_nivel_corres_seleccionado']);
			unset($_SESSION['nombre_entes_externos']);
			unset($_SESSION['ubicacion_entes_externos']);
			unset($_SESSION['edificio_entes_externos']);
			unset($_SESSION['piso_entes_externos']);
			unset($_SESSION['telefono_entes_externos']);
			unset($_SESSION['observacion_entes_externos']);
			unset($_SESSION['id_entes_externos']);
			unset($_SESSION['modi']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
    }
    
   // die($form);
    
    	if ($form == "mod")
	{
		if ($guardar=="Guardar" || $guardar=="" )
		{
			$existe =$entes_externos->CargarDatos();
			$_SESSION['boton']="Modificar";	
			$_SESSION['alto_nivel_corres_seleccionado']=$entes_externos->getCd_alto_nivel();
			$_SESSION['nombre_entes_externos']=$entes_externos->getNombre();
			$_SESSION['ubicacion_entes_externos']=$entes_externos->getUbicacion();
			$_SESSION['edificio_entes_externos']=$entes_externos->getEdificio();
			$_SESSION['piso_entes_externos']=$entes_externos->getPiso();
			$_SESSION['telefono_entes_externos']=$entes_externos->getTelefono();
			$_SESSION['observacion_entes_externos']=$entes_externos->getObservacion();
			$_SESSION['id_entes_externos']=$entes_externos->getId();
			$_SESSION['modi']=1;
			$_SESSION['disabled']="disabled";
			
			$url_relativa = "../vista/registrar_entes_externos.php";
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
		
		$existe=$entes_externos->Existencia('vista_mostrar_direcciones_corres','cd_primer_nivel_corres',$entes_externos->getId(),'cd_direcciones_usuarios',$entes_externos->getCd_direc_user(),'cd_alto_nivel_usuarios',$entes_externos->getAlto_nivel_user(),'cd_primer_nivel_usuarios',$entes_externos->getPrimer_nivel_user());
		
		if($existe){
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_entes_externos']="Existe informaci&oacute;n asociada a este registro. No puede ser Eliminado";
		$_SESSION['boton']="Guardar";
		}else{
		$mensaje = $entes_externos->EjecutarFunciones("funcion_eli_primer_nivel_corres(".$entes_externos->getId().")");
		unset($_SESSION['campoIdPrimerNivel']);
		unset($_SESSION['campoNombrePrimerNivel']);
		unset($_SESSION['cantidad']);
		$_SESSION['estatus_msj']=2;
		$_SESSION['error_entes_externos']="La Información fue Eliminada con Éxito";
		$_SESSION['boton']="Guardar";		

	}
	}
	else
	{
		if ($boton=="Modificar")
		{ 				
			$entes_externos->setId($_POST['id_entes_externos']);
			
			
			$mensaje = $entes_externos->EjecutarFunciones("funcion_mod_primer_nivel_corres('".$entes_externos->getId()."','".$entes_externos->getNombre()."','".$entes_externos->getCd_alto_nivel()."','".$entes_externos->getUbicacion()."','".$entes_externos->getEdificio()."','".$entes_externos->getPiso()."','".$entes_externos->getTelefono()."','".$entes_externos->getObservacion()."','".$entes_externos->getCd_user()."','".$entes_externos->getCd_direc_user()."','".$entes_externos->getAlto_nivel_user()."','".$entes_externos->getPrimer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
			$_SESSION['estatus_msj']=2;
			$_SESSION['error_entes_externos']="La Información fue Modificada con Éxito";
		 	unset($_SESSION['nombre_entes_externos']);
			unset($_SESSION['alto_nivel_corres_seleccionado']);
			unset($_SESSION['nombre_entes_externos']);
			unset($_SESSION['ubicacion_entes_externos']);
			unset($_SESSION['edificio_entes_externos']);
			unset($_SESSION['piso_entes_externos']);
			unset($_SESSION['telefono_entes_externos']);
			unset($_SESSION['observacion_entes_externos']);
			unset($_SESSION['id_entes_externos']);
			unset($_SESSION['modi']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
		}
		else
		{
			if($_POST['enviar']=="Guardar")
			{
				
				$existe =$entes_externos->Existencia('vista_mostrar_primer_nivel_corres','nb_primer_nivel_corres',$entes_externos->getNombre(),'cd_direcciones_usuarios',$entes_externos->getCd_direc_user(),'cd_alto_nivel_usuarios',$entes_externos->getAlto_nivel_user(),'cd_primer_nivel_usuarios',$entes_externos->getPrimer_nivel_user());
				if ($existe==0)
				{										
					$mensaje = $entes_externos->EjecutarFunciones("funcion_insertar_primer_nivel_corres('".$entes_externos->getNombre()."','".$entes_externos->getCd_alto_nivel()."','".$entes_externos->getUbicacion()."','".$entes_externos->getEdificio()."','".$entes_externos->getPiso()."','".$entes_externos->getTelefono()."','".$entes_externos->getObservacion()."','".$entes_externos->getCd_user()."','".$entes_externos->getCd_direc_user()."','".$entes_externos->getAlto_nivel_user()."','".$entes_externos->getPrimer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
					$_SESSION['estatus_msj']=2;
					$_SESSION['error_entes_externos']="La Información fue Guardada con Éxito";
				}
				else
				{
              		$_SESSION['estatus_msj']=1;
					$_SESSION['error_entes_externos']="El nombre que esta ingresando ya existe en la lista";
				}
				
			}
		}
		$boton = "Guardar";
	}
    
	$tabla="vista_mostrar_primer_nivel_corres";
	$orden="nb_primer_nivel_corres";
	$cont = $entes_externos->Mostrar(0,$tabla,$orden);
	//echo($cant); die;
	if ( $cont != 0 ) 
	{
		//echo $entes_externos->Mostrar(0); die();
		$_SESSION['cantidad'] = $cont;
	
		//echo $entes_externos->Mostrar(0); die();
		
		//se crea un arreglo donde se alogen los registros necesarios
    	$campoId=array();
    	$campoNombre=array();
    	$datos = $entes_externos->Mostrar(1,$tabla,$orden);
		
		//Carga los registros
    	while ( $row=pg_fetch_array($datos) )
		{ 

			array_push( $campoId , $row["cd_primer_nivel_corres"] );	
			array_push( $campoNombre , $row["nb_primer_nivel_corres"] );				
		}
    	//Prepara para la comunicacion
		$_SESSION['campoIdPrimerNivelCorres'] = $campoId;
    	$_SESSION['campoNombrePrimerNivelCorres'] = $campoNombre;
		    		
	}
	
	$url_relativa = "../vista/registrar_entes_externos.php";
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