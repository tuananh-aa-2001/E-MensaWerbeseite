<?php

$password = 'password';

$salt = "nGi27xw";

$pass_enc = sha1($salt . $password);

echo $pass_enc . "<br>";

