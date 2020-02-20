<?php
//session_start();
//include('../controlador/script.php');
 
include("input.php");
?>
<html>
<head>
<title>Registro del Memo - SISCOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


<script src="../assets/calendario/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../assets/js/dateInput.js" type="text/javascript"></script>
<script src="../assets/js/jvstools.js" type="text/javascript"></script>
<link href="../assets/calendario/SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link href="../assets/calendario/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/dateInput.css" rel="stylesheet" type="text/css" /> 


<link rel="stylesheet" href="../assets/css/estilo.css" type="text/css"/>




<script type="text/javascript" src="../assets/js/vali_recibida.js"></script> 
<?php 
$rif=$_SESSION['dsrifestablecimientos'];		
if ($rif!="")
{	
	$tabla="establecimientos"; 
	$campos = array(dsrifestablecimientos,dsrazonsocialestablecimientos,idtiposestablecimientos,idparroquia,dsurbanizacionestablecimientos,dsavcalleestablecimientos,dsedificiocasaestablecimientos,dsaptonumcasaestablecimientos,dscodigopostalestablecimientos,nbrepresentanteestablecimientos,emailrepresentanteestablecimientos,nutelfparepresentanteestablecimientos,nutelfcerepresentanteestablecimientos,dsestablecimientos);
	$Establecimiento=new Establecimiento();
	$Var1 = implode(',',$campos);
	$cantidad = count($campos); 
	$campos = $Var1;
	$consulta=$Establecimiento->BuscarTodo($tabla,$campos,$rif);
	$disabled="disabled";
}
else{
	$disabled="";
    }   
