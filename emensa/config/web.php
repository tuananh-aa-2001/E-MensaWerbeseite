<?php
/**
 * Mapping of paths to controllers.
 * Note, that the path only supports one level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as expected
 */

return array(
    // Erstes Beispiel:
    '/m4_6a_queryparameter' => 'ExampleController@m4_6a_queryparameter',
    '/m4' => 'ExampleController@m4_6a_queryparameter',

    "/demo"         => "DemoController@demo",
    '/dbconnect'    => 'DemoController@dbconnect',
    '/debug'        => 'HomeController@debug',
    '/error'        => 'DemoController@error',
    '/requestdata'   => 'DemoController@requestdata',
    '/m4_7a_queryparameter' => 'ExampleController@m4_7a_queryparameter',
    '/m4_7b_kategorie' => 'ExampleController@m4_7b_kategorie',
    '/m4_7c_gerichte' => 'ExampleController@m4_7c_gerichte',
    '/m4_7d_layout' => 'ExampleController@m4_7d_layout',

    '/anmeldung'=>'HomeController@anmeldung',
    '/index' => 'HomeController@index',
    '/index/wunschgericht' => 'HomeController@wunschgericht',
    '/anmeldung_verifizieren' => 'AuthController@anmeldung_verifizieren',
    '/abmeldung' => 'HomeController@abmeldung',


    '/bewertung' =>'BewertungController@bewertung',
    '/bewertung_absenden' =>'BewertungController@bewertung_absenden',



);