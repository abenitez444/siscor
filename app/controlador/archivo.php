<?php 
session_start();
$archivo = $_SESSION['scanner'];
$ruta = 'http://localhost/siscor/assets/imgescanner/'.$archivo;
header("Cache-Control: no-cache");
header('Content-type: application/download');
header("Cache-Control: no-cache");
header('Content-Disposition: attachment; filename="Archivo.tif"');
readfile($ruta);
?>
    
    
