<?php session_start();
header('Content-Type: text/html; charset=utf-8');
require_once('class.ezpdf.php');?>
<?php
$pdf = new Cezpdf();
$pdf->selectFont('fonts/Helvetica.afm');
$pdf->ezText('Mi primer pdf en PHP', 30);
$pdf->ezStream();

?>
