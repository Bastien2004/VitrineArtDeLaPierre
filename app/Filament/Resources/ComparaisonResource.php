<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RealisationResource\Pages;
use App\Models\Comparaison;
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

class ComparaisonResource extends Resource
{
    protected static ?string $model = Comparaison::class;
    protected static string|null|\BackedEnum $navigationIcon = Heroicon::OutlinedPhoto;
    protected static ?string $navigationLabel = 'Réalisations';
    protected static ?string $modelLabel = 'Réalisation';
    protected static ?string $pluralModelLabel = 'Réalisations';

    public static function form(Form|Schema $form): Schema
    {
        return $form->schema([

            Forms\Components\TextInput::make('title')
                ->label('Titre de la réalisation')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('order')
                ->label('Ordre d\'affichage')
                ->numeric()
                ->default(0),

            Forms\Components\FileUpload::make('before_image')
                ->label('Image Avant')
                ->image()
                ->directory('images/comparaisons')
                ->disk('public_path')
                ->required(),

            Forms\Components\FileUpload::make('after_image')
                ->label('Image Après')
                ->image()
                ->directory('images/comparaisons')
                ->disk('public_path')
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

                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('before_image')
                    ->label('Avant')
                    ->disk('public_path'),

                Tables\Columns\ImageColumn::make('after_image')
                    ->label('Après')
                    ->disk('public_path'),

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
            'index' => Pages\ManageComparaisons::route('/'),
        ];
    }
}
