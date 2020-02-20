<?php
include('../controlador/script.php');
include("constantes.php"); // llamo a las costantes de la conexion 
include_once("BaseDatos.php"); //llamo a la conexion

class Usuarios
{
   
	private $id;
	private $nombre;
	private $login;
	private $contrasena;
	private $telefono_trab;
	private $email;
	private $alto_nivel;
	private $primer_nivel;
	private $direcciones;
	private $unidades;
	private $coordinaciones;
	private $perfil;
	private $tipo_usuario;
	private $habilitado;
	private $id_usuario;
	private $id_alto_nivel;
	private $id_primer_nivel;
	private $id_direcciones_user;	
	private $id_alto_nivel_user;
	private $id_primer_nivel_user;	
	private $nb_direcciones;	
	private $nb_alto_nivel;
	private $nb_primer_nivel;
	/**
	 * @return the $id_alto_nivel
	 */
	/**
	 * @return the $id_alto_nivel_usuarios
	 */
	/**
	 * @return the $nb_direcciones
	 */
	public function getNb_direcciones() {
		return $this->nb_direcciones;
	}

	/**
	 * @return the $nb_alto_nivel
	 */
	public function getNb_alto_nivel() {
		return $this->nb_alto_nivel;
	}

	/**
	 * @return the $nb_primer_nivel
	 */
	public function getNb_primer_nivel() {
		return $this->nb_primer_nivel;
	}

	/**
	 * @param $nb_direcciones the $nb_direcciones to set
	 */
	public function setNb_direcciones($nb_direcciones) {
		$this->nb_direcciones = $nb_direcciones;
	}

	/**
	 * @param $nb_alto_nivel the $nb_alto_nivel to set
	 */
	public function setNb_alto_nivel($nb_alto_nivel) {
		$this->nb_alto_nivel = $nb_alto_nivel;
	}

	/**
	 * @param $nb_primer_nivel the $nb_primer_nivel to set
	 */
	public function setNb_primer_nivel($nb_primer_nivel) {
		$this->nb_primer_nivel = $nb_primer_nivel;
	}

	public function getId_alto_nivel_user() {
		return $this->id_alto_nivel_user;
	}

	/**
	 * @return the $id_primer_nivel_usuarios
	 */
	public function getId_primer_nivel_user() {
		return $this->id_primer_nivel_user;
	}

	/**
	 * @param $id_alto_nivel_usuarios the $id_alto_nivel_usuarios to set
	 */
	public function setId_alto_nivel_user($id_alto_nivel_user) {
		$this->id_alto_nivel_user = $id_alto_nivel_user;
	}

	/**
	 * @param $id_primer_nivel_usuarios the $id_primer_nivel_usuarios to set
	 */
	public function setId_primer_nivel_user($id_primer_nivel_user) {
		$this->id_primer_nivel_user = $id_primer_nivel_user;
	}

	public function getId_alto_nivel() {
		return $this->id_alto_nivel;
	}

	/**
	 * @return the $id_primer_nivel
	 */
	public function getId_primer_nivel() {
		return $this->id_primer_nivel;
	}

	/**
	 * @param $id_alto_nivel the $id_alto_nivel to set
	 */
	public function setId_alto_nivel($id_alto_nivel) {
		$this->id_alto_nivel = $id_alto_nivel;
	}

	/**
	 * @param $id_primer_nivel the $id_primer_nivel to set
	 */
	public function setId_primer_nivel($id_primer_nivel) {
		$this->id_primer_nivel = $id_primer_nivel;
	}
   /**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $nombre
	 */
	public function getNombre() {
		return $this->nombre;
	}

	/**
	 * @return the $login
	 */
	public function getLogin() {
		return $this->login;
	}

	/**
	 * @return the $contrasena
	 */
	public function getContrasena() {
		return $this->contrasena;
	}

	/**
	 * @return the $telefono_trab
	 */
	public function getTelefono_trab() {
		return $this->telefono_trab;
	}

	/**
	 * @return the $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @return the $alto_nivel
	 */
	public function getAlto_nivel() {
		return $this->alto_nivel;
	}

	/**
	 * @return the $primer_nivel
	 */
	public function getPrimer_nivel() {
		return $this->primer_nivel;
	}

	/**
	 * @return the $direcciones
	 */
	public function getDirecciones() {
		return $this->direcciones;
	}

	/**
	 * @return the $unidades
	 */
	public function getUnidades() {
		return $this->unidades;
	}

	/**
	 * @return the $coordinaciones
	 */
	public function getCoordinaciones() {
		return $this->coordinaciones;
	}

	/**
	 * @return the $perfil
	 */
	public function getPerfil() {
		return $this->perfil;
	}

	/**
	 * @return the $tipo_usuario
	 */
	public function getTipo_usuario() {
		return $this->tipo_usuario;
	}

	/**
	 * @return the $habilitado
	 */
	public function getHabilitado() {
		return $this->habilitado;
	}

	/**
	 * @return the $id_usuario
	 */
	public function getId_usuario() {
		return $this->id_usuario;
	}

	/**
	 * @return the $id_direcciones_usuarios
	 */
	public function getId_direcciones_user() {
		return $this->id_direcciones_user;
	}

