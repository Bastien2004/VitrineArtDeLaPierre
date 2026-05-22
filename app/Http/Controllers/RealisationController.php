<?php

namespace App\Http\Controllers;

use App\Models\Realisation;
use App\Models\Comparaison;
use Illuminate\View\View;

class RealisationController extends Controller
{
    public function index(): View
    {
        $comparaisons = Comparaison::orderBy('order')->get();
        $realisations = Realisation::orderBy('order')->get();

        return view('welcome', compact('comparaisons', 'realisations'));
    }
}
