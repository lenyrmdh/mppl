<?php

namespace App\Filament\Admin\Resources\SlipGajiResource\Pages;

use App\Filament\Admin\Resources\SlipGajiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSlipGaji extends EditRecord
{
    protected static string $resource = SlipGajiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
