<?php
include('../controlador/script.php');
include("constantes.php"); // llamo a las costantes de la conexion 
include_once("BaseDatos.php"); //llamo a la conexion



class Oficios
{
   
	private $id;
	private $nuanioficio;
	private $id_remitir;
	private $nuanioremitir;	
	private $feenvio;
	private $horahhentrada;
	private $horammentrada;
	private $horattentrada;
	private $responsable;
	private $asunto;
	private $destinatario;
	private $alto_nivel;
	private $primer_nivel;
	private $direcciones;
	private $id_usuario;
	private $id_alto_nivel_user;
	private $id_primer_nivel_user;
	private $id_direcciones_user;
	private $ameritarespuesta;
	private $oficiorespondido;
	private $id_recibidas;
	private $nuanio_recibidas;
	
  
	
	
	
	

/**
	 * @return the $id
	 */
	/**
	 * @return the $id_recibidas
	 */
	public function getId_recibidas() {
		return $this->id_recibidas;
	}

	/**
	 * @return the $nuanio_recibidas
	 */
	public function getNuanio_recibidas() {
		return $this->nuanio_recibidas;
	}

	/**
	 * @param $nuanioremitir the $nuanioremitir to set
	 */
	public function setNuanioremitir($nuanioremitir) {
		$this->nuanioremitir = $nuanioremitir;
	}

	/**
	 * @param $id_recibidas the $id_recibidas to set
	 */
	public function setId_recibidas($id_recibidas) {
		$this->id_recibidas = $id_recibidas;
	}

	/**
	 * @param $nuanio_recibidas the $nuanio_recibidas to set
	 */
	public function setNuanio_recibidas($nuanio_recibidas) {
		$this->nuanio_recibidas = $nuanio_recibidas;
	}

	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $nuanioficio
	 */
	public function getNuanioficio() {
		return $this->nuanioficio;
	}

	/**
	 * @return the $id_recibidas
	 */
	public function getId_remitir() {
		return $this->id_remitir;
	}

	/**
	 * @return the $nuaniorecibidas
	 */
	public function getNuanioremitir() {
		return $this->nuanioremitir;
	}

	/**
	 * @return the $feenvio
	 */
	public function getFeenvio() {
		return $this->feenvio;
	}

	/**
	 * @return the $horahhentrada
	 */
	public function getHorahhentrada() {
		return $this->horahhentrada;
	}

	/**
	 * @return the $horammentrada
	 */
	public function getHorammentrada() {
		return $this->horammentrada;
	}

	/**
	 * @return the $horattentrada
	 */
	public function getHorattentrada() {
		return $this->horattentrada;
	}

	/**
	 * @return the $responsable
	 */
	public function getResponsable() {
		return $this->responsable;
	}

	/**
	 * @return the $asunto
	 */
	public function getAsunto() {
		return $this->asunto;
	}

