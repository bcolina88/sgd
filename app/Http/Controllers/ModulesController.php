<?php

namespace App\Http\Controllers;

use App\Activity;
use App\dataModules;
use App\FilesModules;
use App\Module;
use App\ModuleField;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModulesController extends Controller
{
    static function getModules(){
        $modules = Module::orderBy("order", "asc")->get();
        return $modules;
    }

    public function newForm($module){
        $module = Module::find($module);
        return view("modules.form", compact("module"));
    }

    public function save(Request $request, $module){
        $module = Module::find($module);
        $rules = [];

        foreach ($module->fields as $field){
            if($field->typeField->name == "select"){
                $rules[] = ["field-".$field->id => "number"];
            }
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = Storage::putFile('docs', $request->file('file'));

        $fileModule = new FilesModules();
        $fileModule->module_id = $module->id;
        $fileModule->file = $file;
        $fileModule->state_id = 1;

        try{
            $fileModule->save();
        }catch (\Exception $e){
            dd($fileModule);
        }

        foreach ($module->fields as $field){
            $dataModule = new dataModules();
            $dataModule->file_id = $fileModule->id;
            $dataModule->fields_id = $field->id;
            $dataModule->value = $request->get("field-".$field->id);
            $dataModule->save();
        }

        Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Creacion <a href='/modules/file/$fileModule->id' target='_blank'>archivo</a> $module->name"
        ]);

        return redirect("/list/".$module->id);
    }

    public function _list(Request $request, $module){

        $module = Module::find($module);

        $files = FilesModules::select("files_modules.id")->where("module_id", $module->id)->where("state_id", 1);
        foreach ($module->fields as $field){

            if($request->has("field-".$field->id)){
                if($field->typeField->name == "select"){
                    $files->join("data_modules as data".$field->id, "data$field->id.file_id", "=", "files_modules.id");
                    $files->where("data$field->id.fields_id", $field->id)->where("data$field->id.value", $request->get("field-".$field->id));

                }elseif($field->typeField->name == "date") {
                    $files->join("data_modules as data$field->id", "data$field->id.file_id", "=", "files_modules.id");
                    //$dates = explode("/", $request->get("field-" . $field->id));
                    $date = $request->get("field-" . $field->id);
                    
                    $files->where("data$field->id.fields_id", $field->id)->where("data$field->id.value", $date);
                }elseif($field->typeField->name == "number"){
                        $files->join("data_modules as data$field->id", "data$field->id.file_id", "=", "files_modules.id");
                        $files->where("data$field->id.fields_id", $field->id)->where("data$field->id.value", $request->get("field-".$field->id));
                }else{
                    $files->join("data_modules as data$field->id", "data$field->id.file_id", "=", "files_modules.id");
                    $files->where("data$field->id.fields_id", $field->id)->where("data$field->id.value", "LIKE", "%".$request->get("field-".$field->id)."%");
                }
            }
        }
        if(count($request->all()) == 0){
            $files->whereRaw("1 = 2");
        }

        $files = FilesModules::whereIn("id", $files->get())->with("fields")->paginate(12);

        return view("modules.list", compact("module", "files"));
    }


    public function trash(Request $request, $module){
        $module = Module::find($module);
        $files = FilesModules::where("module_id", $module->id)->where("state_id", 3)->with("fields")->paginate(12);

        //return $files;

        return view("modules.trash", compact("module", "files"));
    }

    public function showFile($file){
        $file = FilesModules::find($file);
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=filename.pdf");

        echo Storage::get($file->file);
    }

    public function editForm($module, $file){
        $module = Module::find($module);
        $file = FilesModules::find($file);
        return view("modules.edit", compact("module", "file"));
    }

    public function edit(Request $request, $module, $file){
        $module = Module::find($module);
        $rules = [];

        foreach ($module->fields as $field){
            if($field->typeField->name == "select"){
                $rules[] = ["field-".$field->id => "number"];
            }
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fileModule = FilesModules::find($file);

        foreach ($module->fields as $field){
            $dataModule = dataModules::where("file_id", $fileModule->id)->where("fields_id", $field->id)->get();
            if($dataModule->count() > 0){
                $dataModule = $dataModule->last();
            }else{
                $dataModule = new dataModules();
                $dataModule->file_id = $fileModule->id;
                $dataModule->fields_id = $field->id;
            }
            $dataModule->value = $request->get("field-".$field->id);
            $dataModule->save();
        }

        Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Edición <a href='/modules/file/$fileModule->id' target='_blank'>archivo</a> $module->name"
        ]);

        return redirect("/list/".$module->id);
    }

    public function delete($file){
        $file = FilesModules::find($file);
        $file->state_id = 3;
        $file->save();

        Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Borro archivo ".$file->module->name
        ]);

        return redirect("/list/".$file->module_id);
    }
    public function recycle($file){
        $file = FilesModules::find($file);
        $file->state_id = 1;
        $file->save();
        return redirect("/list/".$file->module_id);
    }
    public function editFieldForm($field){
        $field = ModuleField::find($field);
        return view("modules.editField", compact("field"));
    }
    public function editRowForm($field, $row){
        $field = ModuleField::find($field);
        $row = json_decode($field->data, true)[$row];
        return view("modules.editRow", compact("field", "row"));
    }
    public function editRow(Request $request, $field, $row){
        $field = ModuleField::find($field);
        $data = json_decode($field->data, true);
        $data[$row] = $request->value;
        $field->data = json_encode($data);
        $field->save();
        return redirect("/editField/".$field->id);
    }
    public function newFieldForm($field){
        $field = ModuleField::find($field);
        return view("modules.newField", compact("field"));
    }
    public function newField(Request $request, $field){
        $field = ModuleField::find($field);
        $data = json_decode($field->data, true);
        $data[] = $request->value;
        $field->data = json_encode($data);
        $field->save();
        return redirect("/editField/".$field->id);
    }

    public function deleteRow($field, $row){
        $field = ModuleField::find($field);

        $data = $field->data_disable == null ? [] : json_decode($field->data_disable, true);
        if(array_search($row, $data) === false){
            $data[] = $row;
            $field->data_disable = json_encode($data);
            $field->save();
        }
        return redirect("/editField/".$field->id);
    }
    public function recycleRow($field, $row){
        $field = ModuleField::find($field);
        $data = json_decode($field->data_disable, true);
        $index = array_search($row, $data);
        if($index !== false){
            unset($data[$index]);
            $field->data_disable = json_encode($data);
            $field->save();
        }

        return redirect("/editField/".$field->id);
    }

    public function importForm($module){
        $module = Module::find($module);
        return view("modules.import", compact("module"));
    }
    public function import(Request $request, $module){
        $data = file_get_contents($request->file("file"));

        $data = explode("\r\n", $data);

        $matriz = [];

        foreach ($data as $key => $row){
            if($key == 0){
                continue;
            }
            $matriz[] = explode($request->separador, $row);
        }

        $module = Module::find($module);

        $this->saveImportData($module, $matriz);

        return redirect()->back()->with("mensaje", "Importación termino con exito");
    }

    private function saveImportData($module, $data){
        foreach ($data as $row){

            $fileName = 'docs/'.md5(str_random(40).date("Ydmhis")).'.pdf';
            if($row[0] != ''){
                if(Storage::put($fileName, file_get_contents($row[0]))){
                    $fileModule = new FilesModules();
                    $fileModule->module_id = $module->id;
                    $fileModule->file = $fileName;
                    $fileModule->state_id = $row[1];
                    $fileModule->save();

                    foreach ($module->fields as $key => $field){
                        $value = $row[$key+2] == "NULL" ? null : utf8_encode($row[$key+2]);

                        $dataModule = new dataModules();
                        $dataModule->file_id = $fileModule->id;
                        $dataModule->fields_id = $field->id;
                        $dataModule->value = $value;
                        $dataModule->save();
                    }

                }
            }
        }
    }

    public function getTemplate($module){

        $module = Module::find($module);

        $data[] = [
            "Archivo",
            "Estado (1 = Activo, 2 = Inactivo)"
        ];

        foreach ($module->fields as $field){
            $campos = $this->getDataField($field);
            array_push($data[0], $field->name.$campos);
        }
        $f = fopen("tmp.csv", "w+");

        foreach ($data as $line) {
            fputcsv($f, $line);
        }

        fclose($f);

        return redirect("/tmp.csv");
    }

    private function getDataField($field){
        if($field->type == 5) {
            $data = json_decode($field->data, 1);
            $text = "(";
            foreach ($data as $key => $value) {
                $text .= " " . ($key + 1) . " = " . $value . ",";
            }
            return substr($text, 0, strlen($text) - 1) . ")";
        }elseif($field->type == 6){
            $data = json_decode($field->data, 1);
            $text = "(";
            foreach ($data as $key => $value) {
                $text .= " " . ($value) . " = " . $key . ",";
            }
            return substr($text, 0, strlen($text) - 1) . ")";
        }else{
            return "";
        }
    }

    static function totalFilesModule($module){
        return FilesModules::selectRaw("count(*) as num")->where("state_id", 1)->where("module_id", $module)->get()->last()->num;
    }

}
