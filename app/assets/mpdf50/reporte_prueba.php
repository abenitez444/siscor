<?php 
/* Incluimos el archivo de configuracion */
include('../controlador/sesion.php');
//include('../controlador/Funciones.php');
require_once("../includes/mpdf50/mpdf.php");
function getDia( $timestamp = 0 ){
	$timestamp = $timestamp == 0 ? time() : $timestamp;
	$dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sábado');
	return $dias[date("w", $timestamp)];
}
function getMes( $timestamp = 0 ){
	$timestamp = $timestamp == 0 ? time() : $timestamp;
	$meses = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
	return $meses[date("n", $timestamp)];
}
$stsNbRegistrador='JESÚS RAFAEL LÓPEZ BRAVO';
$stsNroCedulaRegistrador='V- 4.339.729';
$stsMunicipioRegistrador='Libertador';
$stsEstadoRegistrador='Distro Capital';
$stsNroGacetaResolucion='3334-2';
$feGacetaResolucion='18-11-2010';
$feHoyDia=date('d');
$feHoyMes=date('m');
$feHoyAnio=date('Y');
$feHoyNbDia=getDia();
$feHoyNbMes=getMes();
$stsNbCiudadano='Virginia Nadima Naassaneh Baladi';
$stsEstadoCivil='Soltero';
$stsNroCedulaCiudadano='V- 18.324.729';
$stsResidencia='Av Navarrete, Secto Maiquetía, Urb. Quenepe Casa de Baladi, #37';
$intEdad='25';
$html =
 '<html><head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 <style type="text/css" >
body {
margin-left: 20px;
margin-right: 20px;
margin-top: 20px;
background: white;
font: 12pt Verdana, Geneva, Arial, Helvetica, sans-serif;
text-align: left;

}
table{
width: 600px;
height: auto;
border-collapse: 0px;
border-spacing: 0px;
float:center;

}
p{
text-align:justify;
line-height: 40px;
}
</style>

</head>
<body>
';
$html.= "<table>".
                "<tr>".
                    "<td align='left'><img src='../img/logo.jpg' height='100px' width='90px'  border='0'/></td>".
                    "<td align='center'>".
                    "<table align='center' width='300px'>".
                        "<tr>".
                            "<td align='center'>República Bolivariana de Venezuela </td>".
                        "</tr>".
                        "<tr>".
                            "<td align='center'>Alcaldía del Municipio Bolivariano</td>".
                        "</tr>".
                   "</td>".
                "</tr>".
                "</table>".
                "</td>".
                "</tr>".
                "</table>";
$html.= "<p align='center'><u>FE DE VIDA CON PRESENCIA</u></p>";
$html.= "<p>Quien Suscribe, $stsNbRegistrador, titular de la Cédula de Identidad N°  $stsNroCedulaRegistrador  en mi carácater de Funcionario Designado por la
        Primera Autoridad del Municipio Bolivariano  $stsMunicipioRegistrador del $stsMunicipioRegistrador,
        Resolución N° 1052 Gaceta Municipal N° $stsNroGacetaResolucion de fecha $feGacetaResolucion.
        CERTIFICA  que el día de hoy <u>$feHoyNbDia</u>, ($feHoyDia) del mes de <u>$feHoyNbMes</u> del año  $feHoyAnio.
        Se presentó ante este Despacho el (la)
        ciudadano: <u>$stsNbCiudadano</u>, de estado
        civil <u>$stsEstadoCivil</u> de <u>$intEdad</u> edad y titular de la cédula de Identidad
        N° <u> $stsNroCedulaCiudadano </u>, a fines de dejar contancias de supervivencia,
        Residenciado (a) en: <u>$stsResidencia</u>
        Parroquia EL VALLE, MUNICIPIO BOLIVARIANO LIBERTADOR, DISTRITO   
        CAPITAL. Se Expide la presente constancia a petición de la parte interesada,    
        a los fines de:___________________________________________ y se considera válida
        por 6 meses, en Caracas a los____________() días del mes de _________________     
       del año 2011.</td>
  <p>";
$html .=
       
       "</body></html>";
$mpdf=new mPDF();
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
//echo $html;
/*$dompdf = new DOMPDF();
$dompdf->set_paper('letter','A4');
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("sample.pdf",array("Attachment"=>1));*/
?>