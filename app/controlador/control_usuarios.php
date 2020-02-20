<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_usuarios.php");
include_once("../modelo/class_modulosxusuarios.php");  

	$Usuarios = new Usuarios();
	$Modulosxusuarios = new Modulosxusuarios();
	$Usuarios->setId_usuario($_SESSION['codigo']);
	$Usuarios->setId_direcciones_user($_SESSION['direcciones_user']);
	$Usuarios->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$Usuarios->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
	$Usuarios->setTipo_usuario($_SESSION['tipo_user']);
	$imagen=$_POST['tmptxt'];	
	
		//chequea la imagen del capcha para guardar los datos
		if($_POST['guardar']==true)
		{

			if( $imagen != "")
			{			
				if($_SESSION['tmptxt'] ==  $imagen) 
    			{
					$Usuarios->setNombre($_POST['nb_usuarios']);
					$Usuarios->setLogin($_POST['login']);
					$Usuarios->setContrasena(sha1($_POST['clave']));
					$Usuarios->setTelefono_trab($_POST['telefono_oficina']);
					$Usuarios->setEmail($_POST['email']);
					$Usuarios->setTipo_usuario($_POST['tipo_usuario']);
					$Usuarios->setAlto_nivel($_POST['alto_nivel']);
					$Usuarios->setPrimer_nivel($_POST['primer_nivel']);
					$Usuarios->setDirecciones($_POST['direcciones']);
					$Usuarios->setUnidades($_POST['unidades']);
					$Usuarios->setCoordinaciones($_POST['coordinaciones']);
					$Usuarios->setPerfil($_POST['perfil']);
					$Usuarios->setHabilitado($_POST['habilitado']);
					
					$existe =$Usuarios->Existe('vista_usuarios','nb_login_usuarios',$Usuarios->getLogin());
					
					if ($existe==0)
					{	
						if ($Usuarios->getDirecciones()=="")
						{
							$Usuarios->setDirecciones(0);
						}
						if ($Usuarios->getUnidades()=="")
						{
							$Usuarios->setUnidades(0);
						}
						if ($Usuarios->getCoordinaciones()=="")
						{
							$Usuarios->setCoordinaciones(0);
						}
						if ($Usuarios->getPerfil()=="")
						{
							$Usuarios->setPerfil(0);
						}
						if(	$Usuarios->getHabilitado()=="on")
						{
							$Usuarios->setHabilitado("true");
						}
						else
						{
							$Usuarios->setHabilitado("false");
						}
						
						$mensaje = $Usuarios->EjecutarFunciones("funcion_insertar_usuario('".$Usuarios->getNombre()."','".$Usuarios->getLogin()."','".$Usuarios->getContrasena()."','".$Usuarios->getTelefono_trab()."','".$Usuarios->getEmail()."','".$Usuarios->getCoordinaciones()."','".$Usuarios->getUnidades()."','".$Usuarios->getDirecciones()."','".$Usuarios->getPrimer_nivel()."','".$Usuarios->getAlto_nivel()."','".$Usuarios->getPerfil()."','".$Usuarios->getId_usuario()."','".$Usuarios->getId_direcciones_user()."','".$Usuarios->getTipo_usuario()."','".$Usuarios->getId_alto_nivel_user()."','".$Usuarios->getId_primer_nivel_user()."','".$Usuarios->getHabilitado()."','".$_SERVER["REMOTE_ADDR"]."')");
						
						if($Usuarios->getTipo_usuario()==2)
						{
							
							
							$parametro= "nb_login_usuarios = '".$Usuarios->getLogin()."'";
					    	$tabla= "vista_usuarios";
							$orden="nb_usuarios";		
					    	$campoId=array();
							$datos = $Usuarios->MostrarUsuarios(1,$tabla,$parametro,$orden);
							//Carga los registros
					   		while ( $row=pg_fetch_array($datos) )
							{ 
								array_push( $campoId, $row["cd_usuarios"] );	
							}
					    	//Prepara para la comunicacion
						
							for($j=1;$j<=9;$j++)
							{							
							switch($j)
							{
								case 1:
								
									$Modulosxusuarios->setId(1);
									$Modulosxusuarios->setIngresar($_POST['ingresarMantenimiento']);
									$Modulosxusuarios->getIngresar();
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarMantenimiento']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}								
									$Modulosxusuarios->setModificar($_POST['modificarMantenimiento']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}									
								break;
								case 2:
								
									$Modulosxusuarios->setId(2);
									$Modulosxusuarios->setIngresar($_POST['ingresarRecibida']);
									$Modulosxusuarios->getIngresar();
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarRecibida']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}								
									$Modulosxusuarios->setModificar($_POST['modificarRecibida']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}									
								break;
								case 3:
								
									$Modulosxusuarios->setId(3);
									$Modulosxusuarios->setIngresar($_POST['ingresarRespuestaRecibida']);
									$Modulosxusuarios->getIngresar();
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarRespuestaRecibida']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}								
									$Modulosxusuarios->setModificar($_POST['modificarRespuestaRecibida']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}									
								break;
								case 4:
								
									$Modulosxusuarios->setId(4);
									$Modulosxusuarios->setIngresar($_POST['ingresarOficios']);
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarOficios']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}
									$Modulosxusuarios->setModificar($_POST['modificarOficios']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}
								break;
								case 5:
								
									$Modulosxusuarios->setId(5);
									$Modulosxusuarios->setIngresar($_POST['ingresarRespuestaOficios']);
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarRespuestaOficios']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}
									$Modulosxusuarios->setModificar($_POST['modificarRespuestaOficios']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}
								break;
								case 6:
								
									$Modulosxusuarios->setId(6);
									$Modulosxusuarios->setIngresar($_POST['ingresarRemisiones']);
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarRemisiones']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}
									$Modulosxusuarios->setModificar($_POST['modificarRemisiones']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}
	
								break;
								case 7:
								
									$Modulosxusuarios->setId(7);
									$Modulosxusuarios->setIngresar($_POST['ingresarRespuestaRemisiones']);
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarRespuestaRemisiones']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}
									$Modulosxusuarios->setModificar($_POST['modificarRespuestaRemisiones']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}
	
								break;
								case 8:
								
									$Modulosxusuarios->setId(8);
									$Modulosxusuarios->setIngresar($_POST['ingresarArchivo']);
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarArchivo']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}
									$Modulosxusuarios->setModificar($_POST['modificarArchivo']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}								
								break;
								case 9:
								
									$Modulosxusuarios->setId(9);
									$Modulosxusuarios->setConsultar($_POST['consultarReportes']);
									$Modulosxusuarios->setIngresar("false");
									$Modulosxusuarios->setModificar("false");
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}
							   break;
								
							}
					
								$mensaje = $Modulosxusuarios->EjecutarFunciones("funcion_insertar_modulosxusuarios('".$Modulosxusuarios->getId()."','".$campoId[0]."','".$Modulosxusuarios->getIngresar()."','".$Modulosxusuarios->getConsultar()."','".$Modulosxusuarios->getModificar()."','".$Usuarios->getId_usuario()."','".$Usuarios->getId_alto_nivel_user()."','".$Usuarios->getId_primer_nivel_user()."','".$Usuarios->getId_direcciones_user()."','".$_SERVER["REMOTE_ADDR"]."')");
							}
						}						
						
						
						$_SESSION['estatus_msj']=2;
						$_SESSION['error_usuarios']="La Información fue Guardada con Éxito";
					}
					else
					{
						$_SESSION['estatus_msj']=1;
						$_SESSION['error_usuarios']="El Login que esta ingresando ya se encuentra registrado";
					}
			
				}
				else
				{
					$_SESSION['estatus_msj']=1;
					$_SESSION['error_usuarios']="Los Caracteres de la Imagen son Incorrectos";
					//$_SESSION['error_login']="Palabra Incorrecta!";
					$url_relativa = "siscor/vista/registrar_usuario.php";
				    header("Cache-Control: no-cache");
					header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
				}	
			}
		}//fin de guardar


		//modificar
		if($_POST['modificar']==true)
		{
			if( $imagen != "")
			{
				if($_SESSION['tmptxt'] ==  $imagen) 
		    	{
		    						
						
					
					$Usuarios->setNombre($_POST['nb_usuarios']);
					$Usuarios->setLogin($_POST['login']);
					$Usuarios->setContrasena(sha1($_POST['clave']));
					$Usuarios->setTelefono_trab($_POST['telefono_oficina']);
					$Usuarios->setEmail($_POST['email']);
					$Usuarios->setTipo_usuario($_POST['tipo_usuario']);
					$Usuarios->setAlto_nivel($_POST['alto_nivel']);
					$Usuarios->setPrimer_nivel($_POST['primer_nivel']);
					$Usuarios->setDirecciones($_POST['direcciones']);
					$Usuarios->setUnidades($_POST['unidades']);
					$Usuarios->setCoordinaciones($_POST['coordinaciones']);
					$Usuarios->setPerfil($_POST['perfil']);
					$Usuarios->setHabilitado($_POST['habilitado']);
					$Usuarios->setId($_POST['id_user']);
					if ($Usuarios->getDirecciones()=="")
					{
						$Usuarios->setDirecciones(0);
					}
					if ($Usuarios->getUnidades()=="")
					{
						$Usuarios->setUnidades(0);
					}
					if ($Usuarios->getCoordinaciones()=="")
					{
						$Usuarios->setCoordinaciones(0);
					}
					if ($Usuarios->getPerfil()=="")
					{
						$Usuarios->setPerfil(0);
					}
					if(	$Usuarios->getHabilitado()=="on")
					{
						$Usuarios->setHabilitado("true");
					}
					else
					{
						$Usuarios->setHabilitado("false");
					}
					if ($Usuarios->getContrasena()=="da39a3ee5e6b4b0d3255bfef95601890afd80709")
					{
						
						$mensaje = $Usuarios->EjecutarFunciones("funcion_mod_usuario('".$Usuarios->getId()."','".$Usuarios->getNombre()."','".$Usuarios->getTelefono_trab()."','".$Usuarios->getEmail()."','".$Usuarios->getCoordinaciones()."','".$Usuarios->getUnidades()."','".$Usuarios->getDirecciones()."','".$Usuarios->getPrimer_nivel()."','".$Usuarios->getAlto_nivel()."','".$Usuarios->getPerfil()."','".$Usuarios->getHabilitado()."','".$Usuarios->getId_usuario()."','".$Usuarios->getId_direcciones_user()."','".$Usuarios->getTipo_usuario()."','".$Usuarios->getId_alto_nivel_user()."','".$Usuarios->getId_primer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");

					}
					else
					{
						$mensaje = $Usuarios->EjecutarFunciones("funcion_mod_usuario_contrasena('".$Usuarios->getId()."','".$Usuarios->getNombre()."','".$Usuarios->getContrasena()."','".$Usuarios->getTelefono_trab()."','".$Usuarios->getEmail()."','".$Usuarios->getCoordinaciones()."','".$Usuarios->getUnidades()."','".$Usuarios->getDirecciones()."','".$Usuarios->getPrimer_nivel()."','".$Usuarios->getAlto_nivel()."','".$Usuarios->getPerfil()."','".$Usuarios->getHabilitado()."','".$Usuarios->getId_usuario()."','".$Usuarios->getId_direcciones_user()."','".$Usuarios->getTipo_usuario()."','".$Usuarios->getId_alto_nivel_user()."','".$Usuarios->getId_primer_nivel_user()."','".$_SERVER["REMOTE_ADDR"]."')");
	
					}
		    			$mensaje = $Modulosxusuarios->EjecutarFunciones("funcion_eli_modulosxusuarios('".$Usuarios->getId()."')");				
					
					for($j=1;$j<=9;$j++)
							{							
							switch($j)
							{
								case 1:
								
									$Modulosxusuarios->setId(1);
									$Modulosxusuarios->setIngresar($_POST['ingresarMantenimiento']);
									$Modulosxusuarios->getIngresar();
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarMantenimiento']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}								
									$Modulosxusuarios->setModificar($_POST['modificarMantenimiento']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}									
								break;
								case 2:
								
									$Modulosxusuarios->setId(2);
									$Modulosxusuarios->setIngresar($_POST['ingresarRecibida']);
									$Modulosxusuarios->getIngresar();
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarRecibida']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}								
									$Modulosxusuarios->setModificar($_POST['modificarRecibida']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}									
								break;
								case 3:
								
									$Modulosxusuarios->setId(3);
									$Modulosxusuarios->setIngresar($_POST['ingresarRespuestaRecibida']);
									$Modulosxusuarios->getIngresar();
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarRespuestaRecibida']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}								
									$Modulosxusuarios->setModificar($_POST['modificarRespuestaRecibida']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}									
								break;
								case 4:
								
									$Modulosxusuarios->setId(4);
									$Modulosxusuarios->setIngresar($_POST['ingresarOficios']);
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarOficios']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}
									$Modulosxusuarios->setModificar($_POST['modificarOficios']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}
								break;
								case 5:
								
									$Modulosxusuarios->setId(5);
									$Modulosxusuarios->setIngresar($_POST['ingresarRespuestaOficios']);
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarRespuestaOficios']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}
									$Modulosxusuarios->setModificar($_POST['modificarRespuestaOficios']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}
								break;
								case 6:
								
									$Modulosxusuarios->setId(6);
									$Modulosxusuarios->setIngresar($_POST['ingresarRemisiones']);
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarRemisiones']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}
									$Modulosxusuarios->setModificar($_POST['modificarRemisiones']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}
	
								break;
								case 7:
								
									$Modulosxusuarios->setId(7);
									$Modulosxusuarios->setIngresar($_POST['ingresarRespuestaRemisiones']);
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarRespuestaRemisiones']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}
									$Modulosxusuarios->setModificar($_POST['modificarRespuestaRemisiones']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}
	
								break;
								case 8:
								
									$Modulosxusuarios->setId(8);
									$Modulosxusuarios->setIngresar($_POST['ingresarArchivo']);
									if(	$Modulosxusuarios->getIngresar()=="on")
									{
										$Modulosxusuarios->setIngresar("true");
									}
									else
									{
										$Modulosxusuarios->setIngresar("false");
									}
									$Modulosxusuarios->setConsultar($_POST['consultarArchivo']);
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}
									$Modulosxusuarios->setModificar($_POST['modificarArchivo']);
									if(	$Modulosxusuarios->getModificar()=="on")
									{
										$Modulosxusuarios->setModificar("true");
									}
									else
									{
										$Modulosxusuarios->setModificar("false");
									}								
								break;
								case 9:
								
									$Modulosxusuarios->setId(9);
									$Modulosxusuarios->setConsultar($_POST['consultarReportes']);
									$Modulosxusuarios->setIngresar("false");
									$Modulosxusuarios->setModificar("false");
									if(	$Modulosxusuarios->getConsultar()=="on")
									{
										$Modulosxusuarios->setConsultar("true");
									}
									else
									{
										$Modulosxusuarios->setConsultar("false");
									}
							   break;
							
						}
							$mensaje = $Modulosxusuarios->EjecutarFunciones("funcion_insertar_modulosxusuarios('".$Modulosxusuarios->getId()."','".$Usuarios->getId()."','".$Modulosxusuarios->getIngresar()."','".$Modulosxusuarios->getConsultar()."','".$Modulosxusuarios->getModificar()."','".$Usuarios->getId_usuario()."','".$Usuarios->getId_alto_nivel_user()."','".$Usuarios->getId_primer_nivel_user()."','".$Usuarios->getId_direcciones_user()."','".$_SERVER["REMOTE_ADDR"]."')");
						}
					
					
					
						$_SESSION['estatus_msj']=2;
						unset($_SESSION['nombre_usuario']);
			   	  		unset($_SESSION['nombre_login']);
			   	  		unset($_SESSION['telefono']);
			   	  		unset($_SESSION['email']);
			   	  		unset($_SESSION['tipo_usuario_seleccionado']);
			   	  		unset($_SESSION['alto_nivel_seleccionado']);
			   	  		unset($_SESSION['primer_nivel_seleccionado']);
						unset($_SESSION['direcciones_seleccionado']);
						unset($_SESSION['unidades_seleccionado']);
						unset($_SESSION['coordinaciones_seleccionado']);
						unset($_SESSION['perfiles_seleccionado']);
						unset($_SESSION['habilitado']);			
						unset($_SESSION['id_usuario']);	
						unset($_SESSION['campoIdUsuarios']);
						unset($_SESSION['campoNombreUsuarios']);
						unset($_SESSION['cantidadUsuarios']);
						unset($_SESSION['Usuarios_seleccionado']);
						unset($_SESSION['chkconsultarMantenimiento']);
						unset($_SESSION['chkmodificarMantenimiento']);
						unset($_SESSION['chkingresarRecibida']);
						unset($_SESSION['chkconsultarRecibida']);
						unset($_SESSION['chkmodificarRecibida']);							
						unset($_SESSION['chkingresarRespuestaRecibida']);
						unset($_SESSION['chkconsultarRespuestaRecibida']);
						unset($_SESSION['chkmodificarRespuestaRecibida']);
						unset($_SESSION['chkingresarOficios']);
						unset($_SESSION['chkconsultarOficios']);
						unset($_SESSION['chkmodificarOficios']);
						unset($_SESSION['chkingresarRespuestaOficios']);
						unset($_SESSION['chkconsultarRespuestaOficios']);
						unset($_SESSION['chkmodificarRespuestaOficios']);
						unset($_SESSION['chkingresarRemisiones']);
						unset($_SESSION['chkconsultarRemisiones']);
						unset($_SESSION['chkmodificarRemisiones']);
						unset($_SESSION['chkingresarRespuestaRemisiones']);
						unset($_SESSION['chkconsultarRespuestaRemisiones']);
						unset($_SESSION['chkmodificarRespuestaRemisiones']);		
						unset($_SESSION['chkingresarArchivo']);
						unset($_SESSION['chkconsultarArchivo']);
						unset($_SESSION['chkmodificarArchivo']);
						unset($_SESSION['chkconsultarArchivo']);
						unset($_SESSION['chkconsultarReportes']);					
						unset($_SESSION['campoingresar']);
						
						
						$_SESSION['error_usuarios_mod']="La Información fue Guardada con Éxito";				
						$url_relativa = "siscor/controlador/control_modif_usuarios.php";
					    header("Cache-Control: no-cache");
						header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
					    exit;					
					
					
					
				}
				else
				{
					$_SESSION['estatus_msj']=1;
					$_SESSION['error_usuarios']="Los Caracteres de la Imagen son Incorrectos";
					//$_SESSION['error_login']="Palabra Incorrecta!";
					$url_relativa = "siscor/vista/registrar_usuario.php";
				    header("Cache-Control: no-cache");
					header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
				}	
			}	
		}//fin modificar


		//boton regresar
		if ($_POST['regresar']==true)
		{
			unset($_SESSION['nombre_usuario']);
   	  		unset($_SESSION['nombre_login']);
   	  		unset($_SESSION['telefono']);
   	  		unset($_SESSION['email']);
   	  		unset($_SESSION['tipo_usuario_seleccionado']);
   	  		unset($_SESSION['alto_nivel_seleccionado']);
   	  		unset($_SESSION['primer_nivel_seleccionado']);
			unset($_SESSION['direcciones_seleccionado']);
			unset($_SESSION['unidades_seleccionado']);
			unset($_SESSION['coordinaciones_seleccionado']);
			unset($_SESSION['perfiles_seleccionado']);
			unset($_SESSION['habilitado']);			
			unset($_SESSION['id_usuario']);	
			unset($_SESSION['campoIdUsuarios']);
			unset($_SESSION['campoNombreUsuarios']);
			unset($_SESSION['cantidadUsuarios']);
			unset($_SESSION['Usuarios_seleccionado']);
			unset($_SESSION['chkingresarMantenimiento']);
			unset($_SESSION['chkconsultarMantenimiento']);
			unset($_SESSION['chkmodificarMantenimiento']);
			unset($_SESSION['chkingresarRecibida']);
			unset($_SESSION['chkconsultarRecibida']);
			unset($_SESSION['chkmodificarRecibida']);							
			unset($_SESSION['chkingresarRespuestaRecibida']);
			unset($_SESSION['chkconsultarRespuestaRecibida']);
			unset($_SESSION['chkmodificarRespuestaRecibida']);
			unset($_SESSION['chkingresarOficios']);
			unset($_SESSION['chkconsultarOficios']);
			unset($_SESSION['chkmodificarOficios']);
			unset($_SESSION['chkingresarRespuestaOficios']);
			unset($_SESSION['chkconsultarRespuestaOficios']);
			unset($_SESSION['chkmodificarRespuestaOficios']);
			unset($_SESSION['chkingresarRemisiones']);
			unset($_SESSION['chkconsultarRemisiones']);
			unset($_SESSION['chkmodificarRemisiones']);
			unset($_SESSION['chkingresarRespuestaRemisiones']);
			unset($_SESSION['chkconsultarRespuestaRemisiones']);
			unset($_SESSION['chkmodificarRespuestaRemisiones']);		
			unset($_SESSION['chkingresarArchivo']);
			unset($_SESSION['chkconsultarArchivo']);
			unset($_SESSION['chkmodificarArchivo']);
			unset($_SESSION['chkconsultarArchivo']);
			unset($_SESSION['chkconsultarReportes']);		
			unset($_SESSION['campoingresar']);					
			
			$url_relativa = "siscor/controlador/control_modif_usuarios.php";
		    header("Cache-Control: no-cache");
			header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
			exit;
		}

		//llena el combo tipo usuarios
		$tabla= "vista_tipo_usuarios";
		$orden="nb_tipo_usuarios";
		$cont = $Usuarios->Mostrar(0,$tabla,$orden);
			//echo($cant); die;
		if ( $cont != 0 ) 
		{
			//echo $alto_nivel->Mostrar(0); die();
			$_SESSION['cantidad'] = $cont;
			//echo $alto_nivel->Mostrar(0); die();
			//se crea un arreglo donde se alogen los registros necesarios
		    $campoId=array();
		    $campoNombre=array();
			$datos = $Usuarios->Mostrar(1,$tabla,$orden);
			//Carga los registros
		    while ( $row=pg_fetch_array($datos) )
			{ 
				array_push( $campoId , $row["cd_tipo_usuarios"] );	
				array_push( $campoNombre , $row["nb_tipo_usuarios"] );				
			}
		    //Prepara para la comunicacion
			$_SESSION['campoIdTipoUsuarios'] = $campoId;
			$_SESSION['campoNombreTipoUsuarios'] = $campoNombre;		
		}//fin de llena el combo tipo usuarios
		
		//llena combo de alto nivel
		$tabla= "vista_mostrar_alto_nivel";
		$orden="nb_alto_nivel";		
		$cont = $Usuarios->Mostrar(0,$tabla,$orden);
		//echo($cant); die;
		if ( $cont != 0 ) 
		{
			//echo $alto_nivel->Mostrar(0); die();
			$_SESSION['cantidad_alto_nivel'] = $cont;
			//echo $alto_nivel->Mostrar(0); die();
			//se crea un arreglo donde se alogen los registros necesarios
		    $campoId=array();
		    $campoNombre=array();
			$datos = $Usuarios->Mostrar(1,$tabla,$orden);
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
		
		//combo para llenar los perfiles		
		$tabla= "vista_perfiles";
		$orden="nb_perfiles";		
		$cont = $Usuarios->Mostrar(0,$tabla,$orden);
		//echo($cant); die;
		if ( $cont != 0 ) 
		{
			//echo $alto_nivel->Mostrar(0); die();
			$_SESSION['cantidadPerfil'] = $cont;
			//echo $alto_nivel->Mostrar(0); die();
			//se crea un arreglo donde se alogen los registros necesarios
		    $campoId=array();
		    $campoNombre=array();
			$datos = $Usuarios->Mostrar(1,$tabla,$orden);
			//Carga los registros
			    while ( $row=pg_fetch_array($datos) )
				{ 
					array_push( $campoId , $row["cd_perfiles"] );	
					array_push( $campoNombre , $row["nb_perfiles"] );				
				}
		    	//Prepara para la comunicacion
				$_SESSION['campoIdPerfil'] = $campoId;
		    	$_SESSION['campoNombrePerfil'] = $campoNombre;		
		}//fin de combo para llenar los perfiles
				
		//combo para llenar primer_nivel		
		if ($_SESSION['primer_nivel_seleccionado']!="")
		{
			$valor="cd_alto_nivel=".$_SESSION['alto_nivel_seleccionado'];
			$tabla= "vista_mostrar_primer_nivel";
			$orden="nb_primer_nivel";
			$cont = $Usuarios->MostrarValores(0,$tabla,$orden,$valor);
				//echo($cant); die;
				if ( $cont != 0 ) 
				{
					//echo $alto_nivel->Mostrar(0); die();
					$_SESSION['cantidad_primer_nivel'] = $cont;
					//echo $alto_nivel->Mostrar(0); die();
					//se crea un arreglo donde se alogen los registros necesarios
			    	$campoId=array();
			    	$campoNombre=array();
					$datos = $Usuarios->MostrarValores(1,$tabla,$orden,$valor);
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
			$valor="cd_primer_nivel=".$_SESSION['primer_nivel_seleccionado'];
			$tabla= "vista_mostrar_direcciones";
			$orden="nb_direcciones";
			$cont = $Usuarios->MostrarValores(0,$tabla,$orden,$valor);
			//echo($cant); die;
				if ( $cont != 0 ) 
				{
					//echo $alto_nivel->Mostrar(0); die();
					$_SESSION['cantidaddirecciones'] = $cont;
					//echo $alto_nivel->Mostrar(0); die();
					//se crea un arreglo donde se alogen los registros necesarios
				    $campoId=array();
				    $campoNombre=array();
					$datos = $Usuarios->MostrarValores(1,$tabla,$orden,$valor);
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
		}//fin de combo para llenar direcciones
		
		//combo para llenar unidades
		if ($_SESSION['unidades_seleccionado']!="")
		{
			$valor="cd_direcciones=".$_SESSION['direcciones_seleccionado'];
			$tabla= "vista_mostrar_unidades";
			$orden="nb_unidades";
			$cont = $Usuarios->MostrarValores(0,$tabla,$orden,$valor);
			//echo($cant); die;
				if ( $cont != 0 ) 
				{
					//echo $alto_nivel->Mostrar(0); die();
					$_SESSION['cantidadunidades'] = $cont;
					//echo $alto_nivel->Mostrar(0); die();
					//se crea un arreglo donde se alogen los registros necesarios
		    		$campoId=array();
		    		$campoNombre=array();
					$datos = $Usuarios->MostrarValores(1,$tabla,$orden,$valor);
					//Carga los registros
		    			while ( $row=pg_fetch_array($datos) )
						{ 
							array_push( $campoId , $row["cd_unidades"] );	
							array_push( $campoNombre , $row["nb_unidades"] );				
						}
			    	//Prepara para la comunicacion
					$_SESSION['campoIdunidades'] = $campoId;
					$_SESSION['campoNombreunidades'] = $campoNombre;		
				}
		}//fin decombo para llenar unidades		
		
		//combo para llenar coordinacionces
		if ($_SESSION['coordinaciones_seleccionado']!="")
		{ 
			$valor="cd_unidades=".$_SESSION['unidades_seleccionado'];
			$tabla= "vista_mostrar_coordinaciones";
			$orden="nb_coordinaciones";
			$cont = $Usuarios->MostrarValores(0,$tabla,$orden,$valor);
			//echo($cant); die;
				if ( $cont != 0 ) 
				{
					//echo $alto_nivel->Mostrar(0); die();
					$_SESSION['cantidadcoordinaciones'] = $cont;
					//echo $alto_nivel->Mostrar(0); die();
					//se crea un arreglo donde se alogen los registros necesarios
			    	$campoId=array();
			    	$campoNombre=array();
					$datos = $Usuarios->MostrarValores(1,$tabla,$orden,$valor);
					//Carga los registros
				    	while ( $row=pg_fetch_array($datos) )
						{ 
							array_push( $campoId , $row["cd_coordinaciones"] );	
							array_push( $campoNombre , $row["nb_coordinaciones"] );				
						}
			    	//Prepara para la comunicacion
					$_SESSION['campoIdcoordinaciones'] = $campoId;
					$_SESSION['campoNombrecoordinaciones'] = $campoNombre;		
				}
		}// fin de combo para llenar coordinacionces		
		
		$url_relativa = "siscor/vista/registrar_usuario.php";
		header("Cache-Control: no-cache");
		header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
	
  
?>