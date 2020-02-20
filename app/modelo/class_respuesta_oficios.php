<?php
include('../controlador/script.php');
include("constantes.php"); // llamo a las costantes de la conexion 
include_once("BaseDatos.php"); //llamo a la conexion



class RespuestaOficios
{
   
	private $id_recibida;
	private $nuanio_recibida;
	private $id_oficio;
	private $nuanio_oficios;
	private $id_usuario;
	private $id_alto_nivel_user;
	private $id_primer_nivel_user;
	private $id_direcciones_user;

/**
	 * @return the $id_recibida
	 */
	public function getId_recibida() {
		return $this->id_recibida;
	}

	/**
	 * @return the $nuanio_recibida
	 */
	public function getNuanio_recibida() {
		return $this->nuanio_recibida;
	}

	/**
	 * @return the $id_oficio
	 */
	public function getId_oficio() {
		return $this->id_oficio;
	}

	/**
	 * @return the $nuanio_oficios
	 */
	public function getNuanio_oficios() {
		return $this->nuanio_oficios;
	}

	/**
	 * @return the $id_usuario
	 */
	public function getId_usuario() {
		return $this->id_usuario;
	}

	/**
	 * @return the $id_alto_nivel_user
	 */
	public function getId_alto_nivel_user() {
		return $this->id_alto_nivel_user;
	}

	/**
	 * @return the $id_primer_nivel_user
	 */
	public function getId_primer_nivel_user() {
		return $this->id_primer_nivel_user;
	}

	/**
	 * @return the $id_direcciones_user
	 */
	public function getId_direcciones_user() {
		return $this->id_direcciones_user;
	}

	/**
	 * @param $id_recibida the $id_recibida to set
	 */
	public function setId_recibida($id_recibida) {
		$this->id_recibida = $id_recibida;
	}

	/**
	 * @param $nuanio_recibida the $nuanio_recibida to set
	 */
	public function setNuanio_recibida($nuanio_recibida) {
		$this->nuanio_recibida = $nuanio_recibida;
	}

	/**
	 * @param $id_oficio the $id_oficio to set
	 */
	public function setId_oficio($id_oficio) {
		$this->id_oficio = $id_oficio;
	}

	/**
	 * @param $nuanio_oficios the $nuanio_oficios to set
	 */
	public function setNuanio_oficios($nuanio_oficios) {
		$this->nuanio_oficios = $nuanio_oficios;
	}

	/**
	 * @param $id_usuario the $id_usuario to set
	 */
	public function setId_usuario($id_usuario) {
		$this->id_usuario = $id_usuario;
	}

	/**
	 * @param $id_alto_nivel_user the $id_alto_nivel_user to set
	 */
	public function setId_alto_nivel_user($id_alto_nivel_user) {
		$this->id_alto_nivel_user = $id_alto_nivel_user;
	}

	/**
	 * @param $id_primer_nivel_user the $id_primer_nivel_user to set
	 */
	public function setId_primer_nivel_user($id_primer_nivel_user) {
		$this->id_primer_nivel_user = $id_primer_nivel_user;
	}

	/**
	 * @param $id_direcciones_user the $id_direcciones_user to set
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
			if ($id=='3')
			{
			$sql = "SELECT * from vista_mostrar_primer_nivel where cd_alto_nivel=".$id." and cd_alto_nivel_usuarios=".$alto." and cd_primer_nivel_usuarios=".$primer." and cd_direcciones_usuarios=".$dire." order by nb_primer_nivel";
			}
			else 
			{
			$sql = "SELECT * from vista_mostrar_primer_nivel  where cd_alto_nivel=".$id." order by nb_primer_nivel";	
			}
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
	

function llenarDireccion($idPrimerNivel,$dired,$altod,$primerd)
{
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

function Mostrar( $op,$tabla,$orden,$sw ) 
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
	if ($sw==1)
	{
		$sql= "SELECT * FROM $tabla where cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user." order by $orden";	

	}
	else
	{
		$sql= "SELECT * FROM $tabla order by $orden";
	
	}	
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


function MostrarConsulta( $op,$tabla,$valor,$orden ) 
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
			$sql= "SELECT * FROM $tabla where $valor and cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user." order by $orden";

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
		
function CargarDatos()
{  
	$codigo = $this->getId();
	$anio=$this->getNuano();
	$alto_nivel_user=$this->getId_alto_nivel_user();
	$primer_nivel_user=$this->getId_primer_nivel_user();
	$direcciones_user=$this->getId_direcciones_user();
	
	
    $BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
    $sql = "SELECT * FROM vista_mostrar_recibidas WHERE cd_recibidas=".$codigo." and nu_ano_recibidas=".$anio." and cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user.""; 

    $resultado=$BaseDato->EjecutarQuery($sql);
    if ($resultado->fields['cd_recibidas']=="")
    {
     	return FALSE;
    }
    else 
   	{

   		$this->setFeentrada($resultado->fields['fe_entrada_recibidas']);
   		$this->setFecarta($resultado->fields['fe_carta_recibidas']);
   		$this->setHorahhentrada($resultado->fields['nu_hora_hh_entrada_recibidas']);
   		$this->setHorammentrada($resultado->fields['nu_hora_mm_entrada_recibidas']);
   		$this->setHorattentrada($resultado->fields['nu_hora_tt_entrada_recibidas']);
   		$this->setClasificacion_documento($resultado->fields['cd_clasificacion_documentos']);
   		$this->setAsunto($resultado->fields['tx_asunto_recibidas']);
   		$this->setRemitente($resultado->fields['nb_remitente_recibidas']);
   		$this->setUbicacion($resultado->fields['ds_ubicacion_fisica_documento_recibidas']);
   		$this->setAlto_nivel($resultado->fields['cd_alto_nivel']);
   		$this->setPrimer_nivel($resultado->fields['cd_primer_nivel']);
   		$this->setDirecciones($resultado->fields['cd_direcciones']);
   		$this->setNuexterno($resultado->fields['nu_externo_recibidas']);
   		$this->setCedremitente($resultado->fields['ds_cedula_remitente_recibidas']);
   		return TRUE;
   	}
}  

function MostrarValores( $op,$tabla,$orden,$valor) 
		{
				
			include_once('conexpg.php');
			
			//declarar el objeto de la clase base de dato
			$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	
			//Hace la conexion a la BD
			$conexion= $BaseDato->Conectar();

			//Realiza la consulta
			//$sql= "SELECT * FROM vista_mostrar_alto_nivel ";
			$sql= "SELECT * FROM $tabla where $valor order by $orden";
			//echo $sql;
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

function arregla_fecha($f)
    {	
	$aux="";
    $aux="$f[6]$f[7]$f[8]$f[9]-$f[3]$f[4]-$f[0]$f[1]";	
	$f=$aux; 
	return $f;		
  }
 function devuelve_fecha($f)
    {	
	$aux="";
    $aux="$f[8]$f[9]-$f[5]$f[6]-$f[0]$f[1]$f[2]$f[3]";	
	$f=$aux; 
	return $f;		
  }

}
?>