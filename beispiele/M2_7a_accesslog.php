<?php
/**
 * Praktikum DBWT. Autoren:
 * Tuan,Nguyen, 3517392
 * Dorian,Hoevelmann, 3525346
 */
//WRITE
$file = fopen("accesslog.txt", "a");

fwrite($file, date('d/m/Y H:i:s', time()) . ' '. $_SERVER['HTTP_USER_AGENT']. ' ' . $_SERVER['REMOTE_ADDR'] . "\n");

fclose($file);