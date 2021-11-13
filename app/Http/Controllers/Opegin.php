<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Activity;
class Opegin
{
    static function myActivity(){
        return Activity::where("user_id", Auth::id())->orderBy("created_at", "DESC")->limit(10)->get();
    }
}
