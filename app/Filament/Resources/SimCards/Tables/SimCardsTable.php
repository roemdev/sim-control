<?php

namespace App\Filament\Resources\SimCards\Tables;

use App\Filament\Imports\SimCardImporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ImportAction; // La importación correcta para el botón
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SimCardsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serial_number')
                    ->label('SN')
                    ->searchable(),
                TextColumn::make('numero_telefono')
                    ->label('Teléfono')
                    ->searchable(),
                TextColumn::make('producto.nombre')
                    ->label('Tipo de SIM')
                    ->sortable(),
                TextColumn::make('estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'disponible' => 'success',
                        'asignada' => 'warning',
                        'dañada' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('solicitud_sim_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fecha_asignacion')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([ // Aquí es donde va el botón en tu versión
                ImportAction::make()
                    ->importer(SimCardImporter::class),
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
