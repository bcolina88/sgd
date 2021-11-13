<?php

namespace App\Http\Controllers;

use App\UserModule;
use Illuminate\Http\Request;
use App\User;
use App\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){        
        return view("perfil");
    }
    public function formNew(){
        return view("users.newUser");
    }
    
    public function listUsers(){
        $users = User::where("state_id", 1)->get();
        return view("users.list", compact("users"));
    }
    
    public function editUserForm(Request $request, $id){
        $user = User::find($id);        
        return view("users.editUserForm", compact("user"));
    }
    
    public function deleteUserForm(Request $request, $id){
        $user = User::find($id);  
        $user->update([
            "state_id" => 2
        ]);
        return redirect()->back();
    }
    
    public function editUserAuth(Request $request){
        
        if(!is_null($request->file('avatar'))){
            $avatar = Storage::putFile('avatars', $request->file('avatar'));
             Auth::User()->update([
                "avatar" => $avatar,
            ]);
        }
        
        
        Auth::User()->update([
            "gender" => $request->gender,
            "address" => $request->address,
            "city" => $request->city,
            "country" => $request->country,
            "phone1" => $request->phone1,
            "phone2" => $request->phone2,
            "type_identification" => $request->type_doc,
            "identification" => $request->doc,
            "birthday" => $request->birthday
        ]);
        
        if($request->pass != ''){
            Auth::user()->update([
                "password" => bcrypt($request->pass)
            ]);
        }
        
        return redirect()->back();
    }
    
    
    public function editUser(Request $request){

        $this->validate($request, [
            "email" => "required|email",
            "modules" => "required",
            "rol" => "required",
            "cargo" => "required",
            "name" => "required",
        ]);
        
        $user = User::find($request->user_id);
        
        if(!is_null($request->file('avatar'))){
            $avatar = Storage::putFile('avatars', $request->file('avatar'));
             $user->update([
                "avatar" => $avatar,
            ]);
        }
        
        
        $user->update([
            "email" => $request->email,
            "role_id" => $request->rol,
            "cargo" => $request->cargo,
            "name" => $request->name,
            "gender" => $request->gender,
            "state_id" => 1,
            "user_confirm" => 0,
            "address" => $request->address,
            "city" => $request->city,
            "country" => $request->country,
            "phone1" => $request->phone1,
            "phone2" => $request->phone2,
            "type_identification" => $request->type_doc,
            "identification" => $request->doc,
            "birthday" => $request->birthday,
        ]);
        
        if($request->password != ''){
            $user->update([
                "password" => bcrypt($request->password),
            ]);
        }
        UserModule::where("user_id", $user->id)->delete();

        foreach ($request->modules as $module){
            $userModule = new UserModule();
            $userModule->user_id = $user->id;
            $userModule->module_id = $module;
            if($request->has("empresas")){
                if(isset($request->empresas[$module])){
                    $userModule->empresas = json_encode($request->empresas[$module]);
                }else{
                    $userModule->empresas = "";
                }
            }else{
                $userModule->empresas = "";
            }

            $userModule->save();
        }

        return redirect()->back();
    }
    
    public function crearNuevoUsuario(Request $request){

        $this->validate($request, [
            "email" => "required|email",
            "password" => "required",
            "rol" => "required",
            "cargo" => "required",
            "name" => "required",
            "modules" => "required"
        ]);
        
        $reg = User::create([
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "role_id" => $request->rol,
            "cargo" => $request->cargo,
            "name" => $request->name,
            "gender" => $request->gender,
            "state_id" => 1,
            "user_confirm" => 0,
            "address" => $request->address,
            "city" => $request->city,
            "country" => $request->country,
            "phone1" => $request->phone1,
            "phone2" => $request->phone2,
            "type_identification" => $request->type_doc,
            "identification" => $request->doc,
            "birthday" => $request->birthday,
        ]);

        foreach ($request->modules as $module){
            $userModule = new UserModule();
            $userModule->user_id = $reg->id;
            $userModule->module_id = $module;
            if($request->has("empresas")){
                if(isset($request->empresas[$module])){
                    $userModule->empresas = json_encode($request->empresas[$module]);
                }else{
                    $userModule->empresas = "";
                }
            }else{
                $userModule->empresas = "";
            }
            $userModule->save();
        }

        Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Creacion Usuario"
        ]);
        
        return redirect("/");
    }
    
    public function showAvatar($id){
		$user = User::find($id);
        if(is_null($user->avatar)){
            header("Content-type: image\png");
            header("Content-Disposition: inline");
            echo file_get_contents(asset("/img/Sin_foto.png"));
        }else{            
            $type = Storage::mimeType($user->avatar);
            header("Content-type: $type");
            header("Content-Disposition: inline");

            echo Storage::get($user->avatar);
        }
    	
	}
    
    public function welcome(Request $request){
        if($request->session()->has("bienvenida")){
            $show = "false";
        }else{
            $show = "true";
        }
        return  '{"show" : '.$show.'}';
    }
    
    public function closeWelcome(Request $request){
        $request->session()->push("bienvenida", true);
    }

    static function seeModule($module, $user = null){

        $user = $user == null ? Auth::id() : $user;

        if(is_null($user)){
            Auth::id();
        }

        return UserModule::where("user_id", $user)->where("module_id", $module)->get()->count() > 0;
    }

    static function seeModuleEmpresa($module, $index, $user = null){

        $user = $user == null ? Auth::id() : $user;

        if(is_null($user)){
            Auth::id();
        }

        $module = UserModule::where("user_id", $user)->where("module_id", $module)->get();
        if($module->count() > 0){
            $empresas = $module->last()->empresas;
        }else{
            $empresas = '';
        }

        if($empresas != ''){
            $empresas = json_decode($empresas);
            return in_array($index, $empresas);
        }else{
            return false;
        }

    }
}
