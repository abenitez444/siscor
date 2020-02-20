<?php
include('../controlador/script.php');
include("constantes.php"); // llamo a las costantes de la conexion 
include_once("BaseDatos.php"); //llamo a la conexion
include_once ('conexpg.php');
	
class unidades
{
   private $id;
   private $nombre;
   private $cd_alto_nivel;
   private $cd_primer_nivel;
   private $cd_direcciones;
   private $ubicacion;
   private $edificio;
   private $telefono;
   private $observacion;
   private $cd_user;
   private $cd_direc_user;
   private $alto_nivel_user;
   private $primer_nivel_user;
   private $piso;
   private $nombre_primer_nivel;
   private $nombre_direcciones;

/**
	 * @return the $id
	 */
	/**
	 * @return the $alto_nivel_user
	 */
	/**
	 * @return the $piso
	 */
	/**
	 * @return the $cd_primer_nivel
	 */
	/**
	 * @return the $nombre_primer_nivel
	 */
	/**
	 * @return the $cd_direcciones
	 */
	/**
	 * @return the $nombre_direcciones
	 */
	public function getNombre_direcciones() {
		return $this->nombre_direcciones;
	}

/**
	 * @param $nombre_direcciones the $nombre_direcciones to set
	 */
	public function setNombre_direcciones($nombre_direcciones) {
		$this->nombre_direcciones = $nombre_direcciones;
	}

	public function getCd_direcciones() {
		return $this->cd_direcciones;
	}

/**
	 * @param $cd_direcciones the $cd_direcciones to set
	 */
	public function setCd_direcciones($cd_direcciones) {
		$this->cd_direcciones = $cd_direcciones;
	}

	public function getNombre_primer_nivel() {
		return $this->nombre_primer_nivel;
	}

/**
	 * @param $nombre_primer_nivel the $nombre_primer_nivel to set
	 */
	public function setNombre_primer_nivel($nombre_primer_nivel) {
		$this->nombre_primer_nivel = $nombre_primer_nivel;
	}

	public function getCd_primer_nivel() {
		return $this->cd_primer_nivel;
	}

/**
	 * @param $cd_primer_nivel the $cd_primer_nivel to set
	 */
	public function setCd_primer_nivel($cd_primer_nivel) {
		$this->cd_primer_nivel = $cd_primer_nivel;
	}

	public function getPiso() {
		return $this->piso;
	}

/**
	 * @param $piso the $piso to set
	 */
	public function setPiso($piso) {
		$this->piso = $piso;
	}

