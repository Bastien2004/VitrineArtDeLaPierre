<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class realisationController extends Controller
{
    // Dans ton Controller ou ta route web.php
    public function index() {
        $directory = public_path('images/comparaisons');
        $files = File::files($directory);

        $items = [];
        foreach ($files as $file) {
            // On extrait le nom (ex: "01")
            $name = pathinfo($file, PATHINFO_FILENAME);
            $id = explode('_', $name)[0];
            $type = str_contains($name, 'avant') ? 'before' : 'after';

            $items[$id][$type] = asset('images/comparaisons/' . $file->getFilename());
        }

        return view('page-comparaison', compact('items'));
    }
}
