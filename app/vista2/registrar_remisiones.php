<?php
session_start();
include('../controlador/script.php');
include '../assets/xajax/xajax_core/xajax.inc.php';
include('../controlador/script.php');
include_once("../modelo/conexpg.php"); //Incluye class 'BaseDeDato'nombre
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
<title>Registro de Remisiones - SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


<script src="../assets/calendario/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../assets/js/dateInput.js" type="text/javascript"></script>
<script src="../assets/js/jvstools.js" type="text/javascript"></script>
<link href="../assets/calendario/SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link href="../assets/calendario/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/dateInput.css" rel="stylesheet" type="text/css" /> 
<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>
<script type="text/javascript" src="../assets/js/vali_remisiones.js"></script> 

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
			if ($_SESSION['modif']!=1 && $_SESSION['RespuestaRemisiones']!=1 && $_SESSION['ConsulRespuestaRemisiones']!=1)
			{
			require_once("menu.php");
			}
			?>
		</div>
		<div id="central">
		
		<br>
			<form class="form2" autocomplete="off" name="frm_remisiones" method="post" action="../controlador/control_remisiones.php">	
			
		<fieldset> <legend>Datos de la Remisi&oacute;n </legend>	
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
						echo ($_SESSION['error_remisiones']);
						?></label></td></tr></table><? 
						unset($_SESSION['error_remisiones']);
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
						   		echo ($_SESSION['error_remisiones']);
						   		?></label>
						   		<br>
						   		<br>
						   		<label class="label_corr">
						   		<?php 
						   		echo ($_SESSION['correlativo']);
						   		?></label></td></tr></table><?  
						  		unset($_SESSION['error_remisiones']);
						  		unset($_SESSION['correlativo']);
						  		unset($_SESSION['estatus_msj']);
						  		}
							}
						?>
							 </span><br>
			<table align="center" class="tabla" width="650px">
								<?php
					if($_SESSION['modif']==1 || $_SESSION['RespuestaRemisiones']==1 || $_SESSION['ConsulRespuestaRemisiones']==1)
					{
					?>
						<tr class="modo1">
						<td width="250px"><label><span class = "font3">* </span>A&ntilde;o:</label>
						</td>
						<td><?php echo ($_SESSION['anio_remisiones']);?>
						</td>
						</tr>
						<tr class="modo1">
						<td><label><span class = "font3">* </span>N&uacute;m. Correlativo:</label>
						</td>
						<td><?php echo ($_SESSION['id_remisiones']);?>
						</td>
						</tr>
					<?php } ?>
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Fecha de la Remisi&oacute;n:</label></td> 
					<?php

					if($_SESSION['fecha_remision_carga']!="")
					{

						$fecha_remision=$_SESSION['fecha_remision_carga'];

						if ($_SESSION['perfil']==1)
						{
							//unset($_SESSION['fecha_remision_carga']);
							$_SESSION['disabled']="";	
						}
						else
						{
							$_SESSION['disabled']="disabled";
						}	
								
					}
					else
					{
						$fecha_remision = date("d-m-Y");
					}
					?>
				   	<td><?php 
				   	if ($_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
				   	{
				   		echo $fecha_remision;
				   	}
				   	else
				   	{
				   		Create_DateInput('fecha_remision',$fecha_remision,'','','',$_SESSION['disabled'] );	
				   	}
				   	 
				   	
				   	?></td>
				</tr>
				<tr class="modo1">
					<td>
						<label><span class = "font3">* </span>Hora de la Remisi&oacute;n:</label>
					</td>
					<td>
					<?php
					if($_SESSION['hora_remision']!="")
					{
						$hora=$_SESSION['hora_remision'];
						$minuto=$_SESSION['minuto_remision'];
						$tiempo=$_SESSION['tiempo_remision'];
						
						if ($_SESSION['perfil']==1)
						{
//							unset($_SESSION['hora_remision']);	
//							unset($_SESSION['minuto_remision']);
//							unset($_SESSION['tiempo_remision']);	
							
							$_SESSION['disabled']="";	
						}
						else
						{
							$_SESSION['disabled']="disabled";
						}	
					}
					else
					{
						$hora = date('h'); $minuto = date('i'); $tiempo=date('a');	
						$_SESSION['disabled']=" ";
						
					}
					echo "";
					
					if ($_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
				   	{
                                            if($hora<10)
                                            {
                                                    $hora="0".$hora;
                                            }
                                            if($minuto<10)
                                            {
                                            $minuto="0".$minuto;	
                                            }
                                                    echo $hora.":".$minuto." ".$tiempo;	
				   	}
					else
					{
                                            echo " 
                                            <select name=\"hora\" ".$_SESSION['disabled']." >";
                                            for ($i = 0; $i<13;$i++) 
                                            {
                                                if ($i==0)
                                                {
                                                    echo "<option value=\"--\" selected=\"selected\">- - </option>";
                                                }
                                                else 
                                                {  
                                                    echo "<option value=\"$i\"";
                                                    if ($hora=="$i") echo " selected=\"selected\"";
                                                    echo ">";echo $i;
                                                    echo "</option>";
                                                }
                                            }
                                            echo"</select> :";

                                            echo "<select name=\"minuto\" ".$_SESSION['disabled']." >";
                                            for ($j = 0; $j<60;$j++)
                                            {
                                                if ($j==0)
                                                {
                                                    echo "<option value=\"--\" selected=\"selected\">- - </option>";
                                                    echo "<option value=\"$j\"";
                                                    if ($minuto=="$j") echo " selected=\"selected\"";
                                                    echo ">";echo "00";
                                                    echo "</option>";
                                                }
                                                else 
                                                {  
                                                    echo "<option value=\"$j\"";
                                                    if ($minuto=="$j") echo " selected=\"selected\"";
                                                    echo ">";echo $j;
                                                    echo "</option>";
                                                }
                                            }  
                                            echo"</select>";

                                            echo "<select name=\"tiempo\" ".$_SESSION['disabled']." >
                                            <option value=\"--\" selected=\"selected\">- -</option>
                                            <option value=\"am\"";
                                            if ($tiempo=="am") echo " selected=\"selected\"";
                                            echo ">A.M.</option>
                                            <option value=\"pm\"";
                                            if ($tiempo=="pm") echo "selected=\"selected\"";
                                            echo" >P.M.</option>
                                            </select>";
					}
	              ?>             
                  </td>
				</tr>
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Alto Nivel:</label></td>
					<td><?php
										
				   	
				   	if (($_SESSION['direcciones_user']==0)and ($_SESSION['primer_nivel_user']==329))//329 usuarios DESPACHO ALCALDE
				   	{
                                            $_SESSION['disabled']="";
                                            if ($_SESSION['alto_nivel_seleccionado_remision']==" ")
                                            {
                                                $_SESSION['alto_nivel_seleccionado_remision']="";
                                            }                                            
				   	}
				   	else 
				   	{
                                            $_SESSION['alto_nivel_seleccionado_remision']=$_SESSION['alto_nivel_user'];
                                            $_SESSION['disabled']="disabled";
                                                
				   	}
				   		
				   	
				   	echo "<select  name=\"alto_nivel\" id=\"alto_nivel\" ".$_SESSION['disabled']."  onchange=\"xajax_llenarPrimerNivel(document.getElementById('alto_nivel').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\">";
                                        $idAltoNivel= $_SESSION['campoIdAltoNivel'];
                                        $nombreAltoNivel=$_SESSION['campoNombreAltoNivel'];
                                        $cantidadAltoNivel=$_SESSION['cantidad_alto_nivel'];
                                        $valorAltoNivel=$_SESSION['alto_nivel_seleccionado_remision'];
                                        //$valorAltoNivel=$_SESSION['alto_nivel_seleccionado'];
                                        if ($_SESSION['perfil']==1)
                                        {
                        			//unset($_SESSION['alto_nivel_seleccionado_remision']);
                                        }
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
					<td><label><span class = "font3">* </span>Primer Nivel:</label></td>
					<td>
					<div id="div_primer_nivel">
				   	<?php 
				   	if($_SESSION['primer_nivel_user']!="")
				   	{
                                            if ($_SESSION['primer_nivel_user']!=0)
                                            {
                                                if ($_SESSION['direcciones_user']!=0)
                                                {             
                                                    $_SESSION['primer_nivel_seleccionado_remision']=$_SESSION['primer_nivel_user'];
                                                    $_SESSION['disabled']="disabled";
                                                    
                                                }
                                                else
                                                {
                                                    $_SESSION['disabled']="";
                                                    if ($_SESSION['primer_nivel_seleccionado_remision']==" ")
                                                    {
                                                        $_SESSION['primer_nivel_seleccionado_remision']=$_SESSION['primer_nivel_user'];
                                                    }
                                                }
	
                                            }
                                            else 
                                            {
                                                $_SESSION['disabled']="";
                                            }
                                                
				   		echo "<select  name=\"primer_nivel\" id=\"primer_nivel\" ".$_SESSION['disabled']." onchange=\"xajax_llenarDireccion(document.getElementById('primer_nivel').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\" >";
   						$idprimer_nivel= $_SESSION['campoIdprimer_nivel'];
                                    		$nombreprimer_nivel=$_SESSION['campoNombreprimer_nivel'];
                                                $cantidadprimer_nivel=$_SESSION['cantidad_primer_nivel'];
                                                //$valorprimer_nivel=$_SESSION['primer_nivel_user'];
                                                $valorprimer_nivel=$_SESSION['primer_nivel_seleccionado_remision'];
                                                //1
                                                if ($_SESSION['perfil']==1)
						{
                                                    //unset($_SESSION['primer_nivel_seleccionado']);
						}
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
					<td><label>Direcciones:</label></td>
					<td><div id="div_direcciones">
					<?php 
					  	if($_SESSION['direcciones_user']!="")
						{
                                                    if ($_SESSION['direcciones_user']!=0)
                                                    //if ($_SESSION['direcciones_user']!=0)
                                                    {
                                                        $_SESSION['disabled']="disabled=\"disabled\"";
                                                        echo "<select  name=\"direcciones\" id=\"direcciones\" ".$_SESSION['disabled']." onchange=\"xajax_llenarunidades(document.getElementById('direcciones').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\"  >";
                                                    }
                                                    else 
                                                    {
                                                        $_SESSION['disabled']="";
                                                        echo "<select  name=\"direcciones\" id=\"direcciones\" ".$_SESSION['disabled']."   >";
                                                    }
                                                    if ($_SESSION['direcciones_seleccionado_remision']=="")
                                                    {
				   			$_SESSION['direcciones_seleccionado_remision']=$_SESSION['direcciones_user'];
                                                    }
                                                    $iddirecciones= $_SESSION['campoIddirecciones'];
                                                    $nombredirecciones=$_SESSION['campoNombredirecciones'];
                                                    $cantidaddirecciones=$_SESSION['cantidaddirecciones'];
                                                    $valordirecciones=$_SESSION['direcciones_seleccionado_remision'];
                                                    //1
                                                        if ($_SESSION['perfil']==1)
							{
                                                            //unset($_SESSION['direcciones_seleccionado_remision']);
							}
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
				if($_SESSION['direcciones_user']!=0)
				{

				
				?>
				<tr class="modo1">
					<td><label>Unidad:</label></td>
					<td><div id="div_unidades">
					<?php //echo $_SESSION['direcciones_user']; 
					
  					  	if($_SESSION['direcciones_user']!=0)
						  	{
						  		
		    			  		
		    			  		if($_SESSION['perfil']!=1 || $_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
		    			  		{
		    			  			$_SESSION['disabled']="disabled";
		    			  		}
		    			  		else
		    			  		{
		    			  			$_SESSION['disabled']="";
		    			  		} 
								echo "<label><select  name=\"unidades\" id=\"unidades\" ".$_SESSION['disabled']." onchange=\"xajax_llenarUnidades(document.getElementById('unidades').value,".$_SESSION['direcciones_user'].",".$_SESSION['alto_nivel_user'].",".$_SESSION['primer_nivel_user'].");return false;\"  onclick='todos.checked = false'>";
	   							$idUnidades= $_SESSION['campoIdUnidades'];
	                			$nombreUnidades=$_SESSION['campoNombreUnidades'];
	                			$cantidadUnidades=$_SESSION['cantidadUnidades'];
	                			$valorUnidades=$_SESSION['Unidades_seleccionado_remision'];
	                			//1
	                			if ($_SESSION['perfil']==1)
								{
	                				//unset($_SESSION['Unidades_seleccionado_remision']);
								}	
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
								if ($_SESSION['modif']!=1)
								{
								echo " <input name='todos' type='checkbox' ".$_SESSION['disabled']."
								onclick='unidades.disabled = this.checked;unidades.selectedIndex=0'";
						  		if($_SESSION['check_t']=='on')
						   		{ 
						   			echo "\"checked\""; 
						   			if ($_SESSION['perfil']==1)
									{
						   				//unset($_SESSION['check_t']);
									}
						   		}
								echo ">   Todas las Unidades</label>";	
								}
								
								
							}
					    	else
						   	{
						   /*	echo "<label><select name=\"unidades\" id=\"unidades\" disabled=\"disabled\"><option value=\"0\">-Seleccione una Direcci&oacute;n-</option></select>
						   		   <input name=\"check_todos\" type=\"checkbox\" disabled=\"disabled\">   Todas las Unidades</label>	";	
						   	*/
						   	}
			   		 	  	
					?>
					
				</div></td>
				</tr>
				<?php 
				}// fin de if($_SESSION['direcciones_user']==0)
				else{
					
					echo "<input name=\"unidad\" type=\"hidden\" value =\"0\">";
				}
				?>
				<?php
						if ($_SESSION['perfil']!=1 || $_SESSION['RespuestaRemisiones']==1 || $_SESSION['ConsulRespuestaRemisiones']==1)
						{
						echo "<tr class='modo1'>
							  <td><label>Coordinaci&oacute;n:</label></td>
							  <td><div id='div_coordinaciones'>";
					
					
	  					  	if($_SESSION['Coordinaciones_seleccionado_remision']!="")
							  	{
		  		  			  		if($_SESSION['perfil']==2  )
		    				  		{
		    				  			$_SESSION['disabled']="";
		    				  		}
		    			  			else
		    			  			{
		    			  				$_SESSION['disabled']="disabled";
		    			  			} 
									echo "<select  name=\"coordinaciones\" id=\"coordinaciones\" ".$_SESSION['disabled']." >";
		   							$idCoordinaciones= $_SESSION['campoIdCoordinaciones'];
		                			$nombreCoordinaciones=$_SESSION['campoNombreCoordinaciones'];
		                			$cantidadCoordinaciones=$_SESSION['cantidadCoordinaciones'];
		                			$valorCoordinaciones=$_SESSION['Coordinaciones_seleccionado_remision'];
		                			if ($_SESSION['perfil']==1)
									{
		                				//unset($_SESSION['Coordinaciones_seleccionado_remision']);
									}
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
						}
						   	
				echo "</div></td>
					  </tr>";
				?>
				
					<tr class="modo1">
						<td><label>Nombre Responsable:</label></td>
						<td>
						<?php 
						if ($_SESSION['perfil']==2)
						{
						?>
						<input name="nombre_responsable" type="text" maxlength="255" disabled="disabled" size="60" value ="<?php echo $_SESSION['nombre_responsable_remision'];//unset($_SESSION['nombre_responsable_remision']);?>">	
						<?php 
						}
						else
						{ 
						
							if( $_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
							{
								echo $_SESSION['nombre_responsable_remision'];
								//unset($_SESSION['nombre_responsable_remision']);
							}
							else
							{
								?>
								<input name="nombre_responsable" type="text" maxlength="255"  size="60" value ="<?php echo $_SESSION['nombre_responsable_remision'];//unset($_SESSION['nombre_responsable_remision']);?>">
								
								<?php 
								
							}
							
						}
						?>
						</td>
					</tr>
				
					<tr class="modo1">
					<td><label><span class = "font3">* </span>Prioridad:</label></td>
					<td><?php 
 	   		  		if($_SESSION['perfil']==1 )
    		  		{
    		  			$_SESSION['disabled']="";
    		  			if($_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
    		  			{
    		  				$_SESSION['disabled']="disabled";
    		  			}
    		  		}
    	  			else
    	  			{
    	  				$_SESSION['disabled']="disabled";
    	  			}
				   	echo "<select  name=\"prioridades\" id=\"prioridades\" ".$_SESSION['disabled']." >";
   			$id= $_SESSION['campoIdPrioridades'];
                	$nombre=$_SESSION['campoNombrePrioridades'];
                	$cantidad=$_SESSION['cantidad'];
                	$valor=$_SESSION['prioridades_seleccionado_remision'];
                	       
                	//1
                	if ($_SESSION['perfil']==1)
					{
                	//unset($_SESSION['prioridades_seleccionado_remision']);
					}
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
					<td><label><span class = "font3">* </span>Acci&oacute;n:</label></td>
					<td><?php 
                                                if($_SESSION['perfil']==1)
                                                {
                                                        $_SESSION['disabled']="";
                                                        if($_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
                                                        {
                                                                $_SESSION['disabled']="disabled";
                                                        }   		  			
                                                }
                                                else
                                                {
                                                        $_SESSION['disabled']="disabled";
                                                }
                                                echo "<select  name=\"acciones\" id=\"acciones\" ".$_SESSION['disabled'].">";
                                                $id= $_SESSION['campoIdAcciones'];
                                                $nombre=$_SESSION['campoNombreAcciones'];
                                                $cantidad=$_SESSION['cantidad_acciones'];
                                                $valor=$_SESSION['accion_seleccionado_remision'];
                                                //1
                                                if ($_SESSION['perfil']==1)
                                                {    
                                                //unset($_SESSION['accion_seleccionado_remision']);
                                                }
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
                                            ?>	
                                        </td>
				</tr>
				
				<?php
				
              		if($_SESSION['perfil']==1)
    		  		{

    		  			echo"
    		  				<tr class=\"modo1\">
			    			<td><label>¿Amerita Respuesta?</label></td>
			    			<td>";
			    			
    		  				if($_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
    		  				{
    		  					echo"<input name=\"amerita_respuesta\"  disabled=\"disabled\" type=\"checkbox\"";  if($_SESSION['check_amerita_respuesta_remision']==t){ echo "checked"; }//unset($_SESSION['check_amerita_respuesta_remision']);  
                                                        echo" >";
    		  				}
			    			else
			    			{
			    				echo"<input name=\"amerita_respuesta\" type=\"checkbox\"";  if($_SESSION['check_amerita_respuesta_remision']==t){ echo "checked"; } //unset($_SESSION['check_amerita_respuesta_remision']);
                                                        echo" >";
			    			}
			    			
   					  echo"</td>
							</tr> 
			    			<tr class=\"modo1\">
			    			<td><label>Observaci&oacute;n:</label></td>
			    			<td>";
   								if($_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
    		  					{
									echo $_SESSION['observacion_remision'];
    		  					}
    		  					else
    		  					{					    			
				    			echo"<textarea name=\"observacion\"  cols=\"60\" rows=\"3\">";
				    				echo $_SESSION['observacion_remision'];
		
					    			if ($_SESSION['perfil']==1)
									{
					    				//unset($_SESSION['observacion_remision']);
									}
    		  					}	
			    				echo"</textarea>
		    				
		    				</td>
							</tr>";
    		  		}
    	  			else
    	  			{
						echo" <tr class=\"modo1\">

						<td><label>¿Amerita Respuesta?</label></td>
			    			<td><input name=\"amerita_respuesta\"  disabled=\"disabled\" type=\"checkbox\"";  if($_SESSION['check_amerita_respuesta_remision']=="on"){ echo "checked";  } //unset($_SESSION['check_amerita_respuesta_remision']);
                                                echo" >";
			    				if ($_SESSION['perfil']==1)
								{	
									//unset($_SESSION['check_amerita_respuesta_remision']); 
								}
			    			
    	  				echo "</td>
							  </tr>
							  <tr class=\"modo1\">
			    			<td><label>Observaci&oacute;n:</label></td>
			    			<td><textarea name=\"observacion\"  cols=\"60\" rows=\"3\" disabled =\"disabled\" >";
			    		echo ($_SESSION['observacion_remision']);
			    		
			    		if ($_SESSION['perfil']==1)
						{
							//unset($_SESSION['observacion_remision']); 
						}
			    		echo "</textarea></td>
						</tr>";
    	  			}
    	  			if ($_SESSION['modif']==1 || $_SESSION['RespuestaRemisiones']==1 || $_SESSION['ConsulRespuestaRemisiones']==1)
    	  			{
    	  				
      					$fecha_paralafirma=$_SESSION['fe_paralafirma'];
      					
						$fecha_firmada=$_SESSION['fe_firmada'];
						$fecha_despachada=$_SESSION['fe_despachada'];	
    	  				
    	  				echo "	<tr class=\"modo1\">
			    				<td><label>Enviada para la Firma:</label></td>
			    				<td>";
    	  						if($_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
    		  					{
    		  						echo $fecha_paralafirma;
    		  					}
    		  					else
    		  					{
			    				Create_DateInput('fecha_paralafirma',$fecha_paralafirma,'','','',$_SESSION['disabled'] );
    		  					}
		    			echo "	</td>
								</tr>
								<tr class=\"modo1\">
			    				<td><label>Firmada</label></td>
			    				<td>";
		    					if($_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
    		  					{
    		  						echo $fecha_firmada;
    		  					}
    		  					else
    		  					{
			    				Create_DateInput('fecha_firmada',$fecha_firmada,'','','',$_SESSION['disabled'] );
    		  					}
	    				echo "	</td>
								</tr>
								<tr class=\"modo1\">
			    				<td><label>Despachada:</label></td>
			    				<td>";
    	    					if($_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
    		  					{
    		  						echo $fecha_despachada;
    		  					}
    		  					else
    		  					{	    				
			    				Create_DateInput('fecha_despachada',$fecha_despachada,'','','',$_SESSION['disabled'] );
    		  					}
			    				echo"</td>
								</tr>";
          				echo "	<tr class=\"modo1\">
			    				<td><label>Recibido por:</label></td>
			    				<td>";
    	    					if($_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
    		  					{
    		  						echo $_SESSION['nb_recibidapor'];
    		  					}
    		  					else
    		  					{
			    				echo "<input name=\"nombre_recibidapor\" type=\"text\"" ;echo $_SESSION['disabled']; echo " \" maxlength=\"50\"  size=\"60\" value =\""; echo $_SESSION['nb_recibidapor'];echo"\">";
			    				}
			    		echo"	</td>
								</tr>
								<tr class=\"modo1\">
			    				<td><label>Fecha de Recibido:</label></td>
			    				<td>";
          						$fecha_recibidapor=$_SESSION['fecha_recibidapor_remisiones'];
           		       			if($_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
    		  					{
    		  					 echo $fecha_recibidapor;
    		  					}
    		  					else
    		  					{
			    				Create_DateInput('fecha_recibidapor',$fecha_recibidapor,'','','',$_SESSION['disabled'] );
    		  					}
						echo "	</td>
								</tr>";
								
								$hora_recibida=$_SESSION['hh_recibidapor'];
							
								if ($_SESSION['perfil']==1)
								{
									//unset($_SESSION['hh_recibidapor']);	
								}
								$minuto_recibidapor=$_SESSION['mm_recibidapor'];
							
								if ($_SESSION['perfil']==1)
								{
									//unset($_SESSION['mm_recibidapor']);	
								}
								$tiempo_recibidapor=$_SESSION['tt_recibidapor'];
							
								if ($_SESSION['perfil']==1)
								{
									//unset($_SESSION['tt_recibidapor']);
								}
							
		    			echo "	</td>
								</tr>
								<tr class=\"modo1\">
			    				<td><label>Hora de recibida:</label></td>								
								<td>";
           		       			if($_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
    		  					{
    		  						if($hora_recibida<10)
    		  						{
    		  							$hora_recibida="0".$hora_recibida;
    		  						}
    		  						if($minuto_recibidapor<10)
    		  						{
    		  						$minuto_recibidapor="0".$minuto_recibidapor;	
    		  						}
    		  						echo $hora_recibida.":".$minuto_recibidapor." ".$tiempo_recibidapor;
    		  					}
								else
								{
									echo" <select name=\"hora_recibidapor\" ".$_SESSION['disabled']." >";
					    			for ($a = 0; $a<13;$a++) 
							  				{
												if ($a==0)
							  						{
							  							echo " <option value=\"0\" selected=\"selected\">- - </option>";
							  						}
							  						else 
							  						{  
							  							echo "<option value=\"$a\"";
							  							if ($hora_recibida=="$a") echo " selected=\"selected\"";
							  							echo " >";echo $a;
							  							echo " </option>";
							  						}
							  						
							  				}
				             		echo "</select>";
				             		//echo 'a'.$minuto_recibidapor;
				             		echo "<select name=\"minuto_recibidapor\" ".$_SESSION['disabled']." >"; 
				             				for ($j = 0; $j<60;$j++)
			                  				{
			                  					$paso=1;	
												// es la primera vuelta del for
			                  					if ($j==0)
			                  					{
			                  						// en la primera vuelta del for se valida que sea 61 y blanco los minutos
			                  						if ($minuto_recibidapor==61 || $minuto_recibidapor=="")
			                  						{ 
			                  							// se coloca esta variable de control "paso" en "0" para que cuando siga recorriendo el for
			                  							// no entre a la validacion if ($paso==1)
			                  							$paso=0;
			                  							
			                  							echo " <option value=\"61\" selected>- -</option>";
			                  							echo " <option value=\"0\">00</option>";
			                  							
			                  						}
			                  						else
			                  						{ 
			                  							echo " <option value=\"61\" >- -</option>";
			                  						}
			                  					}
			                  					
			                  					// validacion para que continue con el for
			                  					if ($paso==1)
			                  					{
													// valida para que coloque en la opcion del combo "00" y la seleccione
													if ($j==0)
			                  						{
														if ($minuto_recibidapor==0)
														{
			                  								echo " <option value=\"0\" selected >00</option>";
														}
														
														else
														{
															echo " <option value=\"0\">00</option>";
														}
			                  						}
			                  							
												// else continua de llenar el combo de minutos
												else
												{
													echo " <option value=\"$j\"";	
			                  						if ($minuto_recibidapor=="$j") echo "selected=\"selected\"";
						  							echo " >";echo $j;
						  							echo " </option>";
												}
			                  					}
			                  					
			                  					
			                  				}			  
				              		echo "  </select>
				   		          			<select name=\"tiempo_recibidapor\" ".$_SESSION['disabled']." >
			                    			<option value=\"0\" selected=\"selected\">- -</option>
			                    			<option value=\"am\"";
				             				if ($tiempo_recibidapor=="am") echo " selected=\"selected\"";
				             				echo " >A.M.</option>
			                    			<option value=\"pm\"";
			                    			if ($tiempo_recibidapor=="pm") echo " selected=\"selected\"";
			                    			echo " >P.M.</option>
			                  				</select>";
						    			
			    	  				}
    	  			}	
    	  		?> 	
			
				<tr class="modo1">
			    			<td><label>Respondida:</label></td>
			    			<td>
			    				<?php 
								if ($_SESSION['perfil']!=3)
								{
								?>
									<input name="check_respondida" type="checkbox" <?php	if ($_SESSION['check_r']=="on" ||$_SESSION['check_r']=="t") { echo "checked"; }?> onclick="respondida_observacion.disabled = !this.checked;respondida_observacion.value=''" disabled='disabled'>
			    		    	<?php 
			    		    	if($_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
    		  					{
    		  						echo $_SESSION['respondida_observacion_remision']; 
    		  					}
    		  					else
    		  					{
    		  					?>	
			    					<textarea name="respondida_observacion"  cols="60" rows="3"disabled ="disabled"><?php echo $_SESSION['respondida_observacion_remision'] ; if ($_SESSION['perfil']==1){//unset($_SESSION['respondida_observacion_remision']);
                                                                    }?></textarea>
                                                                
			    				<?php
    		  					} 
								}
								else
								{ 
								if ($_SESSION['check_r']=="t" || $_SESSION['check_r']=="on" )
								{
								?>
									<input name="check_respondida" type="checkbox" <?php echo "checked";if ($_SESSION['perfil']==1){//unset($_SESSION['check_r']);
                                                                        }?> onclick="respondida_observacion.disabled = !this.checked;respondida_observacion.value=''">
                                                                }

									<textarea name="respondida_observacion"  cols="60" rows="3"><?php echo $_SESSION['respondida_observacion_remision'];if ($_SESSION['perfil']==1){//unset($_SESSION['respondida_observacion_remision']);
                                                                        }?></textarea>
                                                                }
								<?php 
								}
								else
								{
								
								?>
									<input name="check_respondida" type="checkbox" <?php if ($_SESSION['check_r']=="t") { echo "checked"; }if ($_SESSION['perfil']==1){//unset($_SESSION['check_r']);
                                                                        }?> onclick="respondida_observacion.disabled = !this.checked;respondida_observacion.value=''">	
                                                                }

									<textarea name="respondida_observacion"  cols="60" rows="3"disabled ="disabled"><?php echo $_SESSION['respondida_observacion_remision'];if ($_SESSION['perfil']==1){//unset($_SESSION['respondida_observacion_remision']);
                                                                        }?></textarea>
                                                                }
								<?php 
								}
								}
								
								?>
								
			    			</td>
				</tr>
				<?php 
				if ($_SESSION['perfil']!=1)
				{
				
				?>
				<tr class="modo1">
                                                <td><label>N&uacute;m. Correspondencia<br> a Remitir:</label></td>
			    			<td><input name="id_remitir" type="text" maxlength="255"  disabled ="disabled" size="60" onKeyPress="return solo_num(event)" value ="<?php echo $_SESSION['id_remitir_remision'];if($_SESSION['perfil']==1){ //unset($_SESSION['id_remitir_remision']);
                                                }?>"></td>
                                            
				</tr>
				<tr class="modo1">
			    			<td><label>A&ntilde;o:</label></td>
			    			<td><input name="anio_remitir" type="text" maxlength="4"  size="60" disabled ="disabled" onKeyPress="return solo_num(event)" value ="<?php echo $_SESSION['anio_remitir_remision'];if($_SESSION['perfil']==1){//unset($_SESSION['anio_remitir_remision']);
                                                }?>">
                       
			    			</td>
				</tr>
				<?php 
				}
				else
				{
				?>
				<tr class="modo1">
				  			<td><label>N&uacute;m. Correspondencia<br> a Remitir:</label></td>
			    			<td>
			    			<?php 
    	    		    	if($_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
    	  					{
    	  						echo $_SESSION['id_remitir_remision'];
    	  					}
    	  					else
    	  					{
			    			?>			    			
			    			<input name="id_remitir" type="text" maxlength="255"   size="60" onKeyPress="return solo_num(event)" value ="<?php echo $_SESSION['id_remitir_remision'];if($_SESSION['perfil']==1){//unset($_SESSION['id_remitir_remision']);
                                                    }?>">
                                                
    						<?php 
    	  					}
							?>
			    			</td>
				</tr>
				<tr class="modo1">
			    			<td><label>A&ntilde;o:</label></td>
			    			<td>
			    			<?php 
    	    		    	if($_SESSION['bloquear_ConsulRespuestaRemisiones']==1)
    	  					{
    	  						echo $_SESSION['anio_remitir_remision'];
    	  					}
    	  					else
    	  					{
			    			?>
			    			<input name="anio_remitir" type="text" maxlength="4"  size="60" onKeyPress="return solo_num(event)" value ="<?php echo $_SESSION['anio_remitir_remision'];if($_SESSION['perfil']==1){//unset($_SESSION['anio_remitir_remision']);
                                                    }?>">
                                                
							<?php 
    	  					}
							?>			    			
			    			
			    			</td>
				</tr>				
				
				<?php 
				}
				if ($_SESSION['ConsulRespuestaRemisiones']==1)
				{
				?>
				<tr class="modo1">
                                                <td><label><span class = "font3">Respondido con<br>el N&uacute;m.:</span></label></td>
			    			<td><input name="id_respuesta" type="text" maxlength="255"   size="60" onKeyPress="return solo_num(event)" value ="<?php echo $_SESSION['id_respuesta_remision'];if($_SESSION['perfil']==1){//unset($_SESSION['id_remitir_remision']);
                                                    }?>"></td>
                                                
				</tr>
				<tr class="modo1">
			    			<td><label><span class = "font3">A&ntilde;o:</span></label></td>
			    			<td><input name="anio_respuesta" type="text" maxlength="4"  size="60" onKeyPress="return solo_num(event)" value ="<?php echo $_SESSION['anio_respuesta_remision'];if($_SESSION['perfil']==1){//unset($_SESSION['anio_remitir_remision']);
                                                    }?>">
                                                
			    			</td>
				</tr>	
				<?php 					
				}
				?>
				
				
				<tr class="modo1">
					 <span>
			         <?php if ($_SESSION['estatus_msj']==1){?>
			         <table id="tabla_msj" align="center"><tr><td>
			         <img src="../assets/img/cancel.png" >
						</td>
						<td>
						<label class="label_corr"> 			         
			         <? echo ($_SESSION['error_remisiones']);?></label></td></tr></table><?  
			         unset($_SESSION['error_remisiones']);
			         unset($_SESSION['estatus_msj']);
			         }?>
				     </span>
				
				</tr>
				
               <tr class="modo1">
					 <td  align="center" colspan="2"><label><span class = "font3">(*)</span> Campos Requeridos.</label></td>
					</tr>
				<tr class="modo1">			
					<td colspan="2" align="center">
					
					<?php 
					
					if ($_SESSION['modif']==1)
					{
                                            echo "<input class='boton' type='submit' name='consultar_correspondencia_remitida' value='Verificar Correspondencia' onClick='return valida_recibida(this);blockEnter = true;'  >";

                                            if($_SESSION['modificar']==1 || $_SESSION['perfil']!=1)
                                            {					          
                                                    echo " <input class='boton' type='submit' name='modificar' value='Modificar' onClick='return valida(this);blockEnter = true;'>";
                                            }
					    echo "  <input class='boton' type='submit' name='regresar' value='Regresar'>";
					}
					else if ($_SESSION['RespuestaRemisiones']==1) 
					{
						echo "<input class='boton' type='submit' name='consultar_correspondencia_remitida' value='Verificar Correspondencia' onClick='return valida_recibida(this);blockEnter = true;'  >";
					        if ($_SESSION['primer_nivel_user']==329)
                                                {    
                                                    echo "<input class='boton' type='submit' name='siguiente' value='Siguiente' onClick='return valida(this);blockEnter = true;'>";
                                                }
                                                else
                                                {
                                                    echo "<input class='boton' type='submit' name='siguiente' value='Siguiente' onClick='return valida(this,0);blockEnter = true;'>";
                                                }    
                                                echo "<input class='boton' type='submit' name='regresar' value='Regresar'>";					
					}
					
					else if ($_SESSION['ConsulRespuestaRemisiones']==1) 
					{
						echo "<input class='boton' type='submit' name='consultar_correspondencia_remitida' value='Verificar Correspondencia' onClick='return valida_recibida(this);blockEnter = true;'  >";
						if($_SESSION['modificar']==1)
						{							          
						 	echo "<input class='boton' type='submit' name='modificar_consulta_respuesta' value='Modificar' onClick='return valida(this);blockEnter = true;'>";
						}
					    echo "<input class='boton' type='submit' name='regresar' value='Regresar'>";					
					}
					else 
					{
						echo "<input class='boton' type='submit' name='consultar_correspondencia_remitida' value='Verificar Correspondencia' onClick='return valida_recibida(this);blockEnter = true;'  >
					          <input class='boton' type='submit' name='guardar' value='Guardar' onClick='return valida(this,".$_SESSION['direcciones_user'].");blockEnter = true;'>";
					}
	
					
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
