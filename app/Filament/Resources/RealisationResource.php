<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RealisationResource\Pages;
use App\Models\Realisation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class RealisationResource extends Resource
{
    protected static ?string $model = Realisation::class;
    protected static string|null|\BackedEnum $navigationIcon = Heroicon::OutlinedCamera;
    protected static ?string $navigationLabel = 'Réalisations';
    protected static ?string $modelLabel = 'Réalisation';
    protected static ?string $pluralModelLabel = 'Réalisations';

    public static function form(Form|Schema $form): Schema
    {
        return $form->schema([

            Forms\Components\TextInput::make('title')
                ->label('Titre')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('category')
                ->label('Catégorie (ex: Sculpture, Marbre, Restauration…)')
                ->maxLength(100),

            Forms\Components\TextInput::make('order')
                ->label('Ordre d\'affichage')
                ->numeric()
                ->default(0),

            Forms\Components\FileUpload::make('image')
                ->label('Photo de la réalisation')
                ->image()
                ->maxSize(5120) // 5MB maximum
                ->directory('realisations')
                ->disk('public')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('#')
                    ->sortable()
                    ->width(50),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Photo')
                    ->disk('public')
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Catégorie')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRealisations::route('/'),
        ];
    }
}
