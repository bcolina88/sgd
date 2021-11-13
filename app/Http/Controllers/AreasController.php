<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Areas;
use App\Activity;
use Illuminate\Support\Facades\Auth;

class AreasController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
    	$list = Areas::where("id", "!=", 4)->orderBy("name", "ASC")->paginate(20);
    	return view("Areas.index", compact("list"));
    }

    public function showForm(){
    	return view("Areas.form");
    }

    public function save(Request $request){
    	$this->validate($request, [
			'name' => 'required',
		]);

		$reg = Areas::create([
			"name" => $request->name
		]);
        
        Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Creacion area $reg->name"
        ]);

		return redirect("areas");
    }
    public function showEditForm($id){
    	$area = Areas::find($id);
    	return view("Areas.editForm", compact("area"));
    }
    public function edit(Request $request){
    	$this->validate($request, [
			'name' => 'required',
		]);
    	$reg = Areas::find($request->id);
        
        $reg->update([
			"name" => $request->name
		]);
        
        Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Edicion area $reg->name"
        ]);

		return redirect("/areas");
    }
}
