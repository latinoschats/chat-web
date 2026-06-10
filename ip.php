<?php
 
$archivo "data.txt"; //Nombre del archivo donde se almacenard la información.
 
$d_ip "Direccion IP: (S SERVER["REMOTE_ADDR"}}\n"; //String con la dirección IP incluida.
 
$fecha "Fecha: ".date('D dS M,Y h:1 a')."\n\n"; //String con la fecha y hora.
 
$texto $d_ip.$fecha; //String que se escribird en el archivo.
 
//Quedard algo asi:
 
//Dirección IP: 127.0.0.1 (Para dar un ejemplo te ip tocol.)
 
//Fecha: Fecha y hora en la cual el usuario entro a to url en su navegador.
 
5th fopen($archivo, 'a'); //Se abre el archivo con el nombre "data.txt".
 
fwrite($fh, $texto); //Se guarda el contenido de la variable "texto" en el archivo.
 
fclose($th); //Se cierra el archivo.
 
//Ahora hané une breve demostración del funcionamiento del código.
 
