<?php

namespace App\Filament\Resources\SolicitudSims\Pages;

use App\Filament\Resources\SolicitudSims\SolicitudSimResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSolicitudSim extends CreateRecord
{
    protected static string $resource = SolicitudSimResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['estado'] = 'pendiente';

        return $data;
    }
}
