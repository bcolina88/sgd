<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public function fields(){
        return $this->hasMany(ModuleField::class, "module_id", "id");
    }

    public function files(){
        return $this->hasMany(FilesModules::class, "module_id", "id");
    }
}
