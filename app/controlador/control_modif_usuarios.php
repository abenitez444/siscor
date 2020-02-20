<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_usuarios.php"); 
include_once("../modelo/class_modulosxusuarios.php");

	$Usuarios = new Usuarios();
	$Modulosxusuarios= new Modulosxusuarios();
	$Usuarios->setId_usuario($_SESSION['codigo']);
	$Usuarios->setId_direcciones_user($_SESSION['direcciones_user']);
	$Usuarios->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	$Usuarios->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
	$Usuarios->setNombre($_POST['nb_usuarios']);
	$Usuarios->setTipo_usuario($_POST['tipo_usuario']);
	$Usuarios->setAlto_nivel($_POST['alto_nivel']);
	$Usuarios->setPrimer_nivel($_POST['primer_nivel']);
	$Usuarios->setDirecciones($_POST['direcciones']);
	$Usuarios->setUnidades($_POST['unidades']);
	$Usuarios->setCoordinaciones($_POST['coordinaciones']);
	$Usuarios->setPerfil($_POST['perfiles']);
	$Usuarios->setHabilitado($_POST['habi_habi']);
	//datos de los checked box marcados
	$habi_user=$_POST['habi_user'];
	$habi_tipo_user=$_POST['habi_tipo_user'];	
	$habi_alto_nivel=$_POST['habi_alto_nivel'];
	$habi_perfiles=$_POST['habi_perfiles'];
	$habi=$_POST['habi'];

	$Usuarios->setId(isset($_GET['id'])? $_GET['id'] : "");

	//lamado para modificar los datos	
	if ($Usuarios->getId()!="")
	{
		$existe =$Usuarios->CargarDatos();	
     	$_SESSION['nombre_usuario']=$Usuarios->getNombre() ;
     	$_SESSION['nombre_login']=$Usuarios->getLogin();
     	$_SESSION['telefono']=$Usuarios->getTelefono_trab();
     	$_SESSION['email']=$Usuarios->getEmail();
     	$_SESSION['tipo_usuario_seleccionado']=$Usuarios->getTipo_usuario();
     	$_SESSION['alto_nivel_seleccionado']= $Usuarios->getAlto_nivel();
     	$_SESSION['primer_nivel_seleccionado']=$Usuarios->getId_primer_nivel();
		$_SESSION['direcciones_seleccionado']=$Usuarios->getDirecciones();
		$_SESSION['unidades_seleccionado']=$Usuarios->getUnidades();
			
		$_SESSION['coordinaciones_seleccionado']=$Usuarios->getCoordinaciones();
		
		$_SESSION['perfiles_seleccionado']= $Usuarios->getPerfil();
		$_SESSION['habilitado']= $Usuarios->getHabilitado();			
		$_SESSION['id_usuario']=$Usuarios->getId();
     	$_SESSION['direcciones_user']= $Usuarios->getId_direcciones_user();
     	$_SESSION['alto_nivel_user']= $Usuarios->getId_alto_nivel_user();
     	$_SESSION['primer_nivel_user']= $Usuarios->getId_primer_nivel_user();

    	$campoin=array();
    	$campocon=array();
    	$campomod=array();
    		    	
    	$Modulosxusuarios->setId($Usuarios->getId());
		$datos = $Modulosxusuarios->Mostrar();
		//Carga los registros
		while ( $row=pg_fetch_array($datos) )
			{ 
				array_push( $campoin, $row["in_ingresar"] );
				array_push( $campocon, $row["in_consultar"] );
				array_push( $campomod, $row["in_modificar"] );
					
			}
		
    	//Prepara para la comunicacion
		
    	$_SESSION['campoingresar']=$campoin;
    	$_SESSION['campoconsultar']=$campocon;
    	$_SESSION['campomodificar']=$campomod;
	
     	$url_relativa = "control_usuarios.php";
		header("Cache-Control: no-cache");
     	header("Location: ".$url_relativa);
	}
	
	