	/**
	 * @param $id the $id to set
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param $nombre the $nombre to set
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	/**
	 * @param $login the $login to set
	 */
	public function setLogin($login) {
		$this->login = $login;
	}

	/**
	 * @param $contrasena the $contrasena to set
	 */
	public function setContrasena($contrasena) {
		$this->contrasena = $contrasena;
	}

	/**
	 * @param $telefono_trab the $telefono_trab to set
	 */
	public function setTelefono_trab($telefono_trab) {
		$this->telefono_trab = $telefono_trab;
	}

	/**
	 * @param $email the $email to set
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @param $alto_nivel the $alto_nivel to set
	 */
	public function setAlto_nivel($alto_nivel) {
		$this->alto_nivel = $alto_nivel;
	}

	/**
	 * @param $primer_nivel the $primer_nivel to set
	 */
	public function setPrimer_nivel($primer_nivel) {
		$this->primer_nivel = $primer_nivel;
	}

	/**
	 * @param $direcciones the $direcciones to set
	 */
	public function setDirecciones($direcciones) {
		$this->direcciones = $direcciones;
	}

	/**
	 * @param $unidades the $unidades to set
	 */
	public function setUnidades($unidades) {
		$this->unidades = $unidades;
	}

	/**
	 * @param $coordinaciones the $coordinaciones to set
	 */
	public function setCoordinaciones($coordinaciones) {
		$this->coordinaciones = $coordinaciones;
	}

	/**
	 * @param $perfil the $perfil to set
	 */
	public function setPerfil($perfil) {
		$this->perfil = $perfil;
	}

	/**
	 * @param $tipo_usuario the $tipo_usuario to set
	 */
	public function setTipo_usuario($tipo_usuario) {
		$this->tipo_usuario = $tipo_usuario;
	}

	/**
	 * @param $habilitado the $habilitado to set
	 */
	public function setHabilitado($habilitado) {
		$this->habilitado = $habilitado;
	}

	/**
	 * @param $id_usuario the $id_usuario to set
	 */
	public function setId_usuario($id_usuario) {
		$this->id_usuario = $id_usuario;
	}

