<?php 
session_start();
header("Cache-Control: no-cache");
header("Content-type:application/vnd.ms-excel");
header("Cache-Control: no-cache");
header("Content-Disposition:attachment; filename=reporte_siscor.xls");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
include_once("../modelo/class_remisiones.php"); 
include_once("../modelo/class_usuarios.php");

$Remisiones= new Remisiones();
    $cantidad=$_SESSION['cantidadValor'];
    $valor=$_SESSION['Remisiones_seleccionado'];
    $id=$_SESSION['campoIdRemisiones'];
    $fecha=$_SESSION['campoIdFecha'];
    
    $alto_nivel=$_SESSION['cd_alto_nivel_corres'];
    $primer_nivel=$_SESSION['cd_primer_nivel_corres'];
    $direcciones=$_SESSION['cd_direcciones_corres'];
    $unidad=$_SESSION['campoIdUnidad'];
    $coordinacion=$_SESSION['campoIdCoordinacion'];

    $prioridades=$_SESSION['campoIdPrioridades'];
    $asunto=$_SESSION['campoObservacion'];
    
	$anioremision=$_SESSION['campoAnioRemision'];
	$recibida=$_SESSION['campoIdRecibidas'];
	$aniorecibida=$_SESSION['campoAnioRecibidas'];

    $recibidopor=$_SESSION['nb_recibidapor'];
    $horarecicido=$_SESSION['nu_hora_hh_recibidapor'];
    $minutorecibido=$_SESSION['nu_hora_mm_recibidapor'];
    $tiemporecibido=$_SESSION['nu_hora_tt_recibidapor'];
    $fecharecibido=$_SESSION['fe_recibidapor'];
	
    $respuesta=$_SESSION['in_respuesta_remisiones'];
	$responsable=$_SESSION['nb_responsable_remisiones'];
	$textrespuesta=$_SESSION['tx_respuesta_remisiones'];   
	
	

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
$html.= "<table width='1170px'>
<tr>
	<td >
		<IMG type='image' name='image' src='http://172.17.0.101/siscor/assets/img/logo_excel.jpg'>
		<br><br><br><br>
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
	<td><b>Listado General de Oficios<br>
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
       		"<td ><label>N&uacute;m. Remisi&oacute;n</label></td>".
       		"<td><label>Fecha</label></td>".
			"<td><label>N&uacute;m. Recibida/A&ntielde;o</label></td>".
       		"<td><label>Remitente</label></td>".
       		"<td><label>Asunto</label></td>";

			if($_SESSION['respuesta']!=1)
			{
	       		$html .="<td><label>Recibido Resp.</label></td>";
			}
	       	else
	       	{
	       		$html .="<td><label>Resp.</label></td>".
       					"<td><label>Responsable</label></td>".
       					"<td><label>Respuesta</label></td>";
	       	}	
       		
   $html .="</tr>";
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
               "<td>".nl2br(wordwrap($id[$index],50, "<br />"))."<br /></td>".
               "<td>".$Remisiones->devuelve_fecha($fecha[$index])."<br /></td>".
			   "<td>".nl2br(wordwrap($recibida[$index]."/".$aniorecibida[$index],50, "<br />"))."<br /></td>".
               "<td>".nl2br(wordwrap($alto_nivel[$index].'<br>'.$primer_nivel[$index].'<br>'.$campo.'<br>'.$unidad[$index].'<br>'.$coordinacion[$index] ,40 )) ."</td>".  
               "<td>".nl2br(wordwrap($asunto[$index],60)) ."</td>";
				
				if($_SESSION['respuesta']!=1)
				{
					if($recibidopor[$index]!="")
					{
						$html .= "<td>".nl2br(wordwrap($recibidopor[$index].'<br>'.$horarecicido[$index].':'.$minutorecibido[$index].'&nbsp;'.$tiemporecibido[$index].'<br>'.$Remisiones->devuelve_fecha($fecharecibido[$index]) ,40 )) ."</td>";	
					}
					else
					{
						$html .= "<td></td>";	
					}
				}
				else
				{
					if($respuesta[$index]=="t"){
						$Res="SI";
					}
					else
					{
						$Res="NO";
					}
					$html .="<td>".nl2br(wordwrap($Res,50))."</td>".
               				"<td>".nl2br(wordwrap($responsable[$index],40))."</td>".  
               				"<td>".nl2br(wordwrap($textrespuesta[$index],60)) ."</td>";
				}
				
$html .="</tr>";
       }
$html .=
       "</table></div>".
       "</body></html>";
echo $html;
?>