if ($_POST['consultar']==true)
{
	$_SESSION['activo']=1;	
	if($habi_user=="on")
	{
		$parametro = "nb_usuarios LIKE '%".$Usuarios->getNombre()."%'";
	}
	if($habi_tipo_user=="on")
	{
		if ($parametro=="")
		{
			$parametro=" cd_tipo_usuarios=".$Usuarios->getTipo_usuario();
		}
		else
		{
			$parametro= $parametro . " and  cd_tipo_usuarios=".$Usuarios->getTipo_usuario();
		}
	}
	if($habi_alto_nivel== "on")
	{
		$parametro2="cd_alto_nivel_fk=".$Usuarios->getAlto_nivel();
   		if($Usuarios->getPrimer_nivel()!=0)
   		{
   			$parametro2=$parametro2 ." and cd_primer_nivel_fk=".$Usuarios->getPrimer_nivel();
   		}
   		if ($Usuarios->getDirecciones()!=0)
   		{
   			$parametro2=$parametro2 ." and cd_direcciones_fk=".$Usuarios->getDirecciones();
   		}
   		if($Usuarios->getUnidades()!=0)
   		{
   			$parametro2=$parametro2 ." and cd_unidades_fk=".$Usuarios->getUnidades();
   		}
   		if($Usuarios->getCoordinaciones()!=0)
   		{
   			$parametro2=$parametro2 ." and cd_coordinaciones_fk=".$Usuarios->getCoordinaciones();
   		}	
   		if ($parametro=="")
   		{
			$parametro=$parametro2;
		}
		else
		{
			$parametro= $parametro ." and ". $parametro2;
		}
	}
	if($habi_perfiles=="on")
	{
		if ($parametro=="")
		{
			$parametro=" cd_perfiles_fk= ".$Usuarios->getPerfil();
		}
		else
		{
			$parametro= $parametro . " and cd_perfiles_fk=". $Usuarios->getPerfil();
		}
	}
	if($habi=="on")
	{
		if ($Usuarios->getHabilitado()=="on")
		{
			$Usuarios->setHabilitado("true");
		}
		else
		{
			$Usuarios->setHabilitado("false");
		}
		if ($parametro=="")
		{
			$parametro=" in_habilitado_usuarios=".$Usuarios->getHabilitado();
		}
		else
		{
			$parametro= $parametro . " and in_habilitado_usuarios=". $Usuarios->getHabilitado();
		}
	}
	$tabla= "vista_usuarios";
	$orden="nb_usuarios";		
	$cont = $Usuarios->MostrarUsuarios(0,$tabla,$parametro,$orden);
	//echo($cant); die;
	if ( $cont != 0 ) 
	{
		//echo $alto_nivel->Mostrar(0); die();
		$_SESSION['cantidadUsuarios'] = $cont;
		//echo $alto_nivel->Mostrar(0); die();
		//se crea un arreglo donde se alogen los registros necesarios
    	$campoId=array();
    	$campoNombre=array();
    	$campoLogin=array();
    	$campoAtoNivel=array();
    	$campoPrimerNivel=array();
    	$campoDireccion=array();
    	
		$datos = $Usuarios->MostrarUsuarios(1,$tabla,$parametro,$orden);
		//Carga los registros
    		while ( $row=pg_fetch_array($datos) )
			{ 
				array_push( $campoId, $row["cd_usuarios"] );	
				array_push( $campoNombre, $row["nb_usuarios"] );
				array_push( $campoLogin, $row["nb_login_usuarios"] );
				array_push( $campoAtoNivel, $row["nb_alto_nivel"] );	
				array_push( $campoPrimerNivel, $row["nb_primer_nivel"] );
				array_push( $campoDireccion, $row["nb_direcciones"] );	
			}
    	//Prepara para la comunicacion
		$_SESSION['campoIdUsuarios']=$campoId;
    	$_SESSION['campoNombreUsuarios']=$campoNombre;
    	$_SESSION['campoNombreLogin']=$campoLogin;
    	$_SESSION['campoAltoNivelUsuarios']=$campoAtoNivel;
    	$_SESSION['campoPrimerNivelUsuarios']=$campoPrimerNivel;
    	$_SESSION['campoDireccionesUsuarios']=$campoDireccion;
    	$_SESSION['Usuarios_seleccionado']=1;
    		
	}
	else
	{
		$_SESSION['Usuarios_seleccionado']=0;
	}
	
	
}//fin de consultar
			
//carga el combo de los tipos de usuarios
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
}//fin de carga los tipos de usuarios

//carga el combo de alto nivel
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
}//fin de carga de alto nivel
	  
//carga del combo de perfiles		
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
}

if ($Usuarios->getId()=="")
{
	$url_relativa = "siscor/vista/modificar_usuario.php";
   	header("Cache-Control: no-cache");
	header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
}	  
?>
