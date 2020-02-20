<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_usuarios.php");
  

	$Usuarios = new Usuarios();
	$Usuarios->setId_usuario($_SESSION['codigo']);
	$Usuarios->setId_direcciones_user($_SESSION['direcciones_user']);
	$Usuarios->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$Usuarios->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
	$Usuarios->setTipo_usuario($_SESSION['tipo_user']);

	//chequea la imagen del capcha para guardar los datos
	if($_POST['cambiar']==true)
	{			
		$imagen=$_POST['tmptxt'];
		if($_SESSION['tmptxt'] ==  $imagen) 
    	{
			$existe =$Usuarios->clave();
			
			if ($existe==1)
			{				
				
				if (sha1($_POST['pass_actual'])==$Usuarios->getContrasena())
				{
					if ($_SESSION['reset']!='t')
					{	
						$pass_new=sha1($_POST['pass_nuevo']);
						$mensaje = $Usuarios->EjecutarFunciones("funcion_mod_usuario_contrasena_user('".$Usuarios->getId_usuario()."','".$pass_new."','".$_SERVER["REMOTE_ADDR"]."')");
						$_SESSION['estatus_msj']=2;
						$_SESSION['error_cambio_pass']="La Contrase&ntilde;a fue Modificada con Éxito";
					}
					else
					{
						$pass_new=sha1($_POST['pass_nuevo']);
						$mensaje = $Usuarios->EjecutarFunciones("funcion_mod_usuario_contrasena_user('".$Usuarios->getId_usuario()."','".$pass_new."','".$_SERVER["REMOTE_ADDR"]."')");
						$_SESSION['estatus_msj']=2;
						$_SESSION['error_inicio']="La Contrase&ntilde;a fue Modificada con Éxito";
						$url_relativa = "siscor/";
						header("Cache-Control: no-cache");
						header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
						exit;						
					}	
				}
				else
				{
					$_SESSION['estatus_msj']=1;
					$_SESSION['error_cambio_pass']="La Contrase&ntilde;a Actual es Inválida";	
				}
				
			}
		}
		else
		{
			$_SESSION['estatus_msj']=1;
			$_SESSION['error_cambio_pass']="Los Caracteres de la Imagen son Incorrectos";
			$url_relativa = "siscor/vista/cambio_pass.php";
		    header("Cache-Control: no-cache");
			header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
		}	
		
	}//fin de guardar


	$url_relativa = "siscor/vista/cambio_pass.php";
	header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
	
  
?>