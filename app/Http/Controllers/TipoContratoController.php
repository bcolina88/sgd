<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeContract;
use App\Rh;
use App\Activity;
use Illuminate\Support\Facades\Auth;

class TipoContratoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
    	$list = TypeContract::orderBy("name", "DESC")->paginate(20);
    	return view("TipoContrato.index", compact("list"));
    }

    public function showForm(){
    	return view("TipoContrato.form");
    }

    public function save(Request $request){
    	$this->validate($request, [
			'name' => 'required',
		]);

		$reg = TypeContract::create([
			"name" => $request->name
		]);
        
        Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Creacion tipo contrato $reg->name"
        ]);

		return redirect("/tipoContrato");
    }
    public function showEditForm($id){
    	$doc = TypeContract::find($id);
    	return view("tipoContrato.editForm", compact("doc"));
    }
    public function edit(Request $request){
    	$this->validate($request, [
			'name' => 'required',
		]);
        
    	$reg = TypeContract::find($request->id);
        $reg->update([
			"name" => $request->name
		]);
        
        Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Edicion tipo contrato $reg->name"
        ]);

		return redirect("/tipoContrato");
    }
    public function delete(Request $request){
    	        
        if(Rh::where("type_contract_id", $request->id)->get()->count() > 0){
            return redirect("/tipoContrato")->with("error", "Este tipo contrato se encuentra en uso");
        }else{            
            $reg = TypeContract::find($request->id);

            $reg->delete();
            
            Activity::create([
                "user_id" => Auth::id(),
                "activity" => "Eliminacion tipo contrato $reg->name"
            ]);

            return redirect("/tipoContrato")->with("msg", "$reg->name fue eliminado");
        }
        
    }
}
