<?php
session_start();
include('../controlador/script.php');
include '../assets/xajax/xajax_core/xajax.inc.php';
include('../controlador/script.php');
include_once("../modelo/conexpg.php"); //Incluye class 'BaseDeDato'
include_once("../modelo/class_recibidas.php");
$MiAjax = new xajax();
$Recibidas = new Recibidas();
$MiAjax->configure('javascript URI','../assets/xajax');
$Recibidas->registrarFunciones($MiAjax);	
?>
<html>
<head>
<?php 
include("input.php");	
$MiAjax->printJavascript();	
?>
<title>Registro del Oficio Recibido - SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../assets/calendario/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../assets/js/dateInput.js" type="text/javascript"></script>
<script src="../assets/js/jvstools.js" type="text/javascript"></script>
<link href="../assets/calendario/SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link href="../assets/calendario/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/dateInput.css" rel="stylesheet" type="text/css" /> 
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="../assets/js/vali_recibidas.js"></script> 
 
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
		
		if($_SESSION['modif']!=1 && $_SESSION['consul']!=1 && $_SESSION['RespuestaOfic']!=1 && $_SESSION['RespuestaOfic']!=2 && $_SESSION['consul_remision']!=1 && $_SESSION['RespuestaRemisiones']!=1)
		{
			require_once("menu.php");
		}
		?>
	</div>
	<div id="central">
		<br>
		<form ENCTYPE="multipart/form-data" class="form2" autocomplete="off" name="frm_recibidas" method="post" action="../controlador/control_recibidas.php">	
		<fieldset> <legend>Datos del Oficio Recibido </legend>	
		<span>
        				<?php
        				if ($_SESSION['estatus_msj']==1)
						{
						?>
						<table id="tabla_msj" align="center">
							<tr>
								<td>
									<img src="../assets/img/cancel.png">
								</td>
						   		<td>
						   		<label class="label_corr">			
						<?php echo ($_SESSION['error_recibidas']);?>
								</label>
								</td>
							</tr>
						</table>
						<?php 
						unset($_SESSION['error_recibidas']);
						unset($_SESSION['estatus_msj']);
						}
					    	else
							{ 
								if($_SESSION['estatus_msj']==2) 
						  		{ ?>
						  		<table id="tabla_msj" align="center">
						  		<tr>
						  			<td>
						  				<img src="../assets/img/accept.png"> 							
						   			</td>
						   			<td>
						   			<label class="label_corr">
						  		<?php
						   		echo ($_SESSION['error_recibidas']);
						   		?>
						   		</label>
						   		<br>
						   		<br>
						   		<label class="label_corr">
						   		<?php 
						   		echo ($_SESSION['correlativo']);
						   		?></label></td></tr></table><?php  
						  		unset($_SESSION['error_recibidas']);
						  		unset($_SESSION['correlativo']);
						  		unset($_SESSION['estatus_msj']);
						  		}
							}
						?>
	 </span><br>
			<table align="center" class="tabla" width="650px" >
				
					<?php
					if($_SESSION['modif']==1 || $_SESSION['consul']==1 || $_SESSION['RespuestaOfic']==1 || $_SESSION['RespuestaOfic']==2 || $_SESSION['consul_remision']==1 || $_SESSION['RespuestaRemisiones']==1)
					{
					?>
						<tr class="modo1">
						<td width="250px"><label><span class = "font3">* </span>A&ntilde;o:</label>
						</td>
						<td><?php echo ($_SESSION['anio_recibidas']);?>
						</td>
						</tr>
						<tr class="modo1">
						<td><label><span class = "font3">* </span>N&uacute;m. Correlativo:</label>
						</td>
						<td><?php echo ($_SESSION['id_recibidas']);?>
						</td>
						</tr>
					<?php } ?>
						
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Fecha de Entrada:</label></td> 
					<?php
					if($_SESSION['modif']==1 || $_SESSION['consul']==1 || $_SESSION['RespuestaOfic']==1 || $_SESSION['RespuestaOfic']==2 || $_SESSION['consul_remision']==1 || $_SESSION['RespuestaRemisiones']==1)
					{
					$fecha_oficio=$_SESSION['fecha_entrada_recibidas'];	
					}
					else
					{
					$fecha_oficio = date("d-m-Y"); 	
					}
					?>    
				   	<td><?php
						if ($_SESSION['bloqueo_consulta']==1)
						{
							echo $fecha_oficio;
						}
						else
						{
							Create_DateInput('fecha_oficio',$fecha_oficio );							
						}
				   	
				   	?></td>
				</tr>
				<tr class="modo1">
					<?php 
					if($_SESSION['modif']==1 || $_SESSION['consul']==1 || $_SESSION['RespuestaOfic']==1 || $_SESSION['RespuestaOfic']==2 || $_SESSION['consul_remision']==1 || $_SESSION['RespuestaRemisiones']==1)
					{
					$fecha_carta=$_SESSION['fecha_carta_recibidas'];	
					}                       
					?>
					<td><label><span class = "font3">* </span>Fecha del Oficio:</label></td> 
				   	<td><?php
				   	if ($_SESSION['bloqueo_consulta']==1)
				   	{
				   		echo $fecha_carta;	
				   	}
				   	else
				   	{
				   		Create_DateInput('fecha_carta',$fecha_carta);	
				   	}
				   	?></td>
				</tr>
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Hora de Entrada:</label></td>
					<td>
					<?php
					if($_SESSION['hora_recibidas']!="")
					{
						$hora=$_SESSION['hora_recibidas'];
						unset($_SESSION['hora_recibidas']);	
						$minuto=$_SESSION['minuto_recibidas'];
						unset($_SESSION['minuto_recibidas']);	
						$tiempo=$_SESSION['tiempo_recibidas'];
						unset($_SESSION['tiempo_recibidas']);
						if ($_SESSION['perfil']==1)
						{
							$_SESSION['disabled']="";	
						}
						else
						{
							$_SESSION['disabled']="disabled";
						}	

					}
					else
					{
						$hora = date('h'); $minuto = date('i'); $tiempo=date('a');	
						$_SESSION['disabled']=" ";
						
					}

					if ($_SESSION['bloqueo_consulta']==1)
					{
         				if($hora<10)
      					{
      						$hora="0".$hora;
      					}
      					if($minuto<10)
      					{
      					$minuto="0".$minuto;	
      					}
						echo ($hora.":".$minuto."".$tiempo); 
					}
					else
					{
		
						  echo " 
						  		<select name=\"hora\" ".$_SESSION['disabled']." >";
			              for ($i = 0; $i<13;$i++) 
						  {
							if ($i==0)
						  	{
						  		echo "<option value=\"--\" selected=\"selected\">- - </option>";
						  	}
						  	else 
						  	{  
						  	echo "<option value=\"$i\"";
						  						  		
						  	if ($i==$hora) echo " selected=\"selected\"";
						  		echo ">";echo $i;
						  		echo "</option>";
						  	}
						  }
			             echo"</select> :";
		
			             
			              echo "<select name=\"minuto\"  >";
		                  for ($j = 0; $j<60;$j++)
		                  {
		                  if ($j==0)
						  	{
						  		echo "<option value=\"--\" selected=\"selected\">- - </option>";
						  		echo "<option value=\"$j\"";
						  		if ($minuto=="$j") echo " selected=\"selected\"";
						  		echo ">";echo "00";
						  		echo "</option>";
						  	}
						  	else 
						  	{  
						  	echo "<option value=\"$j\"";
						  		if ($minuto=="$j") echo "  selected=\"selected\"";
						  		echo ">";echo $j;
						  		echo "</option>";
						  	}
		                  }  
			              echo"</select>";
			             	             
			             echo "<select name=\"tiempo\"   >
		                    <option value=\"--\" selected=\"selected\">- -</option>
		                    <option value=\"am\"";
			             	if ($tiempo=="am") echo "  selected=\"selected\"";
			             	echo ">A.M.</option>
		                    <option value=\"pm\"";
		                    if ($tiempo=="pm") echo " selected=\"selected\"";
		                    echo" >P.M.</option>
		                  </select>";
					}	              
	              ?>           
                	</td>
				</tr>
				<tr class="modo1">
					<td><label>N° Externo:</label></td>
			    			<?php 
			    			if($_SESSION['num_externo_recibidas']==""){
			    				$_SESSION['num_externo_recibidas']="S/N";
			    			}
			    			?>
					<td>
					<?php
					if ($_SESSION['bloqueo_consulta']==1)
					{
						echo $_SESSION['num_externo_recibidas'];
					}
					else
					{
					?>
					<input name="num_externo" type="text" maxlength="20" size="60" value ="<?php echo ($_SESSION['num_externo_recibidas']);?>" onclick="return limpiar(this)">
					<?php 
					}
					?>
					</td>		
				</tr>
				<tr class="modo1">
			    			<td><label><span class = "font3">* </span>Remitente:</label></td>
			    			<td>
			    				<?php 
			    				if ($_SESSION['bloqueo_consulta']==1)
								{
									echo $_SESSION['remitente_recibidas'];
								}
								else
								{
								?>
								<input name="remitente" type="text" onKeyPress="return validarletra(event)" maxlength="30"  size="60" value ="<?php echo ($_SESSION['remitente_recibidas']);?>">	
								<?php 
								}
								?>
			    			</td>
				</tr>
				<tr class="modo1">
			    			<td><label>C&eacute;dula del Remitente:</label></td>
			    			<td>
    		    				<?php 
			    				if ($_SESSION['bloqueo_consulta']==1)
								{
									echo $_SESSION['cedula_recibidas'];
								}
								else
								{
								?>
								<input name="ced_remitente" type="text" maxlength="13"  size="60" value ="<?php echo ($_SESSION['cedula_recibidas']);?>">
								<?php 	
								}
								?>
			    			</td>
				</tr>
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Alto Nivel:</label></td>
					<td><?php
