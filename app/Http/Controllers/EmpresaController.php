<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Activity;
use Illuminate\Support\Facades\Auth;
class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $list = Empresa::orderBy("name", "ASC")->paginate(20);
        return view("empresas.index", compact("list"));
    }

    public function showForm(){
        return view("empresas.form");
    }

    public function save(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);

        $reg = Empresa::create([
            "name" => $request->name
        ]);

        Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Creacion empresa $reg->name"
        ]);

        return redirect("/empresas");
    }
    public function showEditForm($id){
        $empresa = Empresa::find($id);
        return view("empresas.editForm", compact("empresa"));
    }
    public function edit(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);
        $reg = Empresa::find($request->id);

        $reg->update([
            "name" => $request->name
        ]);

        Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Edicion empresa $reg->name"
        ]);

        return redirect("/empresas");
    }
}
