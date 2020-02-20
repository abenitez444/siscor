<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_remisiones.php");
include_once("../modelo/class_recibidas.php");
include_once("../modelo/class_respuesta_remisiones.php"); 
include_once("../modelo/class_modulosxusuarios.php");


if ($_SESSION['modif']==1)
{
	$sw_guardar=0;
}

if($_SESSION['perfil']==1)
{
	$sw_guardar=1;
}


	$Remisiones = new Remisiones();
   	$Modulosxusuarios = new Modulosxusuarios();
   		
	$Remisiones->setId_usuario($_SESSION['codigo']);
	$Remisiones->setId_direcciones_user($_SESSION['direcciones_user']);
	$Remisiones->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$Remisiones->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
	$Remisiones->setPerfil($_SESSION['perfil']);
	
	$permiso =$Modulosxusuarios->Existe($Remisiones->getId_usuario(),'in_ingresar',"TRUE",6);
	

	if ($_SESSION['perfil']==1 )////////********************************************************************** inicio Guardar
   	{
   		if ($sw_guardar==1)
		{   		
   			if ($permiso==1)
   			{
				   		
				if($_POST['guardar']==true)
				{   //se chequea que exista el numero de correlativo de la correspondencia recibida
					$Remisiones->setAnio_recibidas($_POST['anio_remitir']);
					$Remisiones->setId_recibidas($_POST['id_remitir']);
					$parametro= "nu_ano_recibidas=".$Remisiones->getAnio_recibidas()." and cd_recibidas=".$Remisiones->getId_recibidas() ;
					//die($parametro);
					$orden="cd_recibidas";
					$tabla= "vista_mostrar_recibidas";
					$cont = $Remisiones->MostrarConsulta(0,$tabla,$parametro,$orden);
			
				if ( $cont != 0 ) 
				{	
			
					$selectunidades=$_POST['todos'];
				
					if(	$selectunidades!="on")
					{ 
						
						$Remisiones->setDirecciones($_SESSION['direcciones_user']);
						if($Remisiones->getDirecciones()==0)
						{
							$Remisiones->setDirecciones($_POST['direcciones']);
						}
						
						
						$Remisiones->setUnidad($_POST['unidades']);
						if($Remisiones->getUnidad()=="")
						{
							$Remisiones->setUnidad(0);
						}						
						
						
						
						
						
						//$Remisiones->setDirecciones($_POST['direcciones']);	
						
						if($Remisiones->getDirecciones()==0)
						{
							if($Remisiones->getId_primer_nivel_user()!= $_POST['primer_nivel'])
							{
								
								$Remisiones->setPrimer_nivel($_POST['primer_nivel']);
							}
							else
							{
								
								$Remisiones->setPrimer_nivel($_SESSION['primer_nivel_user']);	
							}	
						}
						else
						{
								$Remisiones->setPrimer_nivel($_SESSION['primer_nivel_user']);
						}
						
						
						$parametro= "nu_ano_recibidas=".$Remisiones->getAnio_recibidas()." and cd_recibidas=".$Remisiones->getId_recibidas()." and cd_primer_nivel=".$Remisiones->getPrimer_nivel()." and cd_direcciones=".$Remisiones->getDirecciones()." and cd_unidades=".$Remisiones->getUnidad();
												
						$orden="cd_recibidas";
						$tabla= "vista_mostrar_remisiones";
						$existe = $Remisiones->MostrarConsulta(0,$tabla,$parametro,$orden);		
	
					}
			
					if ( $existe ==0 )
					{
						$Remisiones->setAnio_remision(date("Y"));
						$Remisiones->setFeremision($_POST['fecha_remision']);
						$Remisiones->setHora($_POST['hora']);
						$Remisiones->setMinuto($_POST['minuto']);
						$Remisiones->setTiempo($_POST['tiempo']);	
						$Remisiones->setAlto_nivel($_SESSION['alto_nivel_user']);
						//$Remisiones->setPrimer_nivel($_SESSION['primer_nivel']);
						
						
						if($Remisiones->getDirecciones()==""){
							$Remisiones->setDirecciones($_POST['direcciones']);
						}
											
						$selectunidades=$_POST['todos'];
						if(	$selectunidades=="on")
						{
							$todos=1;
						}
						else
						{
							
							$Remisiones->setUnidad($_POST['unidades']);
							if ($Remisiones->getUnidad()==""){
								$Remisiones->setUnidad(0);
							}
						}
							$Remisiones->setCoordinaciones($_POST['coordinaciones']);
						if ($Remisiones->getCoordinaciones=="")
						{
							$Remisiones->setCoordinaciones(0);
						}
							$Remisiones->setResponsable($_POST['nombre_responsable']);
							$Remisiones->setPrioridad($_POST['prioridades']);
							$Remisiones->setAcciones($_POST['acciones']);
							$Remisiones->setAmerita_remisiones($_POST['amerita_respuesta']);
						if(	$Remisiones->getAmerita_remisiones()=="on")
						{
							$Remisiones->setAmerita_remisiones("true");
						}
						else
						{
							$Remisiones->setAmerita_remisiones("false");
						}
							$Remisiones->setObservaciones($_POST['observacion']);
							$Remisiones->setCheck_respondida_remision($_POST['check_respondida']);
						if(	$Remisiones->getCheck_respondida_remision=="on")
						{
							$Remisiones->setCheck_respondida_remision("true");
							$Remisiones->setRespondida_remision($_POST['respondida_observacion']);
						}
						else
						{
							$Remisiones->setCheck_respondida_remision("false");
							$Remisiones->setRespondida_remision($_POST['respondida_observacion']);
						}
							$Remisiones->setId_recibidas($_POST['id_remitir']);
							$Remisiones->setAnio_recibidas($_POST['anio_remitir']);
							$Remisiones->setHora($_POST['hora']);
							$Remisiones->setMinuto($_POST['minuto']);
							$Remisiones->setTiempo($_POST['tiempo']);
							
							//consulta para saber el numero del contador de las remisiones
							$tabla= "vista_mostrar_remisiones";
							$orden="cd_remisiones";		
							$sw=1;
							$cont = $Remisiones->MostrarGuardar(0,$tabla,$orden,$sw);
							
							$cont=$Remisiones->getId();
						if ( $cont == 0 ) 
						{
							$cont="1";
						}
						else	
						{
							$cont="$cont"+"1";
						}
						
							
							
						if( $todos == 1 )
						{
							die("tosdas".$todos);
							//echo $Remisiones->getId_recibidas();
							$tabla='vista_mostrar_unidades';
							$orden="cd_unidades";
							$where="where cd_direcciones=".$_SESSION['direcciones_user']."";
							//se crea un arreglo donde se alogen los registros necesarios
							$campoId=array();
							$datos = $Remisiones->MostrarUnidades(1,$tabla,$orden,$where);
								//Carga los registros
							while ( $row=pg_fetch_array($datos) )
							{ 
								array_push( $campoId , $row["cd_unidades"] );			
							}
						    	//Prepara para la comunicacion
								//$_SESSION['campoIdTodasUnidades'] = $campoId;	
				
							$cuenta=0;
							for ($index = 0; $index < sizeof($campoId); $index++) 
							{    	
								if ($cuenta==0)
					            {
					            	$cuenta=1;
					            }
					            else
					            {
					            	$cont="$cont"+"1";            	            	
					            }
					            	$fecha_cart=$Remisiones->arregla_fecha($Remisiones->getFeremision());
									$mensaje = $Remisiones->EjecutarFunciones("funcion_insertar_remisiones('".$cont."','".$fecha_cart."','".$Remisiones->getId_recibidas()."','".$Remisiones->getAnio_remision()."','".$Remisiones->getAnio_recibidas()."','".$Remisiones->getId_direcciones_user()."','".$Remisiones->getAlto_nivel()."','".$Remisiones->getPrimer_nivel()."','".$Remisiones->getDirecciones()."','".$campoId[$index]."','".$Remisiones->getCoordinaciones()."','".$Remisiones->getResponsable()."','".$Remisiones->getPrioridad()."','".$Remisiones->getAcciones()."','".$Remisiones->getAmerita_remisiones()."','".$Remisiones->getObservaciones()."','".$Remisiones->getCheck_respondida_remision()."','".$Remisiones->getRespondida_remision()."','".$Remisiones->getId_usuario()."','".$Remisiones->getId_alto_nivel_user()."','".$Remisiones->getId_primer_nivel_user()."','".$Remisiones->getHora()."','".$Remisiones->getMinuto()."','".$Remisiones->getTiempo()."','".$_SERVER["REMOTE_ADDR"]."')");		
								} 
							}
						else
						{
								    $fecha_cart=$Remisiones->arregla_fecha($Remisiones->getFeremision());
									$mensaje = $Remisiones->EjecutarFunciones("funcion_insertar_remisiones('".$cont."','".$fecha_cart."','".$Remisiones->getId_recibidas()."','".$Remisiones->getAnio_remision()."','".$Remisiones->getAnio_recibidas()."','".$Remisiones->getId_direcciones_user()."','".$Remisiones->getAlto_nivel()."','".$Remisiones->getPrimer_nivel()."','".$Remisiones->getDirecciones()."','".$Remisiones->getUnidad()."','".$Remisiones->getCoordinaciones()."','".$Remisiones->getResponsable()."','".$Remisiones->getPrioridad()."','".$Remisiones->getAcciones()."','".$Remisiones->getAmerita_remisiones()."','".$Remisiones->getObservaciones()."','".$Remisiones->getCheck_respondida_remision()."','".$Remisiones->getRespondida_remision()."','".$Remisiones->getId_usuario()."','".$Remisiones->getId_alto_nivel_user()."','".$Remisiones->getId_primer_nivel_user()."','".$Remisiones->getHora()."','".$Remisiones->getMinuto()."','".$Remisiones->getTiempo()."','".$_SERVER["REMOTE_ADDR"]."')");
									
						}                         									
					$_SESSION['estatus_msj']=2;
					$_SESSION['error_remisiones']="La Información fue Guardada con Éxito";
					$_SESSION['correlativo']= "Número de Correlativo Generado: " . $cont ;
					
				}
				else
				{
					$_SESSION['estatus_msj']=1;
					$_SESSION['error_remisiones']="La remisi&oacute;n que intenta agregar, ya se le asign&oacute;";
					$url_relativa = "siscor/controlador/control_remisiones.php";
				    header("Cache-Control: no-cache");
					header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
					exit;
				
				}
				}	
				else
				{
					$_SESSION['estatus_msj']=1;
					$_SESSION['error_remisiones']="El N&uacute;mero de Correlativo de la Asignaci&oacute;n no existe";
					$url_relativa = "siscor/controlador/control_remisiones.php";
				    header("Cache-Control: no-cache");
					header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
					exit;
				}
					
					
					
				}
   			}

   }

   }
   else
   {
   if ($_SESSION['modif']!=1)
   {
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_autorizacion']="Usted no esta autorizado para realizar esta acción";	
		$url_relativa = "siscor/vista/menu_principal.php";
		header("Cache-Control: no-cache");
		header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
		exit;
  }
  }
     //*********************************************************************************************************************fin de guardar




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////modificar
if($_POST['modificar']==true)
{

	if($_SESSION['perfil']==1)
	{
			
		$Remisiones->setAlto_nivel($_SESSION['alto_nivel_seleccionado_remision']);
		
			if($Remisiones->getAlto_nivel()=="")
			{
				$Remisiones->setAlto_nivel($_SESSION['alto_nivel_user']);
			}
		
		
		$Remisiones->setPrimer_nivel($_POST['primer_nivel']);
		
		
		
		if ($Remisiones->getPrimer_nivel()=="")
		{
			$Remisiones->setPrimer_nivel($_SESSION['primer_nivel_user']);
			
		}
		
		//die($Remisiones->getPrimer_nivel());
		$Remisiones->setDirecciones($_POST['direcciones']);
		
		if($Remisiones->getDirecciones()=="")
		{
		   $Remisiones->setDirecciones($_SESSION['direcciones_user']);
		}
		//die($Remisiones->getDirecciones());
		
		$Remisiones->setUnidad($_POST['unidades']);
		
		if ($Remisiones->getUnidad()=="")
		{
			$Remisiones->setUnidad(0);
		}
		
		$Remisiones->setId_recibidas($_POST['id_remitir']);
		$Remisiones->setAnio_recibidas($_POST['anio_remitir']);		
		$parametro= "nu_ano_recibidas=".$Remisiones->getAnio_recibidas()." and cd_recibidas=".$Remisiones->getId_recibidas()." and cd_unidades=".$Remisiones->getUnidad()." and cd_alto_nivel=".$Remisiones->getAlto_nivel()." and cd_primer_nivel=".$Remisiones->getPrimer_nivel()." and cd_direcciones=".$Remisiones->getDirecciones()."";
		//die($parametro);
		$orden="cd_recibidas";
		$tabla= "vista_mostrar_remisiones";
		$existe = $Remisiones->MostrarConsulta(0,$tabla,$parametro,$orden);		

	if ( $existe ==1 )
	{ 
	
		$Remisiones->CargarDatosRemisionesRecibidas();
		
		//die($Remisiones->getId()." id  ".$_SESSION['id_remisiones']);
		if($Remisiones->getId()==$_SESSION['id_remisiones'])
		{
			$existe=0;
		}
		else
		{

			$Remisiones->setAnio_recibidas($_POST['anio_remitir']);
			$Remisiones->setId_recibidas($_POST['id_remitir']);
			$_SESSION['fecha_remision_carga']=($_POST['fecha_remision']);
			$_SESSION['hora_remision']=($_POST['hora']);
			$_SESSION['minuto_remision']=($_POST['minuto']);
			$_SESSION['tiempo_remision']=($_POST['tiempo']);
			$_SESSION['alto_nivel_seleccionado_remision']=($_POST['alto_nivel']);
			$_SESSION['primer_nivel_seleccionado_remision']=($_POST['primer_nivel']);
			$_SESSION['direcciones_seleccionado_remision']=($_POST['direcciones']);
			$_SESSION['Unidades_seleccionado_remision']=($_POST['unidades']);
			$_SESSION['check_t']=$_POST['todos'];
			$_SESSION['Coordinaciones_seleccionado_remision']=($_POST['coordinaciones']);
			$_SESSION['nombre_responsable_remision']=($_POST['nombre_responsable']);
			$_SESSION['prioridades_seleccionado_remision']=($_POST['prioridades']);
			$_SESSION['accion_seleccionado_remision']=($_POST['acciones']);
			$_SESSION['check_amerita_respuesta_remision']=$_POST['amerita_respuesta'];
			$_SESSION['fe_paralafirma']=$_POST['fecha_paralafirma'];
			$_SESSION['fe_firmada']=$_POST['fecha_firmada'];
			$_SESSION['fe_despachada']=$_POST['fecha_despachada'];
			$_SESSION['nb_recibidapor']=($_POST['nombre_recibidapor']);
			$_SESSION['fecha_recibidapor_remisiones']=($_POST['fecha_recibidopor']);
			$_SESSION['hh_recibidapor']=($_POST['hora_recibidapor']);
			$_SESSION['mm_recibidapor']=($_POST['minuto_recibidapor']);
			$_SESSION['tt_recibidapor']=($_POST['tiempo_recibidapor']);
			
			if($_SESSION['check_amerita_respuesta_remision']=="f")
			{
				$_SESSION['check_amerita_respuesta_remision']="on";
			}
			else
			{
				$_SESSION['check_amerita_respuesta_remision']="off";
			}

			$_SESSION['observacion_remision']=($_POST['observacion']);
			die($_SESSION['observacion_remision']." uno");
			$_SESSION['check_r']=$_POST['check_respondida'];
			
			if($_SESSION['check_r']=="on")
			{
				$_SESSION['check_r']="t";
			}
			else
			{
				$_SESSION['check_r']="f";
			}			
			
			$_SESSION['respondida_observacion_remision']=($_POST['respondida_observacion']);
			$_SESSION['id_remitir_remision']=($_POST['id_remitir']);
			$_SESSION['anio_remitir_remision']=($_POST['anio_remitir']);	
			$_SESSION['estatus_msj']=1;
			$_SESSION['error_remisiones']="La remisi&oacute;n que intenta agregar, ya se le asign&oacute;";
			$url_relativa = "siscor/controlador/control_remisiones.php";
		    header("Cache-Control: no-cache");
			header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
			exit;	
		}
	}	
	
	if ( $existe ==0 )
	{
		
		$Remisiones->setId($_SESSION['id_remisiones']);
		$Remisiones->setAnio_remision($_SESSION['anio_remisiones']);
		$Remisiones->setFeremision($_POST['fecha_remision']);
		$Remisiones->setHora($_POST['hora']);
		$Remisiones->setMinuto($_POST['minuto']);
		$Remisiones->setTiempo($_POST['tiempo']);	
		$Remisiones->setAlto_nivel($_SESSION['alto_nivel_seleccionado_remision']);
		
		if($Remisiones->getAlto_nivel()==""){
			$Remisiones->setAlto_nivel($_SESSION['alto_nivel_user']);
		}
		
		if($_SESSION['primer_nivel_seleccionado_remision']==$_POST['primer_nivel'])
		{
			$Remisiones->setPrimer_nivel($_SESSION['primer_nivel_seleccionado_remision']);
		}
		else
		{
			$Remisiones->setPrimer_nivel($_POST['primer_nivel']);
		}
		
		if ($Remisiones->getPrimer_nivel()==""){
			$Remisiones->setPrimer_nivel($_SESSION['primer_nivel_user']);
			
		}
		
		//$Remisiones->setPrimer_nivel($_SESSION['primer_nivel_seleccionado_remision']);
		
		if($_SESSION['direcciones_seleccionado_remision']==$_POST['direcciones'])
		{
			$Remisiones->setDirecciones($_SESSION['direcciones_seleccionado_remision']);
		}
		else
		{
			$Remisiones->setDirecciones($_POST['direcciones']);
		}
		
	
		if($Remisiones->getDirecciones()==""){
		   $Remisiones->setDirecciones($_SESSION['direcciones_user']);
		}
		
		
		//die($Remisiones->getPrimer_nivel()." P D ".$Remisiones->getDirecciones(). "A".$Remisiones->getAlto_nivel());
		
		$selectunidades=$_POST['todos'];
		
		if($Remisiones->getDirecciones()=="")
		{
			$Remisiones->setDirecciones($_POST['direcciones']);
		}
		
		
		if(	$selectunidades=="on")
		{
			$todos=1;
		}
		else
		{
			
			$Remisiones->setUnidad($_POST['unidades']);
			
			if ($Remisiones->getUnidad()=="")
			{
				$Remisiones->setUnidad(0);
			}
			
			
			
		}
		
	
		
		$Remisiones->setCoordinaciones($_POST['coordinaciones']);
		$Remisiones->setResponsable($_POST['nombre_responsable']);
		$Remisiones->setPrioridad($_POST['prioridades']);
		$Remisiones->setAcciones($_POST['acciones']);
		$Remisiones->setAmerita_remisiones($_POST['amerita_respuesta']);
		
		if(	$Remisiones->getAmerita_remisiones()=="on")
		{
			$Remisiones->setAmerita_remisiones("true");
		//	die($Remisiones->getAmerita_remisiones());
		}
		else
		{
			$Remisiones->setAmerita_remisiones("false");
			//die($Remisiones->getAmerita_remisiones());
		}
//		die($Remisiones->getAmerita_remisiones());
		$Remisiones->setObservaciones($_POST['observacion']);
		
		$Remisiones->setCheck_respondida_remision($_POST['check_respondida']);
		if(	$Remisiones->getCheck_respondida_remision=="on")
		{
			$Remisiones->setCheck_respondida_remision("true");
			$Remisiones->setRespondida_remision($_POST['respondida_observacion']);
		}
		else
		{
			$Remisiones->setCheck_respondida_remision("false");
			$Remisiones->setRespondida_remision($_POST['respondida_observacion']);
		}
		$Remisiones->setId_recibidas($_POST['id_remitir']);
		$Remisiones->setAnio_recibidas($_POST['anio_remitir']);
		$Remisiones->setHora($_POST['hora']);
		$Remisiones->setMinuto($_POST['minuto']);
		$Remisiones->setTiempo($_POST['tiempo']);
		$Remisiones->setFecha_paralafirma($_POST['fecha_paralafirma']);
		
		$Remisiones->setFecha_firmado($_POST['fecha_firmada']);
		$Remisiones->setFecha_despachado($_POST['fecha_despachada']);
		$fecha_cart=$Remisiones->arregla_fecha($Remisiones->getFeremision());
		$fecha_paralafirma=$Remisiones->arregla_fecha($Remisiones->getFecha_paralafirma());
		$fecha_firmado=$Remisiones->arregla_fecha($Remisiones->getFecha_firmado());
		$fecha_despachado=$Remisiones->arregla_fecha($Remisiones->getFecha_despachado());

		$Remisiones->setNombre_recibidapor($_POST['nombre_recibidapor']);
		$Remisiones->setFecha_recibidapor($_POST['fecha_recibidapor']);
		$Remisiones->setHora_recibidapor($_POST['hora_recibidapor']);
		$Remisiones->setMinuto_recibidapor($_POST['minuto_recibidapor']);
		$Remisiones->setTiempo_recibidapor($_POST['tiempo_recibidapor']);
		$fecha_recibidas=$Remisiones->arregla_fecha($Remisiones->getFecha_recibidapor());
		
		if($fecha_paralafirma=="--")
		{
			$fecha_paralafirma="NULL";
		}
		else
		{
			$fecha_paralafirma="'".$fecha_paralafirma."'";
		}
		if($fecha_firmado=="--")
		{
			$fecha_firmado="NULL";
		}
		else
		{
			$fecha_firmado="'".$fecha_firmado."'";
		}
		if($fecha_despachado=="--"){
			$fecha_despachado="NULL";
		}
		else		
		{
			$fecha_despachado="'".$fecha_despachado."'";
		}		

		if($fecha_recibidas=="--")
		{
			$fecha_recibidas="NULL";
		}
		else
		{
			$fecha_recibidas="'".$fecha_recibidas."'";
		}
		
        $mensaje = $Remisiones->EjecutarFunciones("funcion_mod_remisiones_direccion('".$Remisiones->getId()."','".$fecha_cart."','".$Remisiones->getId_recibidas()."','".$Remisiones->getAnio_remision()."','".$Remisiones->getAnio_recibidas()."','".$Remisiones->getId_direcciones_user()."','".$Remisiones->getAlto_nivel()."','".$Remisiones->getPrimer_nivel()."','".$Remisiones->getDirecciones()."','".$Remisiones->getUnidad()."','".$Remisiones->getPrioridad()."','".$Remisiones->getAcciones()."','".$Remisiones->getAmerita_remisiones()."','".$Remisiones->getObservaciones()."','".$Remisiones->getId_usuario()."','".$Remisiones->getId_alto_nivel_user()."','".$Remisiones->getId_primer_nivel_user()."','".$Remisiones->getHora()."','".$Remisiones->getMinuto()."','".$Remisiones->getTiempo()."',".$fecha_paralafirma.",".$fecha_firmado.",".$fecha_despachado.",'".$Remisiones->getNombre_recibidapor()."','".$Remisiones->getHora_recibidapor()."','".$Remisiones->getMinuto_recibidapor()."','".$Remisiones->getTiempo_recibidapor()."',".$fecha_recibidas.",'".$Remisiones->getResponsable()."','".$_SERVER["REMOTE_ADDR"]."')");
				                                  								                                       							
		unset($_SESSION['modif']);
		unset($_SESSION['id_remisiones']);
		unset($_SESSION['anio_remisiones']);
		unset($_SESSION['anio_remitir_remision']);
		unset($_SESSION['Unidades_seleccionado_remision']);
		unset($_SESSION['Coordinaciones_seleccionado_remision']);
		unset($_SESSION['nombre_responsable_remision']);
		unset($_SESSION['prioridades_seleccionado_remision']);
		unset($_SESSION['accion_seleccionado_remision']);
		unset($_SESSION['check_amerita_respuesta_remision']);	
		unset($_SESSION['observacion_remision']);
		unset($_SESSION['respondida_observacion_remision']);
		unset($_SESSION['id_remitir_remision']);
		unset($_SESSION['anio_remitir_remision']);
		unset($_SESSION['hora_remision']);
		unset($_SESSION['minuto_remision']);
		unset($_SESSION['tiempo_remision']);
		unset($_SESSION['nb_recibidapor']);
		unset($_SESSION['fecha_recibidapor_remisiones']);
		unset($_SESSION['hh_recibidapor']);
		unset($_SESSION['mm_recibidapor']);
		unset($_SESSION['tt_recibidapor']);
		unset($_SESSION['check_r']);
		unset($_SESSION['alto_nivel_seleccionado_remision']);
		unset($_SESSION['primer_nivel_seleccionado_remision']);
		unset($_SESSION['direcciones_seleccionado_remision']);
		$_SESSION['estatus_msj']=2;
		$_SESSION['error_remisiones_consulta']="La Información fue Modificada con Éxito";
		$url_relativa = "siscor/controlador/control_consultar_remisiones.php";
	    header("Cache-Control: no-cache");
		header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
		exit;
        
	}//fin de modificar perfil 1
	else
	{
		$_SESSION['id_remisiones']=$Remisiones->getId();
		$_SESSION['anio_remisiones']=$Remisiones->getAnio_remision();
		$_SESSION['anio_remitir_remision']=$Remisiones->getFeremision();
		$_SESSION['alto_nivel_user']=$Remisiones->getAlto_nivel();
		$_SESSION['primer_nivel_user']=$Remisiones->getPrimer_nivel();
		$_SESSION['direcciones_user']=$Remisiones->getDirecciones();
		$_SESSION['Unidades_seleccionado_remision']=$Remisiones->getUnidad();
		$_SESSION['Coordinaciones_seleccionado_remision']=$Remisiones->getCoordinaciones();
		$_SESSION['nombre_responsable_remision']=$Remisiones->getResponsable();
		$_SESSION['prioridades_seleccionado_remision']=$Remisiones->getPrioridad();
		$_SESSION['accion_seleccionado_remision']=$Remisiones->getAcciones();
		$_SESSION['check_amerita_respuesta_remision']=$Remisiones->getAmerita_remisiones();	
		$_SESSION['observacion_remision']=$Remisiones->getObservaciones();
	  	$_SESSION['check_r']=$Remisiones->getCheck_respondida_remision();
	  	$_SESSION['respondida_observacion_remision']=$Remisiones->getRespondida_remision();
		$_SESSION['id_remitir_remision']=$Remisiones->getId_recibidas();
		$_SESSION['anio_remitir_remision']=$Remisiones->getAnio_recibidas();
		$_SESSION['hora_remision']=$Remisiones->getHora();
		$_SESSION['minuto_remision']=$Remisiones->getMinuto();
		$_SESSION['tiempo_remision']=$Remisiones->getTiempo();

		$_SESSION['nb_recibidapor']=$Remisiones->getNombre_recibidapor();
		$_SESSION['fecha_recibidapor_remisiones']=$Remisiones->getFecha_recibidapor();
		$_SESSION['hh_recibidapor']=$Remisiones->getHora_recibidapor();
		$_SESSION['mm_recibidapor']=$Remisiones->getMinuto_recibidapor();
		$_SESSION['tt_recibidapor']=$Remisiones->getTiempo_recibidapor();
		
		
		$_SESSION['modif']=1;	
		$_SESSION['estatus_msj']=1;
		$_SESSION['error_remisiones']="La remisi&oacute;n que intenta agregar ya fue asignada a est&aacute; unidad";
		$url_relativa = "siscor/controlador/control_remisiones.php";
	    header("Cache-Control: no-cache");
		header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
		exit;		
			
	}
	}
	if ($_SESSION['perfil']==2)
	{
/***************************************************************************************************/
		$Remisiones->setId($_SESSION['id_remisiones']);
		$Remisiones->setAnio_remision($_SESSION['anio_remisiones']);
		$Remisiones->setAlto_nivel($_SESSION['alto_nivel_user']);
		$Remisiones->setPrimer_nivel($_SESSION['primer_nivel_user']);
		$Remisiones->setDirecciones($_SESSION['direcciones_user']);
	    $Remisiones->setCoordinaciones($_POST['coordinaciones']);

        $mensaje = $Remisiones->EjecutarFunciones("funcion_mod_remisiones_unidad('".$Remisiones->getId()."','".$Remisiones->getAnio_remision()."','".$Remisiones->getDirecciones()."','".$Remisiones->getCoordinaciones()."','".$Remisiones->getId_usuario()."','".$Remisiones->getId_alto_nivel_user()."','".$Remisiones->getId_primer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
			                                       									                                                             										
	unset($_SESSION['modif']);
	unset($_SESSION['id_remisiones']);
	unset($_SESSION['anio_remisiones']);
	unset($_SESSION['anio_remitir_remision']);
	unset($_SESSION['Unidades_seleccionado_remision']);
	unset($_SESSION['Coordinaciones_seleccionado_remision']);
	unset($_SESSION['nombre_responsable_remision']);
	unset($_SESSION['prioridades_seleccionado_remision']);
	unset($_SESSION['accion_seleccionado_remision']);
	unset($_SESSION['check_amerita_respuesta_remision']);	
	unset($_SESSION['observacion_remision']);
	unset($_SESSION['respondida_observacion_remision']);
	unset($_SESSION['id_remitir_remision']);
	unset($_SESSION['anio_remitir_remision']);
	unset($_SESSION['hora_remision']);
	unset($_SESSION['minuto_remision']);
	unset($_SESSION['tiempo_remision']);
	unset($_SESSION['alto_nivel_seleccionado_remision']);
	unset($_SESSION['primer_nivel_seleccionado_remision']);
	unset($_SESSION['direcciones_seleccionado_remision']);
	$_SESSION['estatus_msj']=2;
	$_SESSION['error_remisiones_consulta']="La Información fue Modificada con Éxito";
	$url_relativa = "siscor/controlador/control_consultar_remisiones.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
        
	}//fin de modificar perfil 1
	
	if($_SESSION['perfil']==3)
	{
		$Remisiones->setId($_SESSION['id_remisiones']);
		$Remisiones->setAnio_remision($_SESSION['anio_remisiones']);
		$Remisiones->setAlto_nivel($_SESSION['alto_nivel_user']);
		$Remisiones->setPrimer_nivel($_SESSION['primer_nivel_user']);
		$Remisiones->setDirecciones($_SESSION['direcciones_user']);
		$Remisiones->setResponsable($_POST['nombre_responsable']);

		$Remisiones->setCheck_respondida_remision($_POST['check_respondida']);

		if(	$Remisiones->getCheck_respondida_remision()=="on")
		{
			
			$Remisiones->setCheck_respondida_remision("true");
			$Remisiones->setRespondida_remision($_POST['respondida_observacion']);
		}
		else
		{
			
			$Remisiones->setCheck_respondida_remision("false");
			$Remisiones->setRespondida_remision($_POST['respondida_observacion']);
		}
				
		$mensaje = $Remisiones->EjecutarFunciones("funcion_mod_remisiones_coordinacion('".$Remisiones->getId()."','".$Remisiones->getAnio_remision()."','".$Remisiones->getDirecciones()."','".$Remisiones->getResponsable()."','".$Remisiones->getCheck_respondida_remision()."','".$Remisiones->getRespondida_remision()."','".$Remisiones->getId_usuario()."','".$Remisiones->getAlto_nivel()."','".$Remisiones->getPrimer_nivel()."','".$_SERVER["REMOTE_ADDR"]."')");
	
	unset($_SESSION['modif']);
	unset($_SESSION['id_remisiones']);
	unset($_SESSION['anio_remisiones']);
	unset($_SESSION['anio_remitir_remision']);
	unset($_SESSION['Unidades_seleccionado_remision']);
	unset($_SESSION['Coordinaciones_seleccionado_remision']);
	unset($_SESSION['nombre_responsable_remision']);
	unset($_SESSION['prioridades_seleccionado_remision']);
	unset($_SESSION['accion_seleccionado_remision']);
	unset($_SESSION['check_amerita_respuesta_remision']);	
	unset($_SESSION['observacion_remision']);
	unset($_SESSION['respondida_observacion_remision']);
	unset($_SESSION['id_remitir_remision']);
	unset($_SESSION['anio_remitir_remision']);
	unset($_SESSION['hora_remision']);
	unset($_SESSION['minuto_remision']);
	unset($_SESSION['tiempo_remision']);
	unset($_SESSION['alto_nivel_seleccionado_remision']);
	unset($_SESSION['primer_nivel_seleccionado_remision']);
	unset($_SESSION['direcciones_seleccionado_remision']);
	$_SESSION['estatus_msj']=2;
	$_SESSION['error_remisiones_consulta']="La Información fue Modificada con Éxito";
	$url_relativa = "siscor/controlador/control_consultar_remisiones.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
        
	}//fin de modificar perfil 1

	///////////******************************************************************************************************
}//fin modificar


if ($_POST['consultar_correspondencia_remitida']==true)
{
/*********************************************************************************************************************************************************/	
	

	if ($_SESSION['perfil']==1)
	{
		$Remisiones->setAnio_recibidas($_POST['anio_remitir']);
		$Remisiones->setId_recibidas($_POST['id_remitir']);
		$_SESSION['anio_remitir_remision']=$_POST['anio_remitir'];
		$_SESSION['id_remitir_remision']=$_POST['id_remitir'];
		$_SESSION['fecha_remision_carga']=($_POST['fecha_remision']);
		$_SESSION['hora_remision']=($_POST['hora']);
		$_SESSION['minuto_remision']=($_POST['minuto']);
		$_SESSION['tiempo_remision']=($_POST['tiempo']);
		$_SESSION['accion_seleccionado_remision']=($_POST['acciones']);
		$_SESSION['prioridades_seleccionado_remision']=($_POST['prioridades']);
		$_SESSION['Unidades_seleccionado_remision']=($_POST['unidades']);
		$_SESSION['check_t']=$_POST['todos'];	
		$_SESSION['check_amerita_respuesta_remision']=$_POST['amerita_respuesta'];
		$_SESSION['observacion_remision']=($_POST['observacion']);	
		$_SESSION['Coordinaciones_seleccionado_remision']=($_POST['coordinaciones']);
		$_SESSION['nombre_responsable_remision']=($_POST['nombre_responsable']);
		$_SESSION['nb_recibidapor']=($_POST['nombre_recibidapor']);	
		$_SESSION['hh_recibidapor']=($_POST['hora_recibidapor']);
		$_SESSION['mm_recibidapor']=($_POST['minuto_recibidapor']);
		$_SESSION['tt_recibidapor']=($_POST['tiempo_recibidapor']);
	}
	else
	{
		$Remisiones->setAnio_recibidas($_SESSION['anio_remitir_remision']);
		$Remisiones->setId_recibidas($_SESSION['id_remitir_remision']);
	}
	if ($_SESSION['perfil']==3)
	{
		$_SESSION['check_r']=$_POST['check_respondida'];
		$_SESSION['respondida_observacion_remision']=($_POST['respondida_observacion']);
		$_SESSION['nombre_responsable_remision']=($_POST['nombre_responsable']);
	}

	$_SESSION['alto_nivel_seleccionado_remision']=($_POST['alto_nivel']);
	$_SESSION['primer_nivel_seleccionado_remision']=($_POST['primer_nivel']);
	
	$_SESSION['direcciones_seleccionado_remision']=($_POST['direcciones']);

	$_SESSION['Coordinaciones_seleccionado_remision']=($_POST['coordinaciones']);
	
$parametro= "nu_ano_recibidas=".$Remisiones->getAnio_recibidas()." and cd_recibidas=".$Remisiones->getId_recibidas() ;

//die($parametro);

$orden="cd_recibidas";
$tabla= "vista_mostrar_recibidas";
$cont = $Remisiones->MostrarConsulta(0,$tabla,$parametro,$orden);

if ( $cont != 0 ) 
{
	$Recibidas = new Recibidas();
	if ($_SESSION['perfil']==1){
		$Recibidas->setId($_POST['id_remitir']);
		$Recibidas->setNuano($_POST['anio_remitir']);
	}
	else
	{
		$Recibidas->setId($_SESSION['id_remitir_remision']);
		$Recibidas->setNuano($_SESSION['anio_remitir_remision']);
	}
//////////////////////////////////////////////////////////////////////////////////////////////	echo $_SESSION['id_remitir_remision']. "aaaaaaaaaa";
	
	$Recibidas->setId_direcciones_user($_SESSION['direcciones_user']);
	$Recibidas->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$Recibidas->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
	
	
	
	$Recibidas->CargarDatos();
	//$_SESSION['consul_remision']==1;
	$_SESSION['id_recibidas']=$Recibidas->getId();
	$_SESSION['anio_recibidas']=$Recibidas->getNuano();
	$_SESSION['fecha_entrada_recibidas']=$Recibidas->getFeentrada();
	$_SESSION['fecha_carta_recibidas']=$Recibidas->getFecarta();
	$_SESSION['hora_recibidas']=$Recibidas->getHorahhentrada();
	$_SESSION['minuto_recibidas']=$Recibidas->getHorammentrada();
	$_SESSION['tiempo_recibidas']=$Recibidas->getHorattentrada();
	$_SESSION['num_externo_recibidas']=$Recibidas->getNuexterno();
	$_SESSION['remitente_recibidas']=$Recibidas->getRemitente();
	$_SESSION['cedula_recibidas']=$Recibidas->getCedremitente();
	$_SESSION['alto_nivel_seleccionado']=$Recibidas->getAlto_nivel();
	$_SESSION['primer_nivel_seleccionado']=$Recibidas->getPrimer_nivel();
	$_SESSION['direcciones_seleccionado']=$Recibidas->getDirecciones();
	$_SESSION['clasificacion_documentos_seleccionado']=$Recibidas->getClasificacion_documento();
	$_SESSION['asunto_recibidas']=$Recibidas->getAsunto();
	$_SESSION['ubicacion_recibidas']=$Recibidas->getUbicacion();
	$_SESSION['ame_respuesta']=$Recibidas->getAmerita_respuesta();
	$_SESSION['scanner']=$Recibidas->getDocumento();
	$_SESSION['consul_remision']=1;
	if($_SESSION['ConsulRespuestaRemisiones']==1)
	{
		$RespuestaRemisiones= new RespuestaRemisiones();
		$RespuestaRemisiones->setId_Remisiones($_SESSION['id_remisiones']);
		$RespuestaRemisiones->setNuanio_remisiones($_SESSION['anio_remisiones']);
		$RespuestaRemisiones->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
		$RespuestaRemisiones->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
		$RespuestaRemisiones->setId_direcciones_user($_SESSION['direcciones_user']);
		$RespuestaRemisiones->CargarDatosRemisionesRecibidas();
		$_SESSION['id_respuesta_remision']=$RespuestaRemisiones->getId_recibida();
		$_SESSION['anio_respuesta_remision']=$RespuestaRemisiones->getNuanio_recibida();	
	}
	
	if ($_SESSION['primer_nivel_seleccionado']!="")
	{
		if ($_SESSION['alto_nivel_seleccionado']==3)
		{
			$valor="cd_alto_nivel=".$_SESSION['alto_nivel_seleccionado']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];	
		}
		else
		{
			$valor="cd_alto_nivel=".$_SESSION['alto_nivel_seleccionado'];
		}
	
			$tabla= "vista_mostrar_primer_nivel";
			$orden="nb_primer_nivel";
			$cont = $Recibidas->MostrarValores(0,$tabla,$orden,$valor);
				//echo($cant); die;
		if ( $cont != 0 ) 
		{
			//echo $alto_nivel->Mostrar(0); die();
			$_SESSION['cantidad_primer_nivel'] = $cont;
			//echo $alto_nivel->Mostrar(0); die();
			//se crea un arreglo donde se alogen los registros necesarios
	    	$campoId=array();
	    	$campoNombre=array();
			$datos = $Recibidas->MostrarValores(1,$tabla,$orden,$valor);
			//Carga los registros
		    	while ($row=pg_fetch_array($datos))
				{ 
					array_push( $campoId , $row["cd_primer_nivel"] );	
					array_push( $campoNombre , $row["nb_primer_nivel"] );				
				}
    	//Prepara para la comunicacion
			$_SESSION['campoIdprimer_nivel'] = $campoId;
			$_SESSION['campoNombreprimer_nivel'] = $campoNombre;		
		}
	}//fin de combo para llenar primer_nivel
		
//combo para llenar direcciones
if ($_SESSION['direcciones_seleccionado']!="")
{
	$valor="cd_primer_nivel=".$_SESSION['primer_nivel_seleccionado']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];
	
	$tabla= "vista_mostrar_direcciones";
	$orden="nb_direcciones";
	$cont = $Recibidas->MostrarValores(0,$tabla,$orden,$valor);
	//echo($cant); die;
		if ( $cont != 0 ) 
		{
			//echo $alto_nivel->Mostrar(0); die();
			$_SESSION['cantidaddirecciones'] = $cont;
			//echo $alto_nivel->Mostrar(0); die();
			//se crea un arreglo donde se alogen los registros necesarios
		    $campoId=array();
		    $campoNombre=array();
			$datos = $Recibidas->MostrarValores(1,$tabla,$orden,$valor);
			//Carga los registros
			    while ( $row=pg_fetch_array($datos) )
				{ 
					array_push( $campoId , $row["cd_direcciones"] );	
					array_push( $campoNombre , $row["nb_direcciones"] );				
				}
			    //Prepara para la comunicacion
			$_SESSION['campoIddirecciones'] = $campoId;
			$_SESSION['campoNombredirecciones'] = $campoNombre;		
		}
}

	$url_relativa = "../vista/registrar_recibidas.php";
   	header("Cache-Control: no-cache");
	header("Location: ".$url_relativa);	
   	exit;
}
else
{
	$_SESSION['estatus_msj']=1;
	$_SESSION['error_remisiones']="El N&uacute;mero de Correlativo no existe";
	$url_relativa = "siscor/controlador/control_remisiones.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
}
}// fin de consultar_correspondencia_remitida


