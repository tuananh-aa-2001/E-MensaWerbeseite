<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/bewertung.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/GerichtAr.php');
/* Datei: controllers/HomeController.php */
class HomeController
{
   public function index(RequestData $request): string
    {
        $allergen = db_gericht_hat_allergen();
        $_SESSION['target'] = "index";
        $gerichte = db_gericht_select_price_greater_than(4.9);
        $vars = [
            'gerichte' => $gerichte,
            'allergene' => $allergen,
            'bewertungen' => anzeigen_bewertungen_mit_hervorgehoben(),
            'preis_intern' => GerichtAr::take(4)->pluck('preis_intern'),
            'preis_extern' => GerichtAr::take(4)->pluck('preis_extern')
        ];

        return view('index',$vars);
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

    public function anmeldung_verifizieren(RequestData $request): string
    {
        $vars = ['title' => 'anmeldung_verifizieren',
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];

        return view('anmeldung_verifizieren',$vars);
    }

    public function anmeldung(): string
    {
        $vars = [];
        return view('anmeldung', $vars);
    }

    public function abmeldung(): string
    {
        session_destroy();
        logger()->info('Abmeldung');
        $vars = [];
        return view('abmeldung', $vars);
    }
    public function home(RequestData $request): string
    {
        session_start();

        if (isset($_SESSION['counter'])) {
            $_SESSION['counter'] += 1;
        } else {
            $_SESSION['counter'] = 1;
        }
        $msg = $_SESSION['counter'];
        return view('index', [
            'rd' => $request,
            'name' => $_GET['user'],
            'msg' => $msg,
            'title' => 'Ihre E-Mensa',
            'css' => 'css/gerichte_aus_datenbank.css'
        ]);
    }

}