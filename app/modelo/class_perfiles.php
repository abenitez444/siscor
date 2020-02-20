<?php
include('../controlador/script.php');
include('../controlador/script.php');
include("constantes.php"); // llamo a las costantes de la conexion 
include_once("BaseDatos.php"); //llamo a la conexion

class perfiles
{
   private $id;
   private $nombre;
   private $cd_user;
   private $alto_nivel_user;
   private $primer_nivel_user;
   private $cd_direc_user;
 
   /**
	 * @return the $id
	 */
	/**
	 * @return the $cd_user
	 */
	/**
	 * @return the $alto_nivel_user
	 */
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

	function __construct(/*$login,$contrasena,$cedula,$tipo,$status*/)
   {
   }
  
    function Mostrar( $op ) 
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
			$sql= "SELECT * FROM vista_mostrar_alto_nivel where cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user." order  by nb_alto_nivel";
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
   
function EjecutarFunciones($funcion)
   {            
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
  	  	return $BaseDato->EjecutarProcedure($funcion);
   }
   
function MostrarVista($vista)
   {            
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
		return $BaseDato->EjecutarQuery($vista);
   }

function Existencia($tabla,$campo,$valor,$campo2,$valor2,$campo3,$valor3,$campo4,$valor4)
   {       
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
		return $BaseDato->Existe($tabla,$campo,$valor,$campo2,$valor2,$campo3,$valor3,$campo4,$valor4);
   }
}
?>