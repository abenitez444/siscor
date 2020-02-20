<?php
session_start();
?>
<html>
<head>

<!-- Piwik -->
<!-- <script type="text/javascript"> 
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://sistemas.caracas.gob.ve/estadisticas//";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
    g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();

</script>
<noscript><p><img src="http://sistemas.caracas.gob.ve/estadisticas/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript> -->
<!-- End Piwik Code -->

<title>Iniciar Sesi&oacute;n-SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="assets/js/vali_inicio.js"></script> 
</head>
<body>
<center>
<div id="cuerpo"> 
	<div id="banner"></div>	<!--Fin de 'banner'-->
	<div id="cintillo"></div><!--Fin de 'cintillo'-->
	<div id="superior"></div>
   	<div id="contenedor">
		<div id="izquierda">
			
		</div>	
		<div id="central">
		<form name="frm_nuevo_usuario" autocomplete="off" method="post" action="controlador/control_inicio.php"> 
			<fieldset class="fieldsetInicio"> <legend> Usuario Registrado</legend>
	        <span>
        <?php if ($_SESSION['estatus_msj']==1){?>
         <table id="tabla_msj" align="center">
         	<tr>
         		<td> 
         			<img src="assets/img/cancel.png" height="15" border="0">
         		</td>	
         		<td>
         			<label class="label_corr">	
          			<? echo ($_SESSION['error_inicio']);?>
          			</label>
          		</td>
          	</tr>
         </table><?php  
         unset($_SESSION['error_inicio']);
         unset($_SESSION['estatus_msj']);
         }
         if ($_SESSION['estatus_msj']==2){?>
         <table id="tabla_msj" align="center">
         	<tr>
         		<td>
         			<img src="assets/img/accept.png" height="15" border="0">
         		</td>
         		<td>
         			<label class="label_corr">
         			<? echo ($_SESSION['error_inicio']);?>
         			</label>
         		</td>
         	</tr>
         </table><?php  
         unset($_SESSION['error_inicio']);
         unset($_SESSION['estatus_msj']);
         }
         ?> 
	 </span><br>		
				<table align="center" class="tabla"><label class="titulo">
					<tr class="modo1">
						<td><label>Usuario:</label></td>
						<td><input type="text" name="usuario" maxlength="20" size="10"></td>
					</tr>
					<tr class="modo1">
						<td><label>Contrase&ntilde;a:</label></td>
						<td><input type="password" name="password" maxlength="8"></td>
					</tr>
				
					<tr class="modo1" >						
			<td></td>
			<td align="center"><img src="vista/captcha.php" width="100" height="30" vspace="3"><br>  </td>
		</tr>
		<tr class="modo1">
		    <td><label>Introduzca los caracteres de la imagen:</label></td>
			<td><input name="tmptxt" type="text" /><br>
			</td>
		</tr>
		<tr class="modo1">
						<td colspan="2" align="center">
						<input class="boton" type="submit" name="entrar" value="Iniciar Sesión" onClick="return valida(this);blockEnter = true;"  ></td>
					</tr>
				</table>
	</fieldset>
		</form>
 
	</div>		
	</div><!-- cierra el div contenedor!-->
<div id="pie"></div>
</div> <!-- cierra el div Cuerpo!-->
</center>	
</body>
</html>
