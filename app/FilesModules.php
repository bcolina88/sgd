<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilesModules extends Model
{
    protected $fillable = ["module_id", "file", "fields", "state_id"];

    public function fields(){
        return $this->hasMany(dataModules::class, "file_id", "id");
    }

    public function module(){
        return $this->belongsTo(Module::class, "module_id", "id");
    }
}
