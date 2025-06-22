<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SlipGajiResource\Pages;
use App\Filament\Admin\Resources\SlipGajiResource\RelationManagers;
use App\Models\SlipGaji;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\URL;


class SlipGajiResource extends Resource
{
    protected static ?string $model = SlipGaji::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Laporan'; // ← ditambahkan

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('pegawai_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('periode')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('gaji_pokok')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('tunjangan')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('potongan')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_lembur')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_cuti')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('sisa_cuti')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('gaji_bersih')
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('gaji_pokok')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tunjangan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('potongan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_lembur')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_cuti')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sisa_cuti')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gaji_bersih')
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
                Action::make('Export PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (SlipGaji $record) => route('slip-gaji.export.pdf', $record)) // pakai route yang akan kita buat
                    ->openUrlInNewTab()
                    ->color('success')
                    ->label('Export'),
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
            'index' => Pages\ListSlipGajis::route('/'),
            'create' => Pages\CreateSlipGaji::route('/create'),
            'edit' => Pages\EditSlipGaji::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('view_any_slip_gaji');
    }
}


