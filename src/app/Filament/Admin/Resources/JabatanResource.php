<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\JabatanResource\Pages;
use App\Models\Jabatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JabatanResource extends Resource
{
    // Model yang digunakan resource ini
    protected static ?string $model = Jabatan::class;

    // Icon yang tampil di menu sidebar Filament
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Management Pegawai';
    
    

    // Nama grup navigasi jika ingin mengelompokkan (optional)
    // protected static ?string $navigationGroup = 'Master Data';

    // Urutan menu (optional)
    // protected static ?int $navigationSort = 10;

    // Mendefinisikan form input untuk create & edit
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Jabatan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    // Mendefinisikan tabel yang tampil di list resource
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Jabatan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
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
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // Jika ada relasi yang ingin dikelola dari sini (misal relation manager)
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // Mendefinisikan route page resource (List, Create, Edit)
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJabatans::route('/'),
            'create' => Pages\CreateJabatan::route('/create'),
            'edit' => Pages\EditJabatan::route('/{record}/edit'),
        ];
    }
}
