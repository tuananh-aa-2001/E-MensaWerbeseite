<?php

$password = 'password';

$hash_default_salt = password_hash($password,PASSWORD_DEFAULT);

$hash_variable_salt = password_hash($password,PASSWORD_DEFAULT,array('cost' => 4));

echo $hash_default_salt."<br>";
echo $hash_variable_salt . "<br>";

