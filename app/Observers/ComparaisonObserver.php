<?php

namespace App\Observers;

use App\Models\Comparaison;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class ComparaisonObserver
{
    public function created(Comparaison $comparaison): void
    {
        $this->compress($comparaison);
    }

    public function updated(Comparaison $comparaison): void
    {
        $this->compress($comparaison);
    }

    private function compress(Comparaison $comparaison): void
    {
        foreach (['before_image', 'after_image'] as $field) {
            if (!$comparaison->$field) continue;

            $path = Storage::disk('public')->path($comparaison->$field);
            if (!file_exists($path)) continue;

            $manager = new ImageManager(new Driver());
            $manager->read($path)
                ->scaleDown(width: 800)
                ->toJpeg(quality: 75)
                ->save($path);
        }
    }
}
