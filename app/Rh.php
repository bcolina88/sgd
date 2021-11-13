<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rh extends Model
{
    protected $fillable = ["identification", "empresa_id", "user_id", "state_id", "file", "name"];


    public function area()
    {
        return $this->belongsTo('App\Areas');
    }
    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
    public function typeContract()
    {
        return $this->belongsTo('App\TypeContract', "type_contract_id", "id");
    }
    
    public function setDateAttribute($value){
        $fecha = explode("/", $value);
        $this->attributes['date'] = $fecha[2]."/".$fecha["0"]."/".$fecha[1];
    }
    
    public function getDateAttribute($value){
        return date("m/d/Y", strtotime($value));
    }
}
