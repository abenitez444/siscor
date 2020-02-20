<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_alto_nivel.php");
include_once("../modelo/class_primer_nivel.php");


	$alto_nivel = new alto_nivel();
	$primer_nivel = new primer_nivel();
	
	$primer_nivel->setNombre($_POST['nb_primer_nivel']);

	$primer_nivel->setCd_alto_nivel($_POST['alto_nivel']);
	$primer_nivel->setId_aux($_POST['primer_nivel']);

	$primer_nivel->setUbicacion($_POST['ubicacion_primer_nivel']);
	$primer_nivel->setEdificio($_POST['edificio_primer_nivel']);
	$primer_nivel->setPiso($_POST['piso_primer_nivel']);
	$primer_nivel->setTelefono($_POST['telefono_primer_nivel']);
	$primer_nivel->setObservacion($_POST['observacion_primer_nivel']);
	//datos del usuario que esta ingrensando
 	$primer_nivel->setCd_user($_SESSION['codigo']);
 	$primer_nivel->setCd_direc_user($_SESSION['direcciones_user']);
 	$primer_nivel->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$primer_nivel->setPrimer_nivel_user($_SESSION['primer_nivel_user']);
	
	
 	//datos de alto_nivel
	$alto_nivel->setCd_direc_user($_SESSION['direcciones_user']);
 	$alto_nivel->setAlto_nivel_user($_SESSION['alto_nivel_user']);
	$alto_nivel->setPrimer_nivel_user($_SESSION['primer_nivel_user']);
 	
	//valor de modificar o eliminar	
	$primer_nivel->setId(isset($_GET['id'])? $_GET['id'] : "");
	$_SESSION['idd'] = isset($_GET['idd'])? $_GET['idd'] : "";
	$_SESSION['pn'] = isset($_GET['pn'])? $_GET['pn'] : "";
	$boton= $_POST['enviar'];
	$guardar=$_SESSION['boton'];
    $form = isset($_GET['form'])? $_GET['form'] : "insertar";

    
    if ($_POST['regresar']==true)
    {
    	 	unset($_SESSION['nombre_primer_nivel']);
			unset($_SESSION['alto_nivel_seleccionado']);
			unset($_SESSION['primer_nivel_seleccionado']);
			unset($_SESSION['nombre_primer_nivel']);
			unset($_SESSION['ubicacion_primer_nivel']);
			unset($_SESSION['edificio_primer_nivel']);
			unset($_SESSION['piso_primer_nivel']);
			unset($_SESSION['telefono_primer_nivel']);
			unset($_SESSION['observacion_primer_nivel']);
			unset($_SESSION['id_primer_nivel']);
			unset($_SESSION['modi']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
    }
    
    
    
    if ($form == "mod")
	{  
		if ($guardar=="Guardar"|| $guardar=="")
		{
			
			$existe =$primer_nivel->CargarDatos();
			$_SESSION['boton']="Modificar";	
			$_SESSION['alto_nivel_seleccionado']=$primer_nivel->getCd_alto_nivel();
			$_SESSION['primer_nivel_seleccionado']=$primer_nivel->getId_aux();
			$_SESSION['nombre_primer_nivel']=$primer_nivel->getNombre();
			$_SESSION['ubicacion_primer_nivel']=$primer_nivel->getUbicacion();
			$_SESSION['edificio_primer_nivel']=$primer_nivel->getEdificio();
			$_SESSION['piso_primer_nivel']=$primer_nivel->getPiso();
			$_SESSION['telefono_primer_nivel']=$primer_nivel->getTelefono();
			$_SESSION['observacion_primer_nivel']=$primer_nivel->getObservacion();
			$_SESSION['id_primer_nivel']=$primer_nivel->getId();
			$_SESSION['modi']=1;
			$_SESSION['disabled']="disabled";

			$tabla= "vista_mostrar_primer_nivel";
			$orden="nb_primer_nivel";
			$pn=$primer_nivel->getId();
			$an=$_SESSION['alto_nivel_seleccionado'];
			
		    $campoId=array();
		    $campoNombre=array();
			$datos = $primer_nivel->Mostrar_primer_nivel(1,$tabla,$an,$pn,$orden);
			//Carga los registros
			    while ( $row=pg_fetch_array($datos) )
				{ 
					array_push( $campoId , $row["cd_primer_nivel"] );	
					array_push( $campoNombre , $row["nb_primer_nivel"] );				
				}
		    //Prepara para la comunicacion
			$_SESSION['campoIdPrimerNivel'] = $campoId;
		    $_SESSION['campoNombrePrimerNivel'] = $campoNombre;		
			

			$url_relativa = "../vista/registrar_primer_nivel.php";
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
	else if($form == "eli")
	{
		
		$existe=$primer_nivel->Existencia('vista_mostrar_direcciones','cd_primer_nivel',$primer_nivel->getId(),'cd_direcciones_usuarios',$primer_nivel->getCd_direc_user(),'cd_alto_nivel_usuarios',$primer_nivel->getAlto_nivel_user(),'cd_primer_nivel_usuarios',$primer_nivel->getPrimer_nivel_user());
		if($existe){
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_primer_nivel']="Existe informaci&oacute;n asociada a este registro. No puede ser Eliminado";
		$_SESSION['boton']="Guardar";
		}else{
		$mensaje = $primer_nivel->EjecutarFunciones("funcion_eli_primer_nivel(".$primer_nivel->getId().")");
		$_SESSION['estatus_msj']=2;
		$_SESSION['error_primer_nivel']="La Información fue Eliminada con Éxito";
		$_SESSION['boton']="Guardar";		

	}
	}
	else
	{
		if ($boton=="Modificar")
		{ 				
			$primer_nivel->setId($_POST['id_primer_nivel']);
			$primer_nivel->setCd_alto_nivel($_POST['id_alto_nivel']);
			$mensaje = $primer_nivel->EjecutarFunciones("funcion_mod_primer_nivel('".$primer_nivel->getId()."','".$primer_nivel->getNombre()."','".$primer_nivel->getCd_alto_nivel()."','".$primer_nivel->getUbicacion()."','".$primer_nivel->getEdificio()."','".$primer_nivel->getPiso()."','".$primer_nivel->getTelefono()."','".$primer_nivel->getObservacion()."','".$primer_nivel->getCd_user()."','".$primer_nivel->getCd_direc_user()."','".$primer_nivel->getAlto_nivel_user()."','".$primer_nivel->getPrimer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
			$_SESSION['estatus_msj']=2;
			$_SESSION['error_primer_nivel']="La Información fue Modificada con Éxito";
		 	unset($_SESSION['nombre_primer_nivel']);
			unset($_SESSION['alto_nivel_seleccionado']);
			unset($_SESSION['primer_nivel_seleccionado']);
			unset($_SESSION['nombre_primer_nivel']);
			unset($_SESSION['ubicacion_primer_nivel']);
			unset($_SESSION['edificio_primer_nivel']);
			unset($_SESSION['piso_primer_nivel']);
			unset($_SESSION['telefono_primer_nivel']);
			unset($_SESSION['observacion_primer_nivel']);
			unset($_SESSION['id_primer_nivel']);
			unset($_SESSION['modi']);
			$_SESSION['boton']="Guardar";
			$_SESSION['modi']=0;
			unset($_SESSION['disabled']);
		}
		else
		{
			if($_POST['enviar']=="Guardar")
			{
				
				//$existe =$alto_nivel->Existencia('vista_mostrar_primer_nivel','nb_primer_nivel',$primer_nivel->getNombre(),'cd_direcciones_usuarios',$primer_nivel->getCd_direc_user(),'cd_alto_nivel_usuarios',$primer_nivel->getAlto_nivel_user(),'cd_primer_nivel_usuarios',$alto_nivel->getPrimer_nivel_user());
			//	if ($existe==0)
			//	{										
					$mensaje = $alto_nivel->EjecutarFunciones("funcion_insertar_primer_nivel('".$primer_nivel->getNombre()."','".$primer_nivel->getId_aux()."','".$primer_nivel->getCd_alto_nivel()."','".$primer_nivel->getUbicacion()."','".$primer_nivel->getEdificio()."','".$primer_nivel->getPiso()."','".$primer_nivel->getTelefono()."','".$primer_nivel->getObservacion()."','".$primer_nivel->getCd_user()."','".$primer_nivel->getCd_direc_user()."','".$primer_nivel->getAlto_nivel_user()."','".$primer_nivel->getPrimer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
					$_SESSION['estatus_msj']=2;
					$_SESSION['error_primer_nivel']="La Información fue Guardada con Éxito";
		//		}else{
        //      		$_SESSION['estatus_msj']=1;
		//			$_SESSION['error_primer_nivel']="El nombre que esta ingresando ya existe en la lista";
					
				}
				
			}
			$boton = "Guardar";
		}
		
	//}
    

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
		$_SESSION['error_primer_nivel']="No Existen registro en Alto Nivel";
	}
	
	$url_relativa = "../vista/registrar_primer_nivel.php";
	header("Cache-Control: no-cache");
	header("Location: ".$url_relativa);	
	
?>