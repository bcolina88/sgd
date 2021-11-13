<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contabilidad extends Model
{
    protected $table = "contabilidad";

    protected $fillable = ["identification", "type_doc", "date", "file", "user_id", "state_id", "id_doc", "tercero", "empresa_id"];

	public function typeDoc()
    {
        return $this->belongsTo('App\TipoDocumental', "type_doc", "id");
    }
    
    public function setDateAttribute($value){
        $fecha = explode("/", $value);
        $this->attributes['date'] = $fecha[2]."/".$fecha["0"]."/".$fecha[1];
    }
    public function empresa()
    {
        return $this->belongsTo('App\Empresa', "empresa_id", "id");
    }


    public function getDateAttribute($value){
        return date("m/d/Y", strtotime($value));
    }
}
