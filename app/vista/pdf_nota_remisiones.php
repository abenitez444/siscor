<?php 
	include('../controlador/script.php');
	require_once("../assets/mpdf50/mpdf.php");
	include_once("../modelo/class_remisiones.php");
	
	$Remisiones = new Remisiones();

			   		$cantidad=$_SESSION['cantidadValor'];
                	
		   			$idremisiones= $_SESSION['campoIdRemisiones'];
                	$fecha=$_SESSION['campoIdFecha'];
                	
                	$recibidas=$_SESSION['campoIdRecibidas'];
			    	$fecha_rec=$_SESSION['campoFechaRecibidas'];
                	
		    		$remitente_primer_nivel=$_SESSION['campoNbremitente_primer_nivel'];
		    		$cargo_remitente_primer_nivel=$_SESSION['campoNb_cargoremitente_primer_nivel'];		    	
		    		$remitente_direcciones=$_SESSION['campoNbremitente_direcciones'];
		    		$cargo_remitente_direcciones=$_SESSION['campoNb_cargoremitnete_direcciones'];
			    	
		    		$primer_nivel=$_SESSION['campoIdPrimer_nivel'];
		    		$direcciones=$_SESSION['campoIdDirecciones'];
			    	$unidad=$_SESSION['campoIdUnidad'];
			    	$coordinacion=$_SESSION['campoIdCoordinacion'];

		    	    $destinatario=$_SESSION['campoDestinatario'];
			    	$nb_primer_nivel_destinatario=$_SESSION['campoNb_primer_nivel_destinatario'];
		    	    $nb_direcciones_destinatario=$_SESSION['campoNb_direcciones_destinatario'];
		    	    $nb_unidades_destinatario=$_SESSION['campoNb_unidades_destinatario'];			    	
			    	
			    	
			    	$txt_asunto=$_SESSION['campoAsunto'];
			    	
			    	$prioridades=$_SESSION['campoIdPrioridades'];	
			    	$acciones=$_SESSION['campoAcciones'];
			    	
			    	
			    	$observacion=$_SESSION['campoObservacion'];


			    	if($remitente_direcciones[0]=="")
			    	{
			    		
			    		$remitente=$remitente_primer_nivel[0];
		    			$cargo=$cargo_remitente_primer_nivel[0];		    	
		    			
			    	}
			    	else
			    	{
			    		
				    	$remitente=$remitente_direcciones[0];
			    		$cargo=$cargo_remitente_direcciones[0];	
			    	}
			    	
			    	
			    	
			    	$html='<html>
	   		<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
				<title>Documento sin t&iacute;tulo</title>
			</head>
			<body>';
			
	for ($index = 0; $index < $cantidad; $index++) 
    {
	
$html.='<table width="600" height="550" border="0">

		<tr>
    	<td align="center" width="350" >
    			<img src="../assets/img/logo_pdf_nr.jpg" height="60px" width="45px"/><br>'.$primer_nivel[$index].'<br>'.$direcciones[$index].'<br>
		</td>
    	<td>&nbsp;</td>
    	<td>
    	<p>Nota de Remisi&oacute;n<br>
    	   N&uacute;m. '.$idremisiones[$index].'</p>
    	<p>FECHA: '.$Remisiones->devuelve_fecha($fecha[$index]).'</p>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">De:'.$remitente.'<br>
    &nbsp;&nbsp;&nbsp;&nbsp;'.$cargo.'<br></td>
  </tr>
  <tr>
    <td colspan="3">Para:'.$destinatario[$index].'<br>';
if($nb_unidades_destinatario[$index]=="")
{ 
	if ($nb_direcciones_destinatario[$index]=="")
	{
		$destino=$nb_primer_nivel_destinatario[$index];	
	
	}
	else
	{
		$destino=$nb_direcciones_destinatario[$index];
	}	
}
else
{ 
	$destino=$nb_unidades_destinatario[$index];	
}



$html.='&nbsp;&nbsp;&nbsp;&nbsp;'.$destino.'</td>
  </tr>
  <tr>
    <td colspan="3" height="225px" >Referencia: <br>
    '.$txt_asunto[$index].'
    </td>
  </tr>
  <tr>
    <td colspan="3">Prioridad: '.$prioridades[$index].'<br>
    				Acciones: '.$acciones[$index].'<br>
    </td>
  </tr>
  <tr>
    <td colspan="3" height="225px">Observaciones:<br>&nbsp;&nbsp;&nbsp;'.$observacion[$index].'<br></td>
  </tr>
  <tr>
    <td>Respondiendo: '.$recibidas[$index].' <br>
		Del d&iacute;a: '.$Remisiones->devuelve_fecha($fecha_rec[$index]).'    
    </td>
    <td>&nbsp;</td>
    <td align="center"><br>------------------------------<br>
    	Firma y Sello </td>
  </tr>
</table>

<br><br><br><br><br>
<br><br><br><br><br>
';

	
    }

$html.='</body>
		</html>';
	//echo $html;	    	
	$mpdf=new mPDF();
	$mpdf->WriteHTML($html);
	$mpdf->Output();			    	
	exit;
	
/*	
	                        unset($_SESSION['intNumeroSolicitud']);
							unset($_SESSION['stsFecha']);
							unset($_SESSION['stsFechaAsignada']);
							unset($_SESSION['stsFechaEspera']);
							unset($_SESSION['stsFechaReactivada']);
							unset($_SESSION['stsFechaCierre']);
							unset($_SESSION['stsCoordinacion']);
							unset($_SESSION['stsOrigen']);
							unset($_SESSION['stsNumeroOficio']);
							unset($_SESSION['stsFechaOficio']);
							unset($_SESSION['stsStatus']);
							unset($_SESSION['stsNombreSolicitante']);
							unset($_SESSION['stsApellidoSolicitante']);
							unset($_SESSION['stsDependenciaSolicitante']);
							unset($_SESSION['stsEdificioSolicitante']);
							unset($_SESSION['stsPisoSolicitante']);
							unset($_SESSION['stsOficinaSolicitante']);
							unset($_SESSION['stsTlfOficinaSolicitante']);
							unset($_SESSION['stsTlfMovilSolicitante']);
							unset($_SESSION['stsCorreoSolicitante']);
							unset($_SESSION['stsTipoSolicitud']);
							unset($_SESSION['stsAreaSolicitud']);
							unset($_SESSION['stsEspecificacionSolicitud']);
							unset($_SESSION['stsTipoEquipo']);
							unset($_SESSION['stsMarca']);
							unset($_SESSION['stsModelo']);
							unset($_SESSION['stsSerialInventario']);
							unset($_SESSION['stsServicioDeterminacion']);
							unset($_SESSION['stsSolucion']);
							unset($_SESSION['stsStatus']);
							unset($_SESSION['stsTecnicosAsignados']);*/

?>