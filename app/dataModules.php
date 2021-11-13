<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dataModules extends Model
{
    protected $fillable = ["file_id", "fields_id", "value"];
}
