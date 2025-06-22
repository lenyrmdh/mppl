<?php

namespace App\Filament\Admin\Resources\DataPegawaiResource\Pages;

use App\Filament\Admin\Resources\DataPegawaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataPegawaiExport;


class ListDataPegawais extends ListRecords
{
    protected static string $resource = DataPegawaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
        Action::make('exportExcel')
        ->label('Export Rekap')
        ->icon('heroicon-o-arrow-down-tray')
        ->action(fn () => Excel::download(new DataPegawaiExport, 'rekap-data-pegawai.xlsx')),
        ];

        return [
        Action::make('Export PDF')
            ->url(route('pegawai.export.pdf'))
            ->openUrlInNewTab()
            ->color('danger')
            ->icon('heroicon-o-document-text'),
    ];
    }
}
