<?php
include('../controlador/script.php');
include("constantes.php"); // llamo a las costantes de la conexion 
include_once("BaseDatos.php"); //llamo a la conexion



class Recibidas
{
   
	private $id;
	private $nuano;
	private $feentrada;
	private $fecarta;
	private $horahhentrada;
	private $horammentrada;
	private $clasificacion_documento;
	private $asunto;
	private $remitente;
	private $ubicacion;
	private $alto_nivel;
	private $primer_nivel;
	private $direcciones;
	private $nuexterno;
	private $cedremitente;
	private $id_usuario;
	private $id_alto_nivel_user;
	private $id_primer_nivel_user;
	private $id_direcciones_user;
	private $horattentrada;
	private $amerita_respuesta;
	private $respondida;
	private $id_oficios;
	private $anio_oficios;
	private $documento;		
		
/**
	 * @return the $id
	 */
	/**
	 * @return the $horattentrada
	 */
	/**
	 * @return the $amerita_respuesta
	 */
	/**
	 * @return the $id_oficios
	 */
	public function getId_oficios() {
		return $this->id_oficios;
	}
	/**
	 * @param $documento the $documento to set
	 */
	public function setDocumento($documento) {
		$this->documento = $documento;
	}

	/**
	 * @return the $documento
	 */
	public function getDocumento() {
		return $this->documento;
	}


	/**
	 * @return the $anio_oficios
	 */
	public function getAnio_oficios() {
		return $this->anio_oficios;
	}

	/**
	 * @param $id_oficios the $id_oficios to set
	 */
	public function setId_oficios($id_oficios) {
		$this->id_oficios = $id_oficios;
	}

	/**
	 * @param $anio_oficios the $anio_oficios to set
	 */
	public function setAnio_oficios($anio_oficios) {
		$this->anio_oficios = $anio_oficios;
	}

	public function getAmerita_respuesta() {
		return $this->amerita_respuesta;
	}

	/**
	 * @return the $respondida
	 */
	public function getRespondida() {
		return $this->respondida;
	}

	/**
	 * @param $amerita_respuesta the $amerita_respuesta to set
	 */
	public function setAmerita_respuesta($amerita_respuesta) {
		$this->amerita_respuesta = $amerita_respuesta;
	}

	/**
	 * @param $respondida the $respondida to set
	 */
	public function setRespondida($respondida) {
		$this->respondida = $respondida;
	}

	public function getHorattentrada() {
		return $this->horattentrada;
	}

	/**
	 * @param $horattentrada the $horattentrada to set
	 */
	public function setHorattentrada($horattentrada) {
		$this->horattentrada = $horattentrada;
	}

	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $nuano
	 */
	public function getNuano() {

		return $this->nuano;
	}

	/**
	 * @return the $feentrada
	 */
	public function getFeentrada() {
		return $this->feentrada;
	}

