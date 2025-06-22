<?php

namespace App\Filament\Widgets;

use App\Models\DataPegawai;
use App\Models\Divisi;
use App\Models\Gaji;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget;
use Carbon\Carbon;

class SummaryStats extends StatsOverviewWidget
{
    protected static ?string $pollingInterval = null;

    protected function getCards(): array
    {
        // Hitung total gaji bulan ini
        $totalGajiBulanIni = Gaji::whereMonth('periode', Carbon::now()->month)
            ->whereYear('periode', Carbon::now()->year)
            ->sum('total_gaji');

        return [
            Card::make('Total Pegawai', DataPegawai::count())
                ->color('success'),

            Card::make('Total Divisi', Divisi::count())
                ->color('info'),

            Card::make('Total Gaji Bulan Ini', 'Rp ' . number_format($totalGajiBulanIni, 0, ',', '.'))
                ->description('Periode: ' . Carbon::now()->format('F Y'))
                ->color('warning'),
        ];
    }
}
