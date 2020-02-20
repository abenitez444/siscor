<?php
session_start();
function randomText($length) {
    $pattern = "1234567890abcdefghijkmnopqrstuvwxyz";
    for($i=0;$i<$length;$i++) {
      $key .= $pattern{rand(0,35)};
    }
    return $key;
}
$_SESSION['tmptxt'] = randomText(6);
$captcha = imagecreatefromgif("../assets/img/fondo_captcha.gif");
$colText = imagecolorallocate($captcha, 0, 0, 0);
imagestring($captcha, 5, 16, 7, $_SESSION['tmptxt'], $colText);
header("Content-type: image/gif");
imagegif($captcha);
?>
