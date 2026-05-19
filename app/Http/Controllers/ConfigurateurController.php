<?php

namespace App\Http\Controllers;

use App\Mail\ConfigurateurEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ConfigurateurController extends Controller
{
    public function index()
    {
        return view('configurateur');
    }

    public function envoyerMail(Request $request)
    {
        $pierres = $request->input('pierres', []);

        //Mail::to('frederic.oden.tailleur.pierre@gmail.com')->send(new ConfigurateurEmail($pierres));
        Mail::to('bastienhecquet2004@gmail.com')->send(new ConfigurateurEmail($pierres));

        return response()->json(['success' => true]);
    }

}
