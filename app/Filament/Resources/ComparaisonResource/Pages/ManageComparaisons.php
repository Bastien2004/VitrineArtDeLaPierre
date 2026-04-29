<?php

namespace App\Filament\Resources\RealisationResource\Pages;

use App\Filament\Resources\ComparaisonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageComparaisons extends ManageRecords
{
    protected static string $resource = ComparaisonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
