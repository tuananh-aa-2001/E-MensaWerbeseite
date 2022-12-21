<?php

use Illuminate\Database\Eloquent\Model;

class GerichtAr extends Model
{
    protected $table = 'gericht';
    public $timestamps = false;
    protected $primaryKey = 'id';

    public function bewertungen(){
        return $this->hasMany('BewertungAr');
    }

    function getPreisInternAttribute($preis_intern)
    {
        return number_format($preis_intern, 2);
    }

    function getPreisExternAttribute($preis_extern)
    {
        return number_format($preis_extern, 2);
    }

    function setVegetarischAttribute($value){
        $acceptedTrue = ["yes","ja","wahr",true];
        $acceptedFalse = ["no","nein","falsch",false];
        $str = strtolower($value);
        $str = str_replace(" ","",$str);
        if(in_array($str,$acceptedTrue))
            $this->attributes['vegetarisch'] = true;
        if(in_array($str, $acceptedFalse))
            $this->attributes['vegetarisch'] = false;
    }
    function setVeganAttribute($value){
        $acceptedTrue = ["yes", "ja", "wahr", true];
        $acceptedFalse = ["no", "nein", "falsch", false];
        $str = strtolower($value);
        $str = str_replace(" ", "", $str);
        if (in_array($str, $acceptedTrue))
            $this->attributes['vegan'] = true;
        if(in_array($str, $acceptedFalse))
            $this->attributes['vegan'] = false;
    }
}

