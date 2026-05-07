<?php

namespace App\Filament\Resources\Applications\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class ApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Recu le')
                    ->date('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('last_name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('first_name')
                    ->label('Prenom')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->copyable(),
                TextColumn::make('phone')
                    ->label('Telephone'),
                TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'nouveau' => 'warning',
                        'accepte' => 'success',
                        'refuse' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([])
            ->actions([
                Action::make('view_cv')
                    ->label('Voir CV')
                    ->icon('heroicon-o-document-text')
                    ->color('info')
                    ->url(fn ($record) => asset('storage/' . $record->cv_path))
                    ->openUrlInNewTab(),

                Action::make('view_cover_letter')
                    ->label('Lettre de motivation')
                    ->icon('heroicon-o-envelope')
                    ->color('gray')
                    ->url(fn ($record) => asset('storage/' . $record->cover_letter_path))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => !is_null($record->cover_letter_path)),

                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
