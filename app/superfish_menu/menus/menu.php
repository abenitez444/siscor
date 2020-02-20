<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<body>
	<?php 
			echo "<ul class='sf-menu sf-vertical'>";
			
	if ($_SESSION['perfil']==1)
	{
			echo"<li class='current'>
					<a >Mantenimiento</a>
					<ul>
						<li>
							<a href='../controlador/control_entes_externos.php'>Entes Externos</a>
						</li>
						<li>
		                    <a href='../controlador/control_acciones.php'>Acciones</a>				
						</li>
						<li>
		                    <a href='../controlador/control_clasificacion_documentos.php'>Clasificaci&oacute;n de Documentos</a>				
						</li>
						<li>
		                    <a href='../controlador/control_prioridades.php'>Prioridades</a>				
						</li>
						<li>
		                    <a href='../controlador/control_remitente_nota_remision.php'>Remitente de la Nota Remisi&oacute;n</a>				
						</li>
					</ul>
			</li>
			<li>
				<a >Recibida</a>
					<ul>
						<li>
							<a href='../controlador/control_recibidas.php?User_dire=1'>Registrar</a>
						</li>
						<li>
							<a href='../controlador/control_consultar_recibidas.php'>Consultar</a>
						</li>
						<li>
							<a  >Respuesta</a>
								<ul>
									<li>
										<a href='../controlador/control_respuesta_recibidas.php?Resp_ofi=act'>Registrar</a>
									</li>
									<li>
										<a href='../controlador/control_consul_respuesta_recibidas.php'>Consultar</a>
									</li>
								</ul>
						</li>
						<li>
			            	<a href='../controlador/control_ultima_recibidas.php'>&Uacute;ltima Correspondencia Recibida</a>
						</li>			
					</ul>
		   	</li>";
	}	   	
	  /* echo"<li>
				<a >Remisiones</a>
					<ul>";
	if ($_SESSION['perfil']==1)
	{
					echo"<li>
							<a href='../controlador/control_remisiones.php'>Registrar</a>
						</li>";
	}
				echo"   <li>
							<a href='../controlador/control_consultar_remisiones.php'>Consultar</a>
						</li>";
				
	if ($_SESSION['perfil']==1)
	{	
				echo"	<li>
						<a  >Respuesta</a>
							<ul>
								<li>
									<a href='../controlador/control_respuesta_remisiones.php'>Registrar</a>
								</li>
								<li>
									<a href='../controlador/control_consul_respuesta_remisiones.php'>Consultar</a>
								</li>
							</ul>
					</li>
					<li>
	            	    <a href='../controlador/control_ultima_remision.php'>&Uacute;ltima Remisi&oacute;n Enviada</a>
					</li>";
	}							
			echo"</ul>
			 
		</li>";*/
	if ($_SESSION['perfil']==1)
	{
	echo"<li>
				<a >Oficios</a>
					<ul>
						<li>
							<a href='../controlador/control_oficios.php'>Registrar</a>
						</li>
						<li>
							<a href='../controlador/control_consultar_oficios.php'>Consultar</a>
						</li>
						<li>
							<a>Respuesta</a>
								<ul>
									<li>
										<a href='../controlador/control_respuesta_oficios.php'>Registrar</a>
									</li>
									<li>
										<a href='../controlador/control_consul_respuesta_oficios.php'>Consultar</a>
									</li>
								</ul>
						</li>
						<li >
			                <a href='../controlador/control_ultima_enviada.php'>&Uacute;ltimo Oficio Enviado</a>
						</li>
					</ul>
			</li>
		<!--<li>
				<a >Memos</a>
					<ul>
						<li>
							<a href='registrar_memos.php'>Registrar</a>
						</li>
						<li>
							<a >Consultar</a>
						</li>
						<li>
							<a >Modificar</a>
						</li>
					</ul>
		    </li> -->";			
	}
		echo"<li>
				<a >Reportes</a>
					<ul>";
	if ($_SESSION['perfil']==1)
	{
					echo"<li>
							<a >Recibidas</a>
								<ul>
									<li>
										<a href='../controlador/control_reportes_recibidas.php'>General</a>
									</li>
									<li>
										<a href='../controlador/control_reportes_recibidas_sintesis.php'>Sintesis</a>
									</li>
								</ul>
						</li>
						<li>
							<a>Oficios</a>
								<ul>
									<li>
										<a href='../controlador/control_reportes_oficios_general.php'>General</a>
									</li>
									<li>
										<a href='../controlador/control_reportes_oficios_respuesta.php'>Respuestas</a>
									</li>
								</ul>
						</li>";
	}
				   echo"<li>
							<a >Remisiones</a>
								<ul>
									<li>
										<a href='../controlador/control_reportes_remisiones_general.php'>General</a>
									</li>
									<li>
										<a href='../controlador/control_reportes_remisiones_respuesta.php'>Respuestas</a>
									</li>";
	if ($_SESSION['perfil']==1)
	{	
							   echo"<li>
										<a href='../controlador/control_reportes_nota_remisiones.php'>Nota de Remisi&oacute;n</a>
									</li>";
	}									
							echo"</ul>
						</li>
					</ul>
			</li>";
	
	echo"	<li>
				<a href='../controlador/control_cambio_pass.php' >Cambio de Contrase&ntilde;a</a>
		
			</li>
		
		</ul>";							   		
	?>
	</body>
</html>