<?php
include('../controlador/script.php');
include("constantes.php"); // llamo a las costantes de la conexion 
include_once("BaseDatos.php"); //llamo a la conexion



class RespuestaRemisiones
{
   
	private $id_recibida;
	private $nuanio_recibida;
	private $id_Remisiones;
	private $nuanio_remisiones;
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
	 * @return the $id_Remisiones
	 */
	public function getId_Remisiones() {
		return $this->id_Remisiones;
	}

	/**
	 * @return the $nuanio_remisiones
	 */
	public function getNuanio_remisiones() {
		return $this->nuanio_remisiones;
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
	 * @param $id_Remisiones the $id_Remisiones to set
	 */
	public function setId_Remisiones($id_Remisiones) {
		$this->id_Remisiones = $id_Remisiones;
	}

	/**
	 * @param $nuanio_remisiones the $nuanio_remisiones to set
	 */
	public function setNuanio_remisiones($nuanio_remisiones) {
		$this->nuanio_remisiones = $nuanio_remisiones;
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
   		$this->setHorahhentrada($resultado->fields['nu_hora_hh_entrada_r']);
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

function CargarDatosRemisionesRecibidas()
{  
    $codigo = $this->getId_remisiones();
    $anio = $this->getNuanio_remisiones();
    $alto_nivel = $this->getId_alto_nivel_user();
    $primer_nivel = $this->getId_primer_nivel_user();
    $direcciones = $this->getId_direcciones_user();
    //$unidades = $this->getUnidad();
    $BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
    //$sql = "SELECT * FROM vista_mostrar_remisiones WHERE cd_remisiones=".$codigo." and nu_ano_remisiones=".$anio." and cd_alto_nivel_usuarios=".$alto_nivel." and cd_primer_nivel_usuarios=".$primer_nivel." and cd_direcciones_usuarios=".$direcciones." and cd_unidades=".$unidades."";
    $sql = "SELECT * FROM vista_mostrar_respuesta_remisiones WHERE cd_remisiones=".$codigo." and nu_ano_remisiones=".$anio." and cd_alto_nivel_usuarios=".$alto_nivel." and cd_primer_nivel_usuarios=".$primer_nivel." and cd_direcciones_usuarios=".$direcciones.""; 
//die($sql);
    $resultado=$BaseDato->EjecutarQuery($sql);
    if ($resultado->fields['cd_remisiones']=="")
    {
     	return FALSE;
    }
    else 
   	{
   		$this->setId_recibida($resultado->fields['cd_recibidas']);
   		$this->setNuanio_recibida($resultado->fields['nu_ano_recibidas']);
   		
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


}
?>