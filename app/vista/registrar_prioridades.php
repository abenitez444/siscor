<?php
session_start();
include '../assets/xajax/xajax_core/xajax.inc.php';
include('../controlador/script.php');
include_once("../modelo/conexpg.php"); //Incluye class 'BaseDeDato'
?>
<html>
<head>
<title>Registro de Prioridades - SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="../assets/js/vali_prioridades.js"></script> 
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
			if ($_SESSION['modi']!=1){
			require_once("menu.php"); 
			}
			?>
			</div>
	
		<div id="central">
		
		<br>
			<form class="form2" autocomplete="off" name="frm_alto_nivel" method="post" action="../controlador/control_prioridades.php">			
	
		<fieldset> <legend>Registro de Prioridades</legend>
		
					<span id="error" id="tabla_msj"></span>
					<?php if ($_SESSION['estatus_msj']==1)
						{?>
						<table id="tabla_msj" align="center"><tr><td>
						<img src="../assets/img/cancel.png" > 
						</td>
						<td>
						<label class="label_corr"> 						
						<?php echo ($_SESSION['error_prioridades']);?></label></td></tr></table><?php 
						unset($_SESSION['error_prioridades']);
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
						   <?php echo ($_SESSION['error_prioridades']);?></label></td></tr></table><?php  
						  unset($_SESSION['error_prioridades']);
						  unset($_SESSION['estatus_msj']);
						  }
						}?>
			 <br>
			<table align="center" class="tabla" width="650px">
				

				<tr class="modo1">
					<td width="250px"><label><span class = "font3">* </span>Nombre:</label></td> 
				   	<td><input name="nb_prioridades" type="text" maxlength="50" size="60" value ="<?php echo ($_SESSION['nombre_prioridades']);?>" ></td>
				</tr>
				<tr class="modo1">
					<td  align="center" colspan="2"><label><span class = "font3">(*)</span> Campos Requeridos.</label></td>
				</tr>
				
				<tr class="modo1">	
				
				<?php 
				if ($_SESSION['boton']==""){
					$_SESSION['boton']="Guardar";
				}
				if ($_SESSION['ingresar']==1 && $_SESSION['modificar']==1)
				{
					echo" <td colspan='2' align='center'>
						  <input class='boton' type='submit' name='enviar' value=".$_SESSION['boton']." onClick='return valida(this);blockEnter = true;'>
						  ";
		 	
				}
				if ($_SESSION['ingresar']==1 && $_SESSION['modificar']==0)
				{
					echo" <td colspan='2' align='center'>
			 			  <input class='boton' type='submit' name='enviar' value=".$_SESSION['boton']." onClick='return valida(this);blockEnter = true;'>
			 			  ";
		 	
				}
				if ($_SESSION['ingresar']==0 && $_SESSION['modificar']==1)
				{
					if($_SESSION['boton']!="Guardar")
					{
						echo" <td colspan='2' align='center'>
			 				  <input class='boton' type='submit' name='enviar' value=".$_SESSION['boton']." onClick='return valida(this);blockEnter = true;'>
			 				  ";
		 			}
				}					
			 	if ($_SESSION['modi']==1)
			 	{
		 				echo" <input class='boton' type='submit' name='regresar' value='Regresar'>";
    		 	}?>
				 	</td>
				</tr>
				
				
					<tr class="modo1">
					
				   	<?php	
					if($_SESSION['id_prioridades'] ==""){
				   $id= $_SESSION['campoIdPrioridades'];
				   $nombre=$_SESSION['campoNombrePrioridades'];
				   $cantidad=$_SESSION['cantidad'];
				  
				   
				   if ($id == 0 || $id == '0')
				   {
                       echo "<label>No hay Registros</label>";
               	   }
               	   else
               	   {
       			      echo  "<br>	<table class='tabla' align='center' >
                             <tr class='modo1'>
							 <td class='font1' align='left'>Descripci&oacute;n</td>";
       			      		if ($_SESSION['modificar']==1 || $_SESSION['eliminar']==1)
							 {
							 	echo"<td class='font1' align='raight'>Opciones</td>";	
							 }
	                               
                               for ($index = 0; $index < $cantidad; $index++) 
                               {
                                       echo "<tr class='modo1'>
                                       		 <td class='font2' align='left'>" . $nombre[$index] . "</td>";
                                       if ($_SESSION['modificar']==1 && $_SESSION['eliminar']==1 )
                               		   {		 
                                       		echo" <td class='font2' align='center'><a href='../controlador/control_prioridades.php?form=mod&id=" . $id[$index] . "'>
                                       			  <img src='../assets/img/edit.png'  border='0' title='Modificar' ></a>
                                       			  <a href='../controlador/control_prioridades.php?form=eli&id=" . $id[$index] . "' onClick='return confirma();'>
                                       			  <img src='../assets/img/eliminar.png'  border='0' title='Eliminar' ></a></td></tr>";                                
                               		   }
                               		   else if ($_SESSION['modificar']==1 && $_SESSION['eliminar']==0 )
                               		   {
                               		   		echo" <td class='font2' align='center'><a href='../controlador/control_prioridades.php?form=mod&id=" . $id[$index] . "'>
                                       			  <img src='../assets/img/edit.png'  border='0' title='Modificar' ></a>
                                       			  </td></tr>";
                               		   }
                               		   else if($_SESSION['modificar']==0 && $_SESSION['eliminar']==1)
                                       {
                               				echo " <td class='font2' align='center'><a href='../controlador/control_prioridades.php?form=eli&id=" . $id[$index] . "' onClick='return confirma();'>
                                       			   <img src='../assets/img/eliminar.png'  border='0' title='Eliminar' ></a></td></tr>";
                                       		  
                              
                               		   }
                               }
                               echo "<table>";
                               
                    }                        
}   															
							?>	
              
				</tr>
		</table>
		<input name="id_prioridades" type="hidden" maxlength="10" size="60" value ="<?php echo ($_SESSION['id_prioridades']);?>" >
		
		
	</fieldset>
</form>	
	</div><!-- cierra el div central!-->	
	</div><!-- cierra el div contenedor!-->
<div id="pie"></div>
</div> <!-- cierra el div Cuerpo!-->
</center>	
</body>
</html>