//boton regresar
if ($_POST['regresar']==true)
{
	unset($_SESSION['id_remisiones']);
	unset($_SESSION['anio_remisiones']);
	unset($_SESSION['anio_remitir_remision']);
	unset($_SESSION['Unidades_seleccionado_remision']);
	unset($_SESSION['Coordinaciones_seleccionado_remision']);
	unset($_SESSION['nombre_responsable_remision']);
	unset($_SESSION['prioridades_seleccionado_remision']);
	unset($_SESSION['accion_seleccionado_remision']);
	unset($_SESSION['check_amerita_respuesta_remision']);	
	unset($_SESSION['observacion_remision']);
	unset($_SESSION['respondida_observacion_remision']);
	unset($_SESSION['id_remitir_remision']);
	unset($_SESSION['anio_remitir_remision']);
	unset($_SESSION['hora_remision']);
	unset($_SESSION['minuto_remision']);
	unset($_SESSION['tiempo_remision']);
    unset($_SESSION['check_r']);
	unset($_SESSION['consul_remision']);
	unset($_SESSION['consul_oficio']);//agregada de prueba
	unset($_SESSION['alto_nivel_seleccionado_remision']);
	unset($_SESSION['primer_nivel_seleccionado_remision']);
	unset($_SESSION['direcciones_seleccionado_remision']);
	unset($_SESSION['bloquear_ConsulRespuestaRemisiones']);
	if ($_SESSION['modif']==1)
	{
		unset($_SESSION['modif']);
		$url_relativa = "siscor/controlador/control_consultar_remisiones.php";
	    header("Cache-Control: no-cache");
		header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
		exit;
	}
	else if ($_SESSION['RespuestaRemisiones']==1)
	{
		unset($_SESSION['RespuestaRemisiones']);
		$url_relativa = "siscor/controlador/control_respuesta_remisiones.php";
	    header("Cache-Control: no-cache");
		header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
		exit;
	}
	else if ($_SESSION['ConsulRespuestaRemisiones']==1)
	{
		unset($_SESSION['ConsulRespuestaRemisiones']);
		$url_relativa = "siscor/controlador/control_consul_respuesta_remisiones.php";
	    header("Cache-Control: no-cache");
		header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
		exit;
	}
	
}
//regresar respuesta_oficio
if ($_POST['regresarespuestaoficio']==true)
{
/*

	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['alto_nivel_seleccionado']);
	unset($_SESSION['primer_nivel_seleccionado']);
	unset($_SESSION['direcciones_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['RespuestaOfic']);
	unset($_SESSION['ame_respuesta']);
	$url_relativa = "siscor/controlador/control_respuesta_recibidas.php?Resp_ofi=act";
    header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
*/

}

