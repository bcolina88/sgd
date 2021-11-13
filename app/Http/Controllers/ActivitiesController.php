<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivitiesController extends Controller
{
    public function _list(){
        $activities = Activity::orderBy("created_at", "DESC")->paginate(12);
        return view("activities.list", compact("activities"));
    }
}
