<?php
include('../controlador/script.php');
include("constantes.php"); // llamo a las costantes de la conexion 
include_once("BaseDatos.php"); //llamo a la conexion
include_once ('conexpg.php');
	
class direcciones
{
   private $id;
   private $nombre;
   private $cd_alto_nivel;
   private $cd_primer_nivel;
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
   private $remitente;
   private $cargo_remitente;
 

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
	public function getNombre_primer_nivel() {
		return $this->nombre_primer_nivel;
	}
	/**
	 * @param $cargo_remitente the $cargo_remitente to set
	 */
	public function setCargo_remitente($cargo_remitente) {
		$this->cargo_remitente = $cargo_remitente;
	}

	/**
	 * @param $remitente the $remitente to set
	 */
	public function setRemitente($remitente) {
		$this->remitente = $remitente;
	}

	/**
	 * @return the $cargo_remitente
	 */
	public function getCargo_remitente() {
		return $this->cargo_remitente;
	}

	/**
	 * @return the $remitente
	 */
	public function getRemitente() {
		return $this->remitente;
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
			$sql = "SELECT * from vista_mostrar_primer_nivel where cd_alto_nivel=".$id." order by nb_primer_nivel";
			//$sql = "SELECT * from vista_mostrar_primer_nivel where cd_alto_nivel=".$id." and cd_alto_nivel_usuarios=".$alto." and cd_primer_nivel_usuarios=".$primer." and cd_direcciones_usuarios=".$dire." order by nb_primer_nivel";
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
		return $objResponse;
	}     
	
	
		function llenarDireccion($idPrimerNivel,$dired,$altod,$primerd) 
		{
		
			if ($idPrimerNivel == 0) 
			{
				$salida = "";
			} 
			else 
			{
			
				$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato				
				$conexion = $BaseDato->Conectar ();
			
				//$sql = "SELECT * FROM vista_mostrar_direcciones where cd_primer_nivel = ".$idPrimerNivel." and cd_alto_nivel_usuarios=".$altod." and cd_primer_nivel_usuarios=".$primerd." and cd_direcciones_usuarios=".$dired." order by nb_direcciones";			
				$sql = "SELECT * FROM vista_mostrar_direcciones where cd_primer_nivel = ".$idPrimerNivel." order by nb_direcciones";
				// mostrarmos los registros
				$Resultado = pg_query ( $conexion, $sql );
			
				if (pg_num_rows ($Resultado) == 0) 
                       {
                               $salida = "<label>No Existen Direcciones para el Primer Nivel Seleccionado</label>";                                
                       }
                       else 
                       {
                       	    $salida = "<br>	<table class='tabla' align='center'>
							<tr class='modo1'>
							<td class='font1'>Descripci&oacute;n</td>
							<td class='font1'>Opciones</td>";
	                               
                            while ( $row = pg_fetch_array ( $Resultado ) ) 
                            {
                                       $salida .= "<tr class='modo1'><td class='font2'>" . $row ["nb_direcciones"] . "</td><td class='font2' align='center'><a href='../controlador/control_direcciones.php?form=mod&id=" . $row ["cd_direcciones"] . "&idd=".$row['cd_direcciones_usuarios']."'><img src='../assets/img/edit.png'  border='0' title='Modificar' ></a>
                                       <a href='../controlador/control_direcciones.php?form=eli&id=" . $row ["cd_direcciones"] . "&idd=".$row['cd_direcciones_usuarios']."' onClick='return confirma();'>
                                       <img src='../assets/img/eliminar.png'  border='0' title='Eliminar' ></a></td></tr>";                                
                            }
                            $salida .= "<table>";
                               
                       }    		
			}
		
			$objResponse = new xajaxResponse ();
			$objResponse->assign ( 'div_direcciones', 'innerHTML',$salida);
		
			return $objResponse;
	
	} //Fin de 'llenarPrimerNivel'

 function CargarDatos()
   {  
   	$codigo = $this->getId();

   	
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
   	  	$sql = "SELECT * FROM vista_mostrar_direcciones WHERE cd_direcciones='$codigo'";
   	  	$resultado=$BaseDato->EjecutarQuery($sql);
   	  	if ($resultado->fields['nb_direcciones']=="")
   	  	{
   	  		return FALSE;
   	  	}
   	  	else 
   	  	{
   	  		$this->setNombre($resultado->fields['nb_direcciones']) ;
   	  		$this->setCd_alto_nivel($resultado->fields['cd_alto_nivel']);
   	  		$this->setCd_primer_nivel($resultado->fields['cd_primer_nivel']);
   	  		$this->setUbicacion($resultado->fields['ds_ubicacion_direcciones']);
   	  		$this->setEdificio($resultado->fields['ds_edificio_direcciones']); 
   	  	    $this->setPiso($resultado->fields['ds_piso_direcciones']);
   	  		$this->setTelefono($resultado->fields['ds_telefono_direcciones']);
   	  		$this->setObservacion($resultado->fields['tx_observacion_direcciones']);
   	  		$this->setNombre_primer_nivel($resultado->fields['nb_primer_nivel']);
   	  		$this->setRemitente($resultado->fields['nb_remitente_direcciones']);
   	  		$this->setCargo_remitente($resultado->fields['nb_cargoremitente_direciones']);  
   	  	    return TRUE;
   	  		
   	  	}
       $this->Desconexion ();
   }         
	
}?>