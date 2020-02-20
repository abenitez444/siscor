<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_alto_nivel.php");
include_once("../modelo/class_unidades.php");


	$alto_nivel = new alto_nivel();
	$unidades = new unidades();
	
	$unidades->setNombre($_POST['nb_unidades']);
	
	$unidades->setCd_alto_nivel($_POST['alto_nivel']);
	$unidades->setCd_primer_nivel($_POST['primer_nivel']);
	$unidades->setCd_direcciones($_POST['direcciones_consul']);
	$unidades->setUbicacion($_POST['ubicacion_unidades']);
	$unidades->setEdificio($_POST['edificio_unidades']);
	$unidades->setPiso($_POST['piso_unidades']);
	$unidades->setTelefono($_POST['telefono_unidades']);
	$unidades->setObservacion($_POST['observacion_unidades']);
	//datos del usuario que esta ingrensando

	$unidades->setCd_user($_SESSION['codigo']);
	$unidades->setCd_direc_user($_SESSION['direcciones_user']);
	$unidades->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$unidades->setPrimer_nivel_user($_SESSION['primer_nivel_user']);
	
	
 	//datos de alto_nivel
	$alto_nivel->setCd_direc_user($_SESSION['direcciones_user']);
	$alto_nivel->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$alto_nivel->setPrimer_nivel_user($_SESSION['primer_nivel_user']);
 	
	//valor de modificar o eliminar	
	$unidades->setId(isset($_GET['id'])? $_GET['id'] : "");

	$_SESSION['idd'] = isset($_GET['idd'])? $_GET['idd'] : "";
	
    $boton= $_POST['enviar'];
	$guardar=$_SESSION['boton'];
    $form = isset($_GET['form'])? $_GET['form'] : "insertar";

    
    if ($_POST['regresar']==true){
    	 	unset($_SESSION['nombre_unidades']);
			unset($_SESSION['alto_nivel_seleccionado']);
			unset($_SESSION['primer_nivel']);
			unset($_SESSION['ubicacion_unidades']);
			unset($_SESSION['edificio_unidades']);
			unset($_SESSION['piso_unidades']);
			unset($_SESSION['telefono_unidades']);
			unset($_SESSION['observacion_unidades']);
			unset($_SESSION['id_unidades']);
			unset($_SESSION['nombre_primer_nivel']);
			unset($_SESSION['direcciones']);
			unset($_SESSION['nombre_direcciones']);
			unset($_SESSION['modi']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
    }
    	if ($form == "mod")
	{ 
		
		if ($guardar=="Guardar" || $guardar=="")
		{
			$existe =$unidades->CargarDatos();
			$_SESSION['boton']="Modificar";	
			$_SESSION['alto_nivel_seleccionado']=$unidades->getCd_alto_nivel();
     		$_SESSION['primer_nivel']=$unidades->getCd_primer_nivel();
     		$_SESSION['nombre_primer_nivel']=$unidades->getNombre_primer_nivel();
       		$_SESSION['nombre_unidades']=$unidades->getNombre();
			$_SESSION['ubicacion_unidades']=$unidades->getUbicacion();
			$_SESSION['edificio_unidades']=$unidades->getEdificio();
			$_SESSION['piso_unidades']=$unidades->getPiso();
			$_SESSION['telefono_unidades']=$unidades->getTelefono();
			$_SESSION['observacion_unidades']=$unidades->getObservacion();
			$_SESSION['id_unidades']=$unidades->getId();
			$_SESSION['direcciones']=$unidades->getCd_direcciones();
			$_SESSION['nombre_direcciones']=$unidades->getNombre_direcciones();
			$_SESSION['modi']=1;
			$_SESSION['disabled']="disabled";
			$url_relativa = "../vista/registrar_unidades.php";
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
		$existe=$unidades->Existencia('vista_mostrar_coordinaciones','cd_unidades',$unidades->getId(),'cd_direcciones_usuarios',$unidades->getCd_direc_user(),'cd_alto_nivel_usuarios',$unidades->getAlto_nivel_user(),'cd_primer_nivel_usuarios',$unidades->getPrimer_nivel_user());
		if($existe){
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_unidades']="Existe informaci&oacute;n asociada a este registro. No puede ser Eliminado";
		$_SESSION['boton']="Guardar";
		}else{
		$mensaje = $unidades->EjecutarFunciones("funcion_eli_unidades(".$unidades->getId().")");
		$_SESSION['estatus_msj']=2;
		$_SESSION['error_unidades']="La Información fue Eliminada con Éxito";
		$_SESSION['boton']="Guardar";	
		}
	}
	else
	{
		if ($boton=="Modificar")
		{ 				
			$unidades->setId($_SESSION['id_unidades']);
			$unidades->setCd_direcciones($_POST['id_direcciones']);
			$mensaje = $unidades->EjecutarFunciones("funcion_mod_unidades('".$unidades->getId()."','".$unidades->getNombre()."','".$unidades->getCd_direcciones()."','".$unidades->getUbicacion()."','".$unidades->getEdificio()."','".$unidades->getPiso()."','".$unidades->getTelefono()."','".$unidades->getObservacion()."','".$unidades->getCd_user()."','".$unidades->getCd_direc_user()."','".$unidades->getAlto_nivel_user()."','".$unidades->getPrimer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
			$_SESSION['estatus_msj']=2;
			$_SESSION['error_unidades']="La Información fue Modificada con Éxito";
		 	unset($_SESSION['nombre_unidades']);
			unset($_SESSION['alto_nivel_seleccionado']);
			unset($_SESSION['ubicacion_unidades']);
			unset($_SESSION['edificio_unidades']);
			unset($_SESSION['piso_unidades']);
			unset($_SESSION['telefono_unidades']);
			unset($_SESSION['observacion_unidades']);
			unset($_SESSION['id_unidades']);
			unset($_SESSION['primer_nivel']);
			unset($_SESSION['direcciones']);
			unset($_SESSION['nombre_direcciones']);
			unset($_SESSION['modi']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
		}
		else
		{
			if($_POST['enviar']=="Guardar")
			{										
					$mensaje = $unidades->EjecutarFunciones("funcion_insertar_unidades('".$unidades->getNombre()."','".$unidades->getCd_direcciones()."','".$unidades->getUbicacion()."','".$unidades->getEdificio()."','".$unidades->getPiso()."','".$unidades->getTelefono()."','".$unidades->getObservacion()."','".$unidades->getCd_user()."','".$unidades->getCd_direc_user()."','".$unidades->getAlto_nivel_user()."','".$unidades->getPrimer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
					$_SESSION['estatus_msj']=2;
					$_SESSION['error_unidades']="La Información fue Guardada con Éxito";		
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
		$_SESSION['error_unidades']="No Existen registro en Alto Nivel";
		}
	
	$url_relativa = "../vista/registrar_unidades.php";
	header("Cache-Control: no-cache");
	header("Location: ".$url_relativa);	
	
?>