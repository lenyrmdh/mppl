<?php

namespace App\Filament\Admin\Resources\DivisiResource\Pages;

use App\Filament\Admin\Resources\DivisiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDivisis extends ListRecords
{
    protected static string $resource = DivisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