?> 
</head>
<body>
<center>
<div id="cuerpo"> 
	<div id="banner"></div>	<!--Fin de 'banner'-->
	<div id="cintillo"></div><!--Fin de 'cintillo'-->
	<div id="superior"></div>
	<div id="sesion"> Bienvenido(a): [<?php  echo ($_SESSION['nombreusuario_residuos']);?> ] [<a href="../index.php">Cerrar Sesión</a>]</div>
   	<div id="contenedor">
	
		<div id="izquierda">
			<?php require_once("menu.php") ?>
		</div>
		<div id="central">
		
		<br>
			<form class="form2" autocomplete="off" name="frm_nuevo_usuario" method="post" action="../controlador/control_establecimiento.php">	
			<!-- <table align="right"><tr><td width="150" align="left" onClick="javascript:window.print();"><img src="../assets/img/impresora.jpg" align="center" alt="impresora" width="45" height="39" longdesc="imprimir"/></td></tr></table> -->
		<fieldset> <legend>Datos del Memo </legend>	
	 <span>
         <?php if ($_SESSION['estatus_msj']==2){?>
         <table id="tabla_msj" align="center"><tr><td>
         <img src="../assets/img/accept.png" height="15" border="0"><? echo ($_SESSION['error_login_titulo_establecimiento']);?></td></tr></table><?  
         unset($_SESSION['error_login_titulo_establecimiento']);
         unset($_SESSION['estatus_msj']);
         }?>
	 </span><br>
			<table align="center" class="tabla">
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Fecha de Envio:</label></td> 
					<?php $fecha_oficio = date("d-m-Y"); ?>
				   	<td><?php Create_DateInput('fecha_oficio',$fecha_oficio); ?></td>
				</tr>
					<tr class="modo1">
					<td><label><span class = "font3">* </span>Hora de Envio:</label></td>
					<?php $hora = date('h'); $minuto = date('i'); $tiempo=date('a');?>
				  <td> <select name="hora">
	                  <option value="--" selected="selected">- - </option>
					  <option value="01"<?php if ($hora=="01") echo ' selected'; ?> >01</option>
                      <option value="02"<?php if ($hora=="02") echo ' selected'; ?> >02</option>
                      <option value="03"<?php if ($hora=="03") echo ' selected'; ?>>03</option>
                      <option value="04"<?php if ($hora=="04") echo ' selected'; ?>>04</option>
                      <option value="05"<?php if ($hora=="05") echo ' selected'; ?>>05</option>
                      <option value="06"<?php if ($hora=="06") echo ' selected'; ?>>06</option>
                      <option value="07"<?php if ($hora=="07") echo ' selected'; ?>>07</option>
                      <option value="08"<?php if ($hora=="08") echo ' selected'; ?>>08</option>
                      <option value="09"<?php if ($hora=="09") echo ' selected'; ?>>09</option>
                      <option value="10"<?php if ($hora=="10") echo ' selected'; ?>>10</option>
                      <option value="11"<?php if ($hora=="11") echo ' selected'; ?>>11</option>
                      <option value="12"<?php if ($hora=="12") echo ' selected'; ?>>12</option>
                  </select> :                  
                  <select name="minuto">
                    <option value="--" selected="selected">- -</option>
                    <option value="00"<?php if ($minuto=="00") echo ' selected'; ?>>00</option>
                    <option value="01"<?php if ($minuto=="01") echo ' selected'; ?>>01</option>
                    <option value="02"<?php if ($minuto=="02") echo ' selected'; ?>>02</option>
                    <option value="03"<?php if ($minuto=="03") echo ' selected'; ?>>03</option>
                    <option value="04"<?php if ($minuto=="04") echo ' selected'; ?>>04</option>
                    <option value="05"<?php if ($minuto=="05") echo ' selected'; ?>>05</option>
                    <option value="06"<?php if ($minuto=="06") echo ' selected'; ?>>06</option>
                    <option value="07"<?php if ($minuto=="07") echo ' selected'; ?>>07</option>
                    <option value="08"<?php if ($minuto=="08") echo ' selected'; ?>>08</option>
                    <option value="09"<?php if ($minuto=="09") echo ' selected'; ?>>09</option>
                    <option value="10"<?php if ($minuto=="10") echo ' selected'; ?>>10</option>
                    <option value="11"<?php if ($minuto=="11") echo ' selected'; ?>>11</option>
                    <option value="12"<?php if ($minuto=="12") echo ' selected'; ?>>12</option>
                    <option value="13"<?php if ($minuto=="13") echo ' selected'; ?>>13</option>
                    <option value="14"<?php if ($minuto=="14") echo ' selected'; ?>>14</option>
                    <option value="15"<?php if ($minuto=="15") echo ' selected'; ?>>15</option>
                    <option value="16"<?php if ($minuto=="16") echo ' selected'; ?>>16</option>
                    <option value="17"<?php if ($minuto=="17") echo ' selected'; ?>>17</option>
                    <option value="18"<?php if ($minuto=="18") echo ' selected'; ?>>18</option>
                    <option value="19"<?php if ($minuto=="19") echo ' selected'; ?>>19</option>
                    <option value="20"<?php if ($minuto=="20") echo ' selected'; ?>>20</option>
                    <option value="21"<?php if ($minuto=="21") echo ' selected'; ?>>21</option>
                    <option value="22"<?php if ($minuto=="22") echo ' selected'; ?>>22</option>
                    <option value="23"<?php if ($minuto=="23") echo ' selected'; ?>>23</option>
                    <option value="24"<?php if ($minuto=="24") echo ' selected'; ?>>24</option>
                    <option value="25"<?php if ($minuto=="25") echo ' selected'; ?>>25</option>
                    <option value="26"<?php if ($minuto=="26") echo ' selected'; ?>>26</option>
                    <option value="27"<?php if ($minuto=="27") echo ' selected'; ?>>27</option>
                    <option value="28"<?php if ($minuto=="28") echo ' selected'; ?>>28</option>
                    <option value="29"<?php if ($minuto=="29") echo ' selected'; ?>>29</option>
                    <option value="30"<?php if ($minuto=="30") echo ' selected'; ?>>30</option>
                    <option value="31"<?php if ($minuto=="31") echo ' selected'; ?>>31</option>
                    <option value="32"<?php if ($minuto=="32") echo ' selected'; ?>>32</option>
                    <option value="33"<?php if ($minuto=="33") echo ' selected'; ?>>33</option>
                    <option value="34"<?php if ($minuto=="34") echo ' selected'; ?>>34</option>
                    <option value="35"<?php if ($minuto=="35") echo ' selected'; ?>>35</option>
                    <option value="36"<?php if ($minuto=="36") echo ' selected'; ?>>36</option>
                    <option value="37"<?php if ($minuto=="37") echo ' selected'; ?>>37</option>
                    <option value="38"<?php if ($minuto=="38") echo ' selected'; ?>>38</option>
                    <option value="39"<?php if ($minuto=="39") echo ' selected'; ?>>39</option>
                    <option value="40"<?php if ($minuto=="40") echo ' selected'; ?>>40</option>
                    <option value="41"<?php if ($minuto=="41") echo ' selected'; ?>>41</option>
                    <option value="42"<?php if ($minuto=="42") echo ' selected'; ?>>42</option>
                    <option value="43"<?php if ($minuto=="43") echo ' selected'; ?>>43</option>
                    <option value="44"<?php if ($minuto=="44") echo ' selected'; ?>>44</option>
                    <option value="45"<?php if ($minuto=="45") echo ' selected'; ?>>45</option>
                    <option value="46"<?php if ($minuto=="46") echo ' selected'; ?>>46</option>
                    <option value="47"<?php if ($minuto=="47") echo ' selected'; ?>>47</option>
                    <option value="48"<?php if ($minuto=="48") echo ' selected'; ?>>48</option>
                    <option value="49"<?php if ($minuto=="49") echo ' selected'; ?>>49</option>
                    <option value="50"<?php if ($minuto=="50") echo ' selected'; ?>>50</option>
                    <option value="51"<?php if ($minuto=="51") echo ' selected'; ?>>51</option>
                    <option value="52"<?php if ($minuto=="52") echo ' selected'; ?>>52</option>
                    <option value="53"<?php if ($minuto=="53") echo ' selected'; ?>>53</option>
                    <option value="54"<?php if ($minuto=="54") echo ' selected'; ?>>54</option>
                    <option value="55"<?php if ($minuto=="55") echo ' selected'; ?>>55</option>
                    <option value="56"<?php if ($minuto=="56") echo ' selected'; ?>>56</option>
                    <option value="57"<?php if ($minuto=="57") echo ' selected'; ?>>57</option>
                    <option value="58"<?php if ($minuto=="58") echo ' selected'; ?>>58</option>
                    <option value="59"<?php if ($minuto=="59") echo ' selected'; ?>>59</option>
                  </select>
                  <select name="tiempo">
                    <option value="--" selected="selected">- -</option>
                    <option value="am"<?php if ($tiempo=="am") echo ' selected'; ?>>A.M.</option>
                    <option value="pm"<?php if ($tiempo=="pm") echo ' selected'; ?>>P.M.</option>
                  </select>
                  
                  </td>
				</tr>
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Destinatario: <br></>Unidad:</label></td>
					<td><select name="parroquia" id ="parroquia">
             					<option value="0" selected="selected">- Seleccione -</option>
							<option value="15"  <?php if ($consulta[3]=="15") echo "selected";?>>---</option>
								</option>
					</select></td>
				</tr>
				<tr class="modo1">
					<td><label><span class = "font3">* </span>Destinatario Coordinaci&oacute;n:</label></td>
					<td><select name="parroquia" id ="parroquia">
             					<option value="0" selected="selected">- Seleccione -</option>
							<option value="15"  <?php if ($consulta[3]=="15") echo "selected";?>>---</option>
								</option>
					</select></td>
				</tr>
				<tr class="modo1">
			    			<td><label><span class = "font3">* </span>Responsable:</label></td>
			    			<td><input name="edificiocasa" type="text" maxlength="255"  size="60" value ="<?php echo $consulta[6];?>"></td>
				</tr>
				<tr class="modo1">
			    			<td><label><span class = "font3">* </span>Amerita Respuesta:</label></td>
			    			<td><input name="edificiocasa" type="checkbox" maxlength="255"  size="60" value ="<?php echo $consulta[6];?>"></td>
				</tr>
				
			    <tr class="modo1">
			    			<td><label><span class = "font3">* </span>Asunto:</label></td>
			    			<td><textarea name="asunto"  cols="60" rows="3"></textarea></td>
				</tr>

				<tr class="modo1">
			    			<td><label><span class = "font3">* </span>Respuesta Memo:</label></td>
			    			<td><span class = "font4"><input name="num_respon" type="text" maxlength="10"  size="20" value ="<?php echo $consulta[7];?>">
			    				Año:<input name="ano_respon" type="text" maxlength="10"  size="10" value ="<?php echo $consulta[7];?>"></span>
			    			</td>
				</tr>
				

                        	<tr class="modo1">
					 <td  align="center" colspan="2"><label><span class = "font3">(*)</span> Campos Requeridos.</label></td>
					</tr>
				<tr class="modo1">			
					<td colspan="2" align="center"><input class="boton" type="submit" name="enviar" value="Guardar" onClick="return valida(this);blockEnter = true;"  ></td>
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
