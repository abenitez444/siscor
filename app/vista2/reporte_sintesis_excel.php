<?php 
header("Cache-Control: no-cache");
header("Content-type:application/vnd.ms-excel");
header("Cache-Control: no-cache");
header("Content-Disposition:attachment; filename=archivo.xls");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
include '../assets/xajax/xajax_core/xajax.inc.php';
include_once("../modelo/class_recibidas.php");
include_once("../modelo/class_usuarios.php");
$Recibidas = new Recibidas();
if ($_SESSION['activo_sintesis']==1)
  {
  	$cantidad=$_SESSION['cantidadValor'];
    $valor=$_SESSION['Recibidas_seleccionado'];
   	$id= $_SESSION['campoIdRecibidas'];
    $fecha=$_SESSION['campoFecha'];
    $alto_nivel=$_SESSION['cd_alto_nivel_corres'];
    $primer_nivel=$_SESSION['cd_primer_nivel_corres'];
    $direcciones=$_SESSION['cd_direcciones_corres'];
    $asunto=$_SESSION['tx_asunto'];	
    $anio=$_SESSION['anio'];
    unset($_SESSION['activo_sintensis']);
  }

$Usuarios = New Usuarios();
$Usuarios->setId($_SESSION['codigo']);
$Usuarios->CargarDatos();

$_SESSION['alto_nivel']=$Usuarios->getNb_alto_nivel();
$_SESSION['primer_nivel']=$Usuarios->getNb_primer_nivel();
$_SESSION['direccion']=$Usuarios->getNb_direcciones();

$html =
 '<html><head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 
 <style type="text/css" >
body {
margin-left: 0px;
margin-top: 0px;
background : white ;
}
.tamanio{
margin:/*arriba*/ 1em /*der*/0.5em /* abajo*/1em /*izq*/0.5em;
text-align:justify;
font : 8pt Verdana, Geneva, Arial, Helvetica, sans-serif;	
}
p{
text-align:justify;
}
h2{
font : 9pt Verdana, Geneva, Arial, Helvetica, sans-serif;
text-align:center;
margin-left: 10px;
}
h3{
font : 14pt Verdana, Geneva, Arial, Helvetica, sans-serif;
text-align:center;
}
h4{
font : 12pt Verdana, Geneva, Arial, Helvetica, sans-serif;
text-align:center;
}

</style>

</head>
<body>
';
//<div style=' -webkit-transform: rotate(90deg);-moz-transform: rotate(90deg);rotation: 90deg;filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=2);'>
$html.= "<table width='1170px'>
<tr>
	<td >
		<IMG type='image' name='image' src='http://172.17.0.101/siscor/assets/img/logo_excel.jpg'>
		<br><br><br><br>
	</td>
</tr>
<tr>
	<td >
<br><br>
	</td>
</tr>
<tr>
	<td >
	</td>
</tr>
<tr>
	<td >
		".$_SESSION['primer_nivel']."<br>".$_SESSION['direccion']."
		<br><br>
	</td>
</tr>
<tr>
	<td><b>Lista General de Oficios Recibidos<br>
	".$_SESSION['titulo']." Desde: ".$_SESSION['desde']." Hasta: ".$_SESSION['hasta']."</b>
	</td>
</tr>
</tr>
</table > 
<br>
<br>
<br>
<div>
	<table border='1' align='left'>
		<tr style='padding-right:30px;'>".
       		"<td ><label>N&uacute;m.</label></td>".
       		"<td><label>Fecha</label></td>".
       		"<td><label>Remitente</label></td>".
       		"<td width='10000' ><label>Asunto</label></td>".
       		"<td ><label>Instrucciones</label></td>".
       		"<td><label>Recibido Por:</label></td>".
 "</tr>";
       for ($index = 0; $index < $cantidad; $index++) 
       {
           if($direcciones[$index] == '0')
           {
              $campo="";
           }
           else
           {
              $campo=$direcciones[$index];
           }
$html .=
       "<tr>".
               "<td rowspan='5'>".nl2br(wordwrap($id[$index],50, "<br />")) ."<br /></td>".
               "<td rowspan='5'>".$Recibidas->devuelve_fecha($fecha[$index])."<br /></td>".
               "<td rowspan='5'><div class='tamanio'>".nl2br(wordwrap($alto_nivel[$index].'<br>'.$primer_nivel[$index].'<br>'.$campo,25 )) ."</div></td>".  
               "<td rowspan='5'width='430px' ><div class='tamanio'>".nl2br(wordwrap($asunto[$index],60)) ."</div></td>".
               "<td >Para:<br><br><br></td>".
               "<td >Prioridad:<br><br><br></td>".
                "<td  rowspan='2'>&nbsp;</td>".
        "</tr>".
         "<tr>".
           "<td  colspan='2'>CC:<br><br><br></td>".
       "</tr>".
       "<tr>".
           "<td>Acciones:<br><br><br></td>".
           "<td>Fecha de Entrega:<br><br><br></td>".
               "<td  rowspan='3'>Archivo</td>".
                "</tr>".
       "<tr>".
           "<td rowspan='2'>Observaciones:<br><br><br><br></td>".
           "<td >Responder:<br><br><br></td>".
         "</tr>".
         "<tr>".
           "<td>Firma:<br><br><br></td>";
       }
$html .=
       "</table></div>".
       "</body></html>";
echo $html;
?>