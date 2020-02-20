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
//include '../assets/xajax/xajax_core/xajax.inc.php';
include_once("../modelo/class_oficios.php"); 
include_once("../modelo/class_usuarios.php");

$Oficios = new Oficios();
//if ($_SESSION['activo_sintesis']==1)
 // {
    $cantidad=$_SESSION['cantidadValor'];
	$valor=$_SESSION['oficios_seleccionado'];
    $id=$_SESSION['campoIdOficios'];
    $fecha=$_SESSION['campoFecha'];
    $alto_nivel=$_SESSION['cd_alto_nivel_corres'];
    $primer_nivel=$_SESSION['cd_primer_nivel_corres'];
    $direcciones=$_SESSION['cd_direcciones_corres'];
    $asunto=$_SESSION['tx_asunto'];
    $anio=$_SESSION['anio'];
    $respondida=$_SESSION['respondida_oficios'];
 //   unset($_SESSION['activo_sintensis']);
 // }
      $Oficios->setId_direcciones_user($_SESSION['direcciones_user']);
	  $Oficios->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	  $Oficios->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
    
    
    
    
    
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
       		"<td ><label>N&uacute;m.</label></td>".
       		"<td><label>Fecha</label></td>".
       		"<td><label>Remitente</label></td>".
       		"<td width='10000' ><label>Asunto</label></td>";
       		if($_SESSION['respuesta']==1)
       		{
       		$html .=	"<td><label>Resp.</label></td>".
       			"<td><label>Recibido Resp.</label></td>".
       			"<td><label>Fec. Resp.</label></td>";
       			
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
               "<td rowspan='1'>".nl2br(wordwrap($id[$index],50, "<br />")) ."<br /></td>".
               "<td rowspan='1'>".$Oficios->devuelve_fecha($fecha[$index])."<br /></td>".
               "<td rowspan='1'><div class='tamanio'>".nl2br(wordwrap($alto_nivel[$index].'<br>'.$primer_nivel[$index].'<br>'.$campo,25 )) ."</div></td>".  
               "<td rowspan='1'width='430px' ><div class='tamanio'>".nl2br(wordwrap($asunto[$index],60)) ."</div></td>";
           
       	if($_SESSION['respuesta']==1)
		{
         if($respondida[$index]==true)
          {
          	$tabla1= "vista_mostrar_consul_respuesta_oficios";
            $orden1="cd_oficios";		
	  		$where='cd_oficios ='.$id[$index].' and  nu_ano_oficios='.$anio[$index];
	  		$respuesta_oficios = $Oficios->MostrarConsulta(1,$tabla1,$where,$orden1);
	  		$datatmp=pg_fetch_assoc($respuesta_oficios);
	  		if($datatmp['cd_oficios']<>"")
	  		{
	  		$html .=   "<td rowspan='1'>SI</td>".
               "<td rowspan='1'>".wordwrap($datatmp['cd_recibidas'])."</td>".  
               "<td rowspan='1'>".wordwrap($datatmp['nu_ano_recibidas']) ."</td>";
	  	   	}
          	else
          	{
	  		 $html .=  "<td rowspan='1'>NO</td>".
               "<td rowspan='1'></td>".  
               "<td rowspan='1'></td>";
          	}          	
          }
	}

$html .="</tr>";
       }
$html .=
       "</table></div>".
       "</body></html>";
echo $html;
?>