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
        $note = $request->input('note', '');
        $numero = $request->input('numero', '');
        $mail = $request->input('email', '');
        $nom = $request->input('nom', '');
        $prenom = $request->input('prenom', '');


        //Mail::to('frederic.oden.tailleur.pierre@gmail.com')->send(new ConfigurateurEmail($pierres));
        Mail::to('bastienhecquet2004@gmail.com')->send(new ConfigurateurEmail($pierres, $note, $numero, $mail, $nom, $prenom));


        return response()->json(['success' => true]);
    }

}
