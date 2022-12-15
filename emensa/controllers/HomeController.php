<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
   public function index(RequestData $request): string
    {
        $data = db_gericht_hat_allergen();
        return view('index', [
            'rd' => $request,
            'title' => 'Ihre E-Mensa',
            'css' => 'css/index_stylesheet.css',
            'allergene' => $data
        ]);
    }
    
    public function debug(RequestData $request): string
    {
        return view('debug');
    }

    public function wunschgericht(RequestData $request): string
    {
        return view('wunschgericht',[
            'title' => 'wunschgericht'
        ]);
    }
    /*public function anmeldung_verifizieren(RequestData $request): string
    {
        return logger('Login verify','anmeldung_verifizieren',[
            'title' => 'anmeldung_verifizieren',
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        ]);
    }*/
    public function anmeldung_verifizieren(RequestData $request): string
    {
        return view('anmeldung_verifizieren',[
            'title' => 'anmeldung_verifizieren',
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        ]);
    }

    public function anmeldung(RequestData $request): string
    {
        return view('anmeldung', [
            'rd' => $request,
            'title' => 'Anmeldung Seite',
            'submit' => $_GET['submit']
        ]);
    }

    /*public function anmeldung(RequestData $request): string
    {
        if($_GET['submit'] == 'fail'){
            return logger('Email or password is wrong.Login failed!','anmeldung',[
                'rd' => $request,
                'title' => 'Anmeldung-Seite',
                'submit' => $_GET['submit']
            ]);
        }else{
            return logger('Login Seite','anmeldung',[
                'rd' => $request,
                'title' => 'Anmeldung-Seite',
                'submit' => $_GET['submit']
            ]);
        }
    }*/

    /*public function home_session(RequestData $request): string
    {
        session_start();

        if(isset($_SESSION['counter'])){
            $_SESSION['counter']++;
        }else{
            $_SESSION['counter'] = 1;
        }
        $msg = $_SESSION['counter'];
        return logger('Successfully login as'.$_GET['user'],'home_session',[
            'rd' => $request,
            'name' => $_GET['user'],
            'msg' => $msg,
            'title' => 'E-Mensa',
            'css' => 'css/index_stylesheet.css',
        ]);
    }*/

    public function home(RequestData $request): string
    {
        session_start();

        if (isset($_SESSION['counter'])) {
            $_SESSION['counter'] += 1;
        } else {
            $_SESSION['counter'] = 1;
        }
        $msg = $_SESSION['counter'];
        return view('home_session', [
            'rd' => $request,
            'name' => $_GET['user'],
            'msg' => $msg,
            'title' => 'Ihre E-Mensa',
            'css' => 'css/gerichte_aus_datenbank.css'
        ]);
        session_destroy();
    }
    /*public function abmeldung(RequestData $request): string{
        session_destroy();
        return logger('Logout Seite','abmeldung', [
            'rd' => $request,
            'title' => 'Abmeldung Seite',
        ]);
    }*/
    public function abmeldung(RequestData $request): string{
        session_destroy();
        return view('abmeldung', [
            'rd' => $request,
            'title' => 'Abmeldung Seite',
        ]);
    }



}