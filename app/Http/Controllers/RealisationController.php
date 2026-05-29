<?php

namespace App\Http\Controllers;

use App\Models\Realisation;
use App\Models\Comparaison;
use App\Traits\HasSEO;
use Illuminate\View\View;

class RealisationController extends Controller
{
    use HasSEO;

    public function index(): View
    {
        $this->setSEO(
            'Nos réalisations',
            'Découvrez nos travaux de taille de pierre : avant/après, restaurations et créations.'
        );

        $comparaisons = Comparaison::orderBy('order')->get();
        $realisations = Realisation::orderBy('order')->get();

        return view('welcome', compact('comparaisons', 'realisations'));
    }
}
