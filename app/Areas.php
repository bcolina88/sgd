<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $fillable = ["name"];
    
    static function areasUsers(){
        return Areas::whereIn("id", [1, 2, 3, 4])->get();
    }
}
