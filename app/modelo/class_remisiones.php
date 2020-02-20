<?php
include('../controlador/script.php');
include("constantes.php"); // llamo a las costantes de la conexion 
include_once("BaseDatos.php"); //llamo a la conexion



class Remisiones
{
   
	private $id;
	private $anio_remision;
	private $feremision;
	private $id_recibidas;
	private $anio_recibidas;		
	private $alto_nivel;
	private $primer_nivel;
	private $direcciones;
	private $unidad;
	private $coordinaciones;	
	private $responsable;
	private $prioridad;	
	private $acciones;
	private $amerita_remisiones;
	private $respondida_remision;
	private $check_respondida_remision;
	private $observaciones;
	private $id_usuario;
	private $id_alto_nivel_user;
	private $id_primer_nivel_user;
	private $id_direcciones_user;
	private $id_unidades_user;
	private $id_coordinaciones_user;
	private $perfil;
	private $hora;
	private $minuto;
	private $tiempo;
	private $fecha_paralafirma;
	private $fecha_firmado;
	private $fecha_despachado;	
	private $nombre_recibidapor;
	private $hora_recibidapor;
	private $minuto_recibidapor;
	private $tiempo_recibidapor;
	private $fecha_recibidapor;
/**
	 * @return the $id
	 */
	/**
	 * @return the $perfil
	 */
	/**
	 * @return the $check_respondida_remision
	 */
	/**
	 * @return the $id_unidades_user
	 */
	/**
	 * @return the $hora
	 */
	/**
	 * @return the $fecha_paralafirma
	 */
	/**
	 * @return the $nombre_recibidapor
	 */
	public function getNombre_recibidapor() {
		return $this->nombre_recibidapor;
	}

	/**
	 * @return the $hora_recibidapor
	 */
	public function getHora_recibidapor() {
		return $this->hora_recibidapor;
	}

	/**
	 * @return the $minuto_recibidapor
	 */
	public function getMinuto_recibidapor() {
		return $this->minuto_recibidapor;
	}

	/**
	 * @return the $tiempo_recibidapor
	 */
	public function getTiempo_recibidapor() {
		return $this->tiempo_recibidapor;
	}

	/**
	 * @return the $fecha_recibidapor
	 */
	public function getFecha_recibidapor() {
		return $this->fecha_recibidapor;
	}

	/**
	 * @param $nombre_recibidapor the $nombre_recibidapor to set
	 */
	public function setNombre_recibidapor($nombre_recibidapor) {
		$this->nombre_recibidapor = $nombre_recibidapor;
	}

	/**
	 * @param $hora_recibidapor the $hora_recibidapor to set
	 */
	public function setHora_recibidapor($hora_recibidapor) {
		$this->hora_recibidapor = $hora_recibidapor;
	}

	/**
	 * @param $minuto_recibidapor the $minuto_recibidapor to set
	 */
	public function setMinuto_recibidapor($minuto_recibidapor) {
		$this->minuto_recibidapor = $minuto_recibidapor;
	}

	/**
	 * @param $tiempo_recibidapor the $tiempo_recibidapor to set
	 */
	public function setTiempo_recibidapor($tiempo_recibidapor) {
		$this->tiempo_recibidapor = $tiempo_recibidapor;
	}

	/**
	 * @param $fecha_recibidapor the $fecha_recibidapor to set
	 */
	public function setFecha_recibidapor($fecha_recibidapor) {
		$this->fecha_recibidapor = $fecha_recibidapor;
	}

	public function getFecha_paralafirma() {
		return $this->fecha_paralafirma;
	}

	/**
	 * @return the $fecha_firmado
	 */
	public function getFecha_firmado() {
		return $this->fecha_firmado;
	}

	/**
	 * @return the $fecha_despachado
	 */
	public function getFecha_despachado() {
		return $this->fecha_despachado;
	}

	/**
	 * @param $fecha_paralafirma the $fecha_paralafirma to set
	 */
	public function setFecha_paralafirma($fecha_paralafirma) {
		$this->fecha_paralafirma = $fecha_paralafirma;
	}

