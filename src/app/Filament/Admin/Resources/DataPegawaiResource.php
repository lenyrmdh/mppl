<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DataPegawaiResource\Pages;
use App\Models\DataPegawai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ExportAction;
use App\Exports\DataPegawaiExport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class DataPegawaiResource extends Resource
{
    protected static ?string $model = DataPegawai::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Management Pegawai';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nip')->required()->maxLength(255),
            Forms\Components\TextInput::make('nama')->required()->maxLength(255),
            Forms\Components\TextInput::make('email')->email()->required()->maxLength(255),
            Forms\Components\TextInput::make('password')->password()->required()->maxLength(255),
            Forms\Components\TextInput::make('role')->required(),
            Forms\Components\TextInput::make('jenis_kelamin')->required(),
            Forms\Components\DatePicker::make('tanggal_lahir')->required(),
            Forms\Components\TextInput::make('alamat')->required()->maxLength(255),
            Forms\Components\TextInput::make('no_hp')->required()->maxLength(255),
            Forms\Components\TextInput::make('jabatan_id')->required()->numeric(),
            Forms\Components\TextInput::make('divisi_id')->required()->numeric(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nip')->searchable(),
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('role'),
                Tables\Columns\TextColumn::make('jenis_kelamin'),
                Tables\Columns\TextColumn::make('tanggal_lahir')->date()->sortable(),
                Tables\Columns\TextColumn::make('alamat')->searchable(),
                Tables\Columns\TextColumn::make('no_hp')->searchable(),

                Tables\Columns\TextColumn::make('jabatan.nama')->label('Jabatan')->sortable(),
                Tables\Columns\TextColumn::make('divisi.nama')->label('Divisi')->sortable(),

                Tables\Columns\TextColumn::make('total_gaji')
    ->label('Total Gaji (Rp)')
    ->formatStateUsing(fn ($record) => number_format($record->total_gaji, 0, ',', '.')),

Tables\Columns\TextColumn::make('total_lembur')
    ->label('Total Lembur (Jam)')
    ->formatStateUsing(fn ($record) => $record->total_lembur),


                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportAction::make('export')
                        ->label('Export Excel')
                        ->exporter(DataPegawaiExport::class),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['gajis', 'lemburs', 'jabatan', 'divisi']);
    }
    

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataPegawais::route('/'),
            'create' => Pages\CreateDataPegawai::route('/create'),
            'edit' => Pages\EditDataPegawai::route('/{record}/edit'),
        ];
    }

}
