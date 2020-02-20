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
<title>Respuesta Oficios Recibidos - SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../assets/calendario/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../assets/js/dateInput.js" type="text/javascript"></script>
<script src="../assets/js/jvstools.js" type="text/javascript"></script>
<link href="../assets/calendario/SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link href="../assets/calendario/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/dateInput.css" rel="stylesheet" type="text/css" /> 
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="../assets/js/vali_respuesta_recibidas.js"></script> 
 
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
			if( $_SESSION['RespuestaOfic']!=1)
			{
				require_once("menu.php");
			}
		?>
	</div>
	<div id="central">
		<br>
		<form class="form" autocomplete="off" name="frm_recibidas" method="post" action="../controlador/control_respuesta_oficios.php">	
		<fieldset> <legend>Incluir Respuesta </legend>	
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
						   		</td></tr></table><?php  
						  		unset($_SESSION['error_recibidas']);
						  		unset($_SESSION['estatus_msj']);
						  		}
							}
						?>
	 </span><br>
			<table align="center" class="tabla" width="650px">
				<tr class="modo1"  > 
				    <td width="250px" colspan="2" align="center"><label class="label_class">                                                        
				    
				    <?php 
				    if($_SESSION['RespuestaOfic']==1)
				    {
				    ?>	
				    Por Favor incluya el N&uacute;mero del Oficio de respuesta
				    <?php 
				    }
				    else
				    {
				    ?>	
				    Por Favor incluya el N&uacute;mero del Oficio al cual desea asignar la respuesta
				    
				    <?php				    	
				    }
				    ?>
				    			    
				    
				    </label></td>
				    
				    
				</tr>
				<tr class="modo1"> 
			    			<td><label class="label_class"><span class = "font3">* </span>                                                        
			    			A&ntilde;o:</label></td>
			    			<td><input name="ano_consulta" align="middle" type="text" maxlength="4" size="60" onKeyPress="return solo_num(event)"></td>
				</tr>
				<tr class="modo1">
			    			<td><label class="label_class"><span class = "font3">* </span>                                                        
			    			 N&uacute;mero Correlativo:</label></td>
			    			<td><input name="num_correlativo" type="text" align="middle" maxlength="20" size="60" onKeyPress="return solo_num(event)"></td>
				</tr>				
				<tr class="modo1">
					 <td  align="center" colspan="2"><label><span class = "font3">(*)</span> Campos Requeridos.</label></td>
				</tr>				
				<tr class="modo1">		
				
					<td colspan="2" align="center">
					<input name="tmp_valor" type="hidden">	
					
									<?php if ($_SESSION['RespuestaOfic']==1)
							{
					?>
						<input class="boton" type="submit" name="cancelar_oficios" value="Cancelar" >
						<input class="boton" type="submit" name="consultar" value="Consultar" onClick="return valida(this);blockEnter = true;"  >
						
					<?php 
							}
							else
							{
					?>
					<input class="boton" type="submit" name="consultar" value="Consultar" onClick="return valida(this);blockEnter = true;"  >								
							<?php 
							}
							?>	
						</td>
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
