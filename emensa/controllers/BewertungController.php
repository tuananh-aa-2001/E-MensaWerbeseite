<?php

use \Illuminate\Database\Capsule\Manager as DB;

require_once($_SERVER['DOCUMENT_ROOT'].'/../models/bewertung.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/GerichtAr.php');

class BewertungController{

    public function bewertung(RequestData $rd): string
    {
        $gerichtId = $rd->query['id'];
        if($_SESSION['login_ok']){
            $vars = ['gericht' => GerichtAr::find($gerichtId)];
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

        date_default_timezone_set('europe/berlin');
        $timestamp = date('Y-m-d H:i:s');

        if(isset($_SESSION['admin'])){
            $hervorgehoben = 1;
        }
        if(strlen(trim($bemerkung)) > 4){
            db_bewertung_eintragen($bemerkung,$bewertung,$timestamp,$hervorgehoben,$gericht_id);
            $erfolgsmeldung = 'Die Bewertung wurde erfolgreich hinzugefügt';
            $vars = ['gericht' => GerichtAr::find($gericht_id),
                'meldung' => $erfolgsmeldung];
        }else{
            $fehlermeldung = 'Die Bewertung ist zu kurz';
            $vars = ['meldung' => $fehlermeldung];
        }
        return view('bewertung',$vars);
    }


}

