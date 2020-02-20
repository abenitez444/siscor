<?php
session_start();
include('../controlador/script.php');
include('../controlador/script_tu.php');
include '../assets/xajax/xajax_core/xajax.inc.php';
include_once("../modelo/conexpg.php"); //Incluye class 'BaseDeDato'
include_once("../modelo/class_usuarios.php");
    $MiAjax = new xajax();
	$Usuarios = new Usuarios();
	$MiAjax->configure('javascript URI','../assets/xajax');
	$Usuarios->registrarFunciones($MiAjax);	
?>
<html>
<head>
<title>Consulta de Usuarios-Siscor</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="../assets/js/vali_modif_usuarios.js"></script>
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
		<?php require_once("menu_admin.php") ?>
		</div>
		<div id="central">
			<form name="frm_reg_usuario" autocomplete="off" method="post" action="../controlador/control_modif_usuarios.php">		
			<fieldset><legend> Consulta de Usuarios</legend>
			<span id="error" id="tabla_msj"></span>
					<?php if ($_SESSION['estatus_msj']==1)
						{?>
						<table id="tabla_msj" align="center"><tr><td>
						<img src="../assets/img/cancel.png"> 
						</td>
						<td>
						<label class="label_corr"> 						
						<?php echo ($_SESSION['error_usuarios_mod']);?></label></td></tr></table><?php 
						unset($_SESSION['error_usuarios_mod']);
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
						   <?php echo ($_SESSION['error_usuarios_mod']);?></label></td></tr></table><?php  
						  unset($_SESSION['error_usuarios_mod']);
						  unset($_SESSION['estatus_msj']);
						  }
						}?>
			 <br>
				<table align="center" class="tabla">
					 <tr class="modo1">
						<td><span class = "font4"><input type="checkbox" name="habi_user" onclick="nb_usuarios.disabled = !this.checked;nb_usuarios.value = ''" >Nombre del Usuario: </span></td>
						<td><input type="text" name="nb_usuarios" maxlength="20" size="38" onKeyPress="return validarletra(event)" disabled="disabled"></td>
					</tr>
					<tr class="modo1">						
					<td><span class = "font4"><input type="checkbox" name="habi_tipo_user" onclick="tipo_usuario.disabled = !this.checked; tipo_usuario.selectedIndex='0'" >Tipo de Usuario:</span></td>
				   	<td>
				   	<?php 
				   	echo "<select  disabled='disabled' name=\"tipo_usuario\" id=\"tipo_usuario\" ".$_SESSION['disabled'].">";
   					$id= $_SESSION['campoIdTipoUsuarios'];
                	$nombre=$_SESSION['campoNombreTipoUsuarios'];
                	$cantidad=$_SESSION['cantidad'];
                	$valor=$_SESSION['tipo_usuario_seleccionado'];
                	echo("<option value=\"0\">Seleccione</option>");
				   	for ($index = 0; $index < $cantidad; $index++) 
                		{
                			if ($valor==$id[$index])
                			{
                				echo("<option value= \"$id[$index]\"  selected >$nombre[$index]</option>");
                			}
                			else
                			{
                				echo("<option value= \"$id[$index]\">$nombre[$index]</option>");	
                			}
                		}
					echo ("</select>");
					?>	
              		</td>
					</tr>
					
					<tr class="modo1">
					<td><span class = "font4"><input type="checkbox" name="habi_alto_nivel" onclick="alto_nivel.disabled = !this.checked; alto_nivel.selectedIndex='0';primer_nivel.disabled = !this.checked;primer_nivel.selectedIndex='0';direcciones.disabled = !this.checked;direcciones.selectedIndex='0';unidades.disabled = !this.checked;unidades.selectedIndex='0';coordinaciones.disabled = !this.checked;coordinaciones.selectedIndex='0'">Alto Nivel: </span></td> 
				   	<td>
				   	<?php
				   	echo "<select  disabled='disabled' name=\"alto_nivel\" id=\"alto_nivel\" ".$_SESSION['disabled']." onchange=\"xajax_llenarPrimerNivel_mod(document.getElementById('alto_nivel').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\">";
				   	$idAltoNivel= $_SESSION['campoIdAltoNivel'];
                	$nombreAltoNivel=$_SESSION['campoNombreAltoNivel'];
                	$cantidadAltoNivel=$_SESSION['cantidad_alto_nivel'];
                	$valorAltoNivel=$_SESSION['alto_nivel_seleccionado'];
					echo("<option value=\"0\">Seleccione</option>");
				   		for ($indexAltoNivel = 0; $indexAltoNivel < $cantidadAltoNivel; $indexAltoNivel++) 
    					{
	                		if ($valorAltoNivel== "$idAltoNivel[$indexAltoNivel]")
	                		{
	                		    echo("<option value= \"$idAltoNivel[$indexAltoNivel]\"  selected >$nombreAltoNivel[$indexAltoNivel]</option>");
                			}
                			else
                			{
                				echo("<option value= \"$idAltoNivel[$indexAltoNivel]\">$nombreAltoNivel[$indexAltoNivel]</option>");	
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
						if ( $_SESSION['primer_nivel'] == "" ) 
						{
							echo "<select name=\"primer_nivel\" id=\"primer_nivel\" disabled=\"disabled\"><option value=\"0\">-Seleccione un Alto Nivel-</option></select>";
						}
						else
						{
							echo "<select name=\"primer_nivel_consul\" id=\"primer_nivel_consul\" disabled=\"disabled\">
							<option value=\"". $_SESSION['primer_nivel'] ."\">". $_SESSION['nombre_primer_nivel'] ."</option>";
							echo "</select>";
							}
					?>
				</div>	
				</td>
				</tr>
			 <tr class="modo1">	
				<td>
					<label>Direcciones:</label>
				</td>
				<td>
					<div id="div_direcciones">
					<?php 
						if ( $_SESSION['direcciones'] == "" ) 
						{
							echo "<select name=\"direcciones\" id=\"direcciones\" disabled=\"disabled\"><option value=\"0\">-Seleccione un Primer Nivel-</option></select>";
						}
						else
						{
							echo "<select name=\"direcciones_consul\" id=\"direcciones_consul\" disabled=\"disabled\">
							<option value=\"". $_SESSION['direcciones'] ."\">". $_SESSION['nombre_direcciones'] ."</option>";
							echo "</select>";
							}
					?>
				</div>	
				</td>
				</tr>
				<tr class="modo1">	
				<td>
					<label>Unidades:</label>
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
							echo "<select name=\"unidades_consul\" id=\"unidades_consul\" disabled=\"disabled\">
							<option value=\"". $_SESSION['unidades'] ."\">". $_SESSION['nombre_unidades'] ."</option>";
							echo "</select>";
							}
					?>
				</div>	
				</td>
				</tr>
				<tr class="modo1">	
				<td>
					<label>Coordinaciones:</label>
				</td>
				<td>
					<div id="div_coordinaciones">
					<?php 
						if ( $_SESSION[' coordinaciones'] == "" ) 
						{
							echo "<select name=\"coordinaciones\" id=\"coordinaciones\" disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>";
						}
						else
						{
							echo "<select name=\"coordinaciones_consul\" id=\"coordinaciones_consul\" disabled=\"disabled\">
							<option value=\"". $_SESSION['coordinaciones'] ."\">". $_SESSION['nombre_coordinaciones'] ."</option>";
							echo "</select>";
							}
					?>
				</div>	
				</td>
				</tr>

					<tr class="modo1">
					<td><span class = "font4"><input type="checkbox" name="habi_perfiles" onclick="perfiles.disabled = !this.checked"  >Perfil: </span></td> 
					
				   	<td><div id="div_perfiles">
				   	<?php
			   	echo "<select  disabled='disabled' name=\"perfiles\" id=\"perfiles\" ".$_SESSION['disabled'].">";
                	
   					$id= $_SESSION['campoIdPerfil'];
                	$nombre=$_SESSION['campoNombrePerfil'];
                	$cantidad=$_SESSION['cantidadPerfil'];
                	$valor=$_SESSION['tipo_usuario_seleccionado'];
                	echo("<option value=\"0\">Seleccione</option>");
				   	for ($index = 0; $index < $cantidad; $index++) 
                		{
                			
                			if ($valor==$id[$index]){
                				
                		    echo("<option value= \"$id[$index]\"  selected >$nombre[$index]</option>");
                			}else{
                			echo("<option value= \"$id[$index]\">$nombre[$index]</option>");	
                			}
                		}
					echo ("</select>");
							
				   	?>	
							</div>
              	</td>
				</tr>		
					<tr class="modo1">
			     		<td><span class = "font4"><input type="checkbox" name="habi" onclick="habi_habi.disabled = !this.checked; habi_habi.checked=false"  >Habilitado:</span></td>
             			<td><input type="checkbox" name="habi_habi"  disabled="disabled" ></td>
					</tr>
					<tr class="modo1">
						<td colspan="2" align="center"><input class="boton" type="submit" name="consultar" value="Consultar" onclick="return valida(this);blockEnter = true;" ></td>
						
					</tr>
					
						</table>
							<table class="tabla">
					
					<tr >
					 <td colspan="2">
					<div id="div_tabla_usuarios">
					
			   	<?php
			   	if ($_SESSION['activo']==1)
			   	{
   					$id= $_SESSION['campoIdUsuarios'];
                	$nombre=$_SESSION['campoNombreUsuarios'];
                	$login_u=$_SESSION['campoNombreLogin'];
                	$cantidad=$_SESSION['cantidadUsuarios'];
                	$valor=$_SESSION['Usuarios_seleccionado'];
                	$nombreAltoNivel=$_SESSION['campoAltoNivelUsuarios'];
                	$nombrePrimerNivel=$_SESSION['campoPrimerNivelUsuarios'];
                	$nombreDirecciones=$_SESSION['campoDireccionesUsuarios'];	
                	
                	
                	if ($valor==1){
				   	echo"
				   	<tr>
				   	<td align='center'>
				   	<label>Seleccione</label>
				   	</td>
				   	</tr>
				   	
				   	<tr>
				   	<td>
				   	<label>Nombre</label>
				   	</td>
				   	<td>
				   	<label>Usuario</label>
				   	</td>
				   	
				   	<td>
				   	<label>Alto Nivel</label>
				   	</td>
				   	<td>
				   	<label>Primer nivel</label>
				   	</td>
				   	<td>
				   	<label>Direciones</label>
				   	</td>
				   	<td>
				   	<label></label>
				   	</td>
				   	
				   	</tr>
				   	";
                		for ($index = 0; $index < $cantidad; $index++) 
                	{
						echo "<tr class='modo1'><td class='font2' >" . $nombre[$index] . "</td>
						<td class='font2' >" . $login_u[$index] . "</td>
						<td class='font2' >" . $nombreAltoNivel[$index] . "</td>
						<td class='font2' >" . $nombrePrimerNivel[$index] . "</td>
						<td class='font2' >" . $nombreDirecciones[$index] . "</td>
						
						<td class='font2' align='right'><a href='../controlador/control_modif_usuarios.php?id=" . $id[$index] . "
						'><img src='../assets/img/edit.png'  border='0' title='Modificar' ></a>";                                
					}
                	}
                	else
                	{
                		echo"<label>No existen registros en este rango de b&uacute;squeda</label>";
                	}
			   		unset($_SESSION['activo']);
			   	}
				?>	
					</div>
					</td>
					</tr>

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

