<?php 
include('../controlador/script.php'); 
include('../controlador/script_tu.php');
session_start();

?>
<html>
<head>
<title>SISCOR</title>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
</head>
<body>
<div id="cuerpo"> 
	<div id="banner"></div>	<!--Fin de 'banner'-->
	<div id="cintillo"></div><!--Fin de 'cintillo'-->
	<div id="superior"></div>
	<div id="sesion"> Bienvenido(a): [<?php  echo ($_SESSION['nombre_user']);?> ] [<a href="../index.php">Cerrar Sesión</a>]</div>
   	<div id="contenedor">
		<div id="izquierda">
			<?php require_once("menu_admin.php") ?>
		</div>
		<div id="central">
			<span class="titulo">BIENVENIDOS AL SISTEMA DE ADMINISTRACI&Oacute;N DE REGISTRO DE CORRESPONDENCIA</span>
			<br>
	
	</div><!-- cierra el div central!-->	
</div><!-- cierra el div contenedor!-->
<div id="pie"></div>
</div> <!-- cierra el div Cuerpo!-->	
</body>
</html>