if ($_POST['regresarconsul']==true)
{
/*
	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['alto_nivel_seleccionado']);
	unset($_SESSION['primer_nivel_seleccionado']);
	unset($_SESSION['direcciones_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['RespuestaOfic']);
	unset($_SESSION['ame_respuesta']);
	$url_relativa = "siscor/controlador/control_consul_respuesta_recibidas.php";
    header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
*/
}
if ($_POST['cancelar_recibidas']==true)
{
/*	
	unset($_SESSION['id_oficios']);
	unset($_SESSION['anio_oficios']);
	unset($_SESSION['fecha_envio_oficios']);
	unset($_SESSION['hora_oficios']);
	unset($_SESSION['minuto_oficios']);
	unset($_SESSION['tiempo_oficios']);
	unset($_SESSION['destinatario_oficios']);
	unset($_SESSION['alto_nivel_seleccionado']);
	unset($_SESSION['primer_nivel_seleccionado']);
	unset($_SESSION['direcciones_seleccionado']);
	unset($_SESSION['asunto_oficios']);
	unset($_SESSION['num_correspondencia_remetir_oficios']);
	unset($_SESSION['anio_correspondencia_remetir_oficios']);
	unset($_SESSION['responsable_oficios']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['consul_oficio']);
	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['alto_nivel_seleccionado']);
	unset($_SESSION['primer_nivel_seleccionado']);
	unset($_SESSION['direcciones_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['consul']);
		unset($_SESSION['consul_oficio']);
	unset($_SESSION['ame_respuesta']);
	$url_relativa = "siscor/controlador/control_respuesta_oficios.php";
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
*/	
}

