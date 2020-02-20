<?php
include('../controlador/script.php');
include("constantes.php"); // llamo a las costantes de la conexion 
include_once("BaseDatos.php"); //llamo a la conexion

class General
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
   
 /*
	function mostrar()
   {            
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
		return $BaseDato->EjecutarVista("vista_mostrar_alto_nivel");
      //return 1;
       
   }*/
   
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
			$sql= "SELECT * FROM $tabla where cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user." order  by $orden";
			//echo("$sql");
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
   	  
		return $BaseDato->EjecutarQuery($vista);
	  
      //return 1;
       
   }

function Existencia($tabla,$campo,$valor,$campo2,$valor2,$campo3,$valor3,$campo4,$valor4)
   {       
   	     
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
   	  
		return $BaseDato->Existe($tabla,$campo,$valor,$campo2,$valor2,$campo3,$valor3,$campo4,$valor4);
       
   }

        
 function CargarDatos($tabla, $valor, $orden)
   {  
   	  	
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
   	  	$sql = "SELECT * FROM $tabla WHERE $valor order by $orden";
   	  
   	  	$resultado=$BaseDato->EjecutarQuery($sql);
   	  	if ($resultado->fields[$orden]=="")
   	  	{
   	  		return FALSE;
   	  	}
   	  	else 
   	  	{
   	  		$this->setNombre($resultado->fields[$orden]) ;
   	  		return TRUE;
   	  		
   	  	}
       $this->Desconexion ();
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
			$sql = "SELECT * from vista_mostrar_primer_nivel where cd_alto_nivel=".$id." and cd_alto_nivel_usuarios=".$alto." and cd_primer_nivel_usuarios=".$primer." and cd_direcciones_usuarios=".$dire." order by nb_primer_nivel";
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
		
    	$salida1 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>";
		$objResponse->assign ( 'div_direcciones', 'innerHTML',$salida1);			
    	$salida2 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>";
		$objResponse->assign ( 'div_unidades', 'innerHTML',$salida2);
		$salida3 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>";
		$objResponse->assign ( 'div_coordinaciones', 'innerHTML',$salida3);		
		return $objResponse;
	}     
	

function llenarDireccion($idPrimerNivel,$dired,$altod,$primerd) {
	
		
		if ($idPrimerNivel == 0 || $idPrimerNivel == '0') 
		{
		
			$salida = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione un Alto Nivel-</option></select>";
		
		} 
		else 
		{
			$salida = "<select ".$_SESSION['disabled']." name=\"direcciones\" id=\"direcciones\" onchange=\"xajax_llenarunidades(document.getElementById('direcciones').value,".$dired.",".$altod.",".$primerd.");return false;\">";	
			$salida .= "<option value=\"0\">-Seleccione-</option>";
			$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato		
			$conexion = $BaseDato->Conectar ();
			$sql = "SELECT * FROM vista_mostrar_direcciones where cd_primer_nivel = ".$idPrimerNivel." and cd_alto_nivel_usuarios=".$altod." and cd_primer_nivel_usuarios=".$primerd." and cd_direcciones_usuarios=".$dired." order by nb_direcciones";
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
   
}
 ?>