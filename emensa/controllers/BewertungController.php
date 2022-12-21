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
        if(isset($rd->query['h']) && $_SESSION['admin']){
            $hv = Bewertung::find($rd->query['h']);
            $hv->hervorgehoben ^= 1;
            $hv->save();
        }
        $bewertungen = BewertungAr::orderBy('bewertungszeitpunkt','DESC')->get()->take(30);
        $vars = ['bewertungen'=> $bewertungen];
        return view('bewertungen',$vars);
    }

    public function meinebewertungen(RequestData $rd): string
    {
        if($_POST['bewertungId']!=NULL) {
            $bw = BewertungAr::where('id', $_POST['bewertungId'])->where('benutzerId', $_SESSION['benutzerId']);
            $bw->delete();
        }
        if($_SESSION['login_ok']){
            $vars = ['bewertungen' => get_bewertungen_by_userId($_SESSION['benutzerId'])];
            return view('meinebewertungen',$vars);
        }
        return view('anmeldung', NULL);
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

