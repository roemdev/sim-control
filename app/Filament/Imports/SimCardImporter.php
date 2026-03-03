<?php

namespace App\Filament\Imports;

use App\Models\SimCard;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class SimCardImporter extends Importer
{
    protected static ?string $model = SimCard::class;

    public static function getColumns(): array
    {
        return [
        ImportColumn::make('serial_number')
            ->requiredMapping()
            ->rules(['required', 'unique:sim_cards,serial_number'])
            ->label('SN o ICCID'),
            
        ImportColumn::make('numero_telefono')
            ->requiredMapping()
            ->rules(['required', 'unique:sim_cards,numero_telefono'])
            ->label('Número de Teléfono'),
            
        ImportColumn::make('producto_id')
            ->requiredMapping()
            ->numeric()
            ->label('ID del Producto'),
    ];
    }

    public function resolveRecord(): ?SimCard
    {
        return SimCard::firstOrNew([
            'serial_number' => $this->data['serial_number'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'La importación finalizó. ' . number_format($import->successful_rows) . ' registros importados.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' filas fallaron.';
        }

        return $body;
    }
}