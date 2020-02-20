<?php
session_start();
include('../controlador/script.php');

include '../assets/xajax/xajax_core/xajax.inc.php';
include('../controlador/script.php');
include_once("../modelo/conexpg.php"); //Incluye class 'BaseDeDato'
include_once("../modelo/class_oficios.php");

$MiAjax = new xajax();
$Oficios = new Oficios();
$MiAjax->configure('javascript URI','../assets/xajax');
$Oficios->registrarFunciones($MiAjax);	


?>
<html>
<head>
<?php 
include("input.php");	
$MiAjax->printJavascript();	
	
?>
<title>Registro del Oficio Enviado - SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../assets/calendario/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../assets/js/dateInput.js" type="text/javascript"></script>
<script src="../assets/js/jvstools.js" type="text/javascript"></script>
<link href="../assets/calendario/SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link href="../assets/calendario/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/dateInput.css" rel="stylesheet" type="text/css" /> 
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="../assets/js/vali_oficios.js"></script> 
 
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
		
		if($_SESSION['modif']!=1 && $_SESSION['consul_oficio']!=1 && $_SESSION['RespuestaOfic']!=1 && $_SESSION['ConsultarRespuesta']!=1)
		{
			require_once("menu.php");
		}
		?>
	</div>
	<div id="central">
		<br>
		<form class="form2" autocomplete="off" name="frm_oficios" method="post" action="../controlador/control_oficios.php">	
		<fieldset> <legend>Datos del Oficio Enviado </legend>	
		<span class="">
        				<?php
        				if ($_SESSION['estatus_msj']==1)
						{
						?>
						<table id="tabla_msj" align="center"><tr><td>
						<img src="../assets/img/cancel.png" > 
						</td>
						<td>
						<label class="label_corr"> 
						<?php
						echo ($_SESSION['error_recibidas']);
						?></label></td></tr></table><?php 
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
						  		<?php
						   		echo ($_SESSION['error_recibidas']);
						   		?></label>
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
			<table align="center" class="tabla" width="650px">
				
									<?php
					if($_SESSION['modif']==1 || $_SESSION['consul']==1 || $_SESSION['RespuestaOfic']==1 || $_SESSION['consul_oficio']==1 || $_SESSION['ConsultarRespuesta']==1)
					{
					?>
						<tr class="modo1">
						<td width="250px"><label><span class = "font3">* </span>A&ntilde;o:</label>
						</td>
						<td><?php echo ($_SESSION['anio_oficios']);?>
						</td>
						</tr>
						<tr class="modo1">
						<td><label><span class = "font3">* </span>N&uacute;m. Correlativo:</label>
						</td>
						<td><?php echo ($_SESSION['id_oficios']);?>
						</td>
						</tr>
					<?php } ?>
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Fecha de Envio:</label></td> 
					<?php
					if($_SESSION['modif']==1 || $_SESSION['consul_oficio']==1)
					{
					$fecha_envio=$_SESSION['fecha_envio_oficios'];	
					}
					else
					{
					$fecha_envio = date("d-m-Y"); 	
					}
					?>
				   	<td>
				   	<?php 
				   	if($_SESSION['bloquear_remetir_oficios']==1)
				   	{
				   		echo $fecha_envio; 
				   	}
				   	else
				   	{
				   		Create_DateInput('fecha_envio',$fecha_envio); 	
				   	}
				   	?>
					</td>
				</tr>
					<tr class="modo1">
					<td><label><span class = "font3">* </span>Hora de Envio:</label></td>
					<td>
				   	<?php
					if($_SESSION['hora_oficios']!="")
					{
						$hora=$_SESSION['hora_oficios'];
						unset($_SESSION['hora_oficios']);	
						$minuto=$_SESSION['minuto_oficios'];
						unset($_SESSION['minuto_oficios']);	
						$tiempo=$_SESSION['tiempo_oficios'];
						unset($_SESSION['tiempo_oficios']);
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
					
				  

  	              if($_SESSION['bloquear_remetir_oficios']==1)
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
				  	
					  echo"<select name=\"hora\" ".$_SESSION['disabled']." >";
		              for ($i = 0; $i<13;$i++) 
					  {
						if ($i==0)
					  	{
					  		echo "<option value=\"--\" selected=\"selected\">- - </option>";
					  	}
					  	else 
					  	{  
					  	echo "<option value=\"$i\"";
					  		if ($hora=="$i") echo " selected=\"selected\"";
					  		echo ">";echo $i;
					  		echo "</option>";
					  	}
					  }
		             echo"</select> :";
	
		             
		              echo "<select name=\"minuto\" ".$_SESSION['disabled']." >";
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
					  		if ($minuto=="$j") echo " selected=\"selected\"";
					  		echo ">";echo $j;
					  		echo "</option>";
					  	}
	                  }  
		              echo"</select>";
		             	             
		             echo "<select name=\"tiempo\" ".$_SESSION['disabled']." >
	                    <option value=\"--\" selected=\"selected\">- -</option>
	                    <option value=\"am\"";
		             	if ($tiempo=="am") echo " selected=\"selected\"";
		             	echo ">A.M.</option>
	                    <option value=\"pm\"";
	                    if ($tiempo=="pm") echo "selected=\"selected\"";
	                    echo" >P.M.</option>
	                  </select>";
				  }
	              ?>           
                	</td>
				</tr>
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Alto Nivel:</label></td>
					<td><?php
					if ($_SESSION['perfil']<>1 || $_SESSION['bloquear_remetir_oficios']==1)

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
                    	if ($_SESSION['alto_nivel_user']>=25)
				   	{
$valorAltoNivel=$_SESSION['alto_nivel_corres_seleccionado'];
				   	
//codigo de prueba 						
						if($valorAltoNivel=="")
						{				   	
							$valorAltoNivel=$_SESSION['alto_nivel_user'];
						}
						//fin codigo d eprueba
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
	          			    echo("<option value= \"$idAltoNivel[$indexAltoNivel]\"  selected >$nombreAltoNivel[$indexAltoNivel]</option>");
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
				   		if($_SESSION['primer_nivel_corres_seleccionado']!="" || $_SESSION['alto_nivel_user']>=25)
				   		{
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
					<td><label><span class = "font3">* </span>Destinatario:</label></td>
					<td>
					<?php if($_SESSION['bloquear_remetir_oficios']==1)
						  {
							echo ($_SESSION['destinatario_oficios']);
					      }
					      else
					      {
					      	?>
							<input name="destinatario" type="text" maxlength="50"  size="60" onKeyPress="return validarletra(event)" value ="<?php echo ($_SESSION['destinatario_oficios']);?>">      	
					      	<?php 
					      }
					      	?>
					</td>
				</tr>
				<tr class="modo1">
	    			<td><label>¿Amerita Respuesta?</label></td>
	    			<td>
					<?php if($_SESSION['bloquear_remetir_oficios']==1)
						  {
						  	?>
							<input name="amerita_respuesta" disabled="disabled" type="checkbox" <?php if($_SESSION['ame_respuesta']==t){ echo "checked"; } ?> ">
					      	<?php
						  }
					      else
					      {
					      	?>
							<input name="amerita_respuesta" type="checkbox" <?php if($_SESSION['ame_respuesta']==t){ echo "checked"; } ?> ">      	
					      	<?php 
					      }
					      	?>	    			
	    			</td>
				</tr>
			    <tr class="modo1">
	    			<td><label><span class = "font3">* </span>Asunto:</label></td>
	    			<td>
					<?php if($_SESSION['bloquear_remetir_oficios']==1)
						  {
						    
							echo ($_SESSION['asunto_oficios']);
							 
						  }
					      else
					      {
					      	?>
							<textarea name="asunto"  cols="60" rows="3" ><?php echo ($_SESSION['asunto_oficios']); ?></textarea>      	
					      	<?php 
					      }
					      	?>
	    			</td>
				</tr>
				<tr class="modo1">
					<td><label>Responsable:</label></td>
					<td>
					<?php if($_SESSION['bloquear_remetir_oficios']==1)
						  {
						
							echo ($_SESSION['responsable_oficios']);
						  }
					      else
					      {
					      	?>
								<input name="responsable" type="text" maxlength="50"  size="60" value ="<?php echo ($_SESSION['responsable_oficios']);?>">      	
					      	<?php 
					      }
					      	?>					
					
					</td>
				</tr>		
				<tr class="modo1">
			    			<td><label>N&uacute;mero de Correspondencia<br> a Remitir:</label></td>
			    			<td>
					<?php if($_SESSION['bloquear_remetir_oficios']==1)
						  {
						
							echo ($_SESSION['num_correspondencia_remetir_oficios']); 
							?>
							&nbsp;Año:&nbsp;
							<?php 
							echo ($_SESSION['anio_correspondencia_remetir_oficios']);
							
						  }
					      else
					      {
					      	?>
			    			<span class = "font4">
			    			<input name="num_correspondencia_remitir" type="text" maxlength="20"  size="20" value ="<?php echo ($_SESSION['num_correspondencia_remetir_oficios']);?>">
			    			Año:<input name="anio_remitir" type="text" maxlength="4"  size="10" onKeyPress="return solo_num(event)" value ="<?php echo ($_SESSION['anio_correspondencia_remetir_oficios']);?>"></span>
      	
					      	<?php 
					      }
					      	?>				    			
			    			
			    			
			    			
			    			</td>
				</tr>
				<?php 
					if($_SESSION['ConsultarRespuesta']==1)
					{
						
				?>
				<tr class="modo1">
			    			<td><label><span class = "font3">Respondido con el N&uacute;m.:</span></label></td>
			    			<td><input name="id_recibidas_mod" type="text" maxlength="30"  size="60" value ="<?php echo ($_SESSION['id_recibidas']);?>"></td>
				</tr>
				<tr class="modo1">
			    			<td><label><span class = "font3">Correspondiente al A&ntilde;o:</span></label></td>
			    			<td><input name="anio_oficios_mod" type="text" maxlength="4"  size="60" value ="<?php echo ($_SESSION['anio_recibidas']);?>"></td>
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
				if ($_SESSION['modif']==1)
				{
					
					if ($_SESSION['modificar']==1)
					{
					 echo "<input class='boton' type='submit' name='modificar' value='Modificar' onclick='return valida(this);blockEnter = true;' >";
					}
					 echo "<input class='boton' type='submit' name='regresar' value='Regresar'>";
				}
				else if ($_SESSION['consul_oficio']==1)
				{
					echo "<input class='boton' type='submit' name='regresarespuestarecibida' value='Regresar'>
					<input class='boton' type='submit' name='siguiente' value='Siguiente'>";						
				
				}
				else if ($_SESSION['RespuestaOfic']==1)
				{
					
					echo"<input class='boton' type='submit' name='cancelarespuestaoficio' value='Cancelar'>
					<input class='boton' type='submit' name='regresarespuestaoficio' value='Regresar'>
					<input class='boton' type='submit' name='finalizar' value='Finalizar'>";						
				 
				}
				else if ($_SESSION['ConsultarRespuesta']==1)
				{
					if ($_SESSION['modificar']==1)
					{				
						echo "<input class='boton' type='submit' name='modificarespuestaoficio' value='Modificar' onclick='return valida(this);blockEnter = true;' >";
					}
						echo "<input class='boton' type='submit' name='regresarespuestaoficio' value='Regresar'>";					
				
				}
				else
				{
				
					echo "<input class='boton' type='submit' name='guardar' value='Guardar' onClick='return valida(this);blockEnter = true;'>";
				}
				?>
				</td>
					
					
				
				
				
				</tr>
				
		</table>
		<input name="id" type="hidden" value ="<?php echo ($_SESSION['id_oficios']);?>">
		<input type="hidden" name="anio" value ="<?php echo ($_SESSION['anio_oficios']);?>">
	</fieldset>
</form>	
	</div><!-- cierra el div central!-->	
	</div><!-- cierra el div contenedor!-->
<div id="pie"></div>
</div> <!-- cierra el div Cuerpo!-->
</center>	
</body>
</html>