if ($_POST['siguiente']==true)
{
	
	$url_relativa = "siscor/controlador/control_consul_respuesta_remisiones_recibidas.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
	
}

if ($_POST['finalizar']==true){
/*		
	$RespuestaRemisiones = New RespuestaRecibidas;
	
	$RespuestaRecibidas->setId_recibida($_POST['id']);
	$RespuestaRecibidas->setNuanio_recibida($_POST['anio']);
	$RespuestaRecibidas->setId_oficio($_SESSION['id_oficios']);
	$RespuestaRecibidas->setNuanio_oficios($_SESSION['anio_oficios']);
	$RespuestaRecibidas->setId_usuario($_SESSION['codigo']);
	$RespuestaRecibidas->setId_direcciones_user($_SESSION['direcciones_user']);
	$RespuestaRecibidas->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$RespuestaRecibidas->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
	
	
	$RespuestaRecibidas->EjecutarFunciones("funcion_insertar_respuesta_oficios('".$RespuestaRecibidas->getId_recibida()."','".$RespuestaRecibidas->getNuanio_recibida()."','".$RespuestaRecibidas->getId_oficio()."','".$RespuestaRecibidas->getNuanio_oficios()."','".$RespuestaRecibidas->getId_usuario()."','".$RespuestaRecibidas->getId_direcciones_user()."','".$RespuestaRecibidas->getId_alto_nivel_user()."','".$RespuestaRecibidas->getId_primer_nivel_user()."')");
	
	$RespuestaRecibidas->EjecutarFunciones("funcion_mod_oficios_respondidos('".$RespuestaRecibidas->getId_oficio()."','".$RespuestaRecibidas->getNuanio_oficios()."','true','".$RespuestaRecibidas->getId_usuario()."','".$RespuestaRecibidas->getId_direcciones_user()."','".$RespuestaRecibidas->getId_alto_nivel_user()."','".$RespuestaRecibidas->getId_primer_nivel_user()."')");
	
	                                                                                                                                                               
	
	unset($_SESSION['id_oficios']);
	unset($_SESSION['anio_oficios']);
	unset($_SESSION['fecha_envio_oficios']);
	unset($_SESSION['hora_oficios']);
	unset($_SESSION['minuto_oficios']);
	unset($_SESSION['tiempo_oficios']);
	unset($_SESSION['destinatario_oficios']);
	unset($_SESSION['alto_nivel_seleccionado']);
	unset($_SESSION['primer_nivel_seleccionado']);
	unset($_SESSION['direcciones_seleccionado']);
	unset($_SESSION['asunto_oficios']);
	unset($_SESSION['num_correspondencia_remetir_oficios']);
	unset($_SESSION['anio_correspondencia_remetir_oficios']);
	unset($_SESSION['responsable_oficios']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['consul_oficio']);
	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['alto_nivel_seleccionado']);
	unset($_SESSION['primer_nivel_seleccionado']);
	unset($_SESSION['direcciones_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['consul']);
	unset($_SESSION['RespuestaOficio']);
	unset($_SESSION['RespuestaOfic']);
	unset($_SESSION['ame_respuesta']);
	unset($_SESSION['consul_oficio']);
	$_SESSION['estatus_msj']=2;
	$_SESSION['error_recibidas']="La Información fue Guardada con Éxito";
	$url_relativa = "siscor/controlador/control_respuesta_oficios.php";
    header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;
*/
}

