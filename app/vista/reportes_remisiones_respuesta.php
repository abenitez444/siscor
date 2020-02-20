<?php
session_start();
include('../controlador/script.php');

include '../assets/xajax/xajax_core/xajax.inc.php';
include('../controlador/script.php');
include_once("../modelo/conexpg.php"); //Incluye class 'BaseDeDato'
include_once("../modelo/class_remisiones.php");

$MiAjax = new xajax();
$Remisiones = new Remisiones();
	


?>
<html>
<head>
<?php 
include("input.php");	

	
?>
<title>Reportes Remisiones - SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../assets/calendario/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../assets/js/dateInput.js" type="text/javascript"></script>
<script src="../assets/js/jvstools.js" type="text/javascript"></script>
<link href="../assets/calendario/SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link href="../assets/calendario/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/dateInput.css" rel="stylesheet" type="text/css" /> 
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="../assets/js/vali_reportes_remisiones_respuesta.js"></script> 
 
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
		<form class="form" autocomplete="off" name="frm_reportes_remisiones_respuesta" method="post" action="../controlador/control_reportes_remisiones_respuesta.php">	
		 
		<fieldset> <legend>Reportes Remisiones </legend>	
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
						<?php
						echo ($_SESSION['error_remisiones_consulta']);
						?></label></td></tr></table><?php 
						unset($_SESSION['error_remisiones_consulta']);
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
						   		echo ($_SESSION['error_remisiones_consulta']);
						   		?></label>
						   		</td></tr></table><?php  
						  		unset($_SESSION['error_remisiones_consulta']);
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
	    			<input name="consul_remisiones" type="radio" value="num_remision" onClick="activa_opcion(value,dire_user.value,perf_user.value)" >
	    			<span id='nucorrelativo' class = "font3" style='visibility:hidden'>*</span>	    			
	    			N&uacute;mero Correlativo:</label></td>
	    			<td>
	    			<label class="label_class">
	    			Desde:<input name="num_remision_desde" type="text" maxlength="20" disabled="disabled"  size="20" onKeyPress="return solo_num(event)">
	    			</label>
	    			</td>
				</tr>
				<tr class="modo1"> 
    				<td>                                                        
    				</td>
    				<td>
    				<label class="label_class">
    				Hasta:<input name="num_remision_hasta" type="text" maxlength="20" disabled="disabled"  size="20" onKeyPress="return solo_num(event)">
    				</label>
    				</td>
				</tr>	
				<tr class="modo1">
					<td>
						<label class="label_class">
			    		<input name="consul_remisiones" type="radio" value="fecha" onClick="activa_opcion(value,dire_user.value,perf_user.value)">
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
					 <td  align="center" colspan="2"><label><span id='campos' style='visibility:hidden' class = "font3">(*) </span> <span id='campos2' style='visibility:hidden'> Campos Requeridos.</span> </label></td>
				</tr>
				<tr class="modo1">		
					<td colspan="2" align="center"><input class="boton" type="submit" name="consultar" value="Consultar" onClick="return valida(this,perf_user.value);blockEnter = true;"  ></td>
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
			    	echo"<div  id='contiene_tablas'>
				   		 <table  align='center' class='tabla'>
		    			 <label>Seleccione</label>
						 <tr class='modo1' align='center'>
							<td class='font2' ><label>N&uacute;m.</label></td>
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
								  
							  </tr>";
								 }

				echo "</table>
						<br>
						<table align='center'>
							<tr>
								<td>	
									<a href='pdf_remisiones_general.php'><img src='../assets/img/pdf.jpg' align='center' border='0' title='Imprimir' width='40' height='40'></a>
									&nbsp;&nbsp;																	
								</td>
								<td>
									&nbsp;&nbsp;	
									<a href='excel_remisiones_general.php'><img src='../assets/img/excel.png' align='center' border='0' title='Imprimir' width='40' height='40'></a>
								</td>
							</tr>
						</table>
					</div>";					
					
			    	}
                	else
                	{
                		echo"<label>No existen registros en este rango de b&uacute;squeda</label>";
                	}
                	unset($_SESSION['activo']);
			   		
				
			   	}
					 ?><input type="hidden" name="dire_user" value="<?php echo $_SESSION['direcciones_user'];?>" >
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
