<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigurateurController extends Controller
{
    public function index()
    {
        return view('configurateur');
    }
}
