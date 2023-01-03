<?php

use \Illuminate\Database\Capsule\Manager as DB;

require_once($_SERVER['DOCUMENT_ROOT'].'/../models/bewertung.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/GerichtAr.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/BewertungAr.php');

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

    public function bewertungen(RequestData $rd): string
    {
        if(isset($rd->query['hl']) && $_SESSION['admin']){
            $hv = BewertungAr::find($rd->query['hl']);
            $hv->hervorgehoben ^= 1;
            $hv->save();
        }
        $bewertungen = BewertungAr::orderBy('bewertungszeitpunkt','DESC')->get()->take(30);
        $_SESSION['target'] = "bewertungen";
        $vars = ['bewertungen'=> $bewertungen];
        return view('bewertungen',$vars);
    }

    public function meinebewertungen(RequestData $rd): string
    {
        if($_POST!=NULL) {
            $bw = BewertungAr::where('id', $_POST['bewertungId'])->where('benutzerId', $_SESSION['benutzerId']);
            $bw->delete();
        }
        if($_SESSION['login_ok']){
            $vars = ['bewertungen' => get_bewertungen_by_userId($_SESSION['benutzerId'])];
            return view('meinebewertungen',$vars);
        }
        $_SESSION['target'] = 'meinebewertungen';
        return view('anmeldung', NULL);
    }

    public function bewertung_absenden(): string
    {
        $bemerkung  = $_POST['bewertungstext'];
        $bewertung = $_POST['bewertung'];
        $gericht_id = $_POST['gerichtId'];
        date_default_timezone_set('europe/berlin');
        $timestamp = date('Y-m-d H:i:s');

        if(strlen(trim($bemerkung)) > 4){
            db_bewertung_eintragen($bemerkung,$bewertung,$timestamp,$gericht_id,$_SESSION['benutzerId']);
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

