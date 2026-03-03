<?php

namespace App\Filament\Resources\SolicitudSims\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use App\Models\SolicitudSim;

class SolicitudSimForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('cliente')
                    ->label('Nombre del Cliente')
                    ->placeholder('Ej. Juan Pérez')
                    ->required(),

                Select::make('producto_id')
                    ->label('Producto')
                    ->relationship('producto', 'nombre')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('cantidad')
                    ->label('Cantidad solicitada')
                    ->numeric()
                    ->default(1)
                    ->minValue(1)
                    ->required(),

                // Selector para modificar el estado
                Select::make('estado')
                    ->label('Estado de la Solicitud')
                    ->options(SolicitudSim::opcionesEstado())
                    ->default('pendiente')
                    ->native(false)
                    ->required(),

                // Guarda automáticamente el ID del usuario actual
                Hidden::make('user_id')
                    ->default(auth()->id())
                    ->required(),
            ]);
    }
}