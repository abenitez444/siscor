<?php
include('../controlador/script.php');
include("constantes.php"); // llamo a las costantes de la conexion 
include_once("BaseDatos.php"); //llamo a la conexion
include_once ('conexpg.php');
	
class entes_externos
{
   private $id;
   private $nombre;
   private $cd_alto_nivel;
   private $ubicacion;
   private $edificio;
   private $telefono;
   private $observacion;
   private $cd_user;
   private $cd_direc_user;
   private $alto_nivel_user;
   private $primer_nivel_user;
   private $piso;

 

/**
	 * @return the $id
	 */
	/**
	 * @return the $alto_nivel_user
	 */
	/**
	 * @return the $piso
	 */
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
   

    function Mostrar( $op,$tabla,$orden ) 
		{

			$alto_nivel_user=$this->getAlto_nivel_user();
			$primer_nivel_user=$this->getPrimer_nivel_user();
			$direcciones_user=$this->getCd_direc_user();
			
			include_once('conexpg.php');
			
			//declarar el objeto de la clase base de dato
			$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	
			//Hace la conexion a la BD
			$conexion= $BaseDato->Conectar();

			//Realiza la consulta
			//$sql= "SELECT * FROM vista_mostrar_alto_nivel ";
			$sql= "SELECT * FROM $tabla where cd_alto_nivel_corres='3' and cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user." order  by $orden";
			//die("$sql");
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
		$xajax->processRequest ();
		$xajax->setFlag ( 'statusMessages', true );
		$xajax->setFlag ( 'waitCursor', true );
	}   
   
	
   function llenarPrimerNivel($id,$dire,$alto,$primer)
       {


               if ($id == 0 || $id == '0') {
                       $salida = "<label>No hay Registros</label>";
               } else {
                       
        			   
               	
                       $BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato                                
                       $conexion = $BaseDato->Conectar ();
                       
                       $sql = "SELECT * from vista_mostrar_primer_nivel_corres where cd_alto_nivel_corres=".$id." and cd_alto_nivel_usuarios=".$alto." and cd_primer_nivel_usuarios=".$primer." and cd_direcciones_usuarios=".$dire." order by nb_primer_nivel_corres";                        
				
                       
                       // mostrarmos los registros
                       $Resultado = pg_query ( $conexion, $sql );
                       
                       if (pg_num_rows ($Resultado) == 0) {
                               $salida = "<label>No Existen Primer Nivel para el Alto Nivel Seleccionado</label>";                                
                       }else {
                               $salida = "<br>	<table class='tabla' align='center'>
							<tr class='modo1'>
							<td class='font1'>Descripci&oacute;n</td>
							<td class='font1'>Opciones</td>";
	                               
                               while ( $row = pg_fetch_array ( $Resultado ) ) {
                                       $salida .= "<tr class='modo1'><td class='font2'>" . $row ["nb_primer_nivel_corres"] . "</td><td class='font2' align='center'><a href='../controlador/control_primer_nivel.php?form=mod&id=" . $row ["cd_primer_nivel_corres"] . "&idd=".$row['cd_direcciones_usuarios']."'><img src='../assets/img/edit.png'  border='0' title='Modificar' ></a>
                                       <a href='../controlador/control_primer_nivel.php?form=eli&id=" . $row ["cd_primer_nivel_corres"] . "&idd=".$row['cd_direcciones_usuarios']."' onClick='return confirma();'>
                                       <img src='../assets/img/eliminar.png'  border='0' title='Eliminar' ></a></td></tr>";                                
                               }
                               $salida .= "<table>";
                               
                       }                        
               }

               $objResponse = new xajaxResponse ();
               $objResponse->assign ( 'div_primer_nivel', 'innerHTML',$salida);

     		  
               return $objResponse;
       
       } //Fin de 'llenarPrimerNivel'

	
	
      
 function CargarDatos()
   {  
   	$codigo = $this->getId();

   	
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
   	  	$sql = "SELECT * FROM vista_mostrar_primer_nivel_corres WHERE cd_primer_nivel_corres='$codigo' order by nb_primer_nivel_corres";
   	  	$resultado=$BaseDato->EjecutarQuery($sql);
   	  	if ($resultado->fields['nb_primer_nivel_corres']=="")
   	  	{
   	  		return FALSE;
   	  	}
   	  	else 
   	  	{
   	  		$this->setNombre($resultado->fields['nb_primer_nivel_corres']) ;
   	  		$this->setCd_alto_nivel($resultado->fields['cd_alto_nivel_corres']);
   	  		$this->setUbicacion($resultado->fields['ds_ubicacion_primer_nivel_corres']);
   	  		$this->setEdificio($resultado->fields['ds_edificio_primer_nivel_corres']); 
   	  	    $this->setPiso($resultado->fields['ds_piso_primer_nivel_corres']);
   	  		$this->setTelefono($resultado->fields['ds_telefono_primer_nivel_corres']);
   	  		$this->setObservacion($resultado->fields['tx_observacion_primer_nivel_corres']); 
   	  	    
   	  	    return TRUE;
   	  		
   	  	}
   
   }         
	
}?>