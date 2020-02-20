<?php
session_start();
session_destroy();
$url_relativa = "siscor/index.php";
header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
?>
