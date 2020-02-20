<?php
session_start();
include('../controlador/script.php');
include('../controlador/script_tu.php');
include_once("../modelo/class_alto_nivel.php");

?>
<html>
<head>
<title>Registro de Alto Nivel - SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="../assets/js/vali_alto_nivel.js"></script> 
<?php
$alto_nivel = new alto_nivel();
$vista="select * from vista_mostrar_alto_nivel where  cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user']." order by nb_alto_nivel";
$resultado = $alto_nivel->MostrarVista($vista);
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
			if ($_SESSION['modi']!=1)
			{
				require_once("menu_admin.php");
			}
			?>
		</div>
		<div id="central">
		
		<br>
			<form class="form2" autocomplete="off" name="frm_alto_nivel" method="post" action="../controlador/control_alto_nivel.php">			
	
		<fieldset> <legend>Registro de Alto Nivel</legend>
				<span id="error" id="tabla_msj"></span>
					<?php if ($_SESSION['estatus_msj']==1)
						{?>
						<table id="tabla_msj" align="center"><tr><td>
						<img src="../assets/img/cancel.png"> 
						</td>
						<td>
						<label class="label_corr"> 						
						<?php echo ($_SESSION['error_alto_nivel']);?></label></td></tr></table><?php 
						unset($_SESSION['error_alto_nivel']);
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
						   <?php echo ($_SESSION['error_alto_nivel']);?></label></td></tr></table><?php  
						  unset($_SESSION['error_alto_nivel']);
						  unset($_SESSION['estatus_msj']);
						  }
						}?>
			 <br>
			<table align="center" class="tabla">
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Nombre:</label></td> 
				   	<td><input name="nb_alto_nivel" type="text" maxlength="50" size="60" value ="<?php echo ($_SESSION['nombre']);unset($_SESSION['nombre']);?>" ></td>
				</tr>
				<tr class="modo1">
					<td  align="center" colspan="2"><label><span class = "font3">(*)</span> Campos Requeridos.</label></td>
				</tr>
				<tr class="modo1">	
				
				<?php 
				
				if ($_SESSION['boton']=="")
				{
					$_SESSION['boton']="Guardar";
				}
								
				 	echo "<td colspan='2' align='center'>";
				if($_SESSION['eliminar']!=1)
				{
				 	echo "<input class='boton' type='submit' name='enviar' value=".$_SESSION['boton']." onClick='return valida(this);blockEnter = true;'>";
				}			
				if ($_SESSION['modi']==1)
				{
				 	echo" <input class='boton' type='submit' name='regresar' value='Regresar' onClick='return valida(this);blockEnter = true;'>";
			 	}
			 	?>
			 	<!-- </td> -->
				</tr>
		</table>
	<input name="id_alto_nivel" type="hidden"  value ="<?php echo ($_SESSION['id']);?>">

	<br>
	
	
	<?php 
	
	if ($_SESSION['id']=="")
	{
	?>
	<table class="tabla" align="center">
      <tr class="modo1">
        <td class='font1'>Descripci&oacute;n</td>
        <td class='font1'>Opciones</td>
        
      </tr>
    	<?php if (!$resultado->EOF){ ?>   
 		
 			<?php while(!$resultado->EOF){ ?> 		
 				<tr class="modo1">		
 			
 					<td class='font2'><?php echo $resultado->fields["nb_alto_nivel"]; ?></td>
 	
 	
 	
 					<td align="center" >
 					
 <a href="../controlador/control_alto_nivel.php?form=mod_an&id_an=<?php echo $resultado->fields["cd_alto_nivel"]; ?>&nombre_an=<?php echo $resultado->fields["nb_alto_nivel"]; ?>"><img src='../assets/img/edit.png'  border='0' title='Modificar' ></a>
 <a href="../controlador/control_alto_nivel.php?form=eli_an&id_an=<?php echo $resultado->fields["cd_alto_nivel"]; ?>&nombre_an=<?php echo $resultado->fields["nb_alto_nivel"]; ?>" onClick='return confirma();'><img src='../assets/img/eliminar.png'  border='0' title='Eliminar'></a>
 					</td>
 				 </tr>
 					 					
 			<?php	
 				$resultado->MoveNext();
 			} ?>
 		
 			     
    	 <?php }else{ ?>
					<tr>
						<td>No hay registros</td>
					</tr>
    	
    	<?php }?>  
     	
			</table>
			
	<?php 
	}
	?>		
			
	</fieldset>
</form>	
	</div><!-- cierra el div central!-->	
	</div><!-- cierra el div contenedor!-->
<div id="pie"></div>
</div> <!-- cierra el div Cuerpo!-->
</center>	
</body>
</html>