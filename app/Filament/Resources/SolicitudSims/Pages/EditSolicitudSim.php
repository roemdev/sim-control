<?php

namespace App\Filament\Resources\SolicitudSims\Pages;

use App\Filament\Resources\SolicitudSims\SolicitudSimResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSolicitudSim extends EditRecord
{
    protected static string $resource = SolicitudSimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