if ($_POST['modificar_consulta_respuesta']==true)
{
	$RespuestaRemisiones = New RespuestaRemisiones();
	
	$RespuestaRemisiones->setId_Remisiones($_SESSION['id_remisiones']);
	$RespuestaRemisiones->setNuanio_remisiones($_SESSION['anio_remisiones']);
	$RespuestaRemisiones->setId_recibida($_POST['id_respuesta']);
	$RespuestaRemisiones->setNuanio_recibida($_POST['anio_respuesta']);
	$RespuestaRemisiones->setId_usuario($_SESSION['codigo']);
	$RespuestaRemisiones->setId_direcciones_user($_SESSION['direcciones_user']);
	$RespuestaRemisiones->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$RespuestaRemisiones->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
	
	$mensaje = $RespuestaRemisiones->EjecutarFunciones("funcion_mod_consul_respuesta_remisiones_recibidas('".$RespuestaRemisiones->getId_recibida()."','".$RespuestaRemisiones->getNuanio_recibida()."','".$RespuestaRemisiones->getId_Remisiones()."','".$RespuestaRemisiones->getNuanio_remisiones()."','".$RespuestaRemisiones->getId_usuario()."','".$RespuestaRemisiones->getId_direcciones_user()."','".$RespuestaRemisiones->getId_alto_nivel_user()."','".$RespuestaRemisiones->getId_primer_nivel_user()."')");
	
	unset($_SESSION['id_recibidas']);
	unset($_SESSION['anio_recibidas']);
	unset($_SESSION['fecha_entrada_recibidas']);
	unset($_SESSION['fecha_carta_recibidas']);
	unset($_SESSION['hora_recibidas']);
	unset($_SESSION['minuto_recibidas']);
	unset($_SESSION['tiempo_recibidas']);
	unset($_SESSION['num_externo_recibidas']);
	unset($_SESSION['remitente_recibidas']);
	unset($_SESSION['cedula_recibidas']);
	unset($_SESSION['alto_nivel_seleccionado']);
	unset($_SESSION['primer_nivel_seleccionado']);
	unset($_SESSION['direcciones_seleccionado']);
	unset($_SESSION['clasificacion_documentos_seleccionado']);
	unset($_SESSION['asunto_recibidas']);
	unset($_SESSION['ubicacion_recibidas']);
	unset($_SESSION['consul']);
	unset($_SESSION['RespuestaOficio']);
	unset($_SESSION['RespuestaOfic']);
	unset($_SESSION['ame_respuesta']);	
	unset($_SESSION['ConsulRespuestaRemisiones']);
	unset($_SESSION['id_respuesta_remision']);
	unset($_SESSION['anio_respuesta_remision']);
	unset($_SESSION['alto_nivel_seleccionado_remision']);
	unset($_SESSION['primer_nivel_seleccionado_remision']);
	unset($_SESSION['direcciones_seleccionado_remision']);
	unset($_SESSION['nombre_responsable_remision']);
	unset($_SESSION['bloquear_ConsulRespuestaRemisiones']);
	unset($_SESSION['observacion_remision']);
	$_SESSION['estatus_msj']=2;
	$_SESSION['error_remisiones']="La Información fue Modificada con Éxito";
	$url_relativa = "siscor/vista/consultar_respuesta_remisiones.php";
    header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
	exit;

}

