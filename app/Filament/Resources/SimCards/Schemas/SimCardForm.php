<?php

namespace App\Filament\Resources\SimCards\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SimCardForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('serial_number')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('numero_telefono')
                    ->tel()
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('producto_id')
                    ->required()
                    ->numeric(),
                TextInput::make('estado')
                    ->required()
                    ->default('disponible'),
                TextInput::make('solicitud_sim_id')
                    ->numeric(),
                DateTimePicker::make('fecha_asignacion'),
            ]);
    }
}
