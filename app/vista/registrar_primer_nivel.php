<?php
session_start();
include '../assets/xajax/xajax_core/xajax.inc.php';
include('../controlador/script.php');
include('../controlador/script_tu.php');
include_once("../modelo/conexpg.php"); //Incluye class 'BaseDeDato'
include_once("../modelo/class_primer_nivel.php");

    $MiAjax = new xajax();
	$primer_nivel = new primer_nivel();
	$MiAjax->configure('javascript URI','../assets/xajax');
	$primer_nivel->registrarFunciones($MiAjax);	

?>
<html>
<head>
<title>Registro de Primer Nivel - SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="../assets/js/vali_primer_nivel.js"></script> 
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
			<form class="form2" autocomplete="off" name="frm_primer_nivel" method="post" action="../controlador/control_primer_nivel.php">			
	
		<fieldset> <legend>Registro de Primer Nivel</legend>
		
					<span id="error" id="tabla_msj"></span>
					<?php if ($_SESSION['estatus_msj']==1)
						{?>
						<table id="tabla_msj" align="center"><tr><td>
						<img src="../assets/img/cancel.png" >
						</td>
						<td>
						<label class="label_corr"> 						 
						<?php echo ($_SESSION['error_primer_nivel']);?></label></td></tr></table><?php 
						unset($_SESSION['error_primer_nivel']);
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
						   <?php echo ($_SESSION['error_primer_nivel']);?></label></td></tr></table><?php  
						  unset($_SESSION['error_primer_nivel']);
						  unset($_SESSION['estatus_msj']);
						  }
						}?>
			 <br>
			<table align="center" class="tabla">
				
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Alto Nivel: </label></td> 
					
				   	<td>
				   	<?php	//print_r($_SESSION['campoIdAltoNivel']);die;

				   	echo "<select ".$_SESSION['disabled']." name=\"alto_nivel\" id=\"alto_nivel\" onchange=\"xajax_llenarPrimerNivel(document.getElementById('alto_nivel').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");
				   	                                        xajax_llenarPrimerNivelTabla(document.getElementById('alto_nivel').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\">";
                	
                            $id= $_SESSION['campoIdAltoNivel'];
	                		$nombre=$_SESSION['campoNombreAltoNivel'];
	                		$cantidad=$_SESSION['cantidad'];
	                		$valor=$_SESSION['alto_nivel_seleccionado'];
	                		echo("<option value=\"0\">Seleccione</option>");
	   						for ($index = 0; $index < $cantidad; $index++) 
	                		{
	                			
	                			if ($valor== "$id[$index]")
	                			{
	                				echo("<option value= \"$id[$index]\"  selected >$nombre[$index]</option>");
	                			}else
	                			{
	                				echo("<option value= \"$id[$index]\">$nombre[$index]</option>");	
	                			}
	                		}
					echo ("</select>");
					?>	
              </td>
				</tr>
								 <tr class="modo1">	
				<td>
					<label>Primer Nivel:</label>
				</td>
				<td>
					<div id="div_primer_nivel">
					<?php 
						if ( $_SESSION['primer_nivel_seleccionado'] == "" ) 
						{
							
							echo "<select name=\"primer_nivel\" id=\"primer_nivel\" disabled=\"disabled\"><option value=\"0\">-Seleccione un Alto Nivel-</option></select>";
						}
						else
						{
							
						echo "<select  name=\"primer_nivel\" id=\"primer_nivel\" disabled=\"disabled\" >";
                		$idPrimerNivel= $_SESSION['campoIdPrimerNivel'];
                		$nombrePrimerNivel=$_SESSION['campoNombrePrimerNivel'];
                		$cantidadPrimerNivel=1;
                		$valorPrimerNivel=$_SESSION['pn'];
                		echo("<option value=\"0\">Seleccione</option>");
				   		for ($indexPrimerNivel = 0; $indexPrimerNivel < $cantidadPrimerNivel; $indexPrimerNivel++) 
				   		{
						if ($valorPrimerNivel== "$idPrimerNivel[$indexPrimerNivel]")
						{
	          			    echo("<option value= \"$idPrimerNivel[$indexPrimerNivel]\"  selected >$nombrePrimerNivel[$indexPrimerNivel]</option>");
                		}
                		else
                		{
                			echo("<option value= \"$idPrimerNivel[$indexPrimerNivel]\">$nombrePrimerNivel[$indexPrimerNivel]</option>");	
                		}
                		
                		
                	}
					echo ("</select>");
						}
					?>
				</div>	
				</td>
				</tr>
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Nombre:</label></td> 
				   	<td><input name="nb_primer_nivel" type="text" maxlength="100" size="60" value ="<?php echo ($_SESSION['nombre_primer_nivel']);?>" ></td>
				</tr>
				<tr class="modo1">
					<td><label>Ubicaci&oacute;n:</label></td> 
				   	<td><input name="ubicacion_primer_nivel" type="text" maxlength="100" size="60" value ="<?php echo ($_SESSION['ubicacion_primer_nivel']);?>" ></td>
				</tr>
				<tr class="modo1">
					<td><label>Edificio:</label></td> 
				   	<td><input name="edificio_primer_nivel" type="text" maxlength="50" size="60" value ="<?php echo ($_SESSION['edificio_primer_nivel']);?>" ></td>
				</tr>
				<tr class="modo1">
					<td><label>Piso:</label></td> 
				   	<td><input name="piso_primer_nivel" type="text" maxlength="2" size="60" value ="<?php echo ($_SESSION['piso_primer_nivel']);?>" onKeyPress="return solo_num(event)" ></td>
				</tr>				
				<tr class="modo1">
					<td><label>Tel&eacute;fono:</label></td> 
				   	<td><input name="telefono_primer_nivel" type="text" maxlength="50" size="60" value ="<?php echo ($_SESSION['telefono_primer_nivel']);?>" ></td>
				</tr>
				<tr class="modo1">
					<td><label>Observaci&oacute;n:</label></td> 
				   	<td><textarea name="observacion_primer_nivel" cols="60" rows="3"><?php echo ($_SESSION['observacion_primer_nivel']);?></textarea></td>
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
		<input name="id_primer_nivel" type="hidden" maxlength="10" size="60" value ="<?php echo ($_SESSION['id_primer_nivel']);?>" >
		<input name="id_alto_nivel" type="hidden" maxlength="10" size="60" value ="<?php echo ($_SESSION['alto_nivel_seleccionado']);?>" >
		
						<div id="div_primer_nivel_tabla">
								
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