<?php

namespace App\Http\Controllers;

use App\Models\Realisation;

class RealisationController extends Controller
{
    public function index()
    {
        $realisations = Realisation::orderBy('order')->get();

        $items = [];
        foreach ($realisations as $r) {
            if ($r->before_image && $r->after_image) {
                $items[$r->id] = [
                    'title'  => $r->title,
                    'before' => asset($r->before_image),
                    'after'  => asset($r->after_image),
                ];
            }
        }

        return view('welcome', compact('items'));
    }
}
