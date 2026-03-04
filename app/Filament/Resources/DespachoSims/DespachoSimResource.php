<?php

namespace App\Filament\Resources\DespachoSims;

use App\Filament\Imports\DespachoSimImporter;
use App\Filament\Resources\DespachoSims\Pages\ManageDespachoSims;
use App\Models\DespachoSim;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DespachoSimResource extends Resource
{
    protected static ?string $model = DespachoSim::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('serial_number')
                    ->required()
                    ->exists('sim_cards', 'serial_number')
                    ->label('SN o ICCID'),
                Select::make('solicitud_sim_id')
                    ->relationship('solicitudSim', 'codigo')
                    ->required()
                    ->label('Solicitud'),
                TextInput::make('estado')
                    ->default('completado')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serial_number')
                    ->label('SN o ICCID')
                    ->searchable(),
                TextColumn::make('solicitudSim.codigo')
                    ->label('Código Solicitud')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completado' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->headerActions([
                ImportAction::make()
                    ->importer(DespachoSimImporter::class),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageDespachoSims::route('/'),
        ];
    }
}
