<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoDocumental;
use App\Contabilidad;
use App\Activity;
use Illuminate\Support\Facades\Auth;
class TiposDocumentalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
    	$list = TipoDocumental::orderBy("name", "DESC")->paginate(20);
    	return view("TipoDocumental.index", compact("list"));
    }

    public function showForm(){
    	return view("TipoDocumental.form");
    }

    public function save(Request $request){
    	$this->validate($request, [
			'name' => 'required',
		]);

		$reg = TipoDocumental::create([
			"name" => $request->name
		]);
        
        Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Creacion tipo documental $reg->name"
        ]);

		return redirect("/tipoDocumental");
    }
    public function showEditForm($id){
    	$doc = TipoDocumental::find($id);
    	return view("TipoDocumental.editForm", compact("doc"));
    }
    public function edit(Request $request){
    	$this->validate($request, [
			'name' => 'required',
		]);
        
    	$reg = TipoDocumental::find($request->id);
        $reg->update([
			"name" => $request->name
		]);
        
        Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Edicion tipo documental $reg->name"
        ]);

		return redirect("/tipoDocumental");
    }
    public function delete(Request $request){
    	        
        if(Contabilidad::where("type_doc", $request->id)->get()->count() > 0){
            return redirect("/tipoDocumental")->with("error", "Este tipo documental se encuentra en uso");
        }else{            
            $reg = TipoDocumental::find($request->id);

            $reg->delete();
            
            Activity::create([
                "user_id" => Auth::id(),
                "activity" => "Eliminacion tipo documental $reg->name"
            ]);

            return redirect("/tipoDocumental")->with("msg", "$reg->name fue eliminado");
        }
        
    }
}
