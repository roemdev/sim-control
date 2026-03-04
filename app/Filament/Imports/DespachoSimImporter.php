<?php

namespace App\Filament\Imports;

use App\Models\DespachoSim;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class DespachoSimImporter extends Importer
{
    protected static ?string $model = DespachoSim::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('serial_number')
                ->requiredMapping()
                ->rules(['required', 'exists:sim_cards,serial_number'])
                ->label('SN o ICCID'),

            ImportColumn::make('solicitud_sim_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'exists:solicitud_sims,id'])
                ->label('ID de Solicitud'),
        ];
    }

    public function resolveRecord(): DespachoSim
    {
        $serialNumber = $this->data['serial_number'] ?? null;
        $solicitudSimId = $this->data['solicitud_sim_id'] ?? null;

        return new DespachoSim([
            'serial_number' => $serialNumber,
            'solicitud_sim_id' => $solicitudSimId,
            'estado' => 'completado',
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your despacho sim import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
