<?php 

include('input.php'); ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<!-- Calendario -->		
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="dateInput.js" type="text/javascript"></script>
<script src="jvstools.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="dateInput.css" rel="stylesheet" type="text/css" />
<!-- Fin de Calendario -->	

<input type="checkbox" name="chk_fecha" value="checkbox" />
          Desde&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php Create_DateInput('fecha_desde', $fecha_desde); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hasta&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php Create_DateInput('fecha_hasta', $fecha_hasta); ?><br />

</body>
</html>
