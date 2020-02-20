<?php
session_start();
include '../assets/xajax/xajax_core/xajax.inc.php';
include('../controlador/script.php');
include('../controlador/script_tu.php');
include_once("../modelo/conexpg.php"); //Incluye class 'BaseDeDato'
include_once("../modelo/class_coordinaciones.php");

    $MiAjax = new xajax();
	$coordinaciones = new coordinaciones();
	$MiAjax->configure('javascript URI','../assets/xajax');
	$coordinaciones->registrarFunciones($MiAjax);	

?>
<html>
<head>
<title>Registro de coordinaciones - SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="../assets/js/vali_coordinaciones.js"></script> 
<?php 
	$MiAjax->printJavascript();
?>
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
			if ($_SESSION['modi']!=1){
			require_once("menu_admin.php"); 
			}
			?>
			</div>
	
		<div id="central">
		
		<br>
			<form class="form2" autocomplete="off" name="frm_alto_nivel" method="post" action="../controlador/control_coordinaciones.php">			
	
		<fieldset> <legend>Registro de Coordinaciones</legend>
		
					<span id="error" id="tabla_msj"></span>
					<?php if ($_SESSION['estatus_msj']==1)
						{?>
						<table id="tabla_msj" align="center"><tr><td>
						<img src="../assets/img/cancel.png"> 
						</td>
						<td>
						<label class="label_corr"> 						
						<?php echo ($_SESSION['error_coordinaciones']);?></label></td></tr></table><?php 
						unset($_SESSION['error_coordinaciones']);
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
						   <?php echo ($_SESSION['error_coordinaciones']);?></label></td></tr></table><?php  
						  unset($_SESSION['error_coordinaciones']);
						  unset($_SESSION['estatus_msj']);
						  }
						}?>
			 <br>
			<table align="center" class="tabla">
				
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Alto Nivel: </label></td> 
					
				   	<td>
				   	<?php
				   	echo "<select  name=\"alto_nivel\" id=\"alto_nivel\" ".$_SESSION['disabled']." onchange=\"xajax_llenarPrimerNivel(document.getElementById('alto_nivel').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\">";
                	
				   	$id= $_SESSION['campoIdAltoNivel'];
                							$nombre=$_SESSION['campoNombreAltoNivel'];
                							$cantidad=$_SESSION['cantidad'];
                							$valor=$_SESSION['alto_nivel_seleccionado'];
                			
                							
                							echo("<option value=\"0\">Seleccione</option>");
				   		for ($index = 0; $index < $cantidad; $index++) 
                							{
                								
                								if ($valor== "$id[$index]"){
                									
                							    echo("<option value= \"$id[$index]\"  selected >$nombre[$index]</option>");
                								}else{
                								echo("<option value= \"$id[$index]\">$nombre[$index]</option>");	
                								}
                							}
									echo ("</select>");
							?>	
              </td>
				</tr>
				 <tr class="modo1">	
				<td>
					<label><span class = "font3">* </span>Primer Nivel:</label>
				</td>
				<td>
					<div id="div_primer_nivel">
					<?php 
						if ( $_SESSION['primer_nivel'] == "" ) 
						{
							echo "<select name=\"primer_nivel\" id=\"primer_nivel\" disabled=\"disabled\"><option value=\"0\">-Seleccione un Alto Nivel-</option></select>";
						}
						else
						{
							echo "<select name=\"primer_nivel\" id=\"primer_nivel\" disabled=\"disabled\">
							<option value=0>Seleccione</option>
							<option value=\"". $_SESSION['primer_nivel'] ."\" selected>". $_SESSION['nombre_primer_nivel'] ."</option>";
							echo "</select>";
							}
					?>
				</div>	
				</td>
				</tr>
			 <tr class="modo1">	
				<td>
					<label><span class = "font3">* </span>Direcciones:</label>
				</td>
				<td>
					<div id="div_direcciones">
					<?php 
						if ( $_SESSION['direcciones'] == "" ) 
						{
							echo "<select name=\"direcciones_consul\" id=\"direcciones_consul\" disabled=\"disabled\"><option value=\"0\">-Seleccione un Primer Nivel-</option></select>";
						}
						else
						{
							echo "<select name=\"direcciones_consul\" id=\"direcciones_consul\" disabled=\"disabled\">
							<option value=0>Seleccione</option>
							<option value=\"". $_SESSION['direcciones'] ."\" selected>". $_SESSION['nombre_direcciones'] ."</option>";
							echo "</select>";
							}
					?>
				</div>	
				</td>
				</tr>
				<tr class="modo1">	
				<td>
					<label><span class = "font3">* </span>Unidades:</label>
				</td>
				<td>
					<div id="div_unidades">
					<?php 
						if ( $_SESSION['unidades'] == "" ) 
						{
							echo "<select name=\"unidades\" id=\"unidades\" disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>";
						}
						else
						{
							echo "<select name=\"unidades\" id=\"unidades\" disabled=\"disabled\">
							<option value=0>Seleccione</option>
							<option value=\"". $_SESSION['unidades'] ."\" selected>". $_SESSION['nombre_unidades'] ."</option>";
							echo "</select>";
							}
					?>
				</div>	
				</td>
				</tr>
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Nombre:</label></td> 
				   	<td><input name="nb_coordinaciones" type="text" maxlength="50" size="60" value ="<?php echo ($_SESSION['nombre_coordinaciones']);?>" ></td>
				</tr>
				<tr class="modo1">
					<td><label>Ubicaci&oacute;n:</label></td> 
				   	<td><input name="ubicacion_coordinaciones" type="text" maxlength="100" size="60" value ="<?php echo ($_SESSION['ubicacion_coordinaciones']);?>" ></td>
				</tr>
				<tr class="modo1">
					<td><label>Edificio:</label></td> 
				   	<td><input name="edificio_coordinaciones" type="text" maxlength="50" size="60" value ="<?php echo ($_SESSION['edificio_coordinaciones']);?>" ></td>
				</tr>
				<tr class="modo1">
					<td><label>Piso:</label></td> 
				   	<td><input name="piso_coordinaciones" type="text" maxlength="2" size="60" value ="<?php echo ($_SESSION['piso_coordinaciones']);?>" onKeyPress="return solo_num(event)" ></td>
				</tr>				
				<tr class="modo1">
					<td><label>Tel&eacute;fono:</label></td> 
				   	<td><input name="telefono_coordinaciones" type="text" maxlength="50" size="60" value ="<?php echo ($_SESSION['telefono_coordinaciones']);?>" ></td>
				</tr>
				<tr class="modo1">
					<td><label>Observaci&oacute;n:</label></td> 
				   	<td><textarea name="observacion_coordinaciones" cols="60" rows="3"><?php echo ($_SESSION['observacion_coordinaciones']);?></textarea></td>
				</tr>
				<tr class="modo1">
					<td  align="center" colspan="2"><label><span class = "font3">(*)</span> Campos Requeridos.</label></td>
				</tr>
				<tr class="modo1">	
				
				<?php 
				if ($_SESSION['boton']==""){
					$_SESSION['boton']="Guardar";
				}
				?>	
				 	<td colspan="2" align="center">
				 	<input class="boton" type="submit" name="enviar" value="<?php echo ($_SESSION['boton']) ?>" onClick="return valida(this);blockEnter = true;"  >
				 	<?php if ($_SESSION['modi']==1){?>
				 	<input class="boton" type="submit" name="regresar" value="Regresar" onClick="return valida(this);blockEnter = true;"  >
				 	<?php }?>
				 	</td>
				</tr>
		</table>
		<input name="id_unidades" type="hidden" maxlength="10" size="60" value ="<?php echo ($_SESSION['unidades']);?>" >

							
		<div id="div_coordinaciones">
	
		</div>	
		</fieldset>
</form>	
	</div><!-- cierra el div central!-->	
	</div><!-- cierra el div contenedor!-->
<div id="pie"></div>
</div> <!-- cierra el div Cuerpo!-->
</center>	
</body>
</html>