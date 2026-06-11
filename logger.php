<?php
// Obtener la IP del visitante
$ip = $_SERVER['REMOTE_ADDR'];

// Obtener la fecha y hora actual
$hora = date("Y-m-d H:i:s");

// Consultar API para obtener información del país
$paisInfo = file_get_contents("http://ip-api.com/json/".$ip);
$paisData = json_decode($paisInfo, true);
$pais = $paisData['country'] ?? 'Desconocido';

// Crear la línea de registro
$linea = $ip." | ".$hora." | ".$pais."\n";

// Guardar en archivo visitas.txt
file_put_contents("visitas.txt", $linea, FILE_APPEND);
?>
