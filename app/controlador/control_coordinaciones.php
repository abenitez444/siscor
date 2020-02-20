<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_alto_nivel.php");
include_once("../modelo/class_coordinaciones.php");


	$alto_nivel = new alto_nivel();
	$coordinaciones = new coordinaciones();
	
	$coordinaciones->setNombre($_POST['nb_coordinaciones']);
	$coordinaciones->setCd_alto_nivel($_POST['alto_nivel']);
	$coordinaciones->setCd_primer_nivel($_POST['primer_nivel']);
	$coordinaciones->setCd_unidades($_POST['unidades']);

	$coordinaciones->setCd_direcciones($_POST['direcciones']);
	$coordinaciones->setUbicacion($_POST['ubicacion_coordinaciones']);
	$coordinaciones->setEdificio($_POST['edificio_coordinaciones']);
	$coordinaciones->setPiso($_POST['piso_coordinaciones']);
	$coordinaciones->setTelefono($_POST['telefono_coordinaciones']);
	$coordinaciones->setObservacion($_POST['observacion_coordinaciones']);
	//datos del usuario que esta ingrensando

	$coordinaciones->setCd_user($_SESSION['codigo']);
	$coordinaciones->setCd_direc_user($_SESSION['direcciones_user']);
	$coordinaciones->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$coordinaciones->setPrimer_nivel_user($_SESSION['primer_nivel_user']);
	
	
 	//datos de alto_nivel
	$alto_nivel->setCd_direc_user($_SESSION['direcciones_user']);
	$alto_nivel->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$alto_nivel->setPrimer_nivel_user($_SESSION['primer_nivel_user']);
 	
	//valor de modificar o eliminar	
	$coordinaciones->setId(isset($_GET['id'])? $_GET['id'] : "");

	$_SESSION['idd'] = isset($_GET['idd'])? $_GET['idd'] : "";
	
    $boton= $_POST['enviar'];
	$guardar=$_SESSION['boton'];
    $form = isset($_GET['form'])? $_GET['form'] : "insertar";

    
    if ($_POST['regresar']==true){
    	 	unset($_SESSION['nombre_coordinaciones']);
			unset($_SESSION['alto_nivel_seleccionado']);
			unset($_SESSION['primer_nivel']);
			unset($_SESSION['ubicacion_coordinaciones']);
			unset($_SESSION['edificio_coordinaciones']);
			unset($_SESSION['piso_coordinaciones']);
			unset($_SESSION['telefono_coordinaciones']);
			unset($_SESSION['observacion_coordinaciones']);
			unset($_SESSION['id_unidades']);
			unset($_SESSION['nombre_primer_nivel']);
			unset($_SESSION['direcciones']);
			unset($_SESSION['nombre_direcciones']);
			unset($_SESSION['unidades']);
			unset($_SESSION['nombre_unidades']);
			unset($_SESSION['modi']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
    }
    	if ($form == "mod")
	{ 
		
		if ($guardar=="Guardar" || $guardar=="")
		{
			$existe =$coordinaciones->CargarDatos();
			$_SESSION['boton']="Modificar";	
			$_SESSION['alto_nivel_seleccionado']=$coordinaciones->getCd_alto_nivel();
     		$_SESSION['primer_nivel']=$coordinaciones->getCd_primer_nivel();
     		$_SESSION['nombre_primer_nivel']=$coordinaciones->getNombre_primer_nivel();
       		$_SESSION['nombre_coordinaciones']=$coordinaciones->getNombre();
			$_SESSION['ubicacion_coordinaciones']=$coordinaciones->getUbicacion();
			$_SESSION['edificio_coordinaciones']=$coordinaciones->getEdificio();
			$_SESSION['piso_coordinaciones']=$coordinaciones->getPiso();
			$_SESSION['telefono_coordinaciones']=$coordinaciones->getTelefono();
			$_SESSION['observacion_coordinaciones']=$coordinaciones->getObservacion();
			$_SESSION['id_coordinaciones']=$coordinaciones->getId();
			$_SESSION['direcciones']=$coordinaciones->getCd_direcciones();
			$_SESSION['nombre_direcciones']=$coordinaciones->getNombre_direcciones();
			$_SESSION['unidades']=$coordinaciones->getCd_unidades();
			$_SESSION['nombre_unidades']=$coordinaciones->getNombre_unidades();
			$_SESSION['modi']=1;
			$_SESSION['disabled']="disabled";
			$url_relativa = "../vista/registrar_coordinaciones.php";
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

		
		// se debe chequear con los que se ingrese en recibidas o enla enviadas para poder ser eliminada no se a echo porq esos modulos no estan desarrollado
		
		$existe=$coordinaciones->Existencia('vista_mostrar_remisiones','cd_coordinaciones',$coordinaciones->getId(),'cd_direcciones_usuarios',$coordinaciones->getCd_direc_user(),'cd_alto_nivel_usuarios',$coordinaciones->getAlto_nivel_user(),'cd_primer_nivel_usuarios',$coordinaciones->getPrimer_nivel_user());
		$existe2=$coordinaciones->Existencia('vista_usuarios','cd_coordinaciones_fk',$coordinaciones->getId(),'cd_direcciones_fk',$coordinaciones->getCd_direc_user(),'cd_alto_nivel_fk',$coordinaciones->getAlto_nivel_user(),'cd_primer_nivel_fk',$coordinaciones->getPrimer_nivel_user());
	//	die($existe ."- datros de 1 - ".$existe2."- datos de 2");
		
		if($existe==1){
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_coordinaciones']="Existe informaci&oacute;n asociada a este registro. No puede ser Eliminado";
		$_SESSION['boton']="Guardar";
		}else if($existe2==1){
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_coordinaciones']="Existe1111111informaci&oacute;n asociada a este registro. No puede ser Eliminado";
		$_SESSION['boton']="Guardar";			
		}else if ($existe==0 && $existe2==0){
		$mensaje = $coordinaciones->EjecutarFunciones("funcion_eli_coordinaciones(".$coordinaciones->getId().")");
		$_SESSION['estatus_msj']=2;
		$_SESSION['error_coordinaciones']="La Información fue Eliminada con Éxito";
		$_SESSION['boton']="Guardar";	
		}
	}
	else
	{
		if ($boton=="Modificar")
		{ 				
			$coordinaciones->setId($_SESSION['id_coordinaciones']);
			$coordinaciones->setCd_unidades($_SESSION['unidades']);
			$mensaje = $coordinaciones->EjecutarFunciones("funcion_mod_coordinaciones('".$coordinaciones->getId()."','".$coordinaciones->getNombre()."','".$coordinaciones->getCd_unidades()."','".$coordinaciones->getUbicacion()."','".$coordinaciones->getEdificio()."','".$coordinaciones->getPiso()."','".$coordinaciones->getTelefono()."','".$coordinaciones->getObservacion()."','".$coordinaciones->getCd_user()."','".$coordinaciones->getCd_direc_user()."','".$coordinaciones->getAlto_nivel_user()."','".$coordinaciones->getPrimer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
			$_SESSION['estatus_msj']=2;
			$_SESSION['error_coordinaciones']="La Información fue Modificada con Éxito";
		 	unset($_SESSION['nombre_coordinaciones']);
			unset($_SESSION['alto_nivel_seleccionado']);
			unset($_SESSION['ubicacion_coordinaciones']);
			unset($_SESSION['edificio_coordinaciones']);
			unset($_SESSION['piso_coordinaciones']);
			unset($_SESSION['telefono_coordinaciones']);
			unset($_SESSION['observacion_coordinaciones']);
			unset($_SESSION['id_coordinaciones']);
			unset($_SESSION['primer_nivel']);
			unset($_SESSION['direcciones']);
			unset($_SESSION['nombre_direcciones']);
			unset($_SESSION['unidades']);
			unset($_SESSION['nombre_unidades']);
			unset($_SESSION['modi']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
		}
		else
		{
			if($_POST['enviar']=="Guardar")
			{
				//$existe =$coordinaciones->Existencia('vista_mostrar_coordinaciones','nb_coordinaciones',$coordinaciones->getNombre(),'cd_direcciones_usuarios',$coordinaciones->getCd_direc_user(),'cd_alto_nivel_usuarios',$coordinaciones->getAlto_nivel_user(),'cd_primer_nivel_usuarios',$coordinaciones->getPrimer_nivel_user());
				//if ($existe==0)
				//{										
					$mensaje = $coordinaciones->EjecutarFunciones("funcion_insertar_coordinaciones('".$coordinaciones->getNombre()."','".$coordinaciones->getCd_unidades()."','".$coordinaciones->getUbicacion()."','".$coordinaciones->getEdificio()."','".$coordinaciones->getPiso()."','".$coordinaciones->getTelefono()."','".$coordinaciones->getObservacion()."','".$coordinaciones->getCd_user()."','".$coordinaciones->getCd_direc_user()."','".$coordinaciones->getAlto_nivel_user()."','".$coordinaciones->getPrimer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
					$_SESSION['estatus_msj']=2;
					$_SESSION['error_coordinaciones']="La Información fue Guardada con Éxito";
			//	}else{
            //  		$_SESSION['estatus_msj']=1;
			//		$_SESSION['error_coordinaciones']="El nombre que esta ingresando ya existe en la lista";
			//		
			//	}
			
			}
		}
		$boton = "Guardar";
	}
    

	$cont = $alto_nivel->Mostrar(0);
	//echo($cant); die;
	if ( $cont != 0 ) 
	{

		//echo $alto_nivel->Mostrar(0); die();
		$_SESSION['cantidad'] = $cont;
	
		//echo $alto_nivel->Mostrar(0); die();
		
		//se crea un arreglo donde se alogen los registros necesarios
    	$campoId=array();
    	$campoNombre=array();
		
		$datosAltoNivel = $alto_nivel->Mostrar(1);
		
		//Carga los registros
    	while ( $row=pg_fetch_array($datosAltoNivel) )
		{ 

			array_push( $campoId , $row["cd_alto_nivel"] );	
			array_push( $campoNombre , $row["nb_alto_nivel"] );				

		}
    				    				
    	//Prepara para la comunicacion
		$_SESSION['campoIdAltoNivel'] = $campoId;
    	$_SESSION['campoNombreAltoNivel'] = $campoNombre;		
		}else 
		{
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_coordinaciones']="No Existen registro en Alto Nivel";
		}
	
	$url_relativa = "../vista/registrar_coordinaciones.php";
	header("Cache-Control: no-cache");
	header("Location: ".$url_relativa);	
	
?>