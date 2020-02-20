<?php

include("constantes.php"); // llamo a las costantes de la conexion 
include_once("BaseDatos.php"); //llamo a la conexion



class Inicio
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
	private $cambio_pass;	

	/**
	 * @return the $id_alto_nivel
	 */
	/**
	 * @return the $id_alto_nivel_usuarios
	 */
	public function getId_alto_nivel_user() {
		return $this->id_alto_nivel_user;
	}
	/**
	 * @param $cambio_pass the $cambio_pass to set
	 */
	public function setCambio_pass($cambio_pass) {
		$this->cambio_pass = $cambio_pass;
	}

	/**
	 * @return the $cambio_pass
	 */
	public function getCambio_pass() {
		return $this->cambio_pass;
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


function Sesion()
   {  
   	$usuario = $this->getLogin();
   	$password= $this->getContrasena();
   	          
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
   	  	$sql = "SELECT * FROM vista_usuarios WHERE nb_login_usuarios='$usuario' and password_usuarios='$password'";
   	  	$resultado=$BaseDato->EjecutarQuery($sql);
   	  	if ($resultado->fields['nb_login_usuarios']=="")
   	  	{
   	  		return FALSE;
   	  	}
   	  	else 
   	  	{
   	  		
   	  		$this->setNombre($resultado->fields['nb_usuarios']) ;
   	  		$this->setTipo_usuario($resultado->fields['cd_tipo_usuarios']);
   	  		$this->setDirecciones($resultado->fields['cd_direcciones_fk']); 
   	  	    $this->setId($resultado->fields['cd_usuarios']);
			$this->setAlto_nivel($resultado->fields['cd_alto_nivel_fk']); 
   	  	    $this->setId_primer_nivel($resultado->fields['cd_primer_nivel_fk']);
   	  	    $this->setUnidades($resultado->fields['cd_unidades_fk']);
   	  	    $this->setCoordinaciones($resultado->fields['cd_coordinaciones_fk']); 
   	  	    $this->setHabilitado($resultado->fields['in_habilitado_usuarios']);
   	  	    $this->setPerfil($resultado->fields['cd_perfiles_fk']);
   	  	    $this->setCambio_pass($resultado->fields['in_cambio_pass_usuarios']);
   	  	    
   	  	    return TRUE;
   	  		
   	  	}
       $this->Desconexion ();
   }   
   }
?>
