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
<title>Consultar Oficios Recibidos - SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../assets/calendario/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../assets/js/dateInput.js" type="text/javascript"></script>
<script src="../assets/js/jvstools.js" type="text/javascript"></script>
<link href="../assets/calendario/SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link href="../assets/calendario/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/dateInput.css" rel="stylesheet" type="text/css" /> 
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="../assets/js/vali_consultar_recibidas.js"></script> 
 
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
		<form class="form" autocomplete="off" name="frm_recibidas" method="post" action="../controlador/control_consultar_recibidas.php">	
		<fieldset> <legend>Consultar Oficios Recibidos </legend>	
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
						?></label></td></tr></table><? 
						unset($_SESSION['error_recibidas']);
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
				<tr class="modo1"> 
			    			<td><label class="label_class">
			    			<span id='anioconsulta' class = "font3" style='visibility:hidden'>*</span>                                                        
			    			A&ntilde;o que desea Consultar:</label></td>
			    			<td><input name="ano_consulta" type="text" maxlength="4" disabled="disabled"  size="60" onKeyPress="return solo_num(event)"></td>
				</tr>
				<tr class="modo1"> 
			    			<td><label class="label_class">                                                        
			    			<input name="consul_recibidas" type="radio" value="num_correlativo" onClick="activa_opcion(value,tmp_altonivel.value)" >
			    			 <span id='nucorrelativo' class = "font3" style='visibility:hidden'>*</span>
			    			 N&uacute;mero Correlativo:</label></td>
			    			<td><input name="num_correlativo" type="text" maxlength="20" disabled="disabled"  size="60" "></td>
				</tr>				
				<tr class="modo1">
					<td><label class="label_class">
			    			<input name="consul_recibidas" type="radio" value="num_externo" onClick="activa_opcion(value,tmp_altonivel.value)">
							<span id='nuexterno' class = "font3" style='visibility:hidden'>*</span>
			    			 N° Externo:</label></td>
					<td><input name="num_externo" type="text" maxlength="20" size="60" disabled="disabled" onclick="return limpiar(this)"></td>
				</tr>
				
				<tr class="modo1">
					<td>
						<label class="label_class">
			    		<input name="consul_recibidas" type="radio" value="fecha" onClick="activa_opcion(value,tmp_altonivel.value)">
			    		<span id='fecha' class = "font3" style='visibility:hidden'>*</span>
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
			    			<input name="consul_recibidas" type="radio" value="remitente" onClick="activa_opcion(value,tmp_altonivel.value)"> 
			    			<span id='remitente' class = "font3" style='visibility:hidden'>*</span>
			    			Remitente:</label></td>
			    			<td><input name="remitente" type="text" maxlength="30"  size="60" disabled="disabled" ></td>
				</tr>
				<tr class="modo1">
			    			<td><label class="label_class">
			    			<input name="consul_recibidas" type="radio" value="cedula" onClick="activa_opcion(value,tmp_altonivel.value)">
			    			<span id='cedula' class = "font3" style='visibility:hidden'>* </span>
			    			 C&eacute;dula del Remitente:</label></td>
			    			<td><input name="ced_remitente" type="text" maxlength="13" disabled="disabled" size="60" ></td>
				</tr>
				<tr class="modo1">
					<td><label class="label_class">
					<input name="consul_recibidas" type="radio" value="direccion" onClick="activa_opcion(value,tmp_altonivel.value)"> 
					<span id='altonivel' class = "font3" style='visibility:hidden'>* </span>
					Alto Nivel:</label></td>
					<td><?php
					if ($_SESSION['alto_nivel_user']>=25)
				   	{
				   		$_SESSION['disabled']="disabled=\"disabled\"";
				   	}
				   	else 
				   	{
				   		$_SESSION['disabled']="";
				   	}					
				   	echo "<select  name=\"alto_nivel\" id=\"alto_nivel\" disabled=\"disabled\"  onchange=\"xajax_llenarPrimerNivelCorres(document.getElementById('alto_nivel').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\">";
                	$idAltoNivel= $_SESSION['campoIdAltoNivelCorres'];
                	$nombreAltoNivel=$_SESSION['campoNombreAltoNivelCorres'];
                	$cantidadAltoNivel=$_SESSION['cantidad_alto_nivel_corres'];
                	$valorAltoNivel=$_SESSION['alto_nivel_corres_seleccionado'];
                	if ($_SESSION['alto_nivel_user']>=25)
				   	{
				   	$valorAltoNivel=$_SESSION['alto_nivel_user'];
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
					<td><label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='primernivel' class = "font3" style='visibility:hidden'>* </span>
					Primer Nivel:</label></td>
					<td>
					<div id="div_primer_nivel">
				   	<?php
			   		if($_SESSION['primer_nivel_corres_seleccionado']!="" || $_SESSION['alto_nivel_user']>=25)
			   		{
			   			if ($_SESSION['alto_nivel_user']>=25)
			   			{
			   				$_SESSION['disabled']="";
			   			}				   		
				   		echo "<select  name=\"primer_nivel\" id=\"primer_nivel\" disabled=\"disabled\" onchange=\"xajax_llenarDireccionCorres(document.getElementById('primer_nivel').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\" >";
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
					<td><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direcciones:</label></td>
					<td><div id="div_direcciones">
					<?php 
						  	if($_SESSION['direcciones_corres_seleccionado']!="")
						  	{
								echo "<select  name=\"direcciones\" id=\"direcciones\" disabled=\"disabled\" onchange=\"xajax_llenarunidades(document.getElementById('direcciones').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\"  >";
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
					<td><label class="label_class">
							<input name="consul_recibidas" type="radio" value="documentos" onClick="activa_opcion(value,tmp_altonivel.value)" > 
							<span id='documento' class = "font3" style='visibility:hidden'>* </span>
							Clasificaci&oacute;n del Documento por fecha:</label></td>
					<td><?php 
				   	echo "<select  name=\"clasificacion_documentos\" id=\"clasificacion_documentos\" disabled=\"disabled\" onchange=\"xajax_deshabilitar(document.getElementById('tipo_usuario').value);return false;\">";
   					$id= $_SESSION['campoIdClasificacionDocumentos'];
                	$nombre=$_SESSION['campoNombreClasificacionDocumentos'];
                	$cantidad=$_SESSION['cantidad'];
                	$valor=$_SESSION['clasificacion_documentos_seleccionado'];
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
					?>	</td>
				</tr>
				<tr class="modo1">
					 <td  align="center" colspan="2"><label><span id='campos' style='visibility:hidden' class = "font3">(*) </span> <span id='campos2' style='visibility:hidden'> Campos Requeridos.</span> </label></td>
				</tr>
				<tr class="modo1">		
						
					<td colspan="2" align="center"><input class="boton" type="submit" name="consultar" value="Consultar" onClick="return valida(this);blockEnter = true;"  ></td>
				</tr>
				</table> 
					
					
					
			   	<?php
						
			   	if ($_SESSION['activo']==1)
			   	{
			   	  	
			   		$cantidad=$_SESSION['cantidadValor'];
                	$valor=$_SESSION['Recibidas_seleccionado'];
		   			$id= $_SESSION['campoIdRecibidas'];
                	$fecha=$_SESSION['campoFecha'];
                	$alto_nivel=$_SESSION['cd_alto_nivel_corres'];
			    	$primer_nivel=$_SESSION['cd_primer_nivel_corres'];
			    	$direcciones=$_SESSION['cd_direcciones_corres'];
			    	$asunto=$_SESSION['tx_asunto'];	
			    	$anio=$_SESSION['anio'];
                	if ($valor==1){
                	echo "<div  id='contiene_tablas'>";	
                	echo "<table  align='center' class='tabla'>";	
				   	echo"<label>Seleccione</label>";
					echo"<tr class='modo1' align='center'><td class='font2' ><label>N&uacute;m.</label></td><td><label>Fecha</label></td><td><label>Alto Nivel</label></td><td><label>Primer Nivel</label></td><td><label>Direcciones</label></td><td><label>Asunto</label></td><td><label>Modificar</label></td>";
				   	for ($index = 0; $index < $cantidad; $index++) 
                	{
                		
                		if($direcciones[$index] == '0')
                		{
						$campo="";
                		}
                		else
                		{
						 $campo=$direcciones[$index];
                		}
						echo "<tr class='modo1'><td class='font2' >" . $id[$index] . "</td><td class='font2'>".$Recibidas->devuelve_fecha($fecha[$index])."</td><td class='font2'>".$alto_nivel[$index]."</td><td class='font2'>".$primer_nivel[$index]."</td><td class='font2'>".$campo."</td><td class='font2'>".$asunto[$index]."
						</td><td class='font2' align='center'><a href='../controlador/control_consultar_recibidas.php?id=" . $id[$index] . "&mod=1&a=".$anio[$index]."'><img src='../assets/img/edit.png' align='center' border='0' title='Modificar' ></a>";
					}
                	}
                	else
                	{
                		echo"<label>No existen registros en este rango de b&uacute;squeda</label>";
                	}
                	unset($_SESSION['activo']);
			   	echo "</table>
			   	      </div>";
			   	}
			   	?>	
				<input name="tmp_valor" type="hidden">
				<input name="tmp_altonivel" type="hidden" value="<?php echo $_SESSION['alto_nivel_user'];?>">	

	</fieldset>
</form>	
	</div><!-- cierra el div central!-->	
	</div><!-- cierra el div contenedor!-->
<div id="pie"></div>
</div> <!-- cierra el div Cuerpo!-->
</center>	
</body>
</html>
