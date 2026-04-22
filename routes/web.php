<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('/', function () {
    $directory = public_path('images/comparaisons');
    $items = [];

    if (File::exists($directory)) {
        $files = File::files($directory);
        foreach ($files as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME);

            if (str_contains($name, '_')) {
                $parts = explode('_', $name);
                $id = $parts[0];
                $type = str_contains($parts[1], 'avant') ? 'before' : 'after';

                // On initialise l'entrée si elle n'existe pas encore
                if (!isset($items[$id])) {
                    $items[$id] = [
                        'before' => null,
                        'after' => null,
                        'title' => "Réalisation " . $id
                    ];
                }

                $items[$id][$type] = asset('images/comparaisons/' . $file->getFilename());
            }
        }
    }

    return view('welcome', ['items' => $items]);
});
