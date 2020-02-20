<?php session_start();
header('Content-Type: text/html; charset=utf-8');
require_once('../assets/pdf/class.ezpdf.php');
//require_once('../assets/pdf/fonts/');

$pdf = new Cezpdf();
$pdf->selectFont('../assets/pdf/fonts/Helvetica.afm');
$pdf->ezText('Mi primer pdf en PHP', 30);
$pdf->ezStream();
?>
