<?php
session_start();
	include_once("../modelo/class_inicio.php"); 
	
	if($_SESSION['tmptxt'] == $_POST['tmptxt'])	
	{
			$Inicio=new Inicio();
       	    $Inicio->setLogin($_POST['usuario']);
      	    $Inicio->setContrasena(sha1($_POST['password']));
	    	if (!$Inicio->Sesion())
			{
				$_SESSION['estatus_msj']=2;
			    $_SESSION['error_inicio']="El Usuario o La Contrase&ntilde;a son incorrectas. Int&eacute;ntelo de nuevo.";
			    $url_relativa = "siscor/";
	  			header("Cache-Control: no-cache");
			    header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
			}
			else
			{
				
			if ($Inicio->getHabilitado()==t)
			{
				if($Inicio->getCambio_pass()==t)
				{
				   $_SESSION['codigo']=($Inicio->getId());
				   $_SESSION['nombre_user']=($Inicio->getNombre());
				   $_SESSION['reset']=$Inicio->getCambio_pass();
				   $url_relativa = "siscor/vista/cambio_pass.php";
	               header("Cache-Control: no-cache");
				   header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
				   exit;
				}
				
				
               if($Inicio->getTipo_usuario()==1)
               {
	               $_SESSION['alto_nivel_user'] =($Inicio->getAlto_nivel());
	               $_SESSION['primer_nivel_user']=($Inicio->getId_primer_nivel());
	               $_SESSION['direcciones_user'] =($Inicio->getDirecciones());
	               $_SESSION['nombre_user']=($Inicio->getNombre());
	               $_SESSION['codigo']=($Inicio->getId());
	               $_SESSION['tipo_user']=($Inicio->getTipo_usuario());
	               $url_relativa = "siscor/vista/menu_principal_admin.php";
	               header("Cache-Control: no-cache");
	               header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
               }
               else
               {
	               $_SESSION['alto_nivel_user'] =($Inicio->getAlto_nivel());
	               $_SESSION['primer_nivel_user']=($Inicio->getId_primer_nivel());
	               $_SESSION['direcciones_user'] =($Inicio->getDirecciones());
	               $_SESSION['unidades_user'] =($Inicio->getUnidades());
	               $_SESSION['coordinaciones_user'] =($Inicio->getCoordinaciones());
	               $_SESSION['nombre_user']=($Inicio->getNombre());
	               $_SESSION['codigo']=($Inicio->getId());
	               $_SESSION['perfil']=($Inicio->getPerfil());
	               $url_relativa = "siscor/vista/menu_principal.php";
	               header("Cache-Control: no-cache");
                   header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
               }
		   }
		   else
		   {
		         $_SESSION['estatus_msj']=2;
			     $_SESSION['error_inicio']="Usuario deshabilitado temporalmente";
			 	 $url_relativa = "siscor/";
			     header("Cache-Control: no-cache");
			 	 header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
		   } 
		   }
	}
	else
	{
    $_SESSION['estatus_msj']=2;
	$_SESSION['error_inicio']="Los Caracteres de la Imagen son Incorrectos";
	$url_relativa = "siscor/";
	header("Cache-Control: no-cache");
    header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
	}	
?>