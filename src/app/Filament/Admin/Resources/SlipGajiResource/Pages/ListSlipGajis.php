<?php

namespace App\Filament\Admin\Resources\SlipGajiResource\Pages;

use App\Filament\Admin\Resources\SlipGajiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSlipGajis extends ListRecords
{
    protected static string $resource = SlipGajiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
