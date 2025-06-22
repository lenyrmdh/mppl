<?php

namespace App\Filament\Admin\Resources\DataPegawaiResource\Pages;

use App\Filament\Admin\Resources\DataPegawaiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataPegawai extends EditRecord
{
    protected static string $resource = DataPegawaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
