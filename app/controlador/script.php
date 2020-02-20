<?php
session_start();
extract($_POST);
extract($_GET);

if ($_SESSION['nombre_user']=="") {
	header("Location: ../index.php");
	$_SESSION['estatus_msj']=2;
	$_SESSION['error_inicio']="Debe registrarse primero!";
	exit();
}
/*
//calculamos el tiempo transcurrido
    $fechaGuardada = $_SESSION["ultimoAcceso"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));  
 //comparamos el tiempo transcurrido
    if($tiempo_transcurrido >= 50) 
    {
     //si pasaron 10 minutos o más
      session_unset();
      $_SESSION = array();   // vaciarla  
      session_destroy();    // destruyo la sesión
    }
    else //sino, actualizo la fecha de la sesión 
    {
      $_SESSION["ultimoAcceso"] = $ahora;
    }  
*/

?>
