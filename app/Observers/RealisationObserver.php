<?php

namespace App\Observers;

use App\Models\Realisation;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class RealisationObserver
{
    public function created(Realisation $realisation): void
    {
        $this->compress($realisation);
    }

    public function updated(Realisation $realisation): void
    {
        $this->compress($realisation);
    }

    private function compress(Realisation $realisation): void
    {

        $path = Storage::disk('public')->path($realisation->image);

        $manager = new ImageManager(new Driver());
        $manager->decode($path)
            ->scaleDown(width: 800)
            ->save($path, quality: 75);
    }
}
