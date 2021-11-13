<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleField extends Model
{
    public function typeField(){
        return $this->belongsTo(FieldType::class, "type", "id");
    }
}
