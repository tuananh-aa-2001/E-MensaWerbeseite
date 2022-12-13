<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
class ExampleController
{
    public function m4_6a_queryparameter(RequestData $rd): string
    {
        /*
           Wenn Sie hier landen:
           bearbeiten Sie diese Action,
           sodass Sie die Aufgabe löst
        */
        return view('notimplemented', [
            'request'=>$rd,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }

    public function m4_7a_queryparameter(RequestData $rd): string
    {
        return view('examples.m4_7a_queryparameter',[
           'name' => $_GET[ "name"],
            'title' => 'm4_7a'
        ]);
    }

    public function m4_7b_kategorie(RequestData $rd): string
    {
        $data = db_kategorie_name_aufsteigend();
        return view('examples.m4_7b_kategorie',[
            'title' => 'm4_7b',
            'name' => $data
        ]);
    }

    public function m4_7c_gerichte(RequestData $rd): string
    {
        $data = db_gericht_name_preis_absteigend();
        return view('examples.m4_7c_gerichte',[
            'title' => 'm4_7c',
            'gerichte' => $data
        ]);
    }

    public function m4_7d_layout(RequestData $rd): string
    {
        if($_GET["no"] == '2') {
            return view('examples.pages.m4_7d_page_2',[
                'title' => 'm4_7d_2'
            ]);
        }
        else{
            return view('examples.pages.m4_7d_page_1',[
                'title' => 'm4_7d_1'
            ]);
        }
    }

}