<?php
/**
 * Praktikum DBWT. Autoren:
- Tuan,Nguyen, 3517392
- Dorian,Hoevelmann, 3525346
 */
//WRITE
$file = fopen("accesslog.txt", "a");

fwrite($file,date('m/d/Y h:i:s a', time()) . ' ' . $_SERVER['REMOTE_ADDR'] . ' ' . $_SERVER['HTTP_USER_AGENT'] . "\n");

fclose($file);