$tabla="vista_mostrar_prioridades";
$orden="nb_prioridades";
$sw=1;
$cont = $Remisiones->Mostrar(0,$tabla,$orden,$sw);
//echo($cant); die;
if ( $cont != 0 ) 
{
	//echo $General->Mostrar(0); die();
	$_SESSION['cantidad'] = $cont;
	//echo $General->Mostrar(0); die();
	//se crea un arreglo donde se alogen los registros necesarios
   	$campoId=array();
   	$campoNombre=array();
	$datos = $Remisiones->Mostrar(1,$tabla,$orden,$sw);
	//Carga los registros
	   	while ( $row=pg_fetch_array($datos) )
		{ 
			array_push( $campoId , $row["cd_prioridades"] );	
			array_push( $campoNombre , $row["nb_prioridades"] );				
		}
    	//Prepara para la comunicacion
		$_SESSION['campoIdPrioridades'] = $campoId;
    	$_SESSION['campoNombrePrioridades'] = $campoNombre;
}


//carga el combo de acciones
$tabla="vista_mostrar_acciones";
$orden="nb_acciones";
$sw=1;
$cont = $Remisiones->Mostrar(0,$tabla,$orden,$sw);
//echo($cant); die;
if ( $cont != 0 ) 
{
	//echo $General->Mostrar(0); die();
	$_SESSION['cantidad_acciones'] = $cont;
	//echo $General->Mostrar(0); die();
	//se crea un arreglo donde se alogen los registros necesarios
   	$campoId=array();
   	$campoNombre=array();
	$datos = $Remisiones->Mostrar(1,$tabla,$orden,$sw);
	//Carga los registros
	   	while ( $row=pg_fetch_array($datos) )
		{ 
			array_push( $campoId , $row["cd_acciones"] );	
			array_push( $campoNombre , $row["nb_acciones"] );				
		}
    	//Prepara para la comunicacion
		$_SESSION['campoIdAcciones'] = $campoId;
    	$_SESSION['campoNombreAcciones'] = $campoNombre;
}//fin de acciones


