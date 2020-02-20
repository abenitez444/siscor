<?php
include('../controlador/script.php');
include '../assets/xajax/xajax_core/xajax.inc.php';
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
<title>Reportes Oficios Recibidos - SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../assets/calendario/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../assets/js/dateInput.js" type="text/javascript"></script>
<script src="../assets/js/jvstools.js" type="text/javascript"></script>
<link href="../assets/calendario/SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link href="../assets/calendario/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/dateInput.css" rel="stylesheet" type="text/css" /> 
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="../assets/js/vali_reportes_recibidas_sintesis.js"></script> 
 
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
		<form class="form" autocomplete="off" name="frm_recibidas" method="post" action="../controlador/control_reportes_recibidas_sintesis.php">	
		<fieldset> <legend>Reportes Oficios Recibidos </legend>	
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
						  		<img src="../assets/img/accept.png">
						</td>
						<td>
						<label class="label_corr"> 						  		 							
						   		<?
						   		echo ($_SESSION['error_recibidas']);
						   		?></label>
						   		</td></tr></table><?  
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
	    			<input name="consul_recibidas" type="radio" value="num_correlativo" onClick="activa_opcion(value)" >
	    			 <span id='nucorrelativo' class = "font3" style='visibility:hidden'>*</span>
	    			N&uacute;mero Correlativo:</label></td>
	    			<td>
	    			<label class="label_class">
	    			Desde:<input name="num_correlativo_desde" type="text" maxlength="20" disabled="disabled"  size="20" onKeyPress="return solo_num(event)">
	    			</label>
	    			</td>
				</tr>
				<tr class="modo1"> 
    				<td>                                                        
    				</td>
    				<td>
    				<label class="label_class">
    				Hasta:<input name="num_correlativo_hasta" type="text" maxlength="20" disabled="disabled"  size="20" onKeyPress="return solo_num(event)">
    				</label>
    				</td>
				</tr>					
				<tr class="modo1">
					<td>
						<label class="label_class">
			    		<input name="consul_recibidas" type="radio" value="fecha" onClick="activa_opcion(value)">
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
					 <td  align="center" colspan="2"><label><span id='campos' style='visibility:hidden' class = "font3">(*) </span> <span id='campos2' style='visibility:hidden'> Campos Requeridos.</span> </label></td>
				</tr>
				<tr class="modo1">		
						
					<td colspan="2" align="center">
					<input name="tmp_valor" type="hidden">
					<input class="boton" type="submit" name="consultar" value="Consultar" onClick="return valida(this);blockEnter = true;"  ></td>
				</tr>
									<tr >
					 <td  align="center" colspan="2">
				
			   	<?php

			   	if ($_SESSION['activo']==1)
			   	{
			   		$_SESSION['activo_sintesis']=$_SESSION['activo'];
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
                	echo "<div  id='contiene_tablas'>
						  <table  align='center' class='tabla'>	
				   	      <label>Seleccione</label>
					      <tr class='modo1' align='center'><td class='font2' ><label>N&uacute;m.</label></td><td><label>Fecha</label></td><td><label>Alto Nivel</label></td><td><label>Primer Nivel</label></td><td><label>Direcciones</label></td><td><label>Asunto</label></td>";
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
						</td>";
					}
					
					echo "</table>
						<br>
						<table>
							<tr>
								<td>	
									<a href='reporte_sintesis_recibidas.php'><img src='../assets/img/pdf.jpg' align='center' border='0' title='Imprimir' width='40' height='40'></a>
									&nbsp;&nbsp;																	
								</td>
								<td>
									&nbsp;&nbsp;	
									<a href='reporte_sintesis_excel.php'><img src='../assets/img/excel.png' align='center' border='0' title='Imprimir' width='40' height='40'></a>
								</td>
							</tr>
						</table>										
									";
								
                	}
                	else
                	{
                		echo"<label>No existen registros en este rango de b&uacute;squeda</label>
						</table>";
                	}
                	unset($_SESSION['activo']);
			   	}	
			   	echo "</div>";
				?>	
				
			
					
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