	/**
	 * @return the $fecarta
	 */
	public function getFecarta() {
		return $this->fecarta;
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
	 * @return the $clasificacion_documento
	 */
	public function getClasificacion_documento() {
		return $this->clasificacion_documento;
	}

	/**
	 * @return the $asunto
	 */
	public function getAsunto() {
		return $this->asunto;
	}

	/**
	 * @return the $remitente
	 */
	public function getRemitente() {
		return $this->remitente;
	}

	/**
	 * @return the $ubicacion
	 */
	public function getUbicacion() {
		return $this->ubicacion;
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
	 * @return the $nuexterno
	 */
	public function getNuexterno() {
		return $this->nuexterno;
	}

	/**
	 * @return the $cedremitente
	 */
	public function getCedremitente() {
		return $this->cedremitente;
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
	 * @param $id the $id to set
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param $nuano the $nuano to set
	 */
	public function setNuano($nuano) {
		$this->nuano = $nuano;
	}

	/**
	 * @param $feentrada the $feentrada to set
	 */
	public function setFeentrada($feentrada) {
		$this->feentrada = $feentrada;
	}

	/**
	 * @param $fecarta the $fecarta to set
	 */
	public function setFecarta($fecarta) {
		$this->fecarta = $fecarta;
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
	 * @param $clasificacion_documento the $clasificacion_documento to set
	 */
	public function setClasificacion_documento($clasificacion_documento) {
		$this->clasificacion_documento = $clasificacion_documento;
	}

	/**
	 * @param $asunto the $asunto to set
	 */
	public function setAsunto($asunto) {
		$this->asunto = $asunto;
	}

	/**
	 * @param $remitente the $remitente to set
	 */
	public function setRemitente($remitente) {
		$this->remitente = $remitente;
	}

	/**
	 * @param $ubicacion the $ubicacion to set
	 */
	public function setUbicacion($ubicacion) {
		$this->ubicacion = $ubicacion;
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
	 * @param $nuexterno the $nuexterno to set
	 */
	public function setNuexterno($nuexterno) {
		$this->nuexterno = $nuexterno;
	}

	/**
	 * @param $cedremitente the $cedremitente to set
	 */
	public function setCedremitente($cedremitente) {
		$this->cedremitente = $cedremitente;
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

function Existeimg($valor,$valor2,$valor3,$valor4)
	{            
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
   	  	$sql = "SELECT * FROM vista_mostrar_recibidas WHERE img_documento_recibidas='$valor' and cd_alto_nivel_usuarios='$valor2' and cd_primer_nivel_usuarios='$valor3' and cd_direcciones_corres='$valor4'";
   	  	$resultado=$BaseDato->EjecutarQuery($sql);
   	  	if ($resultado->fields[img_documento_recibidas]=="")
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
		//$sql= "SELECT * FROM $tabla order by $orden";
		if ($_SESSION['alto_nivel_user']>=25)
		{
			$sql= "SELECT * FROM $tabla order by $orden";
		}
		else
		{
		$sql= "SELECT * FROM $tabla where cd_alto_nivel_corres < 25 order by $orden";	
		}
	}
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
}	// Fin de 'mostrar($op)'	

function MostrarGuardar( $op,$tabla,$orden,$sw ) 
{
	$alto_nivel_user=$this->getId_alto_nivel_user();
	$primer_nivel_user=$this->getId_primer_nivel_user();
	$direcciones_user=$this->getId_direcciones_user();
	$anio=$this->getNuano();
//1	include_once('conexpg.php');
	//declarar el objeto de la clase base de dato
	$BaseDato=new BaseDatos();
	//Hace la conexion a la BD
//1$conexion= $BaseDato->Conectar();
	//Realiza la consulta
	//$sql= "SELECT * FROM vista_mostrar_alto_nivel ";
	if ($sw==1)
	{
		
		$sql= "SELECT cd_recibidas FROM $tabla where nu_ano_recibidas=".$anio." and cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user." order by $orden desc";	

	$Resultado=$BaseDato->EjecutarQuery($sql);
	}
	else
	{
		$sql= "SELECT * FROM $tabla order by $orden";
	
	//1	$Resultado=pg_query($conexion,$sql);
	}	
	// Sa realiza la consulta
	
//Retorna los datos 
	if ( $op==1 ) 
	{
		return $Resultado;
	}
		else //Retorna el numero de registros 
	{
		
	    if ($Resultado->fields['cd_recibidas']=="")
	    {
	       	$this->setId($Resultado->fields['cd_recibidas']=0);
	       	return true;
	    }	
	    else
	    {
		//Retorna la cantidad de registros
			$this->setId($Resultado->fields['cd_recibidas']);
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
	$anio=$this->getNuano();
	$alto_nivel_user=$this->getId_alto_nivel_user();
	$primer_nivel_user=$this->getId_primer_nivel_user();
	$direcciones_user=$this->getId_direcciones_user();
	
	
    $BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
    $sql = "SELECT * FROM vista_mostrar_recibidas WHERE cd_recibidas=".$codigo." and nu_ano_recibidas=".$anio." and cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user." order by cd_recibidas"; 
//die($sql);
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
   		$this->setAlto_nivel($resultado->fields['cd_alto_nivel_corres']);
   		$this->setPrimer_nivel($resultado->fields['cd_primer_nivel_corres']);
   		$this->setDirecciones($resultado->fields['cd_direcciones_corres']);
   		$this->setNuexterno($resultado->fields['nu_externo_recibidas']);
   		$this->setCedremitente($resultado->fields['ds_cedula_remitente_recibidas']);
   		$this->setAmerita_respuesta($resultado->fields['in_amerita_respuesta_recibidas']);
   		$this->setDocumento($resultado->fields['img_documento_recibidas']);
   		return TRUE;
   	}
}  

function CargarDatosRespuestaRecibidas()
{  
	$codigo = $this->getId();
	$anio=$this->getNuano();
	$alto_nivel_user=$this->getId_alto_nivel_user();
	$primer_nivel_user=$this->getId_primer_nivel_user();
	$direcciones_user=$this->getId_direcciones_user();
	
	
    $BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
    $sql = "SELECT * FROM vista_mostrar_consul_respuesta_recibidas WHERE cd_recibidas=".$codigo." and nu_ano_recibidas=".$anio." and cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user.""; 

    $resultado=$BaseDato->EjecutarQuery($sql);
    if ($resultado->fields['cd_oficios']=="")
    {
     	return FALSE;
    }
    else 
   	{
   		$this->setId_oficios($resultado->fields['cd_oficios']);
   		$this->setAnio_oficios($resultado->fields['nu_ano_oficios']);
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
