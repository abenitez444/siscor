<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_perfiles.php");

?>
<html>
<head>
<title>Registro de Perfiles - SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="../assets/js/vali_perfiles.js"></script> 
<?php
$perfiles = new perfiles();

$vista="select * from vista_perfiles where  cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user']." order by nb_perfiles";
$resultado = $perfiles->MostrarVista($vista);
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
			<?php require_once("menu_admin.php") ?>
		</div>
		<div id="central">
		
		<br>
			<form class="form2" autocomplete="off" name="frm_perfiles" method="post" action="../controlador/control_perfiles.php">			
	
		<fieldset> <legend>Registro de Perfiles</legend>
				<span id="error" id="tabla_msj"></span>
					<?php if ($_SESSION['estatus_msj']==1)
						{?>
						<table id="tabla_msj" align="center"><tr><td>
						<img src="../assets/img/cancel.png">
						</td>
						<td>
						<label class="label_corr"> 						 
						<? echo ($_SESSION['error_perfiles']);?></label></td></tr></table><? 
						unset($_SESSION['error_perfiles']);
						unset($_SESSION['estatus_msj']);
						}
					      else
						{ if($_SESSION['estatus_msj']==2) 
						  { ?>
						  <table id="tabla_msj" align="center"><tr><td>
						  <img src="../assets/img/accept.png" >
						</td>
						<td>
						<label class="label_corr"> 						   							
						   <? echo ($_SESSION['error_perfiles']);?></label></td></tr></table><?  
						  unset($_SESSION['error_perfiles']);
						  unset($_SESSION['estatus_msj']);
						  }
						}?>
			 <br>
			<table align="center" class="tabla">
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Nombre:</label></td> 
				   	<td><input name="nb_perfiles" type="text" maxlength="50" size="60" value ="<?php echo ($_SESSION['nombre']);unset($_SESSION['nombre']);?>" ></td>
				</tr>
				<tr class="modo1">
					<td  align="center" colspan="2"><label><span class = "font3">(*)</span> Campos Requeridos.</label></td>
				</tr>
				<tr class="modo1">	
				
				<?php 
/*				if ($boton==""){
					
					$boton = "Guardar";
					}*/
				
				if ($_SESSION['boton']==""){
				$_SESSION['boton']="Guardar";
					 
				}
				
				?>	
				<!-- 	<td colspan="2" align="center"><input class="boton" type="submit" name="enviar" value="<?php echo $boton; ?>" onClick="return valida(this);blockEnter = true;"  ></td>
				 -->
				 	<td colspan="2" align="center"><input class="boton" type="submit" name="enviar" value="<?php echo ($_SESSION['boton']) ?>" onClick="return valida(this);blockEnter = true;"  ></td>
				</tr>
		</table>
	<input name="id_perfiles" type="hidden"  value ="<?php echo ($_SESSION['id']);?>">

	<br>
	<table class="tabla" align="center">
      <tr class="modo1">
        <td class='font1'>Descripci&oacute;n</td>
        <td class='font1'>Opciones</td>
        
      </tr>
    	<?php if (!$resultado->EOF){ ?>   
 		
 			<?php while(!$resultado->EOF){ ?> 		
 				<tr class="modo1">		
 			
 					<td class='font2'><?php echo $resultado->fields["nb_perfiles"]; ?></td>
 	
 					<td align="center" >
 <a href="../controlador/control_perfiles.php?form=mod_an&id_an=<?php echo $resultado->fields["cd_perfiles"]; ?>&nombre_an=<?php echo $resultado->fields["nb_perfiles"]; ?>"><img src='../assets/img/edit.png'  border='0' title='Modificar' ></a>
 <a href="../controlador/control_perfiles.php?form=eli_an&id_an=<?php echo $resultado->fields["cd_perfiles"]; ?>&nombre_an=<?php echo $resultado->fields["nb_perfiles"]; ?>" onClick='return confirma();'><img src='../assets/img/eliminar.png'  border='0' title='Eliminar'></a>
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
	</fieldset>
</form>	
	</div><!-- cierra el div central!-->	
	</div><!-- cierra el div contenedor!-->
<div id="pie"></div>
</div> <!-- cierra el div Cuerpo!-->
</center>	
</body>
</html>