	/**
	 * @param $fecha_firmado the $fecha_firmado to set
	 */
	public function setFecha_firmado($fecha_firmado) {
		$this->fecha_firmado = $fecha_firmado;
	}

	/**
	 * @param $fecha_despachado the $fecha_despachado to set
	 */
	public function setFecha_despachado($fecha_despachado) {
		$this->fecha_despachado = $fecha_despachado;
	}

	public function getHora() {
		return $this->hora;
	}

	/**
	 * @return the $minuto
	 */
	public function getMinuto() {
		return $this->minuto;
	}

	/**
	 * @return the $tiempo
	 */
	public function getTiempo() {
		return $this->tiempo;
	}

	/**
	 * @param $hora the $hora to set
	 */
	public function setHora($hora) {
		$this->hora = $hora;
	}

	/**
	 * @param $minuto the $minuto to set
	 */
	public function setMinuto($minuto) {
		$this->minuto = $minuto;
	}

	/**
	 * @param $tiempo the $tiempo to set
	 */
	public function setTiempo($tiempo) {
		$this->tiempo = $tiempo;
	}

	public function getId_unidades_user() {
		return $this->id_unidades_user;
	}

	/**
	 * @return the $id_coordinaciones_user
	 */
	public function getId_coordinaciones_user() {
		return $this->id_coordinaciones_user;
	}

	/**
	 * @param $id_unidades_user the $id_unidades_user to set
	 */
	public function setId_unidades_user($id_unidades_user) {
		$this->id_unidades_user = $id_unidades_user;
	}

	/**
	 * @param $id_coordinaciones_user the $id_coordinaciones_user to set
	 */
	public function setId_coordinaciones_user($id_coordinaciones_user) {
		$this->id_coordinaciones_user = $id_coordinaciones_user;
	}

	public function getCheck_respondida_remision() {
		return $this->check_respondida_remision;
	}

	/**
	 * @param $check_respondida_remision the $check_respondida_remision to set
	 */
	public function setCheck_respondida_remision($check_respondida_remision) {
		$this->check_respondida_remision = $check_respondida_remision;
	}

	public function getPerfil() {
		return $this->perfil;
	}

	/**
	 * @param $perfil the $perfil to set
	 */
	public function setPerfil($perfil) {
		$this->perfil = $perfil;
	}

	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $anio_remision
	 */
	public function getAnio_remision() {
		return $this->anio_remision;
	}

	/**
	 * @return the $feremision
	 */
	public function getFeremision() {
		return $this->feremision;
	}

	/**
	 * @return the $id_recibidas
	 */
	public function getId_recibidas() {
		return $this->id_recibidas;
	}

