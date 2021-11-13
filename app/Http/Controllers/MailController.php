<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\FilesModules;
use App\Mail\Correo;
use App\Activity;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{

	public function send(Request $request)
    {
        $file = FilesModules::find($request->doc);
        Mail::to($request->destino)->send(new Correo($request, $file));
        Activity::create([
            "user_id" => Auth::id(),
            "activity" => "Compartio el <a href='/modules/file/$file->id' target='_blank'>archivo</a> "
        ]);
        return redirect()->back();
    }

}
