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
<title>Registro de Usuario-Siscor</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<?php 
if ($_SESSION['id_usuario']==""){
?>
<script type="text/javascript" src="../assets/js/vali_usuarios.js"></script>
<?php 
}
else
{
?>	
<script type="text/javascript" src="../assets/js/vali_usuarios_mod.js"></script>
<?php 	
}

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
		if ($_SESSION['id_usuario']==""){
		require_once("menu_admin.php"); 
		}
		?>
		</div>
		<div id="central">
			<form name="frm_reg_usuario" autocomplete="off" method="post" action="../controlador/control_usuarios.php">		
			<fieldset><legend> Registro de Cuenta</legend>
			<span id="error" id="tabla_msj"></span>
					<?php if ($_SESSION['estatus_msj']==1)
						{?>
						<table id="tabla_msj" align="center"><tr><td>
						<img src="../assets/img/cancel.png" >
						 						</td>
						<td>
						<label class="label_corr"> 
						<?php echo ($_SESSION['error_usuarios']);?></label></td></tr></table><?php 
						unset($_SESSION['error_usuarios']);
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
						   <?php echo ($_SESSION['error_usuarios']);?></label></td></tr></table><?php  
						  unset($_SESSION['error_usuarios']);
						  unset($_SESSION['estatus_msj']);
						  }
						}?>
			 <br>
				<table align="center" class="tabla" id="acciones">
					 <tr class="modo1">
						<td><label><span class="font3">* </span>Nombre del Usuario:</label></td>
						<td><input type="text" name="nb_usuarios" maxlength="20" size="38" onKeyPress="return validarletra(event)" value ="<?php echo ($_SESSION['nombre_usuario']);?>"></td>
					</tr>
					<tr class="modo1">
						<td><label><span class="font3">* </span>Login:</label></td>
						<td><input type="text" name="login" maxlength="20" size="38" value ="<?php echo ($_SESSION['nombre_login']);?>"></td>
					</tr>
					<tr class="modo1">
						<td><label><span class="font3">* </span>Contrase&ntilde;a:</label></td>
						<td><input type="password" name="clave"  maxlength="8" size="21" >
						<br><span class="label_inf">Utiliza entre 6 y 8 caracteres.</span></td>
					</tr>
					<tr class="modo1">						
						<td><label><span class="font3">* </span>Repita Contrase&ntilde;a:</label></td>
						<td><input type="password" name="reclave"  maxlength="8" size="21"><br>
                        <span class="label_inf">Utiliza entre 6 y 8 caracteres.</span></td>
					</tr>
				    <tr class="modo1">
						<td><label>Tel&eacute;fonos:</label></td>
				        <td><input type="text" name="telefono_oficina" maxlength="50" size="38" value ="<?php echo ($_SESSION['telefono']);?>"></td>
					</tr>
					<tr class="modo1">
						<td><label>Correo Electr&oacute;nico:</label></td>
						<td><input type="text" name="email" maxlength="30" size="38" value ="<?php echo ($_SESSION['email']);?>"></td>
					</tr>
					
					<tr class="modo1">						
					<td><label><span class="font3">* </span>Tipo de Usuario:</label></td>
				   	<td>
				   	<?php 
				   	//echo "<select  name=\"tipo_usuario\" id=\"tipo_usuario\" ".$_SESSION['disabled']." onchange=\"xajax_deshabilitar(document.getElementById('tipo_usuario').value);return false;\">";
				   	echo "<select  name=\"tipo_usuario\" id=\"tipo_usuario\" ".$_SESSION['disabled']." >";
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
					<td>
					<label><span class = "font3">* </span>Perfil: </label></td> 
				   	<td><div id="div_perfiles">
				   	<?php
					/*if ($_SESSION['tipo_usuario_seleccionado'] !=1)
					{*/
					   	echo "<select  name=\"perfil\" id=\"perfil\" onchange=\"xajax_opcionPerfiles(document.getElementById('perfil').value,document.getElementById('tipo_usuario').value);return false;\">";
                		$idperfiles= $_SESSION['campoIdPerfil'];
                		$nombreperfiles=$_SESSION['campoNombrePerfil'];
                		$cantidadperfiles=$_SESSION['cantidadPerfil'];
                		$valorperfiles=$_SESSION['perfiles_seleccionado'];
                		echo("<option value=\"0\">Seleccione</option>");
				   		for ($indexperfiles = 0; $indexperfiles < $cantidadperfiles; $indexperfiles++) 
				   		{
							if ($valorperfiles== "$idperfiles[$indexperfiles]")
							{
	    	      			    echo("<option value= \"$idperfiles[$indexperfiles]\"  selected >$nombreperfiles[$indexperfiles]</option>");
            	    		}
                			else
                			{
                				echo("<option value= \"$idperfiles[$indexperfiles]\">$nombreperfiles[$indexperfiles]</option>");	
                			}
                		}
					echo ("</select>");
					//}
					/*else
					{
						echo "<select name=\"perfil\" ><option value=\"0\">-Seleccione-</option></select>";	
					}*/
					?>	
					</div></td>
				    </tr>	
					<tr class="modo1">
					<td><label><span class = "font3">* </span>Alto Nivel: </label></td> 
					
				   	<td>
				   	<div id="div_altonivel">
				   	<?php
				   	echo "<select  name=\"alto_nivel\" id=\"alto_nivel\" ".$_SESSION['disabled']."  onchange=\"xajax_llenarPrimerNivel(document.getElementById('alto_nivel').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\">";
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
					</div>
              	</td>
				</tr>				
					
	
					

				 <tr class="modo1">	
				<td>
					<label><span class = "font3">* </span>Primer Nivel:</label>
				</td>
				<td>
					<div id="div_primer_nivel">
				   	<?php
				   	if($_SESSION['primer_nivel_seleccionado']!=""){
				   		echo "<select  name=\"primer_nivel\" id=\"primer_nivel\" ".$_SESSION['disabled']." onchange=\"xajax_llenarDireccion(document.getElementById('primer_nivel').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].",document.getElementById('perfil').value);return false;\" >";
   						$idprimer_nivel= $_SESSION['campoIdprimer_nivel'];
                		$nombreprimer_nivel=$_SESSION['campoNombreprimer_nivel'];
                		$cantidadprimer_nivel=$_SESSION['cantidad_primer_nivel'];
                		$valorprimer_nivel=$_SESSION['primer_nivel_seleccionado'];
                   		echo("<option value=\"0\">Seleccione</option>");
						   	for ($indexprimer_nivel = 0; $indexprimer_nivel < $cantidadprimer_nivel; $indexprimer_nivel++) 
                			{
                				if ($valorprimer_nivel== "$idprimer_nivel[$indexprimer_nivel]")
                				{
                					echo("<option value= \"$idprimer_nivel[$indexprimer_nivel]\"  selected >$nombreprimer_nivel[$indexprimer_nivel]</option>");
                				}
                				else
                				{
                					echo("<option value= \"$idprimer_nivel[$indexprimer_nivel]\">$nombreprimer_nivel[$indexprimer_nivel]</option>");	
                				}
                			}
						echo ("</select>");
				   	}
				   	else
				   	{
				   	echo "<select name=\"primer_nivel\" id=\"primer_nivel\" disabled=\"disabled\"><option value=\"0\">-Seleccione un Alto Nivel-</option></select>";	
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
						  	if($_SESSION['direcciones_seleccionado']!="")
						  	{
								echo "<select  name=\"direcciones\" id=\"direcciones\" ".$_SESSION['disabled']." onchange=\"xajax_llenarunidades(document.getElementById('direcciones').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].",document.getElementById('perfil').value);return false;\"  >";
	   							$iddirecciones= $_SESSION['campoIddirecciones'];
	                			$nombredirecciones=$_SESSION['campoNombredirecciones'];
	                			$cantidaddirecciones=$_SESSION['cantidaddirecciones'];
	                			$valordirecciones=$_SESSION['direcciones_seleccionado'];
                				echo("<option value=\"0\">Seleccione</option>");
							   		for ($indexdirecciones = 0; $indexdirecciones < $cantidaddirecciones; $indexdirecciones++) 
            						{
	       								if ($valordirecciones== "$iddirecciones[$indexdirecciones]")
	       								{
               								echo("<option value= \"$iddirecciones[$indexdirecciones]\"  selected >$nombredirecciones[$indexdirecciones]</option>");
                						}
                						else
                						{
                							echo("<option value= \"$iddirecciones[$indexdirecciones]\">$nombredirecciones[$indexdirecciones]</option>");	
                						}
                					}
								echo ("</select>");
							}
					    	else
						   	{
						   	echo "<select name=\"direcciones\" id=\"direcciones\" disabled=\"disabled\"><option value=\"0\">-Seleccione un Primer Nivel-</option></select>";	
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
						if($_SESSION['unidades_seleccionado']!="")
						{
   							echo "<select  name=\"unidades\" id=\"unidades\" ".$_SESSION['disabled']."  >";
							$idunidades= $_SESSION['campoIdunidades'];
                			$nombreunidades=$_SESSION['campoNombreunidades'];
                			$cantidadunidades=$_SESSION['cantidadunidades'];
                			$valorunidades=$_SESSION['unidades_seleccionado'];
   							echo("<option value=\"0\">Seleccione</option>");
						   		for ($indexunidades = 0; $indexunidades < $cantidadunidades; $indexunidades++) 
        						{
	  								if ($valorunidades== "$idunidades[$indexunidades]")
	  								{
       							    	echo("<option value= \"$idunidades[$indexunidades]\"  selected >$nombreunidades[$indexunidades]</option>");
                					}
                					else
                					{
                						echo("<option value= \"$idunidades[$indexunidades]\">$nombreunidades[$indexunidades]</option>");	
                					}
       							}
							echo ("</select>");
					   	}
				    	else
					   {
					   echo "<select name=\"unidades\" id=\"unidades\" disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>";	
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
						if($_SESSION['coordinaciones_seleccionado']!="")
						{
						   	echo "<select  name=\"coordinaciones\" id=\"coordinaciones\" ".$_SESSION['disabled']."  >";
	   						$idcoordinaciones= $_SESSION['campoIdcoordinaciones'];
	                		$nombrecoordinaciones=$_SESSION['campoNombrecoordinaciones'];
	                		$cantidadcoordinaciones=$_SESSION['cantidadcoordinaciones'];
	                		$valorcoordinaciones=$_SESSION['coordinaciones_seleccionado'];
   							echo("<option value=\"0\">Seleccione</option>");
						   		for ($indexcoordinaciones = 0; $indexcoordinaciones < $cantidadcoordinaciones; $indexcoordinaciones++) 
            					{
	   								if ($valorcoordinaciones== "$idcoordinaciones[$indexcoordinaciones]")
	   								{
       							    	echo("<option value= \"$idcoordinaciones[$indexcoordinaciones]\"  selected >$nombrecoordinaciones[$indexcoordinaciones]</option>");
                					}
                					else
                					{
                						echo("<option value= \"$idcoordinaciones[$indexcoordinaciones]\">$nombrecoordinaciones[$indexcoordinaciones]</option>");	
                					}
                				}
							echo ("</select>");
					   	}
				    	else
					   {
					   echo "<select name=\"coordinaciones\" id=\"coordinaciones\" disabled=\"disabled\"><option value=\"0\">-Seleccione una Unidad-</option></select>";	
					   }
				   ?>
				</div>	
				</td>
				</tr>
				
				<?php 
					if ($_SESSION['campoingresar']!="")
					{
						$_SESSION['disabled_check']="";
						$ingresar_chek=$_SESSION['campoingresar'];
				    	$consultar_chek=$_SESSION['campoconsultar'];
				    	$modificar_chek=$_SESSION['campomodificar'];

			   			for ($indexmodulos = 0; $indexmodulos <= 8; $indexmodulos++) 
            			{							
							switch($indexmodulos)
							{
								case 0:
									$_SESSION['chkingresarMantenimiento']=$ingresar_chek[$indexmodulos];
									$_SESSION['chkconsultarMantenimiento']=$consultar_chek[$indexmodulos];
									$_SESSION['chkmodificarMantenimiento']=$modificar_chek[$indexmodulos];								
										
								break;
								case 1:
									$_SESSION['chkingresarRecibida']=$ingresar_chek[$indexmodulos];
									$_SESSION['chkconsultarRecibida']=$consultar_chek[$indexmodulos];
									$_SESSION['chkmodificarRecibida']=$modificar_chek[$indexmodulos];								
										
								break;
								case 2:
									$_SESSION['chkingresarRespuestaRecibida']=$ingresar_chek[$indexmodulos];
									$_SESSION['chkconsultarRespuestaRecibida']=$consultar_chek[$indexmodulos];
									$_SESSION['chkmodificarRespuestaRecibida']=$modificar_chek[$indexmodulos];								
										
								break;								
								case 3:
									$_SESSION['chkingresarOficios']=$ingresar_chek[$indexmodulos];
									$_SESSION['chkconsultarOficios']=$consultar_chek[$indexmodulos];
									$_SESSION['chkmodificarOficios']=$modificar_chek[$indexmodulos];
								break;
								case 4:
									$_SESSION['chkingresarRespuestaOficios']=$ingresar_chek[$indexmodulos];
									$_SESSION['chkconsultarRespuestaOficios']=$consultar_chek[$indexmodulos];
									$_SESSION['chkmodificarRespuestaOficios']=$modificar_chek[$indexmodulos];
								break;								
								case 5:
									$_SESSION['chkingresarRemisiones']=$ingresar_chek[$indexmodulos];
									$_SESSION['chkconsultarRemisiones']=$consultar_chek[$indexmodulos];
									$_SESSION['chkmodificarRemisiones']=$modificar_chek[$indexmodulos];
								break;
								case 6:
									$_SESSION['chkingresarRespuestaRemisiones']=$ingresar_chek[$indexmodulos];
									$_SESSION['chkconsultarRespuestaRemisiones']=$consultar_chek[$indexmodulos];
									$_SESSION['chkmodificarRespuestaRemisiones']=$modificar_chek[$indexmodulos];
								break;								
								case 7:
									$_SESSION['chkingresarArchivo']=$ingresar_chek[$indexmodulos];
									$_SESSION['chkconsultarArchivo']=$consultar_chek[$indexmodulos];
									$_SESSION['chkmodificarArchivo']=$modificar_chek[$indexmodulos];
								break;
								case 8:
									$_SESSION['chkconsultarReportes']=$consultar_chek[$indexmodulos];			
								break;
							}
				
						}
					}
					else
					{
						$_SESSION['disabled_check']="disabled";	
					}

				?>

					<tr  class="modo1" >
						
			     		<td><label>Mantenimiento:</label></td>
             			
             			<td width="268">
             			
             			<label><input id="ingresarMantenimiento" type="checkbox"  name="ingresarMantenimiento" <?php if($_SESSION['chkingresarMantenimiento']==t){ echo "checked"; } $_SESSION['disabled_check']; ?> >  Ingresar</label>
             			<label><input id="modificarMantenimiento" type="checkbox" name="modificarMantenimiento" <?php if($_SESSION['chkmodificarMantenimiento']==t){ echo "checked";} $_SESSION['disabled_check']; ?> >  Modificar</label>
						<label><input id="consultarMantenimiento" type="checkbox" name="consultarMantenimiento" <?php if($_SESSION['chkconsultarMantenimiento']==t){ echo "checked";} $_SESSION['disabled_check']; ?> >  Eliminar</label>             			
             			</td>
             		
					</tr>				
					<tr  class="modo1" >
						
			     		<td><label>Recibida:</label></td>
             			
             			<td width="268">
             			
             			<label><input id="ingresarRecibida" type="checkbox"  name="ingresarRecibida" <?php if($_SESSION['chkingresarRecibida']==t){ echo "checked"; } $_SESSION['disabled_check']; ?> >  Ingresar</label>
             			<label><input id="consultarRecibida" type="checkbox" name="consultarRecibida" <?php if($_SESSION['chkconsultarRecibida']==t){ echo "checked";} $_SESSION['disabled_check']; ?> >  Consultar</label>
             			<label><input id="modificarRecibida" type="checkbox" name="modificarRecibida" <?php if($_SESSION['chkmodificarRecibida']==t){ echo "checked";} $_SESSION['disabled_check']; ?> >  Modificar</label>
             			
             			</td>
             		
					</tr>
					<tr  class="modo1" >
						
			     		<td><label>Respuesta Recibida:</label></td>
             			
             			<td width="268">
             			
             			<label><input id="ingresarRespuestaRecibida" type="checkbox"  name="ingresarRespuestaRecibida" <?php if($_SESSION['chkingresarRespuestaRecibida']==t){ echo "checked"; } $_SESSION['disabled_check']; ?> >  Ingresar</label>
             			<label><input id="consultarRespuestaRecibida" type="checkbox" name="consultarRespuestaRecibida" <?php if($_SESSION['chkconsultarRespuestaRecibida']==t){ echo "checked";} $_SESSION['disabled_check']; ?> >  Consultar</label>
             			<label><input id="modificarRespuestaRecibida" type="checkbox" name="modificarRespuestaRecibida" <?php if($_SESSION['chkmodificarRespuestaRecibida']==t){ echo "checked";} $_SESSION['disabled_check']; ?> >  Modificar</label>
             			
             			</td>
             		
					</tr>
					<tr  class="modo1">
					
			     		<td><label>Oficios:</label></td>
             			<td>
             			
             			<label><input id="ingresarOficios" type="checkbox" name="ingresarOficios" <?php if($_SESSION['chkingresarOficios']==t){ echo "checked"; } $_SESSION['disabled_check']; ?> >  Ingresar</label>
             			<label><input id="consultarOficios" type="checkbox" name="consultarOficios" <?php if($_SESSION['chkconsultarOficios']==t){ echo "checked"; } $_SESSION['disabled_check']; ?> >  Consultar</label>
             			<label><input id="modificarOficios" type="checkbox" name="modificarOficios" <?php if($_SESSION['chkmodificarOficios']==t){ echo "checked"; } $_SESSION['disabled_check']; ?> >  Modificar</label>
             			
             			</td>
					</tr>
					<tr  class="modo1" >
						
			     		<td><label>Respuesta Oficios:</label></td>
             			
             			<td width="268">
             			
             			<label><input id="ingresarRespuestaOficios" type="checkbox"  name="ingresarRespuestaOficios" <?php if($_SESSION['chkingresarRespuestaOficios']==t){ echo "checked"; } $_SESSION['disabled_check']; ?> >  Ingresar</label>
             			<label><input id="consultarRespuestaOficios" type="checkbox" name="consultarRespuestaOficios" <?php if($_SESSION['chkconsultarRespuestaOficios']==t){ echo "checked";} $_SESSION['disabled_check']; ?> >  Consultar</label>
             			<label><input id="modificarRespuestaOficios" type="checkbox" name="modificarRespuestaOficios" <?php if($_SESSION['chkmodificarRespuestaOficios']==t){ echo "checked";} $_SESSION['disabled_check']; ?> >  Modificar</label>
             			
             			</td>
             		
					</tr>
					<tr  class="modo1">
			     		<td><label>Remisiones:</label></td>
             			<td>
             			
             			<label><input id="ingresarRemisiones" type="checkbox" name="ingresarRemisiones" <?php if($_SESSION['chkingresarRemisiones']==t){ echo "checked"; } $_SESSION['disabled_check']; ?> >  Ingresar</label>
             			<label><input id="consultarRemisiones" type="checkbox" name="consultarRemisiones" <?php if($_SESSION['chkconsultarRemisiones']==t){ echo "checked"; } $_SESSION['disabled_check']; ?> >  Consultar</label>
             			<label><input id="modificarRemisiones" type="checkbox" name="modificarRemisiones" <?php if($_SESSION['chkmodificarRemisiones']==t){ echo "checked"; } $_SESSION['disabled_check']; ?> >  Modificar</label>
             			
             			</td>
					</tr>
					<tr  class="modo1" >
						
			     		<td><label>Respuesta Remisiones:</label></td>
             			
             			<td width="268">
             			
             			<label><input id="ingresarRespuestaRemisiones" type="checkbox"  name="ingresarRespuestaRemisiones" <?php if($_SESSION['chkingresarRespuestaRemisiones']==t){ echo "checked"; } $_SESSION['disabled_check']; ?> >  Ingresar</label>
             			<label><input id="consultarRespuestaRemisiones" type="checkbox" name="consultarRespuestaRemisiones" <?php if($_SESSION['chkconsultarRespuestaRemisiones']==t){ echo "checked";} $_SESSION['disabled_check']; ?> >  Consultar</label>
             			<label><input id="modificarRespuestaRemisiones" type="checkbox" name="modificarRespuestaRemisiones" <?php if($_SESSION['chkmodificarRespuestaRemisiones']==t){ echo "checked";} $_SESSION['disabled_check']; ?> >  Modificar</label>
             			
             			</td>
             		
					</tr>
					<tr  class="modo1">
			     		<td><label>Archivo:</label></td>
             			<td>
             			
             			<label><input id="ingresarArchivo" type="checkbox" name="ingresarArchivo" <?php if($_SESSION['chkingresarArchivo']==t){ echo "checked"; } $_SESSION['disabled_check']; ?> >  Ingresar</label>
             			<!-- <label><input id="consultarArchivo" type="checkbox" name="consultarArchivo" <?php if($_SESSION['chkconsultarArchivo']==t){ echo "checked"; } $_SESSION['disabled_check']; ?> >  Consultar</label> -->
             			<label><input id="modificarArchivo" type="checkbox" name="modificarArchivo" <?php if($_SESSION['chkmodificarArchivo']==t){ echo "checked"; } $_SESSION['disabled_check']; ?> >  Modificar</label>
             			
             			</td>
					</tr>
					<tr  class="modo1">
			     		<td><label>Reportes:</label></td>
             			<td>
             			
             			<label><input id="consultarReportes" type="checkbox" name="consultarReportes" <?php if($_SESSION['chkconsultarReportes']==t){ echo "checked"; } $_SESSION['disabled_check']; ?> >  Consultar</label>
             			
             			
             			</td>
					</tr>
					
						
				<!--		</table>
						
						<table align="center" class="tabla"  width="409"> -->			
					<tr class="modo1">
			     		<td><label>Habilitado:</label></td>
             			<td width="268">
             			<label><input type="checkbox" name="habilitado" <?php if($_SESSION['habilitado']==t){ echo "checked"; } ?> >  Activar</label>
             			</td>
					</tr>
					<tr class="modo1">
						<td></td>						
						<td> <img src="captcha.php" width="100" height="30" vspace="3"><br></td>
					</tr>
					<tr class="modo1">
		    			<td ><label><span class="font3">* </span>Introduzca los caracteres <br> de la imagen:</label></td>
						<td ><label><?php echo ($_SESSION['error_login']); ?></label><br>
                        <input name="tmptxt" type="text"/></td>
					</tr>
					<tr class="modo1">
					<?php 
					if ($_SESSION['id_usuario']==""){
						?>
<td colspan="2" align="center"><input class="boton" type="submit" name="guardar" value="Guardar" onclick="return valida(this);blockEnter = true;" ></td>						
						<?php 
					}
					else
					{
						?>
<td colspan="2" align="center">
<input class="boton" type="submit" name="modificar" value="Modificar" onclick="return valida(this);blockEnter = true;" >
<input class="boton" type="submit" name="regresar" value="Regresar">
</td>						

						<?php 
					}
					
					?>
						
					</tr>
					<tr class="modo1">
					 <td  align="center" colspan="2"><label><span class = "font3">(*)</span> Campos Requeridos.</label>
					 <input name="id_user" type="hidden"  value ="<?php echo ($_SESSION['id_usuario']);?>">
					 </td>
					</tr>
			
				
		</table>
	<br>
	</fieldset>						
</form>
	</div><!-- cierra el div central!-->		
	</div><!-- cierra el div contenedor!-->
<div id="pie"></div>
</div> <!-- cierra el div Cuerpo!-->	
</center>
</body>
</html>