	/**
	 * @param $id_direcciones_usuarios the $id_direcciones_usuarios to set
	 */
	public function setId_direcciones_user($id_direcciones_user) {
		$this->id_direcciones_user = $id_direcciones_user;
	}

	
	
function __construct(/*$login,$contrasena,$cedula,$tipo,$status*/)
   {

   }

   
function EjecutarFunciones($funcion)
   {            
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
  	  	return $BaseDato->EjecutarProcedure($funcion);
	  
   	  	//return 1;
       
   }
   
function MostrarVista($vista)
   {            
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
   	  
		return $BaseDato->EjecutarVista($vista);
	  
      //return 1;
       
   }

   
function Existe($tabla,$campo,$valor)
{            
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
   	  	$sql = "SELECT * FROM $tabla WHERE $campo='$valor'";
   	  	$resultado=$BaseDato->EjecutarQuery($sql);
   	  	if ($resultado->fields[$campo]=="")
   	  	 	{
   	  		return 0;
   	  		}
   	  	else 
   	  		{
   	  		return 1;
   	  		}

}

function ExisteGlobal($tabla,$valor)
{            
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
   	  	$sql = "SELECT * FROM $tabla WHERE $valor";
   	 echo $sql; 	
   	  	$resultado=$BaseDato->EjecutarQuery($sql);
   	  	if ($resultado->fields['nb_usuarios']=="")
   	  	 	{
die("blanco");
   	  	 		return 0;
   	  		}
   	  	else 
   	  		{
die("lleno");
   	  			return 1;
   	  		}

}

function MostrarModificar( $op,$tabla,$orden ) 
		{
	
			
			$alto_nivel_user=$this->getId_alto_nivel_user();
			$primer_nivel_user=$this->getId_primer_nivel_user();
			$direcciones_user=$this->getId_direcciones_user();
			
			include_once('conexpg.php');
			
			//declarar el objeto de la clase base de dato
			$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	
			//Hace la conexion a la BD
			$conexion= $BaseDato->Conectar();

			//Realiza la consulta
			//$sql= "SELECT * FROM vista_mostrar_alto_nivel ";
			$sql= "SELECT * FROM $tabla where cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user." order by $orden";
			// Sa realiza la consulta
			$Resultado=pg_query($conexion,$sql);
					
			//Retorna los datos 
			if ( $op==1 ) 
			{
				return $Resultado;
			}
			else //Retorna el numero de registros 
			{
				//Retorna la cantidad de registros
				return pg_num_rows($Resultado);
			}		

		}	// Fin de 'mostrar($op)'	
	

function Mostrar( $op,$tabla,$orden ) 
		{
	
			
			$alto_nivel_user=$this->getId_alto_nivel_user();
			$primer_nivel_user=$this->getId_primer_nivel_user();
			$direcciones_user=$this->getId_direcciones_user();
			
			include_once('conexpg.php');
			
			//declarar el objeto de la clase base de dato
			$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	
			//Hace la conexion a la BD
			$conexion= $BaseDato->Conectar();

			//Realiza la consulta
			//$sql= "SELECT * FROM vista_mostrar_alto_nivel ";
			$sql= "SELECT * FROM $tabla where cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user." order by $orden";


			// Sa realiza la consulta
			$Resultado=pg_query($conexion,$sql);
					
			//Retorna los datos 
			if ( $op==1 ) 
			{
				return $Resultado;
			}
			else //Retorna el numero de registros 
			{
				//Retorna la cantidad de registros
				return pg_num_rows($Resultado);
			}		

		}	// Fin de 'mostrar($op)'
	
function MostrarUsuarios( $op,$tabla,$valor,$orden ) 
		{
	
			
			$alto_nivel_user=$this->getId_alto_nivel_user();
			$primer_nivel_user=$this->getId_primer_nivel_user();
			$direcciones_user=$this->getId_direcciones_user();
			
			include_once('conexpg.php');
			
			//declarar el objeto de la clase base de dato
			$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	
			//Hace la conexion a la BD
			$conexion= $BaseDato->Conectar();

			//Realiza la consulta
			//$sql= "SELECT * FROM vista_mostrar_alto_nivel ";
			$sql= "SELECT * FROM $tabla where $valor order by $orden";

			// Sa realiza la consulta
			$Resultado=pg_query($conexion,$sql);
					
			//Retorna los datos 
			if ( $op==1 ) 
			{
				return $Resultado;
			}
			else //Retorna el numero de registros 
			{
				//Retorna la cantidad de registros
				return pg_num_rows($Resultado);
			}		

		}	// Fin de 'mostrar($op)'		
		
		
function MostrarValores( $op,$tabla,$orden,$valor) 
		{
	
			
			$alto_nivel_user=$this->getId_alto_nivel_user();
			$primer_nivel_user=$this->getId_primer_nivel_user();
			$direcciones_user=$this->getId_direcciones_user();
			
			include_once('conexpg.php');
			
			//declarar el objeto de la clase base de dato
			$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	
			//Hace la conexion a la BD
			$conexion= $BaseDato->Conectar();

			//Realiza la consulta
			//$sql= "SELECT * FROM vista_mostrar_alto_nivel ";
			$sql= "SELECT * FROM $tabla where $valor order by $orden";
			// Sa realiza la consulta
			$Resultado=pg_query($conexion,$sql);
					
			//Retorna los datos 
			if ( $op==1 ) 
			{
				return $Resultado;
			}
			else //Retorna el numero de registros 
			{
				//Retorna la cantidad de registros
				return pg_num_rows($Resultado);
			}		

		}		
		
function deshabilitar($id)
{
	
		
		if ($id == 1 || $id == '1' || $id == 0 || $id == '0') 
		{
		
		$salida = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione-</option></select>";
		
		} 
		else if ($id == 2 || $id == '2') 
		{
			$salida = "<select name=\"perfil\" id=\"perfil\" onchange=\"xajax_opcionPerfiles(document.getElementById('perfil').value);return false;\">";
			//$salida = "<select ".$_SESSION['disabled']." name=\"perfil\" id=\"perfil\" onchange=\"xajax_opcionPerfiles(document.getElementById('perfil').value);return false;\">";	
			$salida .= "<option value=\"0\">-Seleccione-</option>";
			$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato		
			$conexion = $BaseDato->Conectar ();
			$sql = "SELECT cd_perfiles, nb_perfiles from vista_perfiles order by nb_perfiles";
			// mostrarmos los registros
			$Resultado = pg_query ( $conexion, $sql );

			while ( $row = pg_fetch_array ( $Resultado ) ) 
			{
                $salida .= "<option value =\"" . $row ["cd_perfiles"] . "\">" . $row ["nb_perfiles"] . "</option>";	
			}
			$salida .= "</select>";
		}
			
		$objResponse = new xajaxResponse ();
		$objResponse->assign ( 'div_perfiles', 'innerHTML', $salida );
		return $objResponse;
}  
function opcionPerfiles($id,$tipo_user) 
{

		$objResponse = new xajaxResponse ();
		if ($id == 1 && $tipo_user == 2 ) 
		{
	
			$objResponse->assign ('ingresarMantenimiento', 'disabled', '' );
			$objResponse->assign ('consultarMantenimiento', 'disabled', '' );
			$objResponse->assign ('modificarMantenimiento', 'disabled', '' );
			$objResponse->assign ('ingresarMantenimiento', 'checked', 'checked' );
			$objResponse->assign ('consultarMantenimiento', 'checked', 'checked' );
			$objResponse->assign ('modificarMantenimiento', 'checked', 'checked' );
			
			$objResponse->assign ('ingresarRecibida', 'disabled', '' );
			$objResponse->assign ('consultarRecibida', 'disabled', '' );
			$objResponse->assign ('modificarRecibida', 'disabled', '' );
			$objResponse->assign ('ingresarRecibida', 'checked', 'checked' );
			$objResponse->assign ('consultarRecibida', 'checked', 'checked' );
			$objResponse->assign ('modificarRecibida', 'checked', 'checked' );
			
			$objResponse->assign ('ingresarRespuestaRecibida', 'disabled', '' );
			$objResponse->assign ('consultarRespuestaRecibida', 'disabled', '' );
			$objResponse->assign ('modificarRespuestaRecibida', 'disabled', '' );
			$objResponse->assign ('ingresarRespuestaRecibida', 'checked', 'checked' );
			$objResponse->assign ('consultarRespuestaRecibida', 'checked', 'checked' );
			$objResponse->assign ('modificarRespuestaRecibida', 'checked', 'checked' );
			
			$objResponse->assign ('ingresarOficios', 'disabled', '' );
			$objResponse->assign ('consultarOficios', 'disabled', '' );
			$objResponse->assign ('modificarOficios', 'disabled', '' );
			$objResponse->assign ('ingresarOficios', 'checked', 'checked' );
			$objResponse->assign ('consultarOficios', 'checked', 'checked' );
			$objResponse->assign ('modificarOficios', 'checked', 'checked' );
			
			$objResponse->assign ('ingresarRespuestaOficios', 'disabled', '' );
			$objResponse->assign ('consultarRespuestaOficios', 'disabled', '' );
			$objResponse->assign ('modificarRespuestaOficios', 'disabled', '' );
			$objResponse->assign ('ingresarRespuestaOficios', 'checked', 'checked' );
			$objResponse->assign ('consultarRespuestaOficios', 'checked', 'checked' );
			$objResponse->assign ('modificarRespuestaOficios', 'checked', 'checked' );			
			
			$objResponse->assign ('ingresarRemisiones', 'disabled', '' );
			$objResponse->assign ('consultarRemisiones', 'disabled', '' );
			$objResponse->assign ('modificarRemisiones', 'disabled', '' );
			$objResponse->assign ('ingresarRemisiones', 'checked', 'checked' );
			$objResponse->assign ('consultarRemisiones', 'checked', 'checked' );
			$objResponse->assign ('modificarRemisiones', 'checked', 'checked' );

			$objResponse->assign ('ingresarRespuestaRemisiones', 'disabled', '' );
			$objResponse->assign ('consultarRespuestaRemisiones', 'disabled', '' );
			$objResponse->assign ('modificarRespuestaRemisiones', 'disabled', '' );
			$objResponse->assign ('ingresarRespuestaRemisiones', 'checked', 'checked' );
			$objResponse->assign ('consultarRespuestaRemisiones', 'checked', 'checked' );
			$objResponse->assign ('modificarRespuestaRemisiones', 'checked', 'checked' );			
			
			$objResponse->assign ('ingresarArchivo', 'disabled', '' );
			$objResponse->assign ('consultarArchivo', 'disabled', '' );
			$objResponse->assign ('modificarArchivo', 'disabled', '' );
			$objResponse->assign ('ingresarArchivo', 'checked', 'checked' );
			$objResponse->assign ('consultarArchivo', 'checked', 'checked' );
			$objResponse->assign ('modificarArchivo', 'checked', 'checked' );
			
			$objResponse->assign ('consultarReportes', 'disabled', '' );
			$objResponse->assign ('consultarReportes', 'checked', 'checked' );
			
			$objResponse->assign ('alto_nivel', 'selectedIndex', 0 );
			
			$salida1 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione un Primer Nivel-</option></select>";
			$objResponse->assign ( 'div_direcciones', 'innerHTML',$salida1);			
	    	$salida2 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>";
			$objResponse->assign ( 'div_unidades', 'innerHTML',$salida2);
			$salida3 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>";
			$objResponse->assign ( 'div_coordinaciones', 'innerHTML',$salida3);		
			$salida4 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione un Alto Nivel-</option></select>";
			$objResponse->assign ( 'div_primer_nivel', 'innerHTML', $salida4 );	
			
	
		}
		else
		{
			$objResponse->assign ('ingresarMantenimiento', 'disabled', 'disabled' );
			$objResponse->assign ('consultarMantenimiento', 'disabled', 'disabled' );
			$objResponse->assign ('modificarMantenimiento', 'disabled', 'disabled' );
			$objResponse->assign ('ingresarMantenimiento', 'checked', '' );
			$objResponse->assign ('consultarMantenimiento', 'checked', '' );
			$objResponse->assign ('modificarMantenimiento', 'checked', '' );
			
			$objResponse->assign ('ingresarRecibida', 'disabled', 'disabled' );
			$objResponse->assign ('consultarRecibida', 'disabled', 'disabled' );
			$objResponse->assign ('modificarRecibida', 'disabled', 'disabled' );
			$objResponse->assign ('ingresarRecibida', 'checked', '' );
			$objResponse->assign ('consultarRecibida', 'checked', '' );
			$objResponse->assign ('modificarRecibida', 'checked', '' );

			$objResponse->assign ('ingresarRespuestaRecibida', 'disabled', 'disabled' );
			$objResponse->assign ('consultarRespuestaRecibida', 'disabled', 'disabled' );
			$objResponse->assign ('modificarRespuestaRecibida', 'disabled', 'disabled' );
			$objResponse->assign ('ingresarRespuestaRecibida', 'checked', '' );
			$objResponse->assign ('consultarRespuestaRecibida', 'checked', '' );
			$objResponse->assign ('modificarRespuestaRecibida', 'checked', '' );			
			
			$objResponse->assign ('ingresarOficios', 'disabled', 'disabled' );
			$objResponse->assign ('consultarOficios', 'disabled', 'disabled' );
			$objResponse->assign ('modificarOficios', 'disabled', 'disabled' );
			$objResponse->assign ('ingresarOficios', 'checked', '' );
			$objResponse->assign ('consultarOficios', 'checked', '' );
			$objResponse->assign ('modificarOficios', 'checked', '' );

			$objResponse->assign ('ingresarRespuestaOficios', 'disabled', 'disabled' );
			$objResponse->assign ('consultarRespuestaOficios', 'disabled', 'disabled' );
			$objResponse->assign ('modificarRespuestaOficios', 'disabled', 'disabled' );
			$objResponse->assign ('ingresarRespuestaOficios', 'checked', '' );
			$objResponse->assign ('consultarRespuestaOficios', 'checked', '' );
			$objResponse->assign ('modificarRespuestaOficios', 'checked', '' );				
			
			$objResponse->assign ('ingresarRemisiones', 'disabled', 'disabled' );
			$objResponse->assign ('consultarRemisiones', 'disabled', 'disabled' );
			$objResponse->assign ('modificarRemisiones', 'disabled', 'disabled' );
			$objResponse->assign ('ingresarRemisiones', 'checked', '' );
			$objResponse->assign ('consultarRemisiones', 'checked', '' );
			$objResponse->assign ('modificarRemisiones', 'checked', '' );

			$objResponse->assign ('ingresarRespuestaRemisiones', 'disabled', 'disabled' );
			$objResponse->assign ('consultarRespuestaRemisiones', 'disabled', 'disabled' );
			$objResponse->assign ('modificarRespuestaRemisiones', 'disabled', 'disabled' );
			$objResponse->assign ('ingresarRespuestaRemisiones', 'checked', '' );
			$objResponse->assign ('consultarRespuestaRemisiones', 'checked', '' );
			$objResponse->assign ('modificarRespuestaRemisiones', 'checked', '' );				
			
			$objResponse->assign ('ingresarArchivo', 'disabled', 'disabled' );
			$objResponse->assign ('consultarArchivo', 'disabled', 'disabled' );
			$objResponse->assign ('modificarArchivo', 'disabled', 'disabled' );
			$objResponse->assign ('ingresarArchivo', 'checked', '' );
			$objResponse->assign ('consultarArchivo', 'checked', '' );
			$objResponse->assign ('modificarArchivo', 'checked', '' );
			
			$objResponse->assign ('consultarReportes', 'disabled', 'disabled' );
			$objResponse->assign ('consultarReportes', 'checked', '' );
			$objResponse->assign ('alto_nivel', 'selectedIndex', 0 );
			
			$salida1 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione un Primer Nivel-</option></select>";
			$objResponse->assign ( 'div_direcciones', 'innerHTML',$salida1);			
	    	$salida2 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>";
			$objResponse->assign ( 'div_unidades', 'innerHTML',$salida2);
			$salida3 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>";
			$objResponse->assign ( 'div_coordinaciones', 'innerHTML',$salida3);		
			$salida4 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione un Alto Nivel-</option></select>";
			$objResponse->assign ( 'div_primer_nivel', 'innerHTML', $salida4 );	
		
		} 
		return $objResponse;
}  
	
function registrarFunciones($xajax) {
	  
		$xajax->registerFunction ( array ('llenarPrimerNivel', &$this, 'llenarPrimerNivel' ) );
		$xajax->registerFunction ( array ('llenarDireccion', &$this, 'llenarDireccion' ) );
		$xajax->registerFunction ( array ('llenarunidades', &$this, 'llenarunidades' ) );
		$xajax->registerFunction ( array ('llenarPrimerNivel_mod', &$this, 'llenarPrimerNivel_mod' ) );
		$xajax->registerFunction ( array ('llenarDireccion_mod', &$this, 'llenarDireccion_mod' ) );
		$xajax->registerFunction ( array ('llenarunidades_mod', &$this, 'llenarunidades_mod' ) );
		$xajax->registerFunction ( array ('llenarCoordinaciones', &$this, 'llenarCoordinaciones' ) );
		$xajax->registerFunction ( array ('deshabilitar', &$this, 'deshabilitar' ) );
		$xajax->registerFunction ( array ('opcionPerfiles', &$this, 'opcionPerfiles' ) );
		$xajax->processRequest ();
		$xajax->setFlag ( 'statusMessages', true );
		$xajax->setFlag ( 'waitCursor', true );
		
} 
	
	
function llenarPrimerNivel($id,$dire,$alto,$primer) {
	
		if ($id == 0 || $id == '0') 
		{
		    
			$salida = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione un Alto Nivel-</option></select>";
		
		} 
		else 
		{
			$salida = "<select name=\"primer_nivel\" id=\"primer_nivel\" onchange=\"xajax_llenarDireccion(document.getElementById('primer_nivel').value,".$dire.",".$alto.",".$primer.",document.getElementById('perfil').value);return false;\">";	
			$salida .= "<option value=\"0\">-Seleccione-</option>";
			$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato		
			$conexion = $BaseDato->Conectar ();
			//$sql = "SELECT * from vista_mostrar_primer_nivel where cd_alto_nivel=".$id." and cd_alto_nivel_usuarios=".$alto." and cd_primer_nivel_usuarios=".$primer." and cd_direcciones_usuarios=".$dire." order by nb_primer_nivel";
			$sql = "SELECT * from vista_mostrar_primer_nivel where cd_alto_nivel=".$id." order by nb_primer_nivel";
			// mostrarmos los registros
			$Resultado = pg_query ( $conexion, $sql );

			while ( $row = pg_fetch_array ( $Resultado ) ) 
			{
                $salida .= "<option value =\"" . $row ["cd_primer_nivel"] . "\">" . $row ["nb_primer_nivel"] .  "</option>";	
			}
			$salida .= "</select>";
		}
			
		$objResponse = new xajaxResponse ();
		$objResponse->assign ( 'div_primer_nivel', 'innerHTML', $salida );
		
    	$salida1 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione un Primer Nivel-</option></select>";
		$objResponse->assign ( 'div_direcciones', 'innerHTML',$salida1);			
    	$salida2 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>";
		$objResponse->assign ( 'div_unidades', 'innerHTML',$salida2);
		$salida3 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>";
		$objResponse->assign ( 'div_coordinaciones', 'innerHTML',$salida3);		
		return $objResponse;
	}     
	
function llenarPrimerNivel_mod($id,$dire,$alto,$primer) {
	
		if ($id == 0 || $id == '0') 
		{
		    
			$salida = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione un Alto Nivel-</option></select>";
		
		} 
		else 
		{
			$salida = "<select name=\"primer_nivel\" id=\"primer_nivel\" onchange=\"xajax_llenarDireccion_mod(document.getElementById('primer_nivel').value,".$dire.",".$alto.",".$primer.");return false;\">";	
			$salida .= "<option value=\"0\">-Seleccione-</option>";
			$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato		
			$conexion = $BaseDato->Conectar ();
			//$sql = "SELECT * from vista_mostrar_primer_nivel where cd_alto_nivel=".$id." and cd_alto_nivel_usuarios=".$alto." and cd_primer_nivel_usuarios=".$primer." and cd_direcciones_usuarios=".$dire." order by nb_primer_nivel";
			$sql = "SELECT * from vista_mostrar_primer_nivel where cd_alto_nivel=".$id." order by nb_primer_nivel";
			// mostrarmos los registros
			$Resultado = pg_query ( $conexion, $sql );

			while ( $row = pg_fetch_array ( $Resultado ) ) 
			{
                $salida .= "<option value =\"" . $row ["cd_primer_nivel"] . "\">" . $row ["nb_primer_nivel"] . "</option>";	
			}
			$salida .= "</select>";
		}
			
		$objResponse = new xajaxResponse ();
		$objResponse->assign ( 'div_primer_nivel', 'innerHTML', $salida );
		
    	$salida1 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione un Primer Nivel-</option></select>";
		$objResponse->assign ( 'div_direcciones', 'innerHTML',$salida1);			
    	$salida2 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>";
		$objResponse->assign ( 'div_unidades', 'innerHTML',$salida2);
		$salida3 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>";
		$objResponse->assign ( 'div_coordinaciones', 'innerHTML',$salida3);		
		return $objResponse;
	}
	
function llenarDireccion($idPrimerNivel,$dired,$altod,$primerd,$idperfild) {
	
		/*if($idperfild==""){
			$idperfild=1;
		}*/
		if ($idperfild == 0  || $idperfild == '0') 
		{
		
			$salida = "<select disabled=\"disabled\"><option value=\"0\">".$idperfild."al-Seleccione un Alto Nivel-</option></select>";
		
		} 
		else 
		{
			
			$salida = "<select name=\"direcciones\" id=\"direcciones\" onchange=\"xajax_llenarunidades(document.getElementById('direcciones').value,".$dired.",".$altod.",".$primerd.",$idperfild);return false;\">";	
			
			$salida .= "<option value=\"0\">-Seleccione-</option>";
			$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato		
			$conexion = $BaseDato->Conectar ();
			  
			//$sql = "SELECT * FROM vista_mostrar_direcciones where cd_primer_nivel = ".$idPrimerNivel." and cd_alto_nivel_usuarios=".$altod." and cd_primer_nivel_usuarios=".$primerd." and cd_direcciones_usuarios=".$dired." order by nb_direcciones";
			$sql = "SELECT * FROM vista_mostrar_direcciones where cd_primer_nivel = ".$idPrimerNivel." order by nb_direcciones";
			// mostrarmos los registros
			$Resultado = pg_query ( $conexion, $sql );

			while ( $row = pg_fetch_array ($Resultado) ) 
			{
                $salida .= "<option value =\"" . $row ["cd_direcciones"] . "\">" . $row ["nb_direcciones"] . "</option>";	
			}
			$salida .= "</select>";
		}

	
		$objResponse = new xajaxResponse ();
		$objResponse->assign ( 'div_direcciones', 'innerHTML', $salida );
    	$salida1 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>";
		$objResponse->assign ( 'div_unidades', 'innerHTML',$salida1);
		$salida2 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>";
		$objResponse->assign ( 'div_coordinaciones', 'innerHTML',$salida2);		
		return $objResponse;
	} 

	
function llenarDireccion_mod($idPrimerNivel,$dired,$altod,$primerd) {
	
		/*if($idperfild==""){
			$idperfild=1;
		}*/
		/*if ($idperfild == 0  || $idperfild == '0') 
		{
		
			$salida = "<select disabled=\"disabled\"><option value=\"0\">".$idperfild."al-Seleccione un Alto Nivel-</option></select>";
		
		} 
		else 
		{*/
			
			$salida = "<select name=\"direcciones\" id=\"direcciones\" onchange=\"xajax_llenarunidades_mod(document.getElementById('direcciones').value,".$dired.",".$altod.",".$primerd.");return false;\">";	
			
			$salida .= "<option value=\"0\">-Seleccione-</option>";
			$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato		
			$conexion = $BaseDato->Conectar ();
			//$sql = "SELECT * FROM vista_mostrar_direcciones where cd_primer_nivel = ".$idPrimerNivel." and cd_alto_nivel_usuarios=".$altod." and cd_primer_nivel_usuarios=".$primerd." and cd_direcciones_usuarios=".$dired." order by nb_direcciones";
			$sql = "SELECT * FROM vista_mostrar_direcciones where cd_primer_nivel = ".$idPrimerNivel." order by nb_direcciones";
			// mostrarmos los registros
			$Resultado = pg_query ( $conexion, $sql );

			while ( $row = pg_fetch_array ($Resultado) ) 
			{
                $salida .= "<option value =\"" . $row ["cd_direcciones"] . "\">" . $row ["nb_direcciones"] . "</option>";	
			}
			$salida .= "</select>";
		//}

	
		$objResponse = new xajaxResponse ();
		$objResponse->assign ( 'div_direcciones', 'innerHTML', $salida );
    	$salida1 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>";
		$objResponse->assign ( 'div_unidades', 'innerHTML',$salida1);
		$salida2 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>";
		$objResponse->assign ( 'div_coordinaciones', 'innerHTML',$salida2);		
		return $objResponse;
	} 	
	
	
function llenarUnidades($idPrimerNivel,$dired,$altod,$primerd,$idperfild) {
			
		if ($idperfild == 1 || $idperfild == "1") 
		{
			$salida = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>";
		
		} 
		else if ($idperfild == 2 || $idperfild == "2")
		{
			//$salida = "<select name=\"unidades[]\" multiple=\"multiple\" id=\"unidades\" onchange=\"xajax_llenarCoordinaciones(document.getElementById('unidades').value,".$dired.",".$altod.",".$primerd.");return false;\">";
			$salida = "<select name=\"unidades\" id=\"unidades\" >";	
			$salida .= "<option value=\"0\">-Seleccione-</option>";
			$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato		
			$conexion = $BaseDato->Conectar ();
			$sql = "SELECT * FROM vista_mostrar_unidades where cd_direcciones = ".$idPrimerNivel." and cd_alto_nivel_usuarios=".$altod." and cd_primer_nivel_usuarios=".$primerd." and cd_direcciones_usuarios=".$dired." order by nb_unidades";
			// mostrarmos los registros
			$Resultado = pg_query ( $conexion, $sql );

			while ( $row = pg_fetch_array ($Resultado) ) 
			{
                $salida .= "<option value =\"" . $row ["cd_unidades"] . "\">" . $row ["nb_unidades"] . "</option>";	
			}
			$salida .= "</select>";
		}

		else if ($idperfild == 3 || $idperfild == "3")
		{
			$salida = "<select ".$_SESSION['disabled']." name=\"unidades\" id=\"unidades\" onchange=\"xajax_llenarCoordinaciones(document.getElementById('unidades').value,".$dired.",".$altod.",".$primerd.");return false;\">";	
			$salida .= "<option value=\"0\">-Seleccione-</option>";
			$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato		
			$conexion = $BaseDato->Conectar ();
			$sql = "SELECT * FROM vista_mostrar_unidades where cd_direcciones = ".$idPrimerNivel." and cd_alto_nivel_usuarios=".$altod." and cd_primer_nivel_usuarios=".$primerd." and cd_direcciones_usuarios=".$dired." order by nb_unidades";
			// mostrarmos los registros
			$Resultado = pg_query ( $conexion, $sql );

			while ( $row = pg_fetch_array ($Resultado) ) 
			{
                $salida .= "<option value =\"" . $row ["cd_unidades"] . "\">" . $row ["nb_unidades"] . "</option>";	
			}
			$salida .= "</select>";
		}
		
		$objResponse = new xajaxResponse ();
		$objResponse->assign ( 'div_unidades', 'innerHTML', $salida );
    	$salida1 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>";
		$objResponse->assign ( 'div_coordinaciones', 'innerHTML',$salida1);
		return $objResponse;
	} 

function llenarUnidades_mod($idPrimerNivel,$dired,$altod,$primerd) {
			

			$salida = "<select ".$_SESSION['disabled']." name=\"unidades\" id=\"unidades\" onchange=\"xajax_llenarCoordinaciones(document.getElementById('unidades').value,".$dired.",".$altod.",".$primerd.");return false;\">";	
			$salida .= "<option value=\"0\">-Seleccione-</option>";
			$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato		
			$conexion = $BaseDato->Conectar ();
			$sql = "SELECT * FROM vista_mostrar_unidades where cd_direcciones = ".$idPrimerNivel." and cd_alto_nivel_usuarios=".$altod." and cd_primer_nivel_usuarios=".$primerd." and cd_direcciones_usuarios=".$dired." order by nb_unidades";
			// mostrarmos los registros
			$Resultado = pg_query ( $conexion, $sql );

			while ( $row = pg_fetch_array ($Resultado) ) 
			{
                $salida .= "<option value =\"" . $row ["cd_unidades"] . "\">" . $row ["nb_unidades"] . "</option>";	
			}
			$salida .= "</select>";
	//	}
		
		$objResponse = new xajaxResponse ();
		$objResponse->assign ( 'div_unidades', 'innerHTML', $salida );
    	$salida1 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>";
		$objResponse->assign ( 'div_coordinaciones', 'innerHTML',$salida1);
		return $objResponse;
	} 
	
function llenarCoordinaciones($idDire,$dired,$altod,$primerd){
		
			if ($idDire == 0 || $idDire == '0') 
			{
			$salida = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>"; 
			} 
			else 
			{
			$salida = "<select name=\"coordinaciones\" id=\"coordinaciones\">";	
			$salida .= "<option value=\"0\">-Seleccione-</option>";			
				$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato				
				$conexion = $BaseDato->Conectar ();
				$sql = "SELECT * FROM vista_mostrar_coordinaciones where cd_unidades = ".$idDire." and cd_direcciones_usuarios=".$dired."and cd_alto_nivel_usuarios=".$altod." and cd_primer_nivel_usuarios=".$primerd." order by nb_coordinaciones";
					
				// mostrarmos los registros
				$Resultado = pg_query ( $conexion, $sql );
			
			while ( $row = pg_fetch_array ($Resultado) ) 
				{
                	$salida .= "<option value =\"" . $row ["cd_coordinaciones"] . "\">" . $row ["nb_coordinaciones"] . "</option>";	
				}
					$salida .= "</select>";
			}
		
			$objResponse = new xajaxResponse ();
			$objResponse->assign ( 'div_coordinaciones', 'innerHTML',$salida);
			
    		return $objResponse;
		}

function CargarDatos()
   {  
   	$codigo = $this->getId();

   	
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
   	  	$sql = "SELECT * FROM vista_usuarios WHERE cd_usuarios='$codigo'";
   	  	$resultado=$BaseDato->EjecutarQuery($sql);
   	  	if ($resultado->fields['nb_usuarios']=="")
   	  	{
   	  		return FALSE;
   	  	}
   	  	else 
   	  	{
   	  		$this->setNombre($resultado->fields['nb_usuarios']) ;
   	  		$this->setLogin($resultado->fields['nb_login_usuarios']);
   	  		$this->setTelefono_trab($resultado->fields['ds_telf_trabajo_usuarios']);
   	  		$this->setEmail($resultado->fields['ds_email_usuarios']);
   	  		$this->setAlto_nivel($resultado->fields['cd_alto_nivel_fk']);
   	  		$this->setId_primer_nivel($resultado->fields['cd_primer_nivel_fk']);
   	  		$this->setDirecciones($resultado->fields['cd_direcciones_fk']);
   	  		$this->setUnidades($resultado->fields['cd_unidades_fk']);
   	  		$this->setCoordinaciones($resultado->fields['cd_coordinaciones_fk']);
   	  		$this->setPerfil($resultado->fields['cd_perfiles_fk']);
   	  		$this->setHabilitado($resultado->fields['in_habilitado_usuarios']); 
   	  	    $this->setTipo_usuario($resultado->fields['cd_tipo_usuarios']);
   	  		$this->setId($resultado->fields['cd_usuarios']);
   	  		$this->setId_primer_nivel_user($resultado->fields['cd_primer_nivel_usuarios_cargas']);
   	  		$this->setId_direcciones_user($resultado->fields['cd_direcciones_usuarios_carga']);
   	  		$this->setId_alto_nivel_user($resultado->fields['cd_alto_nivel_usuarios_cargas']);
   	  		$this->setNb_alto_nivel($resultado->fields['nb_alto_nivel']);
   	  		$this->setNb_primer_nivel($resultado->fields['nb_primer_nivel']);
   	  		$this->setNb_direcciones($resultado->fields['nb_direcciones']);   	  		
   	  	    return TRUE;
   	  	}
       
   } 

function clave()
   {  
   	$codigo = $this->getId_usuario();

   	
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
   	  	$sql = "SELECT * FROM vista_usuarios WHERE cd_usuarios='$codigo'";
   	  	$resultado=$BaseDato->EjecutarQuery($sql);
   	  	if ($resultado->fields['nb_usuarios']=="")
   	  	{
   	  		return FALSE;
   	  	}
   	  	else 
   	  	{
   	  		$this->setContrasena($resultado->fields['password_usuarios']) ;
   	  	    return TRUE;
   	  		
   	  	}
       
   }    

}
?>