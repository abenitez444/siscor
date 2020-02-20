<?php
include('../controlador/script.php');
include("constantes.php"); // llamo a las costantes de la conexion 
include_once("BaseDatos.php"); //llamo a la conexion



class Modulosxusuarios
{
   
	private $id;
	private $id_usuarios;
	
	private $ingresar;
	private $consultar;
	private $modificar;
	
	private $id_usuarios_usuarios;
	private $id_alto_nivel_usuarios;
	private $id_primer_nivel_usuarios;
  	private $id_direcciones_usurios;
 		
/**
	 * @param $id_direcciones_usurios the $id_direcciones_usurios to set
	 */
	public function setId_direcciones_usurios($id_direcciones_usurios) {
		$this->id_direcciones_usurios = $id_direcciones_usurios;
	}

/**
	 * @param $id_primer_nivel_usuarios the $id_primer_nivel_usuarios to set
	 */
	public function setId_primer_nivel_usuarios($id_primer_nivel_usuarios) {
		$this->id_primer_nivel_usuarios = $id_primer_nivel_usuarios;
	}

/**
	 * @param $id_alto_nivel_usuarios the $id_alto_nivel_usuarios to set
	 */
	public function setId_alto_nivel_usuarios($id_alto_nivel_usuarios) {
		$this->id_alto_nivel_usuarios = $id_alto_nivel_usuarios;
	}

/**
	 * @param $id_usuarios the $id_usuarios to set
	 */
	public function setId_usuarios($id_usuarios) {
		$this->id_usuarios = $id_usuarios;
	}

/**
	 * @param $modificar the $modificar to set
	 */
	public function setModificar($modificar) {
		$this->modificar = $modificar;
	}

/**
	 * @param $consultar the $consultar to set
	 */
	public function setConsultar($consultar) {
		$this->consultar = $consultar;
	}

/**
	 * @param $ingresar the $ingresar to set
	 */
	public function setIngresar($ingresar) {
		$this->ingresar = $ingresar;
	}

/**
	 * @param $id_usuarios the $id_usuarios to set
	 */
	public function setId_usuarios_usuarios($id_usuarios_usuarios) {
		$this->$id_usuarios_usuarios = $id_usuarios_usuarios;
	}

/**
	 * @param $id the $id to set
	 */
	public function setId($id) {
		$this->id = $id;
	}

/**
	 * @return the $id_direcciones_usurios
	 */
	public function getId_direcciones_usurios() {
		return $this->id_direcciones_usurios;
	}

/**
	 * @return the $id_primer_nivel_usuarios
	 */
	public function getId_primer_nivel_usuarios() {
		return $this->id_primer_nivel_usuarios;
	}

/**
	 * @return the $id_alto_nivel_usuarios
	 */
	public function getId_alto_nivel_usuarios() {
		return $this->id_alto_nivel_usuarios;
	}

/**
	 * @return the $id_usuarios
	 */
	public function getId_usuarios() {
		return $this->id_usuarios;
	}

/**
	 * @return the $modificar
	 */
	public function getModificar() {
		return $this->modificar;
	}

/**
	 * @return the $consultar
	 */
	public function getConsultar() {
		return $this->consultar;
	}

/**
	 * @return the $ingresar
	 */
	public function getIngresar() {
		return $this->ingresar;
	}

/**
	 * @return the $id_usuarios
	 */
	public function getId_usuarios_usuarios() {
		return $this->$id_usuarios_usuarios;
	}

/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
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



function MostrarConsulta( $op,$tabla,$valor,$orden ) 
		{
	
	/*		
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
			//echo($sql);
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
			}		*/

		}	// Fin de 'mostrar($op)'	
		
function CargarDatos()
{  
/*	$codigo = $this->getId();
	$anio=$this->getNuano();
	$alto_nivel_user=$this->getId_alto_nivel_user();
	$primer_nivel_user=$this->getId_primer_nivel_user();
	$direcciones_user=$this->getId_direcciones_user();
	
	
    $BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
    $sql = "SELECT * FROM vista_mostrar_recibidas WHERE cd_recibidas=".$codigo." and nu_ano_recibidas=".$anio." and cd_alto_nivel_usuarios=".$alto_nivel_user." and cd_primer_nivel_usuarios=".$primer_nivel_user." and cd_direcciones_usuarios=".$direcciones_user."order by cd_recibidas"; 

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
   		$this->setAmerita_respuesta($resultado->fields['in_amerita_respuesta_recibidas']);
   		return TRUE;
	}*/
}

function Mostrar() 
{
	
	$codigo = $this->getId();
	
	include_once('conexpg.php');
	
	//declarar el objeto de la clase base de dato
	$BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);

	//Hace la conexion a la BD
	$conexion= $BaseDato->Conectar();

	//Realiza la consulta
	$sql= "SELECT * FROM vista_mostrar_modulosxusuarios where cd_usuarios=".$codigo." order by cd_modulos";

	// Sa realiza la consulta
	$Resultado=pg_query($conexion,$sql);
			
	return $Resultado;
}	// Fin de 'mostrar($op)'


function Existe($valor,$valor2,$valor3,$valor4)
{            
   	  	$BaseDato=new BaseDatos();//declarar el objeto de la clase base de dato
   	  	$sql = "SELECT * FROM vista_mostrar_modulosxusuarios WHERE cd_usuarios= '$valor' and $valor2='$valor3' and cd_modulos='$valor4'";
                $resultado=$BaseDato->EjecutarQuery($sql);
   	  	if ($resultado->fields[cd_usuarios]=="")
   	  	 	{
   	  		return 0;
   	  		}
   	  	else 
   	  		{
   	  		return 1;
   	  		}

}



}  

?>