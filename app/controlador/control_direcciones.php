<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_alto_nivel.php");
include_once("../modelo/class_direcciones.php");


	$alto_nivel = new alto_nivel();
	$direcciones = new direcciones();
	
	$direcciones->setNombre($_POST['nb_direcciones']);
	$direcciones->setCd_alto_nivel($_POST['alto_nivel']);
	$direcciones->setCd_primer_nivel($_POST['primer_nivel']);
	$direcciones->setUbicacion($_POST['ubicacion_direcciones']);
	$direcciones->setEdificio($_POST['edificio_direcciones']);
	$direcciones->setPiso($_POST['piso_direcciones']);
	$direcciones->setTelefono($_POST['telefono_direcciones']);
	$direcciones->setObservacion($_POST['observacion_direcciones']);
	//datos del usuario que esta ingrensando

	$direcciones->setCd_user($_SESSION['codigo']);
	$direcciones->setCd_direc_user($_SESSION['direcciones_user']);
	$direcciones->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$direcciones->setPrimer_nivel_user($_SESSION['primer_nivel_user']);
	
	
 	//datos de alto_nivel
	$alto_nivel->setCd_direc_user($_SESSION['direcciones_user']);
	$alto_nivel->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$alto_nivel->setPrimer_nivel_user($_SESSION['primer_nivel_user']);
 	
	//valor de modificar o eliminar	
	$direcciones->setId(isset($_GET['id'])? $_GET['id'] : "");

	$_SESSION['idd'] = isset($_GET['idd'])? $_GET['idd'] : "";
	
    $boton= $_POST['enviar'];
	$guardar=$_SESSION['boton'];
    $form = isset($_GET['form'])? $_GET['form'] : "insertar";

    
    if ($_POST['regresar']==true){
    	 	unset($_SESSION['nombre_direcciones']);
			unset($_SESSION['alto_nivel_seleccionado']);
			unset($_SESSION['primer_nivel']);
			unset($_SESSION['nombre_direcciones']);
			unset($_SESSION['ubicacion_direcciones']);
			unset($_SESSION['edificio_direcciones']);
			unset($_SESSION['piso_direcciones']);
			unset($_SESSION['telefono_direcciones']);
			unset($_SESSION['observacion_direcciones']);
			unset($_SESSION['id_direcciones']);
			unset($_SESSION['nombre_primer_nivel']);
			unset($_SESSION['modi']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
    }
    	if ($form == "mod")
	{ 
		
		if ($guardar=="Guardar" || $guardar=="")
		{
			$existe =$direcciones->CargarDatos();
			$_SESSION['boton']="Modificar";	
			$_SESSION['alto_nivel_seleccionado']=$direcciones->getCd_alto_nivel();
     		$_SESSION['primer_nivel']=$direcciones->getCd_primer_nivel();
     		$_SESSION['nombre_primer_nivel']=$direcciones->getNombre_primer_nivel();
       		$_SESSION['nombre_direcciones']=$direcciones->getNombre();
			$_SESSION['ubicacion_direcciones']=$direcciones->getUbicacion();
			$_SESSION['edificio_direcciones']=$direcciones->getEdificio();
			$_SESSION['piso_direcciones']=$direcciones->getPiso();
			$_SESSION['telefono_direcciones']=$direcciones->getTelefono();
			$_SESSION['observacion_direcciones']=$direcciones->getObservacion();
			$_SESSION['id_direcciones']=$direcciones->getId();
			$_SESSION['modi']=1;
			$_SESSION['disabled']="disabled";
			$url_relativa = "../vista/registrar_direcciones.php";
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
		$existe=$direcciones->Existencia('vista_mostrar_unidades','cd_direcciones',$direcciones->getId(),'cd_direcciones_usuarios',$direcciones->getCd_direc_user(),'cd_alto_nivel_usuarios',$direcciones->getAlto_nivel_user(),'cd_primer_nivel_usuarios',$direcciones->getPrimer_nivel_user());
		if($existe){
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_direcciones']="Existe informaci&oacute;n asociada a este registro. No puede ser Eliminado";
		$_SESSION['boton']="Guardar";
		}else{
		$mensaje = $direcciones->EjecutarFunciones("funcion_eli_direcciones(".$direcciones->getId().")");
		$_SESSION['estatus_msj']=2;
		$_SESSION['error_direcciones']="La Información fue Eliminada con Éxito";
		$_SESSION['boton']="Guardar";	
		}
	}
	else
	{
		if ($boton=="Modificar")
		{ 				
			$direcciones->setId($_SESSION['id_direcciones']);
			$direcciones->setCd_primer_nivel($_POST['id_primer_nivel']);
			$mensaje = $direcciones->EjecutarFunciones("funcion_mod_direcciones('".$direcciones->getId()."','".$direcciones->getNombre()."','".$direcciones->getCd_primer_nivel()."','".$direcciones->getUbicacion()."','".$direcciones->getEdificio()."','".$direcciones->getPiso()."','".$direcciones->getTelefono()."','".$direcciones->getObservacion()."','".$direcciones->getCd_user()."','".$direcciones->getCd_direc_user()."','".$direcciones->getAlto_nivel_user()."','".$direcciones->getPrimer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
			
			$_SESSION['estatus_msj']=2;
			$_SESSION['error_direcciones']="La Información fue Modificada con Éxito";
		 	unset($_SESSION['nombre_direcciones']);
			unset($_SESSION['alto_nivel_seleccionado']);
			unset($_SESSION['nombre_direcciones']);
			unset($_SESSION['ubicacion_direcciones']);
			unset($_SESSION['edificio_direcciones']);
			unset($_SESSION['piso_direcciones']);
			unset($_SESSION['telefono_direcciones']);
			unset($_SESSION['observacion_direcciones']);
			unset($_SESSION['id_direcciones']);
			unset($_SESSION['primer_nivel']);
			unset($_SESSION['modi']);
			unset($_SESSION['nombre_primer_nivel']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
		}
		else
		{
			if($_POST['enviar']=="Guardar")
			{
				//$existe =$direcciones->Existencia('vista_mostrar_direcciones','nb_direcciones',$direcciones->getNombre(),'cd_direcciones_usuarios',$direcciones->getCd_direc_user(),'cd_alto_nivel_usuarios',$direcciones->getAlto_nivel_user(),'cd_primer_nivel_usuarios',$direcciones->getPrimer_nivel_user());
				
				//if ($existe==0)
				//{										
					$mensaje = $direcciones->EjecutarFunciones("funcion_insertar_direcciones('".$direcciones->getNombre()."','".$direcciones->getCd_primer_nivel()."','".$direcciones->getUbicacion()."','".$direcciones->getEdificio()."','".$direcciones->getPiso()."','".$direcciones->getTelefono()."','".$direcciones->getObservacion()."','".$direcciones->getCd_user()."','".$direcciones->getCd_direc_user()."','".$direcciones->getAlto_nivel_user()."','".$direcciones->getPrimer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
					$_SESSION['estatus_msj']=2;
					$_SESSION['error_direcciones']="La Información fue Guardada con Éxito";
			//	}else{
             // 		$_SESSION['estatus_msj']=1;
			//		$_SESSION['error_direcciones']="El nombre que esta ingresando ya existe en la lista";
					
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
		$_SESSION['error_direcciones']="No Existen registro en Alto Nivel";
		}
	
	$url_relativa = "../vista/registrar_direcciones.php";
	header("Cache-Control: no-cache");
	header("Location: ".$url_relativa);	
	
?>