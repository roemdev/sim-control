<?php

namespace App\Filament\Resources\SolicitudSims;

use App\Filament\Resources\SolicitudSims\Pages\CreateSolicitudSim;
use App\Filament\Resources\SolicitudSims\Pages\EditSolicitudSim;
use App\Filament\Resources\SolicitudSims\Pages\ListSolicitudSims;
use App\Filament\Resources\SolicitudSims\Schemas\SolicitudSimForm;
use App\Filament\Resources\SolicitudSims\Tables\SolicitudSimsTable;
use App\Models\SolicitudSim;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class SolicitudSimResource extends Resource
{
    protected static ?string $modelLabel = 'Solicitud';
    protected static ?string $pluralModelLabel = 'Solicitudes de SIMs';
    protected static ?string $navigationLabel = 'Solicitudes';

    protected static ?string $model = SolicitudSim::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SolicitudSimForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SolicitudSimsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSolicitudSims::route('/'),
            'create' => CreateSolicitudSim::route('/create'),
            'edit' => EditSolicitudSim::route('/{record}/edit'),
        ];
    }
}
