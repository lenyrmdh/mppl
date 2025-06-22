<?php

namespace App\Filament\Admin\Resources\CutiResource\Pages;

use App\Filament\Admin\Resources\CutiResource;
use Filament\Resources\Pages\EditRecord;

class EditCuti extends EditRecord
{
    protected static string $resource = CutiResource::class;

    protected function authorizeAccess(): void
    {
        if (!auth()->user()->can('update_cuti')) {
            abort(403, 'Anda tidak punya akses.');
        }
    }
}