	/**
	 * @return the $anio_recibidas
	 */
	public function getAnio_recibidas() {
		return $this->anio_recibidas;
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
	 * @return the $unidad
	 */
	public function getUnidad() {
		return $this->unidad;
	}

	/**
	 * @return the $coordinaciones
	 */
	public function getCoordinaciones() {
		return $this->coordinaciones;
	}

	/**
	 * @return the $responsable
	 */
	public function getResponsable() {
		return $this->responsable;
	}

	/**
	 * @return the $prioridad
	 */
	public function getPrioridad() {
		return $this->prioridad;
	}

	/**
	 * @return the $acciones
	 */
	public function getAcciones() {
		return $this->acciones;
	}

	/**
	 * @return the $amerita_remisiones
	 */
	public function getAmerita_remisiones() {
		return $this->amerita_remisiones;
	}

	/**
	 * @return the $respondida_remision
	 */
	public function getRespondida_remision() {
		return $this->respondida_remision;
	}

	/**
	 * @return the $observaciones
	 */
	public function getObservaciones() {
		return $this->observaciones;
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
	 * @param $anio_remision the $anio_remision to set
	 */
	public function setAnio_remision($anio_remision) {
		$this->anio_remision = $anio_remision;
	}

	/**
	 * @param $feremision the $feremision to set
	 */
	public function setFeremision($feremision) {
		$this->feremision = $feremision;
	}

	/**
	 * @param $id_recibidas the $id_recibidas to set
	 */
	public function setId_recibidas($id_recibidas) {
		$this->id_recibidas = $id_recibidas;
	}

	/**
	 * @param $anio_recibidas the $anio_recibidas to set
	 */
	public function setAnio_recibidas($anio_recibidas) {
		$this->anio_recibidas = $anio_recibidas;
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
	 * @param $unidad the $unidad to set
	 */
	public function setUnidad($unidad) {
		$this->unidad = $unidad;
	}

	/**
	 * @param $coordinaciones the $coordinaciones to set
	 */
	public function setCoordinaciones($coordinaciones) {
		$this->coordinaciones = $coordinaciones;
	}

	/**
	 * @param $responsable the $responsable to set
	 */
	public function setResponsable($responsable) {
		$this->responsable = $responsable;
	}

	/**
	 * @param $prioridad the $prioridad to set
	 */
	public function setPrioridad($prioridad) {
		$this->prioridad = $prioridad;
	}

	/**
	 * @param $acciones the $acciones to set
	 */
	public function setAcciones($acciones) {
		$this->acciones = $acciones;
	}

	/**
	 * @param $amerita_remisiones the $amerita_remisiones to set
	 */
	public function setAmerita_remisiones($amerita_remisiones) {
		$this->amerita_remisiones = $amerita_remisiones;
	}

	/**
	 * @param $respondida_remision the $respondida_remision to set
	 */
	public function setRespondida_remision($respondida_remision) {
		$this->respondida_remision = $respondida_remision;
	}

	/**
	 * @param $observaciones the $observaciones to set
	 */
	public function setObservaciones($observaciones) {
		$this->observaciones = $observaciones;
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

   
function ExisteRespuestaRemision($tabla,$campo,$valor,$campo2,$valor2,$campo3,$valor3,$campo4,$valor4,$campo5,$valor5,$campo6,$valor6)
{            
    $BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
    $sql = "SELECT * FROM $tabla WHERE $campo='$valor' and $campo2='$valor2' and $campo3='$valor3' and $campo4='$valor4' and $campo5='$valor5' and $campo6='$valor6' ";
//die($sql);
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
		$xajax->registerFunction ( array ('llenarunidades', &$this, 'llenarunidades' ) );
		$xajax->registerFunction ( array ('llenarCoordinaciones', &$this, 'llenarCoordinaciones' ) );
		$xajax->registerFunction ( array ('deshabilitar', &$this, 'deshabilitar' ) );
		$xajax->processRequest ();
		$xajax->setFlag ( 'statusMessages', true );
		$xajax->setFlag ( 'waitCursor', true );
		
} 
	
	
function llenarPrimerNivel($id,$dire,$alto,$primer) {
	
		if ($id == 0 || $id == '0') 
		{
		    die("d");
			$salida = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione un Alto Nivel-</option></select>";
		
		} 
		else 
		{
                    if ($primer == 329)
                    {    
			
                        $salida = "<select name=\"primer_nivel\" id=\"primer_nivel\" onchange=\"xajax_llenarDireccion(document.getElementById('primer_nivel').value,".$dire.",".$alto.",".$primer.");return false;\">";	
                    }
                    else
                    {
                        $salida = "<select ".$_SESSION['disabled']." name=\"primer_nivel\" id=\"primer_nivel\" onchange=\"xajax_llenarDireccion(document.getElementById('primer_nivel').value,".$dire.",".$alto.",".$primer.");return false;\">";	
                    }
                        $salida .= "<option value=\"0\">-Seleccione-</option>";
			$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato		
			$conexion = $BaseDato->Conectar ();
			
                        if ($id==3)
			{
                           
                            $sql = "SELECT * from vista_mostrar_primer_nivel_corres where cd_alto_nivel_corres=".$id." and cd_alto_nivel_usuarios=".$alto." and cd_primer_nivel_usuarios=".$primer." and cd_direcciones_usuarios=".$dire." order by nb_primer_nivel_corres";	
                            $Resultado = pg_query ( $conexion, $sql );
                            while ( $row = pg_fetch_array ( $Resultado ) ) 
                            {
                                $salida .= "<option value =\"" . $row ["cd_primer_nivel_corres"] . "\">" . $row ["nb_primer_nivel_corres"] . "</option>";	
                            }
			}
			else 
			{
                            
                            $sql = "SELECT * from vista_mostrar_primer_nivel where cd_alto_nivel=".$id." and cd_primer_nivel < 144 order by nb_primer_nivel";
                     			$Resultado = pg_query ( $conexion, $sql );

                            while ( $row = pg_fetch_array ( $Resultado ) ) 
                            {
                                $salida .= "<option value =\"" . $row ["cd_primer_nivel"] . "\">" . $row ["nb_primer_nivel"] . "</option>";	
                            }
			}                        
			// mostrarmos los registros

                    $salida .= "</select> ";
                }
			
		$objResponse = new xajaxResponse ();
		$objResponse->assign ( 'div_primer_nivel', 'innerHTML', $salida );
		
                $salida1 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>";
		$objResponse->assign ( 'div_direcciones', 'innerHTML',$salida1);			
                $salida2 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>";
		$objResponse->assign ( 'div_unidades', 'innerHTML',$salida2);
		$salida3 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Coordinaci&oacute;n-</option></select>";
		$objResponse->assign ( 'div_coordinaciones', 'innerHTML',$salida3);		
		return $objResponse;
	}     
	

function llenarDireccion($idPrimerNivel,$dired,$altod,$primerd) {
	
		
		if ($idPrimerNivel == 0 || $idPrimerNivel == '0') 
		{
		
			$salida = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione un Primer Nivel-</option></select>";
		
		} 
		else 
		{
			//$salida = "<select ".$_SESSION['disabled']." name=\"direcciones\" id=\"direcciones\" onchange=\"xajax_llenarunidades(document.getElementById('direcciones').value,".$dired.",".$altod.",".$primerd.");return false;\">";
			$salida = "<select name=\"direcciones\" id=\"direcciones\" onchange=\"xajax_llenarunidades(document.getElementById('direcciones').value,".$dired.",".$altod.",".$primerd.");return false;\">";	
			$salida .= "<option value=\"0\">-Seleccione-</option>";
			$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato		
			$conexion = $BaseDato->Conectar ();
			///if ($dired!=0)
			//{
			$sql = "SELECT * FROM vista_mostrar_direcciones_corres where cd_primer_nivel_corres = ".$idPrimerNivel." order by nb_direcciones_corres";	
                        
			//}
			//else
			//{
			//	$sql = "SELECT * FROM vista_mostrar_direcciones where cd_primer_nivel = ".$idPrimerNivel." order by nb_direcciones";	
		//	}
			
			
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
	
	
function llenarUnidades($idPrimerNivel,$dired,$altod,$primerd) {

	
		if ($idPrimerNivel == 0 || $idPrimerNivel == '0') 
		{
			$salida = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>";
		
		} 
		else 
		{
			$salida = "<label><select ".$_SESSION['disabled']." name=\"unidades\" id=\"unidades\" onchange=\"xajax_llenarCoordinaciones(document.getElementById('unidades').value,".$dired.",".$altod.",".$primerd.");return false;\">";	
			$salida .= "<option value=\"0\">-Seleccione-</option>";
			$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato		
			$conexion = $BaseDato->Conectar ();
			//if ($dired!=0)
			//{
				$sql = "SELECT * FROM vista_mostrar_unidades where cd_direcciones=".$idPrimerNivel." order by nb_unidades";		
		///	}
		//	else 
		///	{
		//		$sql = "SELECT * FROM vista_mostrar_unidades where cd_direcciones=".$idPrimerNivel." and cd_alto_nivel_usuarios=".$altod." and cd_primer_nivel_usuarios=".$primerd." order by nb_unidades";				
		//	}
			
			
			// mostrarmos los registros
			$Resultado = pg_query ( $conexion, $sql );

			while ( $row = pg_fetch_array ($Resultado) ) 
			{
                $salida .= "<option value =\"" . $row ["cd_unidades"] . "\">" . $row ["nb_unidades"] . "</option>";	
			}
			$salida .= "</select>";
			$salida .= "<input name='todos' type='checkbox' onclick='unidades.disabled = this.checked;unidades.selectedIndex=0'>   Todas las Unidades</label>";
		}
			
		$objResponse = new xajaxResponse ();
		$objResponse->assign ( 'div_unidades', 'innerHTML', $salida );

    	$salida1 = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>";
		$objResponse->assign ( 'div_coordinaciones', 'innerHTML',$salida1);
		return $objResponse;
	} 

function llenarCoordinaciones($idDire,$dired,$altod,$primerd){
		
			if ($idDire == 0 || $idDire == '0') 
			{
				$salida = "<select disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>"; 
			} 
			else 
			{
				if ($_SESSION['perfil']==1)
				{
					echo "<select name=\"unidades\" disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>";
				}
				else
				{
					$salida = "<select ".$_SESSION['disabled']." name=\"coordinaciones\" id=\"coordinaciones\">";	
					$salida .= "<option value=\"0\">-Seleccione-</option>";			
					$BaseDato = new BaseDeDato ( SERVIDOR, PUERTO, BD, USUARIO, CLAVE ); //declarar el objeto de la clase base de dato				
					$conexion = $BaseDato->Conectar ();
					$sql = "SELECT * FROM vista_mostrar_coordinaciones where cd_unidades = ".$idDire." order by nb_coordinaciones";
					//$sql = "SELECT * FROM vista_mostrar_coordinaciones where cd_unidades = ".$idDire." and cd_direcciones_usuarios=".$dired."and cd_alto_nivel_usuarios=".$altod." and cd_primer_nivel_usuarios=".$primerd." order by nb_coordinaciones";
					// mostrarmos los registros
					$Resultado = pg_query ( $conexion, $sql );
			
					while ( $row = pg_fetch_array ($Resultado) ) 
					{
            	    	$salida .= "<option value =\"" . $row ["cd_coordinaciones"] . "\">" . $row ["nb_coordinaciones"] . "</option>";	
					}
						$salida .= "</select>";
				}
			}		
			$objResponse = new xajaxResponse ();
			$objResponse->assign ( 'div_coordinaciones', 'innerHTML',$salida);
			
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

    if ($sw==1)
    {
        $sql= "SELECT * FROM $tabla where cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user." order by $orden";	

    }
    else if ($sw==2)
    {
       $sql= "SELECT * FROM $tabla where cd_alto_nivel < 25 order by $orden";

    }
    else if ($sw==3)
    {
       $sql= "SELECT * FROM $tabla order by $orden";
    }   
    else 
    {
        //$sql= "SELECT * FROM $tabla order by $orden";
       $sql= "SELECT * FROM $tabla where cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user." order by $orden";	
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
	$anio=$this->getAnio_remision();
//1	include_once('conexpg.php');
	//declarar el objeto de la clase base de dato
//1	$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	//Hace la conexion a la BD
//1	$conexion= $BaseDato->Conectar();
	$BaseDato=new BaseDatos();	
//Realiza la consulta

	if ($sw==1)
	{
		 $sql= "SELECT * FROM $tabla where nu_ano_remisiones=".$anio." and cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user." order by $orden desc";	
		 $Resultado=$BaseDato->EjecutarQuery($sql);
	}
	else
	{
		$sql= "SELECT * FROM $tabla order by $orden";
	
	}	
	// Sa realiza la consulta
	//1$Resultado=pg_query($conexion,$sql);
	//Retorna los datos 
	if ( $op==1 ) 
	{
		return $Resultado;
	}
		else //Retorna el numero de registros 
	{
		//Retorna la cantidad de registros
			if ($Resultado->fields['cd_remisiones']=="")
	    {
	       	$this->setId($Resultado->fields['cd_remisiones']=0);
	       	return true;
	    }	
	    else
	    {
		//Retorna la cantidad de registros
			$this->setId($Resultado->fields['cd_remisiones']);
		//return pg_num_rows($Resultado);
			return true;
	    }
	}		
}	// Fin de 'mostrar($op)'

function MostrarUnidades($op,$tabla,$orden,$where ) 
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

		$sql= "SELECT * FROM $tabla $where and cd_alto_nivel=".$alto_nivel_user." and cd_primer_nivel=".$primer_nivel_user." and cd_direcciones=".$direcciones_user." order by $orden";	
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
  // die($sql);
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
    $anio=$this->getAnio_remision();
    $alto_nivel_user=$this->getId_alto_nivel_user();
    $primer_nivel_user=$this->getId_primer_nivel_user();
    $direcciones_user=$this->getId_direcciones_user();
	
    $BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
    $sql = "SELECT * FROM vista_mostrar_remisiones WHERE cd_remisiones=".$codigo." and nu_ano_remisiones=".$anio." and cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user.""; 
   //die($sql);
    $resultado=$BaseDato->EjecutarQuery($sql);
    if ($resultado->fields['cd_remisiones']=="")
    {
     	return FALSE;
    }
    else 
    {

        $this->setId($resultado->fields['cd_remisiones']);
        $this->setFeremision($resultado->fields['fe_remisiones']);
        $this->setId_recibidas($resultado->fields['cd_recibidas']);
        $this->setAlto_nivel($resultado->fields['cd_alto_nivel']);
        $this->setPrimer_nivel($resultado->fields['cd_primer_nivel']);
        $this->setDirecciones($resultado->fields['cd_direcciones']);
        $this->setUnidad($resultado->fields['cd_unidades']);
        $this->setCoordinaciones($resultado->fields['cd_coordinaciones']);
        $this->setResponsable($resultado->fields['nb_responsable_remisiones']);
        $this->setPrioridad($resultado->fields['cd_prioridades']);
        $this->setAcciones($resultado->fields['cd_acciones']);
        $this->setAmerita_remisiones($resultado->fields['in_responder_remisiones']);
        $this->setObservaciones($resultado->fields['tx_observacion_remisiones']);
        $this->setId_usuario($resultado->fields['cd_usuarios']);
        $this->setAnio_recibidas($resultado->fields['nu_ano_recibidas']);
        $this->setRespondida_remision($resultado->fields['tx_respuesta_remisiones']);
        $this->setHora($resultado->fields['nu_hora_hh_entrada_remisiones']);
        $this->setMinuto($resultado->fields['nu_hora_mm_entrada_remisiones']);
        $this->setTiempo($resultado->fields['nu_hora_tt_entrada_remisiones']);
        $this->setCheck_respondida_remision($resultado->fields['in_respuesta_remisiones']);
        $this->setFecha_paralafirma($resultado->fields['fe_paralafirma']);
        $this->setFecha_firmado($resultado->fields['fe_firmada']);
        $this->setFecha_despachado($resultado->fields['fe_despachada']);
        $this->setNombre_recibidapor($resultado->fields['nb_recibidapor_remisiones']);
        $this->setFecha_recibidapor($resultado->fields['fe_recibidapor_remisiones']);
        $this->setHora_recibidapor($resultado->fields['nu_hora_hh_recibidapor_remisiones']);
        $this->setMinuto_recibidapor($resultado->fields['nu_hora_mm_recibidapor_remisiones']);
        $this->settiempo_recibidapor($resultado->fields['nu_hora_tt_recibidapor_remisiones']);

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

function CargarDatosRemisionesRecibidas()
{  
	
	
	
	$codigo = $this->getId_recibidas();
	$anio = $this->getAnio_recibidas();
	$alto_nivel = $this->getAlto_nivel();
	$primer_nivel = $this->getPrimer_nivel();
	$direcciones = $this->getDirecciones();
	$unidades = $this->getUnidad();
	
	
    $BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
    $sql = "SELECT * FROM vista_mostrar_remisiones WHERE cd_recibidas=".$codigo." and nu_ano_recibidas=".$anio." and cd_alto_nivel=".$alto_nivel." and cd_primer_nivel=".$primer_nivel." and cd_direcciones=".$direcciones." and cd_unidades=".$unidades.""; 
//die($sql);
    $resultado=$BaseDato->EjecutarQuery($sql);
    if ($resultado->fields['cd_recibidas']=="")
    {
     	return FALSE;
    }
    else 
   	{
   		$this->setId($resultado->fields['cd_remisiones']);
   		
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