<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

trait HasSEO
{
    protected function setSEO(string $title, string $description, ?string $image = null): void
    {
        SEOMeta::setTitle($title . ' | ' . config('app.name'));
        SEOMeta::setDescription(strip_tags(Str::limit($description, 155)));
        OpenGraph::setUrl(request()->url());
        OpenGraph::setTitle($title);
        OpenGraph::setDescription(strip_tags(Str::limit($description, 155)));

        if ($image) {
            OpenGraph::addImage($image);
        }
    }
}
