<?php
use Illuminate\Database\Eloquent\Model;

class BewertungAr extends Model
{
    protected $table = 'bewertung';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function gericht(){
        return $this->belongsTo('GerichtAr','gerichtId');
    }

}