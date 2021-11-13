<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contabilidad;
use App\Rh;

class FilesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    static function expiredFiles(){
        $filesController = new FilesController(); 
        $filesContabilidad = $filesController->expiredFilesContabilidad();
        //$filesRH = $filesController->expiredFilesRH();
        //$files = $filesContabilidad->merge($filesRH);
        return $filesContabilidad->take(5);
    }
    
    static function expiredFilesCount(){
        $filesController = new FilesController(); 
        $filesContabilidad = $filesController->expiredFilesContabilidad();
        //$filesRH = $filesController->expiredFilesRH();
        //$files = $filesContabilidad->merge($filesRH);
        return $filesContabilidad->count();
    }
    
    private function expiredFilesContabilidad(){
        $listFiles = collect([]);
        $date = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")-10));
        $files = Contabilidad::where("date", "<=", $date)->orderBy("date", "DESC")->limit(10)->get();
        
        foreach($files as $file){
            $listFiles->push(collect([
                "area" => "Contabilidad",
                "name" => $file->identification." - ".$file->typeDoc->name,
                "date" => $file->date,
                "file" => "/contabilidad/file/".$file->id
            ]));
        }
        
        return $listFiles;
    }
    private function expiredFilesRH(){
        
        $listFiles = collect([]);
        $date = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")-10));
        $files = Rh::where("date", "<=", $date)->orderBy("date", "DESC")->get();
        
        foreach($files as $file){
            if($file->area_id != 0){
                $listFiles->push(collect([
                    "area" => "RH",
                    "name" => $file->identification." - ".$file->area->name,
                    "date" => $file->date,
                    "file" => "/rh/file/".$file->id
                ]));
            }
            
        }
        return $listFiles;
    }
}