//				   	if ($_SESSION['alto_nivel_user']>=25 ||$_SESSION['bloqueo_consulta']==1)
					if ($_SESSION['perfil']<>1 ||$_SESSION['bloqueo_consulta']==1)
				   	{
				   		$_SESSION['disabled']="disabled=\"disabled\"";
				   	}
				   	else 
				   	{
				   		$_SESSION['disabled']="";
				   	}					
				   	echo "<select  name=\"alto_nivel\" id=\"alto_nivel\" ".$_SESSION['disabled']."  onchange=\"xajax_llenarPrimerNivelCorres(document.getElementById('alto_nivel').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\">";
                	$idAltoNivel= $_SESSION['campoIdAltoNivelCorres'];
                	$nombreAltoNivel=$_SESSION['campoNombreAltoNivelCorres'];
                	$cantidadAltoNivel=$_SESSION['cantidad_alto_nivel_corres'];
                	//if ($_SESSION['alto_nivel_user']>=25)
			if ($_SESSION['alto_nivel_user']<>1)
				   	{
					$valorAltoNivel=$_SESSION['alto_nivel_corres_seleccionado'];
						//codigo de prueba 						
						if($valorAltoNivel=="")
						{				   	
							$valorAltoNivel=$_SESSION['alto_nivel_user'];
						}
						//fin codigo de prueba
				   	}
				   	else 
				   	{
				   	$valorAltoNivel=$_SESSION['alto_nivel_corres_seleccionado'];
				   	}               	

                	echo("<option value=\"0\">Seleccione</option>");
				   	for ($indexAltoNivel = 0; $indexAltoNivel < $cantidadAltoNivel; $indexAltoNivel++) 
				   	{
						if ($valorAltoNivel== "$idAltoNivel[$indexAltoNivel]")
						{
	          			    echo("<option value= \"$idAltoNivel[$indexAltoNivel]\"  selected='selected' >$nombreAltoNivel[$indexAltoNivel]</option>");
                		}
                		else
                		{
                			echo("<option value= \"$idAltoNivel[$indexAltoNivel]\">$nombreAltoNivel[$indexAltoNivel]</option>");	
                		}
                		
                		
                	}
					echo ("</select>");
					?></td>
					

				</tr>
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Primer Nivel:</label></td>
					<td>
					<div id="div_primer_nivel">
				   	<?php
				   		if($_SESSION['primer_nivel_corres_seleccionado']!="" || $_SESSION['alto_nivel_user']>=25){
				   		
				   			if ($_SESSION['alto_nivel_user']>=25)
				   			{
				   				$_SESSION['disabled']="";
				   			}
				   		echo "<select  name=\"primer_nivel\" id=\"primer_nivel\" ".$_SESSION['disabled']." onchange=\"xajax_llenarDireccionCorres(document.getElementById('primer_nivel').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\" >";
   						$idprimer_nivel= $_SESSION['campoIdprimer_nivel_corres'];
                                                $nombreprimer_nivel=$_SESSION['campoNombreprimer_nivel_corres'];
                                                $cantidadprimer_nivel=$_SESSION['cantidad_primer_nivel_corres'];
                                                $valorprimer_nivel=$_SESSION['primer_nivel_corres_seleccionado'];
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
					<td><label>Direcciones:</label></td>
					<td><div id="div_direcciones">
					<?php 
  					  	if($_SESSION['direcciones_corres_seleccionado']!="")
						  	{
								echo "<select  name=\"direcciones\" id=\"direcciones\" ".$_SESSION['disabled']." onchange=\"xajax_llenarunidades(document.getElementById('direcciones').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\"  >";
	   							$iddirecciones= $_SESSION['campoIddirecciones_corres'];
	                			$nombredirecciones=$_SESSION['campoNombredirecciones_corres'];
	                			$cantidaddirecciones=$_SESSION['cantidaddirecciones_corres'];
	                			$valordirecciones=$_SESSION['direcciones_corres_seleccionado'];
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
				</div></td>
				</tr>
				<tr class="modo1">
					<td><label>Clasificaci&oacute;n del Documento:</label></td>
					<td><?php 
				   	if ($_SESSION['bloqueo_consulta']==1)
				   	{
				   		$_SESSION['disabled']="disabled=\"disabled\"";
				   	}
					else 
				   	{
				   		$_SESSION['disabled']="";
				   	}
				   	echo "<select  name=\"clasificacion_documentos\" id=\"clasificacion_documentos\" ".$_SESSION['disabled']." onchange=\"xajax_deshabilitar(document.getElementById('tipo_usuario').value);return false;\">";
   					$id= $_SESSION['campoIdClasificacionDocumentos'];
                	$nombre=$_SESSION['campoNombreClasificacionDocumentos'];
                   	$cantidad=$_SESSION['cantidad'];
                	$valor=$_SESSION['clasificacion_documentos_seleccionado'];
                	echo("<option value=\"0\">Seleccione</option>");
				   	for ($index = 0; $index < $cantidad; $index++) 
                		{
                			if ($valor==$id[$index])
                			{
                		    	echo("<option value=\"$id[$index]\" selected >$nombre[$index]</option>");
                			}
                			else
                			{
                				echo("<option value=\"$id[$index]\">$nombre[$index]</option>");	
                			}
                		}
					echo ("</select>");
					
					?>	</td>
				</tr>
				<tr class="modo1">
	    			<td><label>Amerita Respuesta:</label></td>
	    			<td>
	    			<?php 
	    			if ($_SESSION['bloqueo_consulta']==1)
		   			{
		   			?>
		   			<input name="amerita_respuesta"  disabled="disabled" type="checkbox" <?php if($_SESSION['ame_respuesta']==t){ echo "checked"; } ?> >
		   			<?php
		   			}
		   			else
		   			{
		   			?>
		   				<input name="amerita_respuesta"  type="checkbox" <?php if($_SESSION['ame_respuesta']==t){ echo "checked"; } ?> >
		   			<?php 	
		   			}
	    			?>
	    			
	    			</td>
				</tr>
			    <tr class="modo1">
			    	<td>
			    		<label><span class = "font3">* </span>Asunto:</label>
		    		</td>
		    		<td>		
	    				<?php 
		    			if ($_SESSION['bloqueo_consulta']==1)
			   			{
			   				echo ($_SESSION['asunto_recibidas']);
			   			}
						else 
			   			{
			   			?>	
			   				<!-- <textarea name="asunto"  disabled="<?php //echo ($_SESSION['disabled']);?>" cols="60" rows="3" ><?php // echo ($_SESSION['asunto_recibidas']);?></textarea> -->
			   				<textarea name="asunto"  cols="60" rows="3" ><?php echo ($_SESSION['asunto_recibidas']);?></textarea>
			   			<?php 
			   			}
		    			?>
					</td>
							
				</tr>
				<tr class="modo1">
					<td><label>Ubicaci&oacute;n del Documento:</label></td>
					<td>
	    				<?php 
		    			if ($_SESSION['bloqueo_consulta']==1)
			   			{
			   				echo ($_SESSION['ubicacion_recibidas']);
			   			}
						else 
			   			{
			   			?>					
						<input name="ubicacion" type="text" maxlength="255"  size="60" value ="<?php echo ($_SESSION['ubicacion_recibidas']);?>">
						<?php 
			   			}
						?>
					</td>
				</tr>
				<tr class="modo1">
						<?php 
						if($_SESSION['scanner']=="")
						{
							if ($_SESSION['$archivador_in']==1)
							{
								if ($_SESSION['bloqueo_consulta']==1)
			   					{
									echo " <td><label><span class = 'font3'>Subir Correspondencia:</span></label></td>
		    					   		   <td><input name='documento' disabled='disabled' id='documento' type='file' size='50'>";			   						
			   					}
			   					else
			   					{
									echo " <td><label><span class = 'font3'>Subir Correspondencia:</span></label></td>
		    					   		   <td><input name='documento' id='documento' type='file' size='50'>";			   						
			   					}
							
							}
						}
						else
						{
		    				echo " <td><label>Descargar archivo</label></td>
		    					   <td><a href='../controlador/archivo.php'><img src='../assets/img/archivo.png' align='center' border='0' title='Descargar' ></a>
		    					   <label><span class = 'font3'>NOTA: abrir con un VISOR DE DOCUMENTOS</span></label>";
		    				if($_SESSION['perfil']==1 && $_SESSION['$archivador_mo']==1 && $_SESSION['modif']==1)
		    				{
    							if ($_SESSION['bloqueo_consulta']==1)
			   					{		
		    						echo"<label>Eliminar Imagen<input disabled='disabled' name='eli_img'  type='checkbox'></label>
	    					   			</td>";
			   					}
			   					else
			   					{
		    						echo"<label>Eliminar Imagen<input name='eli_img'  type='checkbox'></label>
	    					   			</td>";			   						
			   					}	
		    				}				
						}
						?>			
				</tr>
				
				<?php 
					if($_SESSION['RespuestaOfic']==2)
					{
				?>
					<tr class="modo1">
			    		<td><label><span class = "font3">Respondido con el N&uacute;m.:</span></label></td>
			    		<td><input name="id_oficios" type="text" maxlength="30"  size="60" value ="<?php echo ($_SESSION['id_oficio_consul']);?>"></td>
					</tr>
					<tr class="modo1">
			    		<td><label><span class = "font3">Correspondiente al A&ntilde;o:</span></label></td>
			    		<td><input name="anio_oficios" type="text" maxlength="4"  size="60" value ="<?php echo ($_SESSION['anio_oficio_onsul']);?>"></td>
					</tr>
				<?php 
					}
				?>
				<tr class="modo1">
					 <td  align="center" colspan="2"><label><span class = "font3">(*)</span> Campos Requeridos.</label></td>
				</tr>
				<tr class="modo1">			
				<td colspan="2" align="center">
				<?php
				if ($_SESSION['RespuestaRemisiones']==1 && $_SESSION['consul_remision']==0)
				{
					echo "	<input class=\"boton\" type=\"submit\" name=\"cancelar_remisiones\" value=\"Cancelar\">
							<input class=\"boton\" type=\"submit\" name=\"regresar_remisionies\" value=\"Regresar\">
							<input class=\"boton\" type=\"submit\" name=\"finalizar_remisiones\" value=\"Finalizar\" onclick=\"return valida(this);blockEnter = true;\" >";	
				}	
				else if ($_SESSION['modif']==1 && $_SESSION['consul_remision']==0)
				{
					if ($_SESSION['modificar']==1)
					{
					echo"<input class=\"boton\" type=\"submit\" name=\"modificar\" value=\"Modificar\" onclick=\"return valida(this);blockEnter = true;\" >";
					unset($_SESSION['modificar']);
					}
					echo"<input class=\"boton\" type=\"submit\" name=\"regresar\" value=\"Regresar\">";
				}
				else if ($_SESSION['consul']==1)
				{
					echo "	<input class=\"boton\" type=\"submit\" name=\"cancelar_recibidas\" value=\"Cancelar\">
							<input class=\"boton\" type=\"submit\" name=\"regresar\" value=\"Regresar\">
							<input class=\"boton\" type=\"submit\" name=\"finalizar\" value=\"Finalizar\" onclick=\"return valida(this);blockEnter = true;\" >";	
				}
				else if ($_SESSION['RespuestaOfic']==1)
				{
					echo"	<input class=\"boton\" type=\"submit\" name=\"regresarespuestaoficio\" value=\"Regresar\">
							<input class=\"boton\" type=\"submit\" name=\"siguiente\" value=\"Siguiente\" onclick=\"return valida(this);blockEnter = true;\"> ";	
				}
				else if ($_SESSION['RespuestaOfic']==2)
				{
					if ($_SESSION['modificar']==1)
					{
					echo"<input class=\"boton\" type=\"submit\" name=\"modificarconsul\" value=\"Modificar\" onclick=\"return valida(this);blockEnter = true;\" >";
					unset($_SESSION['modificar']);
					}
					echo "<input class=\"boton\" type=\"submit\" name=\"regresarconsul\" value=\"Regresar\">";
								
				}
				else if ($_SESSION['consul_remision']==1)
				{
					echo "	<input class=\"boton\" type=\"submit\" name=\"regresaremision\" value=\"Regresar\"> ";
				}
				else 
				{
					echo "	<input class=\"boton\" type=\"submit\" name=\"guardar\" value=\"Guardar\" onClick=\"return valida(this);blockEnter = true;\"  > ";	
				}
				?>
				</td>
				</tr>
				
		</table>
		<input name="id" type="hidden" name="guardar" value ="<?php echo ($_SESSION['id_recibidas']);?>">
		<input type="hidden" name="anio" value ="<?php echo ($_SESSION['anio_recibidas']);?>">
	</fieldset>
</form>	
	</div><!-- cierra el div central!-->	
	</div><!-- cierra el div contenedor!-->
<div id="pie"></div>
</div> <!-- cierra el div Cuerpo!-->
</center>	
</body>
</html>
