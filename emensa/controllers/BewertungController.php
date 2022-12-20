<?php

use \Illuminate\Database\Capsule\Manager as DB;

require_once($_SERVER['DOCUMENT_ROOT'].'/../models/bewertung.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
//require_once('../models/GerichtAr.php');

class BewertungController{

    public function bewertung(RequestData $rd): string
    {
        $gerichtId = 10;
        if($_SESSION['login_ok']){
            //$vars = ['gericht' => GerichtAr::find($gericht_id)];
            $gericht = get_gericht_per_id($gerichtId);
            $vars=['gericht'=> $gericht];
            return view('bewertung',$vars);
        }
        $_SESSION['target'] = 'bewertung?id=' . $gerichtId;
        return view('anmeldung', NULL);
    }

    public function bewertungen(RequestData $rd)
    {
    }

    public function bewertung_absenden(): string
    {
        $bemerkung  = $_POST['bewertungstext'];
        $bewertung = $_POST['bewertung'];
        $gericht_id = $_POST['gerichtId'];
        $hervorgehoben = 0;
        if(isset($_SESSION['admin'])){
            $hervorgehoben = 1;
        }

        if(strlen(trim($bemerkung)) > 4){
            db_bewertung_eintragen($bemerkung,$bewertung,$hervorgehoben,$gericht_id);
            $erfolgsmeldung = 'Die Bewertung wurde erfolgreich hinzugefügt';

            $vars = ['meldung' => $erfolgsmeldung];
        }else{
            $fehlermeldung = 'Die Bewertung ist zu kurz';
            $vars = ['meldung' => $fehlermeldung];
        }
        return view('bewertung',$vars);
    }


}

