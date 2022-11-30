<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function index(RequestData $request): string
    {
        return view('homelayout', [
            'rd' => $request,
            'title' => 'Ihre E-Mensa',
            'css' => 'css/index_stylesheet.css'
        ]);
    }
    
    public function debug(RequestData $request) {
        return view('debug');
    }

    public function refresh(RequestData $request): string
    {
        return view('refresh', [
            'title' => 'refresh'
        ]);
    }

}