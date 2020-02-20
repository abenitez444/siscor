<?php
session_start();
include('../controlador/script.php');

include '../assets/xajax/xajax_core/xajax.inc.php';
include('../controlador/script.php');
include_once("../modelo/conexpg.php"); //Incluye class 'BaseDeDato'
include_once("../modelo/class_remisiones.php");

$MiAjax = new xajax();
$Remisiones = new Remisiones();
$MiAjax->configure('javascript URI','../assets/xajax');
$Remisiones->registrarFunciones($MiAjax);	


?>
<html>
<head>
<?php 
include("input.php");	
$MiAjax->printJavascript();	
?>
<title>Consultar Remisiones - SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../assets/calendario/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../assets/js/dateInput.js" type="text/javascript"></script>
<script src="../assets/js/jvstools.js" type="text/javascript"></script>
<link href="../assets/calendario/SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link href="../assets/calendario/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/dateInput.css" rel="stylesheet" type="text/css" /> 
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="../assets/js/vali_consultar_remisiones.js"></script> 
 
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
		<?php require_once("menu.php") ?>
	</div>
	<div id="central">
		<br>
		<form class="form" autocomplete="off" name="frm_remisiones" method="post" action="../controlador/control_consultar_remisiones.php">	
		 
		<fieldset> <legend>Consultar Remisiones </legend>	
		<span >
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
						echo ($_SESSION['error_remisiones_consulta']);
						?>
						</label></td></tr></table><? 
						unset($_SESSION['error_remisiones_consulta']);
						unset($_SESSION['estatus_msj']);
						}
					    	else
							{ 
								if($_SESSION['estatus_msj']==2) 
						  		{ ?>
						  		<table id="tabla_msj" align="center"><tr><td>
						  		<img src="../assets/img/accept.png" > 							
						</td>
						<td>
						<label class="label_corr"> 						 
						   		<?
						   		echo ($_SESSION['error_remisiones_consulta']);
						   		?>
						   		</label></td></tr></table><?  
						  		unset($_SESSION['error_remisiones_consulta']);
						  		unset($_SESSION['estatus_msj']);
						  		}
							}
						?>
	 </span><br>
			<table align="center" class="tabla" width="650px">
				<tr class="modo1" > 
			    			<td><label class="label_class" >                                                        
			    			<span id='anioconsulta' class = "font3" style='visibility:hidden'>*</span>
			    			A&ntilde;o que desea Consultar:</label></td>
			    			<td><input name="ano_consulta" type="text" maxlength="4" disabled="disabled"  size="60" onKeyPress="return solo_num(event)"></td>
				</tr>
				<tr class="modo1"> 
			    			<td><label class="label_class">                                                        
			    			<input name="consul_remisiones" type="radio" value="num_remision" onClick="activa_opcion(value,dire_user.value,perf_user.value,primer_nivel_user.value)" >
			    			<span id='nucorrelativo' class = "font3" style='visibility:hidden'>*</span>
			    			N&uacute;mero de Correlativo de la Remisi&oacute;n:</label></td>
			    			<td><input name="num_remision" type="text" maxlength="20" disabled="disabled"  size="60" onKeyPress="return solo_num(event)"></td>
				</tr>				
				<tr class="modo1">
					<td><label class="label_class">
			    			<input name="consul_remisiones" type="radio" value="num_remitida" onClick="activa_opcion(value,dire_user.value,perf_user.value,primer_nivel_user.value)">
			    			<span id='nuremitida' class = "font3" style='visibility:hidden'>*</span>
			    			N° Correspondencia Remitida:</label></td>
					<td><input name="num_remitida" type="text" maxlength="20" size="60" disabled="disabled" onKeyPress="return solo_num(event)"></td>
				</tr>
				
				<tr class="modo1">
					<td>
						<label class="label_class">
			    		<input name="consul_remisiones" type="radio" value="fecha" onClick="activa_opcion(value,dire_user.value,perf_user.value,primer_nivel_user.value)">
			    		<span id='fecha' class = "font3" style='visibility:hidden'>* </span>
			    		Fecha:
			    		</label>
			    	</td> 
					<td>
						<label class="label_class"> Desde:<?php Create_DateInput('fecha_desde',$fecha_desde,'','','','disabled'); ?>
						</label>
					</td>
				</tr>
				<tr class="modo1">
					<td>
					</td> 
				   	<td>
				   		<label class="label_class"> Hasta:<?php Create_DateInput('fecha_hasta',$fecha_hasta,'','','','disabled'); ?>
				   		</label>
				   	</td>
				</tr>
				<tr class="modo1">
					<td><label class="label_class">
					<input name="consul_remisiones" type="radio" value="direccion" onClick="activa_opcion(value,dire_user.value,perf_user.value,primer_nivel_user.value)">
					<span id='altonivel' class = "font3" style='visibility:hidden'>&nbsp;* </span>
					Alto Nivel:</label></td>
					<td><?php
				   	if ($_SESSION['alto_nivel_user']!=0)
                                       	{
				   		$_SESSION['disabled']="disabled=\"disabled\"";
				   	}
				   	else 
				   	{
				   		$_SESSION['disabled']="";
				   	}
						echo "<select  name=\"alto_nivel\" id=\"alto_nivel\" ".$_SESSION['disabled']."  onchange=\"xajax_llenarPrimerNivel(document.getElementById('alto_nivel').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\">";
                		$idAltoNivel= $_SESSION['campoIdAltoNivel'];
                		$nombreAltoNivel=$_SESSION['campoNombreAltoNivel'];
                		$cantidadAltoNivel=$_SESSION['cantidad_alto_nivel'];
                		$valorAltoNivel=$_SESSION['alto_nivel_user'];
                	//	unset($_SESSION['alto_nivel_seleccionado_remision']);
         
                		echo("<option value=\"0\" >Seleccione</option>");
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
					<td><label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='primernivel' class = "font3" style='visibility:hidden'>* </span>
					Primer Nivel:</label></td>
					<td>
					<div id="div_primer_nivel">
				   	<?php 
				   	if($_SESSION['primer_nivel_user']!="")
				   	{
				   		if (($_SESSION['primer_nivel_user']!=0)||($_SESSION['primer_nivel_user']!=329))
				   		{
				   			$_SESSION['disabled']="disabled=\"disabled\"";
				   		
				   		}
				   		else 
				   		{
				   			$_SESSION['disabled']="";
				   		}
                                                
				   		echo "<select  name=\"primer_nivel\" id=\"primer_nivel\" ".$_SESSION['disabled']." onchange=\"xajax_llenarDireccion(document.getElementById('primer_nivel').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\" >";
   						$idprimer_nivel= $_SESSION['campoIdprimer_nivel'];
                		$nombreprimer_nivel=$_SESSION['campoNombreprimer_nivel'];
                		$cantidadprimer_nivel=$_SESSION['cantidad_primer_nivel'];
                		$valorprimer_nivel=$_SESSION['primer_nivel_user'];
                		//unset($_SESSION['primer_nivel_seleccionado_remision']);
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
				   	echo "<select name=\"primer_nivel\" id=\"primer_nivel\" disabled=\"disabled\"><option>-Seleccione un Alto Nivel-</option></select>";	
				   	}
					?>	
					</div>
					</td>
				</tr>
				<tr class="modo1">
					<td><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direcciones:</label></td>
					<td>
					<div id="div_direcciones">
					<?php 
  					  	if($_SESSION['direcciones_user']!="")
						{
							
							if ($_SESSION['direcciones_user']!=0)
				   			{
				   				
				   				$_SESSION['disabled']="disabled=\"disabled\"";
				   			}
				   			else 
				   			{
				   				
				   				//$_SESSION['disabled']="disabled=\"disabled\"";
				   				//$_SESSION['disabled']="";
				   			}
							
				   			echo "<select  name=\"direcciones\" id=\"direcciones\" ".$_SESSION['disabled']." onchange=\"xajax_llenarunidades(document.getElementById('direcciones').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\"  >";
   							
				   			$iddirecciones= $_SESSION['campoIddirecciones'];
                			$nombredirecciones=$_SESSION['campoNombredirecciones'];
                			$cantidaddirecciones=$_SESSION['cantidaddirecciones'];
                			$valordirecciones=$_SESSION['direcciones_user'];
                			//unset($_SESSION['direcciones_seleccionado_remision']);
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
				<?php 
				if ($_SESSION['direcciones_user']!=0)
				{
				?>
				<tr class="modo1">
					<td><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unidad:</label></td>
					<td><div id="div_unidades">
					<?php 
      		  			if($_SESSION['unidades_user']!="")
						{
							if ($_SESSION['unidades_user']!=0)
				   			{
				   				$_SESSION['disabled']="disabled=\"disabled\"";
				   			}
				   			else 
				   			{
				   				$_SESSION['disabled']="";
				   			}
					
								echo "<label><select  name=\"unidades\" id=\"unidades\" disabled=\"disabled\" onchange=\"xajax_llenarCoordinaciones(document.getElementById('unidades').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\"  >";
	   							$idUnidades= $_SESSION['campoIdUnidades'];
	                			$nombreUnidades=$_SESSION['campoNombreUnidades'];
	                			$cantidadUnidades=$_SESSION['cantidadUnidades'];
	                			$valorUnidades=$_SESSION['unidades_user'];
	                			echo("<option value=\"0\">Seleccione</option>");
							   		for ($indexUnidades = 0; $indexUnidades < $cantidadUnidades; $indexUnidades++) 
            						{
	       								if ($valorUnidades== "$idUnidades[$indexUnidades]")
	       								{
               								echo("<option value= \"$idUnidades[$indexUnidades]\"  selected >$nombreUnidades[$indexUnidades]</option>");
                						}
                						else
                						{
                							echo("<option value= \"$idUnidades[$indexUnidades]\">$nombreUnidades[$indexUnidades]</option>");	
                						}
                					}
								echo ("</select>");
								echo " <input name='todos' type='checkbox' disabled='disabled'
								onclick='unidades.disabled = this.checked;unidades.selectedIndex=0'";
						  		if($_SESSION['check_t']=='on')
						   		{ 
						   			echo "\"checked\""; 
						   		}
								echo ">   Todas las Unidades</label>";
							}
					    	else
						   	{
						   	echo "<label><select name=\"unidades\" id=\"unidades\" disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>
						   		<input name=\"todos\" type=\"checkbox\" disabled=\"disabled\">   Todas las Unidades</label>	";	
						   	}
			   		 	  	
					?>
					
				</div></td>
				</tr>
				<?php 
				}
				?>
				<tr class="modo1">
				<?php if ($_SESSION['perfil']!=1)
                        {
                        	?>
					<td><label>Coordinaci&oacute;n:</label></td>
					<td><div id="div_coordinaciones">
					<?php 
                        if($_SESSION['coordinaciones_user']!="")
						{
							/*if ($_SESSION['coordinaciones_user']==0)
				   			{*/
				   				$_SESSION['disabled']="disabled";
				   			/*}
				   			else 
				   			{
				   				$_SESSION['disabled']="";
				   			}onchange=\"xajax_llenarCoordinaciones(document.getElementById('coordinaciones').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\" */
								echo "<select  name=\"coordinaciones\" id=\"coordinaciones\" ".$_SESSION['disabled']." >";
	   							$idCoordinaciones= $_SESSION['campoIdCoordinaciones'];
	                			$nombreCoordinaciones=$_SESSION['campoNombreCoordinaciones'];
	                			$cantidadCoordinaciones=$_SESSION['cantidadCoordinaciones'];
	                			$valorCoordinaciones=$_SESSION['coordinaciones_user'];
	                			//unset($_SESSION['Coordinaciones_seleccionado_remision']);
                				echo("<option value=\"0\">Seleccione</option>");
							   		for ($indexCoordinaciones = 0; $indexCoordinaciones < $cantidadCoordinaciones; $indexCoordinaciones++) 
            						{
	       								if ($valorCoordinaciones== "$idCoordinaciones[$indexCoordinaciones]")
	       								{
               								echo("<option value= \"$idCoordinaciones[$indexCoordinaciones]\"  selected >$nombreCoordinaciones[$indexCoordinaciones]</option>");
                						}
                						else
                						{
                							echo("<option value= \"$idCoordinaciones[$indexCoordinaciones]\">$nombreCoordinaciones[$indexCoordinaciones]</option>");	
                						}
                					}
								echo ("</select>");
							}
					    	else
						   	{
						   	echo "<select name=\"coordinaciones\" id=\"coordinaciones\" disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>";	
						   	}
					?>
				</div></td>
				<?php }?>
				</tr>
				<tr class="modo1">
					 <td  align="center" colspan="2"><label><span id='campos' style='visibility:hidden' class = "font3">(*) </span> <span id='campos2' style='visibility:hidden'> Campos Requeridos.</span> </label></td>
				</tr>
				<tr class="modo1">		
					
					<td colspan="2" align="center"><input class="boton" type="submit" name="consultar" value="Consultar" onClick="return valida(this,perf_user.value,dire_user.value);blockEnter = true;"  ></td>
				</tr>
									<tr >
					 <td  align="center" colspan="2">
					
					</td>
					</tr>
				
		</table>
		<?php 
			if ($_SESSION['activo']==1)
			   	{
			   
			   		
			   		$cantidad=$_SESSION['cantidadValor'];
                	$valor=$_SESSION['Remisiones_seleccionado'];
		   			$idremisiones= $_SESSION['campoIdRemisiones'];
                	$fecha=$_SESSION['campoIdFecha'];
                	$recibidas=$_SESSION['campoIdRecibidas'];
			    	$unidad=$_SESSION['campoIdUnidad'];
			    	$coordinacion=$_SESSION['campoIdCoordinacion'];
			    	$prioridades=$_SESSION['campoIdPrioridades'];	
			    	$anioremision=$_SESSION['campoAnioRemision'];
			    	$aniorecibidas=$_SESSION['campoAnioRecibidas'];	
			    	$observacion=$_SESSION['campoObservacion'];

			    	if ($valor==1)
			    	{
			    		
			    		echo " <div  id='contiene_tablas'>";
			    		
				   	echo"<table  align='center' class='tabla'>";
			    		echo"<label>Seleccione</label>";
					echo"<tr class='modo1'>
							<td class='font2' align='center'><label>N&uacute;m.</label></td>
							<td><label>Fecha</label></td>
							<td><label>N&uacute;m. Remisi&oacute;n</label></td>
							<td><label>A&ntilde;o Remisi&oacute;n</label></td>
							<td><label>N&uacute;m. Remitida</label></td>
							<td><label>A&ntilde;o Remitida</label></td>
							<td><label>Unidades</label></td>";
							if ($_SESSION['perfil']!=1)
							{
								echo"<td><label>Coordinaciones</label></td>";
							}
							echo"<td><label>Prioridades</label></td>
							<td><label>Observaci&oacute;n</label></td>
							<td><label>Modificar</label></td>
						</tr>";
					$id=0;
					
				   	for ($index = 0; $index < $cantidad; $index++) 
                	{

                	$id=$id+1;

						echo "<tr class='modo1'>
								  <td class='font2' >" . $id . "</td>
								  <td class='font2'>".$Remisiones->devuelve_fecha($fecha[$index])."</td>
								  <td class='font2'>".$idremisiones[$index]."</td>
								  <td class='font2'>".$anioremision[$index]."</td>
								  <td class='font2'>".$recibidas[$index]."</td>
								  <td class='font2'>".$aniorecibidas[$index]."</td>
								  <td class='font2'>".$unidad[$index]."</td>";
								  if ($_SESSION['perfil']!=1)
								  {
								  	echo"	  <td class='font2'>".$coordinacion[$index]."</td>";
								  	
								  }
								  echo"<td class='font2'>".$prioridades[$index]."</td>
								  <td class='font2'>".$observacion[$index]."</td>
								  <td class='font2' align='center'><a href='../controlador/control_consultar_remisiones.php?id=" .$idremisiones[$index] . "&mod=1&a=".$anioremision[$index]."'><img src='../assets/img/edit.png' align='center' border='0' title='Modificar' ></a></td>
							  </tr>";
								 }
					echo "</table>
					</div>";
			    	}
                	else
                	{
                		echo"<label>No existen registros en este rango de b&uacute;squeda</label>";
                	}
                	unset($_SESSION['activo']);
			   		
				
			   	}
					 ?>
					 <input name="dire_user" type="hidden" value="<?php echo $_SESSION['direcciones_user'];?>" >
                                         <input name="primer_nivel_user" type="hidden" value="<?php echo $_SESSION['primer_nivel_user'];?>" >
					 <input name="tmp_valor" type="hidden" value="">
					 <input name="perf_user" type="hidden" value="<?php echo $_SESSION['perfil'];?>">
						
	</fieldset>
</form>	
	</div><!-- cierra el div central!-->	
	</div><!-- cierra el div contenedor!-->
<div id="pie"></div>
</div> <!-- cierra el div Cuerpo!-->
</center>	
</body>
</html>