	public function getAlto_nivel_user() {
		return $this->alto_nivel_user;
	}

/**
	 * @return the $primer_nivel_user
	 */
	public function getPrimer_nivel_user() {
		return $this->primer_nivel_user;
	}

/**
	 * @param $alto_nivel_user the $alto_nivel_user to set
	 */
	public function setAlto_nivel_user($alto_nivel_user) {
		$this->alto_nivel_user = $alto_nivel_user;
	}

/**
	 * @param $primer_nivel_user the $primer_nivel_user to set
	 */
	public function setPrimer_nivel_user($primer_nivel_user) {
		$this->primer_nivel_user = $primer_nivel_user;
	}

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
	 * @return the $cd_alto_nivel
	 */
	public function getCd_alto_nivel() {
		return $this->cd_alto_nivel;
	}

/**
	 * @return the $ubicacion
	 */
	public function getUbicacion() {
		return $this->ubicacion;
	}

/**
	 * @return the $edificio
	 */
	public function getEdificio() {
		return $this->edificio;
	}

/**
	 * @return the $telefono
	 */
	public function getTelefono() {
		return $this->telefono;
	}

/**
	 * @return the $observacion
	 */
	public function getObservacion() {
		return $this->observacion;
	}

/**
	 * @return the $cd_user
	 */
	public function getCd_user() {
		return $this->cd_user;
	}

/**
	 * @return the $cd_direc_user
	 */
	public function getCd_direc_user() {
		return $this->cd_direc_user;
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
	 * @param $cd_alto_nivel the $cd_alto_nivel to set
	 */
	public function setCd_alto_nivel($cd_alto_nivel) {
		$this->cd_alto_nivel = $cd_alto_nivel;
	}

/**
	 * @param $ubicacion the $ubicacion to set
	 */
	public function setUbicacion($ubicacion) {
		$this->ubicacion = $ubicacion;
	}

/**
	 * @param $edificio the $edificio to set
	 */
	public function setEdificio($edificio) {
		$this->edificio = $edificio;
	}

/**
	 * @param $telefono the $telefono to set
	 */
	public function setTelefono($telefono) {
		$this->telefono = $telefono;
	}

/**
	 * @param $observacion the $observacion to set
	 */
	public function setObservacion($observacion) {
		$this->observacion = $observacion;
	}

/**
	 * @param $cd_user the $cd_user to set
	 */
	public function setCd_user($cd_user) {
		$this->cd_user = $cd_user;
	}

/**
	 * @param $cd_direc_user the $cd_direc_user to set
	 */
	public function setCd_direc_user($cd_direc_user) {
		$this->cd_direc_user = $cd_direc_user;
	}

function __construct(/*$login,$contrasena,$cedula,$tipo,$status*/)
   {

   }
   

	function mostrar()
   {            
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
		return $BaseDato->EjecutarVista("vista_mostrar_alto_nivel");
      //return 1;
       
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

function Existencia($tabla,$campo,$valor,$campo2,$valor2,$campo3,$valor3,$campo4,$valor4)
   {            
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
   	  
		return $BaseDato->Existe($tabla,$campo,$valor,$campo2,$valor2,$campo3,$valor3,$campo4,$valor4);
       
   }

   
	function registrarFunciones($xajax) {
	  
		$xajax->registerFunction ( array ('llenarPrimerNivel', &$this, 'llenarPrimerNivel' ) );
		$xajax->registerFunction ( array ('llenarDireccion', &$this, 'llenarDireccion' ) );
		$xajax->registerFunction ( array ('llenarunidades', &$this, 'llenarunidades' ) );
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
			$salida = "<select ".$_SESSION['disabled']." name=\"primer_nivel\" id=\"primer_nivel\" onchange=\"xajax_llenarDireccion(document.getElementById('primer_nivel').value,".$dire.",".$alto.",".$primer.");return false;\">";	
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
		$objResponse->assign ( 'div_direcciones', 'innerHTML', $salida1 );
		$salida2 = "";
		$objResponse->assign ( 'div_unidades', 'innerHTML',$salida2);		
		return $objResponse;
	}     
	

		function llenarDireccion($idPrimerNivel,$dired,$altod,$primerd) {
	
		
		if ($idPrimerNivel == 0 || $idPrimerNivel == '0') 
		{
		
			$salida = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione un Alto Nivel-</option></select>";
		
		} 
		else 
		{
			$salida = "<select ".$_SESSION['disabled']." name=\"direcciones_consul\" id=\"direcciones_consul\" onchange=\"xajax_llenarunidades(document.getElementById('direcciones_consul').value,".$dired.",".$altod.",".$primerd.");return false;\">";	
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
		$salida1 = "";
		$objResponse->assign ( 'div_unidades', 'innerHTML',$salida1);
	return $objResponse;
	} 
	
		function llenarunidades($idDire,$dired,$altod,$primerd)
		{
		
			if ($idDire == 0) 
			{
				$salida = "";
			} 
			else 
			{
			
				$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato				
				$conexion = $BaseDato->Conectar ();
				$sql = "SELECT * FROM vista_mostrar_unidades where cd_direcciones = ".$idDire." order by nb_unidades";
				//$sql = "SELECT * FROM vista_mostrar_unidades where cd_direcciones = ".$idDire." and cd_direcciones_usuarios=".$dired."and cd_alto_nivel_usuarios=".$altod." and cd_primer_nivel_usuarios=".$primerd." order by nb_unidades";
							
				// mostrarmos los registros
				$Resultado = pg_query ( $conexion, $sql );
			
				if (pg_num_rows ($Resultado) == 0) 
                       {
                               $salida = "<label>No Existen Unidades para la Direcci&oacute;n Seleccionado</label>";                                
                       }
                       else 
                       {
                       	    $salida = "<br>	<table class='tabla' align='center'>
							<tr class='modo1'>
							<td class='font1'>Descripci&oacute;n</td>
							<td class='font1'>Opciones</td>";
	                               
                            while ( $row = pg_fetch_array ( $Resultado ) ) 
                            {
                                       $salida .= "<tr class='modo1'><td class='font2'>" . $row ["nb_unidades"] . "</td><td class='font2' align='center'><a href='../controlador/control_unidades.php?form=mod&id=" . $row ["cd_unidades"] . "'><img src='../assets/img/edit.png'  border='0' title='Modificar' ></a>
                                       <a href='../controlador/control_unidades.php?form=eli&id=" . $row ["cd_unidades"] . "' onClick='return confirma();'>
                                       <img src='../assets/img/eliminar.png'  border='0' title='Eliminar' ></a></td></tr>";                                
                            }
                            $salida .= "<table>";
                               
                       }    		
			}
		
			$objResponse = new xajaxResponse ();
			$objResponse->assign ( 'div_unidades', 'innerHTML',$salida);
		
			return $objResponse;
	
	} ///Fin de 'llenarPrimerNivel'

 function CargarDatos()
   {  
   	$codigo = $this->getId();

   	
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
   	  	$sql = "SELECT * FROM vista_mostrar_unidades WHERE cd_unidades='$codigo'";
   	  	$resultado=$BaseDato->EjecutarQuery($sql);
   	  	if ($resultado->fields['nb_unidades']=="")
   	  	{
   	  		return FALSE;
   	  	}
   	  	else 
   	  	{
   	  		$this->setNombre($resultado->fields['nb_unidades']) ;
   	  		$this->setCd_alto_nivel($resultado->fields['cd_alto_nivel']);
   	  		$this->setCd_primer_nivel($resultado->fields['cd_primer_nivel']);
   	  		$this->setCd_direcciones($resultado->fields['cd_direcciones']);
   	  		$this->setUbicacion($resultado->fields['ds_ubicacion_unidades']);
   	  		$this->setEdificio($resultado->fields['ds_edificio_unidades']); 
   	  	    $this->setPiso($resultado->fields['ds_piso_unidades']);
   	  		$this->setTelefono($resultado->fields['ds_telefono_unidades']);
   	  		$this->setObservacion($resultado->fields['tx_observacion_unidades']);
   	  		$this->setNombre_primer_nivel($resultado->fields['nb_primer_nivel']);
   	  		$this->setNombre_direcciones($resultado->fields['nb_direcciones']);
   	  	    return TRUE;
   	  		
   	  	}
       $this->Desconexion ();
   }         
	
}?>