//llena combo de alto nivel
$tabla= "vista_mostrar_alto_nivel";
$orden="nb_alto_nivel";		
$sw=0;
$cont = $Remisiones->Mostrar(0,$tabla,$orden,$sw);
//echo($cant); die;
if ( $cont != 0 ) 
{
	//echo $alto_nivel->Mostrar(0); die();
	$_SESSION['cantidad_alto_nivel'] = $cont;
	//echo $alto_nivel->Mostrar(0); die();
	//se crea un arreglo donde se alogen los registros necesarios
    $campoId=array();
    $campoNombre=array();
	$datos = $Remisiones->Mostrar(1,$tabla,$orden,$sw);
	//Carga los registros
	    while ( $row=pg_fetch_array($datos) )
		{ 
			array_push( $campoId , $row["cd_alto_nivel"] );	
			array_push( $campoNombre , $row["nb_alto_nivel"] );				
		}
    //Prepara para la comunicacion
	$_SESSION['campoIdAltoNivel'] = $campoId;
    $_SESSION['campoNombreAltoNivel'] = $campoNombre;		
}//fin de llena combo de alto nivel



	$Remisiones->setId_direcciones_user($_SESSION['direcciones_user']);
	$Remisiones->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$Remisiones->setId_primer_nivel_user($_SESSION['primer_nivel_user']);


