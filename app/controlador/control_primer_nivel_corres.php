<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_alto_nivel_corres.php");
include_once("../modelo/class_primer_nivel_corres.php");


	$alto_nivel_corres = new alto_nivel_corres();
	$primer_nivel_corres = new primer_nivel_corres();
	
	$primer_nivel_corres->setNombre($_POST['nb_primer_nivel']);
	$primer_nivel_corres->setCd_alto_nivel($_POST['alto_nivel']);
	$primer_nivel_corres->setUbicacion($_POST['ubicacion_primer_nivel']);
	$primer_nivel_corres->setEdificio($_POST['edificio_primer_nivel']);
	$primer_nivel_corres->setPiso($_POST['piso_primer_nivel']);
	$primer_nivel_corres->setTelefono($_POST['telefono_primer_nivel']);
	$primer_nivel_corres->setObservacion($_POST['observacion_primer_nivel']);

 	$primer_nivel_corres->setCd_user($_SESSION['codigo']);
 	$primer_nivel_corres->setCd_direc_user($_SESSION['direcciones_user']);
 	$primer_nivel_corres->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$primer_nivel_corres->setPrimer_nivel_user($_SESSION['primer_nivel_user']);
	
	
 	//datos de alto_nivel
	$alto_nivel_corres->setCd_direc_user($_SESSION['direcciones_user']);
 	$alto_nivel_corres->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$alto_nivel_corres->setPrimer_nivel_user($_SESSION['primer_nivel_user']);
 	
	//valor de modificar o eliminar	
	$primer_nivel_corres->setId(isset($_GET['id'])? $_GET['id'] : "");
	$_SESSION['idd'] = isset($_GET['idd'])? $_GET['idd'] : "";
	
    $boton= $_POST['enviar'];
	$guardar=$_SESSION['boton'];
    $form = isset($_GET['form'])? $_GET['form'] : "insertar";

    
    if ($_POST['regresar']==true)
    {
    	 	unset($_SESSION['nombre_primer_nivel_corres']);
			unset($_SESSION['alto_nivel_seleccionado']);
			unset($_SESSION['nombre_primer_nivel_corres']);
			unset($_SESSION['ubicacion_primer_nivel_corres']);
			unset($_SESSION['edificio_primer_nivel_corres']);
			unset($_SESSION['piso_primer_nivel_corres']);
			unset($_SESSION['telefono_primer_nivel_corres']);
			unset($_SESSION['observacion_primer_nivel_corres']);
			unset($_SESSION['id_primer_nivel_corres']);
			unset($_SESSION['modi']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
    }
    
    
    
    	if ($form == "mod")
	{  
		if ($guardar=="Guardar"|| $guardar=="")
		{
			$existe =$primer_nivel_corres->CargarDatos();
			$_SESSION['boton']="Modificar";	
			$_SESSION['alto_nivel_seleccionado']=$primer_nivel_corres->getCd_alto_nivel();
			$_SESSION['nombre_primer_nivel_corres']=$primer_nivel_corres->getNombre();
			$_SESSION['ubicacion_primer_nivel_corres']=$primer_nivel_corres->getUbicacion();
			$_SESSION['edificio_primer_nivel_corres']=$primer_nivel_corres->getEdificio();
			$_SESSION['piso_primer_nivel_corres']=$primer_nivel_corres->getPiso();
			$_SESSION['telefono_primer_nivel_corres']=$primer_nivel_corres->getTelefono();
			$_SESSION['observacion_primer_nivel_corres']=$primer_nivel_corres->getObservacion();
			$_SESSION['id_primer_nivel_corres']=$primer_nivel_corres->getId();
			$_SESSION['modi']=1;
			$_SESSION['disabled']="disabled";
			
			$url_relativa = "../vista/registrar_primer_nivel_corres.php";
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
		
		$existe=$primer_nivel_corres->Existencia('vista_mostrar_direcciones_corres','cd_primer_nivel_corres',$primer_nivel_corres->getId(),'cd_direcciones_usuarios',$primer_nivel_corres->getCd_direc_user(),'cd_alto_nivel_usuarios',$primer_nivel_corres->getAlto_nivel_user(),'cd_primer_nivel_usuarios',$primer_nivel_corres->getPrimer_nivel_user());
		if($existe){
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_primer_nivel_corres']="Existe informaci&oacute;n asociada a este registro. No puede ser Eliminado";
		$_SESSION['boton']="Guardar";
		}else{
		$mensaje = $primer_nivel_corres->EjecutarFunciones("funcion_eli_primer_nivel_corres(".$primer_nivel_corres->getId().")");
		$_SESSION['estatus_msj']=2;
		$_SESSION['error_primer_nivel_corres']="La Información fue Eliminada con Éxito";
		$_SESSION['boton']="Guardar";		

	}
	}
	else
	{
		if ($boton=="Modificar")
		{ 				
			$primer_nivel_corres->setId($_POST['id_primer_nivel']);
			$primer_nivel_corres->setCd_alto_nivel($_POST['id_alto_nivel']);
			$mensaje = $primer_nivel_corres->EjecutarFunciones("funcion_mod_primer_nivel_corres('".$primer_nivel_corres->getId()."','".$primer_nivel_corres->getNombre()."','".$primer_nivel_corres->getCd_alto_nivel()."','".$primer_nivel_corres->getUbicacion()."','".$primer_nivel_corres->getEdificio()."','".$primer_nivel_corres->getPiso()."','".$primer_nivel_corres->getTelefono()."','".$primer_nivel_corres->getObservacion()."','".$primer_nivel_corres->getCd_user()."','".$primer_nivel_corres->getCd_direc_user()."','".$primer_nivel_corres->getAlto_nivel_user()."','".$primer_nivel_corres->getPrimer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
			$_SESSION['estatus_msj']=2;
			$_SESSION['error_primer_nivel_corres']="La Información fue Modificada con Éxito";
		 	unset($_SESSION['nombre_primer_nivel_corres']);
			unset($_SESSION['alto_nivel_seleccionado']);
			unset($_SESSION['nombre_primer_nivel_corres']);
			unset($_SESSION['ubicacion_primer_nivel_corres']);
			unset($_SESSION['edificio_primer_nivel_corres']);
			unset($_SESSION['piso_primer_nivel_corres']);
			unset($_SESSION['telefono_primer_nivel_corres']);
			unset($_SESSION['observacion_primer_nivel_corres']);
			unset($_SESSION['id_primer_nivel_corres']);
			unset($_SESSION['modi']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
		}
		else
		{
			if($_POST['enviar']=="Guardar")
			{
					$mensaje = $alto_nivel_corres->EjecutarFunciones("funcion_insertar_primer_nivel_corres('".$primer_nivel_corres->getNombre()."','".$primer_nivel_corres->getCd_alto_nivel()."','".$primer_nivel_corres->getUbicacion()."','".$primer_nivel_corres->getEdificio()."','".$primer_nivel_corres->getPiso()."','".$primer_nivel_corres->getTelefono()."','".$primer_nivel_corres->getObservacion()."','".$primer_nivel_corres->getCd_user()."','".$primer_nivel_corres->getCd_direc_user()."','".$primer_nivel_corres->getAlto_nivel_user()."','".$primer_nivel_corres->getPrimer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
					$_SESSION['estatus_msj']=2;
					$_SESSION['error_primer_nivel_corres']="La Información fue Guardada con Éxito";
			}
				
			}
			$boton = "Guardar";
		}
		
	//}
    

	$cont = $alto_nivel_corres->Mostrar(0);
	//echo($cant); die;
	if ( $cont != 0 ) 
	{
		//echo $alto_nivel_corres->Mostrar(0); die();
		$_SESSION['cantidad'] = $cont;
	
		//echo $alto_nivel_corres->Mostrar(0); die();
		
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
		$_SESSION['error_primer_nivel_corres']="No Existen registro en Alto Nivel";
	
	}
	
	$url_relativa = "../vista/registrar_primer_nivel_corres.php";
	header("Cache-Control: no-cache");
	header("Location: ".$url_relativa);	
	
?>