<?php
$ip = $_SERVER['REMOTE_ADDR'];
$hora = date("Y-m-d H:i:s");

// Guardar en visitas.txt
file_put_contents("visitas.txt", $ip . " | " . $hora . "\n", FILE_APPEND);

echo "Tu IP es: " . $ip;
?>
