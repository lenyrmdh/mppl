<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GajiResource\Pages;
use App\Filament\Admin\Resources\GajiResource\RelationManagers;
use App\Models\Gaji;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GajiResource extends Resource
{
    protected static ?string $model = Gaji::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Management Pegawai';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('pegawai_id')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('periode')
                    ->required(),
                Forms\Components\TextInput::make('gaji_pokok')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('tunjangan')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('potongan')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('total_gaji')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pegawai_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('periode')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gaji_pokok')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tunjangan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('potongan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_gaji')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGajis::route('/'),
            'create' => Pages\CreateGaji::route('/create'),
            'edit' => Pages\EditGaji::route('/{record}/edit'),
        ];
    }
}
