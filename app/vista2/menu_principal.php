<?php include('../controlador/script.php'); 
session_start();
?>
<html>
<head>
<title>Sistema de Correspondencia (SISCOR)</title>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
</head>
<body>
<div id="cuerpo"> 
	<div id="banner"></div>	<!--Fin de 'banner'-->
	<div id="cintillo"></div><!--Fin de 'cintillo'-->
	<div id="superior"></div>
	<div id="sesion"> Bienvenido(a): [<?php  echo ($_SESSION['nombre_user']);?> ] [<a href="../controlador/control_session.php">Cerrar Sesión</a>]</div>
   	<div id="contenedor">
		<div id="izquierda">
			<?php require_once("menu.php") ?>
		</div>
		<div id="central">
			<?php
			if($_SESSION['error_autorizacion']=="")
			{
			?>
				<span class="titulo">BIENVENIDOS AL SISTEMA DE REGISTRO DE CORRESPONDENCIA</span>
			<?php 
			}
			?>
			<br>
			<br>
			<br>
			<br>
			<br>
	<?php
        				if ($_SESSION['estatus_msj']==1)
						{
							?>
							<table id="tabla_msj" align="center"><tr><td>
							<img src="../assets/img/cancel.png">
							</td>
							<td>
							<label class="label_corr"> 							 
							<?
							echo ($_SESSION['error_autorizacion']);
							?></label></td></tr></table><? 
							unset($_SESSION['error_autorizacion']);
							unset($_SESSION['estatus_msj']);
						}
				    	else
						{ 
							if($_SESSION['estatus_msj']==2) 
					  		{ 
					  			?>
						  		<table id="tabla_msj" align="center">
						  		<tr>
						  		<td>
						  		<img src="../assets/img/accept.png">
								</td>
								<td>
								<label class="label_corr">			  		 							
						   		<?php 
						   		echo ($_SESSION['error_autorizacion']);
						   		?>
						   		</label>
						   		</td>
						   		</tr>
						   		</table><?  
						  		unset($_SESSION['error_autorizacion']);
						  		unset($_SESSION['estatus_msj']);
					  		}
						}
						?>
						
										<?php if ($_SESSION['estatus_msj']==1)
						{?>
						<table id="tabla_msj" align="center"><tr><td>
						<img src="../assets/img/cancel.png">
						</td>
						<td>
						<label class="label_corr"> 
						<? echo ($_SESSION['error_acciones']);?>
						</label></td></tr></table><? 
						unset($_SESSION['error_acciones']);
						unset($_SESSION['estatus_msj']);
						}
					      else
						{ if($_SESSION['estatus_msj']==2) 
						  { ?>
						  <table id="tabla_msj" align="center"><tr><td>
						  <img src="../assets/img/accept.png">
						  </td>
						  <td>
						  <label class="label_corr"> 							
						   <? echo ($_SESSION['error_acciones']);?>
						   </label></td></tr></table><?  
						  unset($_SESSION['error_acciones']);
						  unset($_SESSION['estatus_msj']);
						  }
						}?>
						
						
						
						
	</div><!-- cierra el div central!-->	
</div><!-- cierra el div contenedor!-->
<div id="pie"></div>
</div> <!-- cierra el div Cuerpo!-->	
</body>
</html>
