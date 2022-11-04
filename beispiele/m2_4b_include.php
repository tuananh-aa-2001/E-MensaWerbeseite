<?php
/**
 * Praktikum DBWT. Autoren:
 * Tuan,Nguyen, 3517392
 * Dorian,Hoevelmann, 3525346
 */
include('m2_4a_standardparameter.php');

echo "1+2=".addieren(1,2)."<br>";
echo "420+69=".addieren(420,69)."<br>";
echo "1+2+3=".addieren(addieren(1,2),3)."<br>";
echo "usw....";