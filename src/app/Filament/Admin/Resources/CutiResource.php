<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CutiResource\Pages;
use App\Models\Cuti;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CutiResource extends Resource
{
    protected static ?string $model = Cuti::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Management Pegawai';

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Pegawai hanya melihat datanya sendiri
        if (auth()->user()->role === 'pegawai') {
            return $query->where('pegawai_id', session('pegawai_id'));
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Hidden::make('pegawai_id')
                ->default(fn () => session('pegawai_id'))
                ->visible(fn () => auth()->user()->role === 'pegawai'),

            Forms\Components\Select::make('pegawai_id')
                ->label('Nama Pegawai')
                ->relationship('pegawai', 'nama')
                ->searchable()
                ->required()
                ->visible(fn () => auth()->user()->role !== 'pegawai'),

            Forms\Components\DatePicker::make('tanggal_mulai')
                ->required()
                ->label('Tanggal Mulai'),

            Forms\Components\DatePicker::make('tanggal_selesai')
                ->required()
                ->label('Tanggal Selesai'),

            Forms\Components\Textarea::make('alasan')
                ->required()
                ->label('Alasan Cuti')
                ->columnSpanFull(),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'Menunggu' => 'Menunggu',
                    'Disetujui' => 'Disetujui',
                    'Ditolak' => 'Ditolak',
                ])
                ->default('Menunggu')
                ->disabled(fn () => auth()->user()->role === 'pegawai'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('pegawai.nama')
                ->label('Nama Pegawai')
                ->sortable()
                ->searchable()
                ->visible(fn () => auth()->user()->role !== 'pegawai'),

            Tables\Columns\TextColumn::make('tanggal_mulai')
                ->label('Tanggal Mulai')
                ->date(),

            Tables\Columns\TextColumn::make('tanggal_selesai')
                ->label('Tanggal Selesai')
                ->date(),

            Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'primary' => 'Menunggu',
                    'success' => 'Disetujui',
                    'danger' => 'Ditolak',
                ]),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Diajukan Pada')
                ->dateTime(),
        ])
        ->actions([
            Tables\Actions\EditAction::make()
                ->visible(fn () => auth()->user()->can('update_cuti')),

            Tables\Actions\Action::make('Setujui')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn ($record) =>
                    auth()->user()->can('update_cuti') && $record->status === 'Menunggu'
                )
                ->action(function (Cuti $record) {
                    if (!auth()->user()->can('update_cuti')) {
                        abort(403);
                    }
                    $record->update(['status' => 'Disetujui']);
                }),

            Tables\Actions\Action::make('Tolak')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn ($record) =>
                    auth()->user()->can('update_cuti') && $record->status === 'Menunggu'
                )
                ->action(function (Cuti $record) {
                    if (!auth()->user()->can('update_cuti')) {
                        abort(403);
                    }
                    $record->update(['status' => 'Ditolak']);
                }),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make()
                ->visible(fn () => auth()->user()->can('delete_any_cuti')),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCutis::route('/'),
            'create' => Pages\CreateCuti::route('/create'),
            'edit' => Pages\EditCuti::route('/{record}/edit'),
        ];
    }
}
