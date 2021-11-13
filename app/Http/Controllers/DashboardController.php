<?php

namespace App\Http\Controllers;

use App\FilesModules;
use App\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Contabilidad;
use App\Rh;
use App\Activity;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    public function index(){        
        
        if(Auth::user()->state_id == 2){
            Auth::logout();
            return redirect('/');
        }
        
        $users = User::all();
        $usersTotal = User::all()->count();
        
        $informe1 = $this->getInforme1();
        $informe2 = $this->getInforme2();
        $informe3 = $this->getInforme3();
        
        $activities = Activity::orderBy("created_at", "DESC")->limit(5)->get();
        
        return view("dashboard", compact("users", "usersTotal", "informe1", "informe2", "informe3", "activities"));
    }
    
    private function getInforme1(){
        
        $json = [];
        $modules = Module::all();

        for($x = 0; $x < 7; $x++){
            $dateI = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m")-$x, 1, date("Y")));
            $dateF = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m")-$x, 31, date("Y")));
            $object = [];
            foreach ($modules as $module){
                $files = FilesModules::where("module_id", $module->id)->whereBetween("created_at", [$dateI, $dateF])->get()->count();
                $object[$module->name] = $files;
            }
            $periodo = date("Y-m", strtotime($dateI));
            $object["periodo"] = $periodo;
            $json[] = $object;
            
        }

        return json_encode($json);
        
    }
    private function getInforme2(){
        
        $json = ["meses" => [], "datos" => []];

        $modules = Module::all();

        for($x = 6; $x >= 0; $x--){
            $dateI = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m")-$x, 1, date("Y")));
            $dateF = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m")-$x, 31, date("Y")));
            $sum = 0;
            foreach ($modules as $module){
                $files = FilesModules::where("module_id", $module->id)->whereBetween("created_at", [$dateI, $dateF])->get()->count();
                $sum += $files;
            }
            $json["datos"][] = $sum;
            $json["meses"][] = date("M", strtotime($dateI));
            
        }
        return json_encode($json);
        
    }
    private function getInforme3(){
        
        $json = ["meses" => [], "datos" => []];
        $modules = Module::all();

        for($x = 6; $x >= 0; $x--){
            $dateI = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m")-$x, 1, date("Y")));
            $dateF = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m")-$x, 31, date("Y")));
            $activity = FilesModules::whereBetween("created_at", [$dateI, $dateF])->get()->count();
            $json["datos"][] = $activity;
            $json["meses"][] = date("M", strtotime($dateI));
            
        }
        return json_encode($json);
        
    }
}
