<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use App\Rh;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Areas;
use App\TypeContract;
use App\Activity;

class RhController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permissions:2,4');
    }
	
    public function index(){
		
		$docs = Rh::orderBy("created_at", "desc")->paginate(20);

		$areas = Areas::where("id", "!=", 4)->orderBy("name", "ASC")->get();
        
        $tiposContratos = TypeContract::orderBy("name", "ASC")->get();

        $empresas = Empresa::orderBy("name", "ASC")->get();

		return view("Rh.index", compact("docs", "areas", "tiposContratos", "empresas"));
		
	}
	
	public function find(Request $request){
		
		$areas = Areas::where("id", "!=", 4)->orderBy("name", "ASC")->get();
        
        $tiposContratos = TypeContract::orderBy("name", "ASC")->get();

		$docs = Rh::orderBy("created_at", "desc");

        $empresas = Empresa::orderBy("name", "ASC")->get();

        if($request->name != ''){
			$docs->where("name", "like", '%'.$request->name.'%');
		}        
        
		if($request->empresa != ''){
			$docs->where("empresa_id", $request->empresa);
		}
		
		if($request->identification != ''){
			$docs->where("identification", $request->identification);
		}

        
        if($request->global != ''){
			$docs->orWhere("id_doc", $request->global);
			$docs->orWhere("identification", $request->global);
			$docs->orWhere("name", "like", '%'.$request->global.'%');
		}
			
		$docs = $docs->paginate(20);

		$typeDoc = [1 => "Facturas", 2 => "C.E", 3 => "Recibos de caja", 4 => "Notas contables"];
		
		return view("Rh.index", compact("docs", "typeDoc", "areas", "tiposContratos", "empresas"));
		
	}
	
	public function showForm(){
		$areas = Areas::where("id", "!=", 4)->orderBy("name", "ASC")->get();
		$typeContracts = TypeContract::orderBy("name", "ASC")->get();
		$empresas = Empresa::orderBy("name", "ASC")->get();
		return view("Rh.form", compact("areas", "typeContracts", "empresas"));
	}
	
	public function showEditForm($id){
		$doc = Rh::find($id);

		$areas = Areas::where("id", "!=", 4)->orderBy("name", "ASC")->get();
        $typeContracts = TypeContract::orderBy("name", "ASC")->get();
        $empresas = Empresa::orderBy("name", "ASC")->get();

        return view("Rh.editForm", compact("doc", "areas", "typeContracts", "empresas"));
	}
	
	public function save(Request $request){
		
		$this->validate($request, [
			'identification' => 'required',
			'name' => 'required',
			'state' => 'required',
			'empresa' => 'required|numeric'
		]);
		
		$file = Storage::putFile('docs/rh', $request->file('file'));
		
		$reg = Rh::create([
			"identification" => $request->identification,
			"name" => $request->name,
			"empresa_id" => $request->empresa,
			"file" => $file,
			"user_id" => Auth::id(),
			"state_id" => $request->state
		]);
        
        Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Creacion <a href='/rh/file/$reg->id' target='_blank'>archivo</a> recursos humanos"
        ]);
		
		
		return redirect("/rh");
	}
	
	public function edit(Request $request){
		
		$this->validate($request, [
			'name' => 'required',
			'identification' => 'required',
			'id_doc' => 'required|numeric',
			'area' => 'required|numeric',
            'tipo_contrato' => 'required|numeric',
			'date' => 'required|date',
		]);
				
		Rh::find($request->id)->update([
			"identification" => $request->identification,
			"name" => $request->name,
			"id_doc" => $request->id_doc,
			"area_id" => $request->area,
            "type_contract_id" => $request->tipo_contrato,
			"date" => $request->date,
		]);
		
		Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Creacion <a href='/rh/file/$request->id' target='_blank'>archivo</a> recursos humanos"
        ]);
        
		return redirect()->back();
	}
	
	public function delete($id){
				
		Rh::find($id)->update([
			"state_id" => 3,
		]);		
        
        Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Eliminacion archovo id $id recursos humanos"
        ]);
		
		return redirect()->back();
	}
	
	public function showFile($id){
		$file = Rh::find($id);
		
		header("Content-type: application/pdf");
		header("Content-Disposition: inline; filename=filename.pdf");
		
		echo Storage::get($file->file);
    	
	}
}
