<?php

namespace App\Filament\Resources\SolicitudSims\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class SolicitudSimsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('codigo')
                    ->label('Código')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Código copiado al portapapeles')
                    ->copyMessageDuration(1500),

                TextColumn::make('user.name')
                    ->label('Solicitante')
                    ->sortable(),

                TextColumn::make('cliente')
                    ->label('Cliente')
                    ->searchable(),

                TextColumn::make('producto.nombre')
                    ->label('Producto')
                    ->sortable(),

                TextColumn::make('cantidad')
                    ->label('Cant.')
                    ->numeric()
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendiente' => 'warning',
                        'completada' => 'success',
                        'desestimada' => 'danger',
                        default => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'pendiente' => 'heroicon-m-clock',
                        'completada' => 'heroicon-m-check-circle',
                        'desestimada' => 'heroicon-m-x-circle',
                        default => 'heroicon-m-question-mark-circle',
                    })
                    // Transformamos el texto para que se vea en mayúsculas en la tabla
                    ->formatStateUsing(fn (string $state): string => strtoupper($state)),

                TextColumn::make('created_at')
                    ->label('Fecha de Solicitud')
                    ->dateTime('d/m/Y h:i A')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc'); // Ordena por los más recientes primero
    }
}