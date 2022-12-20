<?php
require_once ('../models/login.php');

class AuthController
{
    public function anmeldung_verifizieren(): void
    {
        $email = $_POST['email'] ?? false;
        $pass = $_POST['password'] ?? false;
// Überprüfung Eingabedaten
        $_SESSION['login_result_message'] = null;
        $data = get_user($email);
        if ($data['passwort'] == $pass) {
            $_SESSION['login_ok'] = true;
            $_SESSION['user'] = $email;
            $_SESSION['benutzerId'] = $data['id'];
            $_SESSION['admin'] = $data['admin'];
            update_user($email, true);
            logger()->info('login',[$email]);
            header('Location: /index');
        } else {
            update_user($email, false);
            logger()->warning('failed login', [$email]);
            $_SESSION['login_result_message'] = "Benutzername oder Passwort falsch";
            header('Location: /anmeldung');
        }
    }
}