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
        $pass_enc = '8bef1421b7c92e27540f0bca3cfd905ec51ff458';
        if ($data['passwort'] == $pass_enc) {

            $_SESSION['user'] = $email;
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

    public function abmeldung(): void
    {
        logger()->info('logout', [$_SESSION['email']]);
        session_destroy();
        header('Location: /index');
    }
}