	/**
	 * @return the $destinatario
	 */
	public function getDestinatario() {
		return $this->destinatario;
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
	 * @return the $ameritarespuesta
	 */
	public function getAmeritarespuesta() {
		return $this->ameritarespuesta;
	}

	/**
	 * @return the $oficiorespondido
	 */
	public function getOficiorespondido() {
		return $this->oficiorespondido;
	}

	/**
	 * @param $id the $id to set
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param $nuanioficio the $nuanioficio to set
	 */
	public function setNuanioficio($nuanioficio) {
		$this->nuanioficio = $nuanioficio;
	}

	/**
	 * @param $id_recibidas the $id_recibidas to set
	 */
	public function setId_remitir($id_remitir) {
		$this->id_remitir = $id_remitir;
	}

	/**
	 * @param $nuaniorecibidas the $nuaniorecibidas to set
	 */
	public function setNuaniorecibidas($nuaniorecibidas) {
		$this->nuaniorecibidas = $nuaniorecibidas;
	}

	/**
	 * @param $feenvio the $feenvio to set
	 */
	public function setFeenvio($feenvio) {
		$this->feenvio = $feenvio;
	}

	/**
	 * @param $horahhentrada the $horahhentrada to set
	 */
	public function setHorahhentrada($horahhentrada) {
		$this->horahhentrada = $horahhentrada;
	}

	/**
	 * @param $horammentrada the $horammentrada to set
	 */
	public function setHorammentrada($horammentrada) {
		$this->horammentrada = $horammentrada;
	}

	/**
	 * @param $horattentrada the $horattentrada to set
	 */
	public function setHorattentrada($horattentrada) {
		$this->horattentrada = $horattentrada;
	}

	/**
	 * @param $responsable the $responsable to set
	 */
	public function setResponsable($responsable) {
		$this->responsable = $responsable;
	}

	/**
	 * @param $asunto the $asunto to set
	 */
	public function setAsunto($asunto) {
		$this->asunto = $asunto;
	}

	/**
	 * @param $destinatario the $destinatario to set
	 */
	public function setDestinatario($destinatario) {
		$this->destinatario = $destinatario;
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

	/**
	 * @param $ameritarespuesta the $ameritarespuesta to set
	 */
	public function setAmeritarespuesta($ameritarespuesta) {
		$this->ameritarespuesta = $ameritarespuesta;
	}

	/**
	 * @param $oficiorespondido the $oficiorespondido to set
	 */
	public function setOficiorespondido($oficiorespondido) {
		$this->oficiorespondido = $oficiorespondido;
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

   
function ExisteRespuestaOficio($tabla,$campo,$valor,$campo2,$valor2,$campo3,$valor3,$campo4,$valor4,$campo5,$valor5,$campo6,$valor6)
	{            
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
   	  	$sql = "SELECT * FROM $tabla WHERE $campo='$valor' and $campo2='$valor2' and $campo3='$valor3' and $campo4='$valor4' and $campo5='$valor5' and  $campo6='$valor6'";
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
	  
		$xajax->registerFunction ( array ('llenarPrimerNivelCorres', &$this, 'llenarPrimerNivelCorres' ) );
		$xajax->registerFunction ( array ('llenarDireccionCorres', &$this, 'llenarDireccionCorres' ) );
		$xajax->processRequest ();
		$xajax->setFlag ( 'statusMessages', true );
		$xajax->setFlag ( 'waitCursor', true );
		
	} 

function llenarPrimerNivelCorres($id,$dire,$alto,$primer) {
	
		if ($id == 0 || $id == '0') 
		{
		   
			$salida = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione un Alto Nivel-</option></select>";
		
		} 
		else 
		{
			$salida = "<select ".$_SESSION['disabled']." name=\"primer_nivel\" id=\"primer_nivel\" onchange=\"xajax_llenarDireccionCorres(document.getElementById('primer_nivel').value,".$dire.",".$alto.",".$primer.");return false;\">";	
			$salida .= "<option value=\"0\">-Seleccione-</option>";
			$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato		
			$conexion = $BaseDato->Conectar ();
			if ($id=='3')
			{
			$sql = "SELECT * from vista_mostrar_primer_nivel_corres where cd_alto_nivel_corres=".$id." and cd_alto_nivel_usuarios=".$alto." and cd_primer_nivel_usuarios=".$primer." and cd_direcciones_usuarios=".$dire." order by nb_primer_nivel_corres";
			}
			else 
			{
			$sql = "SELECT * from vista_mostrar_primer_nivel_corres  where cd_alto_nivel_corres=".$id." order by nb_primer_nivel_corres";	
			}
			// mostrarmos los registros
			$Resultado = pg_query ( $conexion, $sql );

			while ( $row = pg_fetch_array ( $Resultado ) ) 
			{
                $salida .= "<option value =\"" . $row ["cd_primer_nivel_corres"] . "\">" . $row ["nb_primer_nivel_corres"] . "</option>";	
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
	

function llenarDireccionCorres($idPrimerNivel,$dired,$altod,$primerd)
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
		$sql = "SELECT * FROM vista_mostrar_direcciones_corres where cd_primer_nivel_corres = ".$idPrimerNivel." order by nb_direcciones_corres";
		// mostrarmos los registros
		$Resultado = pg_query ( $conexion, $sql );
			while ( $row = pg_fetch_array ($Resultado) ) 
			{
                $salida .= "<option value =\"" . $row ["cd_direcciones_corres"] . "\">" . $row ["nb_direcciones_corres"] . "</option>";	
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
//		$sql= "SELECT * FROM $tabla order by $orden";
		if ($_SESSION['alto_nivel_user']>=25)
		{
			$sql= "SELECT * FROM $tabla order by $orden";
		}
		else
		{
		$sql= "SELECT * FROM $tabla where cd_alto_nivel_corres < 25 order by $orden";	
		}
	
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

function MostrarGuardar( $op,$tabla,$orden,$sw ) 
{
	$alto_nivel_user=$this->getId_alto_nivel_user();
	$primer_nivel_user=$this->getId_primer_nivel_user();
	$direcciones_user=$this->getId_direcciones_user();
	$anio=$this->getNuanioficio();
	//include_once('conexpg.php');
	//declarar el objeto de la clase base de dato
	//$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
		$BaseDato=new BaseDatos();
	//Hace la conexion a la BD
//	$conexion= $BaseDato->Conectar();
	//Realiza la consulta
	//$sql= "SELECT * FROM vista_mostrar_alto_nivel ";
	if ($sw==1)
	{
		$sql= "SELECT * FROM $tabla where nu_ano_oficios=".$anio." and cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user." order by $orden desc";	
		$Resultado=$BaseDato->EjecutarQuery($sql);
		//DIE($sql);
	}
	else
	{
		$sql= "SELECT * FROM $tabla order by $orden";
	
	}	
	// Sa realiza la consulta
//	$Resultado=pg_query($conexion,$sql);
	//Retorna los datos 
	if ( $op==1 ) 
	{
		return $Resultado;
	}
		else //Retorna el numero de registros 
	{
		//Retorna la cantidad de registros
	//1	return pg_num_rows($Resultado);
	$x=$Resultado->fields['cd_oficios'];
		
		if ($Resultado->fields['cd_oficios']=="")
	    {
	       	$this->setId($Resultado->fields['cd_oficios']=0);
	       	return true;
	    }	
	    else
	    {
		//Retorna la cantidad de registros
			$this->setId($Resultado->fields['cd_oficios']);
		//return pg_num_rows($Resultado);
			return true;
	    }
		
		
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
	//$sql= "SELECT * FROM $tabla where $valor order by $orden";
//die($sql);
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
	$anio=$this->getNuanioficio();
	$alto_nivel_user=$this->getId_alto_nivel_user();
	$primer_nivel_user=$this->getId_primer_nivel_user();
	$direcciones_user=$this->getId_direcciones_user();
	
	
    $BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
    $sql = "SELECT * FROM vista_mostrar_oficios WHERE cd_oficios=".$codigo." and nu_ano_oficios=".$anio." and cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user.""; 

    $resultado=$BaseDato->EjecutarQuery($sql);
    if ($resultado->fields['cd_oficios']=="")
    {
     	return FALSE;
    }
    else 
   	{
   		$this->setFeenvio($resultado->fields['fe_envio_oficios']);
   		$this->setHorahhentrada($resultado->fields['nu_hora_hh_envio_oficios']);
   		$this->setHorammentrada($resultado->fields['nu_hora_mm_envio_oficios']);
   		$this->setHorattentrada($resultado->fields['nu_hora_tt_envio_oficios']);
   		$this->setAsunto($resultado->fields['txt_asunto_oficios']);
   		$this->setDestinatario($resultado->fields['nb_destinatario_oficios']);
   		$this->setAlto_nivel($resultado->fields['cd_alto_nivel_corres']);
   		$this->setPrimer_nivel($resultado->fields['cd_primer_nivel_corres']);
   		$this->setDirecciones($resultado->fields['cd_direcciones_corres']);
   		$this->setId_remitir($resultado->fields['cd_remitir']);
   		$this->setResponsable($resultado->fields['nb_responsable_oficios']);
   		$this->setNuanioremitir($resultado->fields['nu_ano_remitir']);
   		$this->setAmeritarespuesta($resultado->fields['in_amerita_respuesta_oficios']);
   		return TRUE;
   	}
} 


function CargarDatosRespuestaOficio()
{  
	$codigo = $this->getId();
	$anio=$this->getNuanioficio();
	$alto_nivel_user=$this->getId_alto_nivel_user();
	$primer_nivel_user=$this->getId_primer_nivel_user();
	$direcciones_user=$this->getId_direcciones_user();
	
	
    $BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
    $sql = "SELECT * FROM vista_mostrar_consul_respuesta_oficios WHERE cd_oficios=".$codigo." and nu_ano_oficios=".$anio." and cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user.""; 

    $resultado=$BaseDato->EjecutarQuery($sql);
    if ($resultado->fields['cd_oficios']=="")
    {
     	return FALSE;
    }
    else 
   	{
   		$this->setId_recibidas($resultado->fields['cd_recibidas']);
   		$this->setNuanio_recibidas($resultado->fields['nu_ano_recibidas']);
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