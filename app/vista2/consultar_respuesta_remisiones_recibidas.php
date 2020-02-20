<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/conexpg.php"); //Incluye class 'BaseDeDato'

?>
<html>
<head>

<title>Respuesta Remisiones - SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../assets/calendario/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../assets/js/dateInput.js" type="text/javascript"></script>
<script src="../assets/js/jvstools.js" type="text/javascript"></script>
<link href="../assets/calendario/SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link href="../assets/calendario/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/dateInput.css" rel="stylesheet" type="text/css" /> 
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="../assets/js/vali_respuesta_recibidas.js"></script> 
 
</head>
<body>
<center>
<div id="cuerpo"> 
	<div id="banner"></div>	<!--Fin de 'banner'-->
	<div id="cintillo"></div><!--Fin de 'cintillo'-->
	<div id="superior"></div>
	<div id="sesion"> Bienvenido(a): [<?php  echo ($_SESSION['nombre_user']);?> ] [<a href="../controlador/control_session.php">Cerrar Sesión</a>]</div>
   	<div id="contenedor">
	<div id="izquierda">
	<?php 
		//	require_once("menu.php");
	?>
	
	</div>
	<div id="central">
		<br>
		<form class="form" autocomplete="off" name="frm_recibidas" method="post" action="../controlador/control_consul_respuesta_remisiones_recibidas.php">	
		<fieldset> <legend>Incluir Respuesta</legend>	
		<span>
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
							echo ($_SESSION['error_recibidas']);
							?>
							</label></td></tr></table><? 
							unset($_SESSION['error_recibidas']);
							unset($_SESSION['estatus_msj']);
						}
					    else
						{ 
							if($_SESSION['estatus_msj']==2) 
							{ ?>
						  		<table id="tabla_msj" align="center"><tr><td>
						  		<img src="../assets/img/accept.png">
						  								</td>
						<td>
						<label class="label_corr">  							
						   		<?
						   		echo ($_SESSION['error_recibidas']);
						   		?>
						   		</label></td></tr></table><?  
						  		unset($_SESSION['error_recibidas']);
						  		unset($_SESSION['estatus_msj']);
							}
						}
						?>
	 </span><br>
			<table align="center" class="tabla" width="650px">
				<tr class="modo1"  > 
			    			<td width="250px" colspan="2" align="center"><label class="label_class">                                                        
			    			Por favor incluya el N&uacute;mero del Oficio Recibido al cual desea asignar la respuesta</label></td>
			    			
				</tr>

				<tr class="modo1"> 
			    			<td><label class="label_class">                                                        
			    			A&ntilde;o:</label></td>
			    			<td><input name="ano_consulta" align="middle" type="text" maxlength="4" size="60" onKeyPress="return solo_num(event)"></td>
				</tr>
				<tr class="modo1"> <!-- onClick="this.form.num_correlativo.disabled = !this.checked;num_correlativo.value = ''" -->
			    			<td><label class="label_class">                                                        
			    			 N&uacute;mero Correlativo:</label></td>
			    			<td><input name="num_correlativo" type="text" align="middle" maxlength="20" size="60" onKeyPress="return solo_num(event)"></td>
				</tr>				
				
				<tr class="modo1">		
					<input name="tmp_valor" type="hidden">	
					<td colspan="2" align="center">
						<input class="boton" type="submit" name="consultar" value="Consultar" onClick="return valida(this);blockEnter = true;"  >
						<input class="boton" type="submit" name="cancelar_recibidas" value="Cancelar" >
					</td>
		</table>
	</fieldset>
</form>	
	</div><!-- cierra el div central!-->	
	</div><!-- cierra el div contenedor!-->
<div id="pie"></div>
</div> <!-- cierra el div Cuerpo!-->
</center>	
</body>
</html>
