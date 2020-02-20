<?php
session_start();
include('../controlador/script.php');

?>
<html>
<head>
<?php 
	
?>
<title>Cambio de Contrase&ntilde;a - SISCOR</title>
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<link rel="stylesheet" href="../assets/css/style.css" type="text/css"/>
<script type="text/javascript" src="../superfish_menu/menus/js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="../superfish_menu/menus/js/password_strength_plugin.js"></script>

<script type="text/javascript" src="../assets/js/vali_cambio_pass.js"></script> 

</head>
<body>
<center>
<div id="cuerpo"> 
	<div id="banner"></div>	<!--Fin de 'banner'-->
	<div id="cintillo"></div><!--Fin de 'cintillo'-->
	<div id="superior"></div>
		<?php
		if ($_SESSION['reset']!='t')
		{
			echo" <div id='sesion'> Bienvenido(a): [";echo $_SESSION['nombre_user']; echo"][<a href='../controlador/control_session.php'>Cerrar Sesión</a>]</div>";
		}
		?>
   	<div id="contenedor">
	<div id="izquierda">
		<?php
		if ($_SESSION['reset']!='t')
		{
			require_once("menu.php");
		}
		?>
	</div>
	<div id="central">
		<br>
		<form class="form" autocomplete="off" name="frm_remisiones" method="post" action="../controlador/control_cambio_pass.php">	
		<fieldset>
		<legend>
			Cambio de Contrase&ntilde;a		
		</legend>	
		<span>
		
        				<?php
        				if ($_SESSION['estatus_msj']==1)
						{
						
						 echo " <table id='tabla_msj' align='center'>
						 		<tr>
						 		<td>
									<img src='../assets/img/cancel.png' height='15' border='0'>
						 		</td>
								<td>
								<label class='label_corr'>";  
									echo $_SESSION['error_cambio_pass'];
						 echo " </label>
						 		</td>
						        </tr>
						        </table>";
									unset($_SESSION['error_cambio_pass']);
						            unset($_SESSION['estatus_msj']);
						}
					    else
						{ 
							if($_SESSION['estatus_msj']==2) 
						  	{
						  	
						  		echo " <table id='tabla_msj' align='center'>
						  			   <tr>
						  			   <td>
						  			   	  <img src='../assets/img/accept.png' height='15' border='0'>
						  			   </td>
						  			   <td>
						  			   <label class='label_corr'>";
						   				  echo $_SESSION['error_cambio_pass'];
						   		echo " </label
						   			   </td>
						   		       </tr>
						   		       </table>";  
						  			   unset($_SESSION['error_cambio_pass']);
						  			   unset($_SESSION['estatus_msj']);
						  	}
						}
						?>
	 </span><br>
			<table align="center" class="tabla"  width="650px">
				<tr class="modo1" > 
			    			<td width="325px"><label class="label_class">                                                        
			    			<span class = "font3">* </span> Contrase&ntilde;a actual:</label></td>
			    			<td><input name="pass_actual" align="middle" type="password" maxlength="8" size="15" ></td>
				</tr>
				<tr class="modo1"> <!-- onClick="this.form.num_correlativo.disabled = !this.checked;num_correlativo.value = ''" -->
			    			<td><label class="label_class">                                                        
			    			 <span class = "font3">* </span> Nueva Contrase&ntilde;a</label></td>
			    			<td><input name="pass_nuevo" class="pass_nuevo" type="password" align="middle" maxlength="8" size="15" >
							<input type="hidden" name="user_name" id="user_id_adv"/></td>
				</tr>
				<tr class="modo1"> <!-- onClick="this.form.num_correlativo.disabled = !this.checked;num_correlativo.value = ''" -->
			    			<td><label class="label_class">                                                        
			    			<span class = "font3">* </span> Confirmar Nueva Contrase&ntilde;a</label></td>
			    			<td><input name="pass_confir" type="password" align="middle" maxlength="8" size="15" ></td>
				
				</tr>
				
				<tr class="modo1">
				<td></td>						
				<td> <img src="captcha.php" width="100" height="30" vspace="3"><br></td>
				</tr>
				<tr class="modo1">
		    			<td ><label><span class="font3">* </span>Introduzca los caracteres <br> de la imagen:</label></td>
						<td ><label><?php echo ($_SESSION['error_login']); ?></label><br>
                        <input name="tmptxt" type="text" size="15"/></td>
				</tr>
				<tr class="modo1">
					 <td  align="center" colspan="2"><label><span class = "font3">(*)</span> Campos Requeridos.</label></td>
				</tr>				
				<tr class="modo1">		
					<td colspan="2" align="center">
					
						<input class="boton" type="submit" name="cambiar" value="Cambiar" onClick="return valida(this);blockEnter = true;"  >								
                       
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