if ($Remisiones->getId_primer_nivel_user()!="")
{
if ($_SESSION['alto_nivel_user']==3){
	$valor="cd_alto_nivel=".$_SESSION['alto_nivel_user']." and cd_primer_nivel=".$_SESSION['primer_nivel_user']." or cd_primer_nivel_aux=".$_SESSION['primer_nivel_user'];	
}
else{
	$valor="cd_alto_nivel=".$_SESSION['alto_nivel_user']." and cd_primer_nivel=".$_SESSION['primer_nivel_user']." or cd_primer_nivel_aux=".$_SESSION['primer_nivel_user'];
}
	
	$tabla= "vista_mostrar_primer_nivel";
	$orden="nb_primer_nivel";
	$cont = $Remisiones->MostrarValores(0,$tabla,$orden,$valor);
		//echo($cant); die;
		if ( $cont != 0 ) 
		{
			//echo $alto_nivel->Mostrar(0); die();
			$_SESSION['cantidad_primer_nivel'] = $cont;
			//echo $alto_nivel->Mostrar(0); die();
			//se crea un arreglo donde se alogen los registros necesarios
	    	$campoId=array();
	    	$campoNombre=array();
			$datos = $Remisiones->MostrarValores(1,$tabla,$orden,$valor);
			//Carga los registros
		    	while ($row=pg_fetch_array($datos))
				{ 
					array_push( $campoId , $row["cd_primer_nivel"] );	
					array_push( $campoNombre , $row["nb_primer_nivel"] );				
				}
    	//Prepara para la comunicacion
			$_SESSION['campoIdprimer_nivel'] = $campoId;
			$_SESSION['campoNombreprimer_nivel'] = $campoNombre;		
		}
}//fin de combo para llenar primer_nivel
		
//combo para llenar direcciones
if ($_SESSION['direcciones_user']!="")
{

	if ($_SESSION['direcciones_user']==0)
	{
	
	$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user'];	
	//$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user'];
	}
	else 
	{
		
	$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_direcciones=".$_SESSION['direcciones_user'];
	//$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];		
	}
	
	
	$tabla= "vista_mostrar_direcciones";
	$orden="nb_direcciones";
	$cont = $Remisiones->MostrarValores(0,$tabla,$orden,$valor);
	//die("$valor"."fin");
	//echo($cant); die;
		if ( $cont != 0 ) 
		{
			//echo $alto_nivel->Mostrar(0); die();
			$_SESSION['cantidaddirecciones'] = $cont;
			//echo $alto_nivel->Mostrar(0); die();
			//se crea un arreglo donde se alogen los registros necesarios
		    $campoId=array();
		    $campoNombre=array();
			$datos = $Remisiones->MostrarValores(1,$tabla,$orden,$valor);
			//Carga los registros
			    while ( $row=pg_fetch_array($datos) )
				{ 
					array_push( $campoId , $row["cd_direcciones"] );	
					array_push( $campoNombre , $row["nb_direcciones"] );				
				}
			    //Prepara para la comunicacion
			$_SESSION['campoIddirecciones'] = $campoId;
			$_SESSION['campoNombredirecciones'] = $campoNombre;		
		}
		
}

if ($_SESSION['direcciones_user']!=0)
{
$tabla="vista_mostrar_unidades";
$orden="nb_unidades";
$where="where cd_direcciones=".$_SESSION['direcciones_user']."";
$cont = $Remisiones->MostrarUnidades(0,$tabla,$orden,$where);
//echo($cant); die;
if ( $cont != 0 ) 
{
	//echo $General->Mostrar(0); die();
	$_SESSION['cantidadUnidades'] = $cont;
	//echo $General->Mostrar(0); die();
	//se crea un arreglo donde se alogen los registros necesarios
   	$campoId=array();
   	$campoNombre=array();
	$datos = $Remisiones->MostrarUnidades(1,$tabla,$orden,$where);
	//Carga los registros
	   	while ( $row=pg_fetch_array($datos) )
		{ 
			array_push( $campoId , $row["cd_unidades"] );	
			array_push( $campoNombre , $row["nb_unidades"] );				
		}
    	//Prepara para la comunicacion
		$_SESSION['campoIdUnidades'] = $campoId;
    	$_SESSION['campoNombreUnidades'] = $campoNombre;	
}
}
$url_relativa = "siscor/vista/registrar_remisiones.php";
header("Cache-Control: no-cache");
header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
?>