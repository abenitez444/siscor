<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_alto_nivel_corres.php");
include_once("../modelo/class_direcciones_corres.php");


	$alto_nivel_corres = new alto_nivel_corres();
	$direcciones_corres = new direcciones_corres();
	
	$direcciones_corres->setNombre($_POST['nb_direcciones']);
	$direcciones_corres->setCd_alto_nivel($_POST['alto_nivel']);
	$direcciones_corres->setCd_primer_nivel($_POST['primer_nivel']);
	$direcciones_corres->setUbicacion($_POST['ubicacion_direcciones']);
	$direcciones_corres->setEdificio($_POST['edificio_direcciones']);
	$direcciones_corres->setPiso($_POST['piso_direcciones']);
	$direcciones_corres->setTelefono($_POST['telefono_direcciones']);
	$direcciones_corres->setObservacion($_POST['observacion_direcciones']);
	//datos del usuario que esta ingrensando

	$direcciones_corres->setCd_user($_SESSION['codigo']);
	$direcciones_corres->setCd_direc_user($_SESSION['direcciones_user']);
	$direcciones_corres->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$direcciones_corres->setPrimer_nivel_user($_SESSION['primer_nivel_user']);
	
	
 	//datos de alto_nivel_corres
	$alto_nivel_corres->setCd_direc_user($_SESSION['direcciones_user']);
	$alto_nivel_corres->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$alto_nivel_corres->setPrimer_nivel_user($_SESSION['primer_nivel_user']);
 	
	//valor de modificar o eliminar	
	$direcciones_corres->setId(isset($_GET['id'])? $_GET['id'] : "");

	$_SESSION['idd'] = isset($_GET['idd'])? $_GET['idd'] : "";
	
    $boton= $_POST['enviar'];
	$guardar=$_SESSION['boton'];
    $form = isset($_GET['form'])? $_GET['form'] : "insertar";

    
    if ($_POST['regresar']==true){
    	 	unset($_SESSION['nombre_direcciones_corres']);
			unset($_SESSION['alto_nivel_seleccionado']);
			unset($_SESSION['primer_nivel_corres']);
			unset($_SESSION['nombre_primer_nivel_corres']);
			unset($_SESSION['ubicacion_direcciones_corres']);
			unset($_SESSION['edificio_direcciones_corres']);
			unset($_SESSION['piso_direcciones_corres']);
			unset($_SESSION['telefono_direcciones_corres']);
			unset($_SESSION['observacion_direcciones_corres']);
			unset($_SESSION['id_direcciones_corres']);
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
			$existe =$direcciones_corres->CargarDatos();
			$_SESSION['boton']="Modificar";	
			$_SESSION['alto_nivel_seleccionado']=$direcciones_corres->getCd_alto_nivel();
     		$_SESSION['primer_nivel_corres']=$direcciones_corres->getCd_primer_nivel();
     		$_SESSION['nombre_primer_nivel_corres']=$direcciones_corres->getNombre_primer_nivel();
       		$_SESSION['nombre_direcciones_corres']=$direcciones_corres->getNombre();
			$_SESSION['ubicacion_direcciones_corres']=$direcciones_corres->getUbicacion();
			$_SESSION['edificio_direcciones_corres']=$direcciones_corres->getEdificio();
			$_SESSION['piso_direcciones_corres']=$direcciones_corres->getPiso();
			$_SESSION['telefono_direcciones_corres']=$direcciones_corres->getTelefono();
			$_SESSION['observacion_direcciones_corres']=$direcciones_corres->getObservacion();
			$_SESSION['id_direcciones_corres']=$direcciones_corres->getId();
			$_SESSION['modi']=1;
			$_SESSION['disabled']="disabled";
			$url_relativa = "../vista/registrar_direcciones_corres.php";
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
		$existe=$direcciones_corres->Existencia('vista_mostrar_recibidas','cd_direcciones_corres',$direcciones_corres->getId(),'cd_direcciones_usuarios',$direcciones_corres->getCd_direc_user(),'cd_alto_nivel_usuarios',$direcciones_corres->getAlto_nivel_user(),'cd_primer_nivel_usuarios',$direcciones_corres->getPrimer_nivel_user());
		if($existe){
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_direcciones_corres']="Existe informaci&oacute;n asociada a este registro. No puede ser Eliminado";
		$_SESSION['boton']="Guardar";
		}else{
		$mensaje = $direcciones_corres->EjecutarFunciones("funcion_eli_direcciones_corres(".$direcciones_corres->getId().")");
		$_SESSION['estatus_msj']=2;
		$_SESSION['error_direcciones_corres']="La Información fue Eliminada con Éxito";
		$_SESSION['boton']="Guardar";	
		}
	}
	else
	{
		if ($boton=="Modificar")
		{ 				
			$direcciones_corres->setId($_SESSION['id_direcciones_corres']);
			$direcciones_corres->setCd_primer_nivel($_POST['id_primer_nivel']);
			$mensaje = $direcciones_corres->EjecutarFunciones("funcion_mod_direcciones_corres('".$direcciones_corres->getId()."','".$direcciones_corres->getNombre()."','".$direcciones_corres->getCd_primer_nivel()."','".$direcciones_corres->getUbicacion()."','".$direcciones_corres->getEdificio()."','".$direcciones_corres->getPiso()."','".$direcciones_corres->getTelefono()."','".$direcciones_corres->getObservacion()."','".$direcciones_corres->getCd_user()."','".$direcciones_corres->getCd_direc_user()."','".$direcciones_corres->getAlto_nivel_user()."','".$direcciones_corres->getPrimer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
			
			$_SESSION['estatus_msj']=2;
			$_SESSION['error_direcciones_corres']="La Información fue Modificada con Éxito";
		 	unset($_SESSION['nombre_direcciones_corres']);
			unset($_SESSION['alto_nivel_seleccionado']);
			unset($_SESSION['nombre_direcciones_corres']);
			unset($_SESSION['ubicacion_direcciones_corres']);
			unset($_SESSION['edificio_direcciones_corres']);
			unset($_SESSION['piso_direcciones_corres']);
			unset($_SESSION['telefono_direcciones_corres']);
			unset($_SESSION['observacion_direcciones_corres']);
			unset($_SESSION['id_direcciones_corres']);
			unset($_SESSION['primer_nivel_corres']);
			unset($_SESSION['modi']);
			unset($_SESSION['nombre_primer_nivel_corres']);
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
					$mensaje = $direcciones_corres->EjecutarFunciones("funcion_insertar_direcciones_corres('".$direcciones_corres->getNombre()."','".$direcciones_corres->getCd_primer_nivel()."','".$direcciones_corres->getUbicacion()."','".$direcciones_corres->getEdificio()."','".$direcciones_corres->getPiso()."','".$direcciones_corres->getTelefono()."','".$direcciones_corres->getObservacion()."','".$direcciones_corres->getCd_user()."','".$direcciones_corres->getCd_direc_user()."','".$direcciones_corres->getAlto_nivel_user()."','".$direcciones_corres->getPrimer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
					$_SESSION['estatus_msj']=2;
					$_SESSION['error_direcciones_corres']="La Información fue Guardada con Éxito";
			//	}else{
             // 		$_SESSION['estatus_msj']=1;
			//		$_SESSION['error_direcciones']="El nombre que esta ingresando ya existe en la lista";
					
			//	}
				
			}
		}
		$boton = "Guardar";
	}
    

	$cont = $alto_nivel_corres->Mostrar(0);
	//echo($cant); die;
	if ( $cont != 0 ) 
	{
		//echo $alto_nivel->Mostrar(0); die();
		$_SESSION['cantidad'] = $cont;
	
		//echo $alto_nivel->Mostrar(0); die();
		
		//se crea un arreglo donde se alogen los registros necesarios
    	$campoId=array();
    	$campoNombre=array();
		
		$datosAltoNivel = $alto_nivel_corres->Mostrar(1);
		
		//Carga los registros
    	while ( $row=pg_fetch_array($datosAltoNivel) )
		{ 

			array_push( $campoId , $row["cd_alto_nivel_corres"] );	
			array_push( $campoNombre , $row["nb_alto_nivel_corres"] );				

		}
    				    				
    	//Prepara para la comunicacion
		$_SESSION['campoIdAltoNivel'] = $campoId;
    	$_SESSION['campoNombreAltoNivel'] = $campoNombre;		
		}else 
		{
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_direcciones_corres']="No Existen registro en Alto Nivel";
		}
	
	$url_relativa = "../vista/registrar_direcciones_corres.php";
	header("Cache-Control: no-cache");
	header("Location: ".$url_relativa);	
	
?>