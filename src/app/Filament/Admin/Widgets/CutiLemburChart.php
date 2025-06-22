<?php

namespace App\Filament\Widgets; // ✅ PENTING: Tambahkan ini agar dikenali!

use App\Models\Cuti;
use App\Models\Lembur;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class CutiLemburChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Cuti & Lembur per Bulan';

    protected function getData(): array
    {
        $cutiData = [];
        $lemburData = [];

        foreach (range(1, 12) as $bulan) {
            $cuti = Cuti::whereYear('tanggal_mulai', Carbon::now()->year)
                        ->whereMonth('tanggal_mulai', $bulan)
                        ->count();

            $lembur = Lembur::whereYear('tanggal', Carbon::now()->year)
                            ->whereMonth('tanggal', $bulan)
                            ->count();

            $cutiData[] = $cuti;
            $lemburData[] = $lembur;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Cuti',
                    'data' => $cutiData,
                    'backgroundColor' => '#facc15', // kuning
                ],
                [
                    'label' => 'Lembur',
                    'data' => $lemburData,
                    'backgroundColor' => '#10b981', // hijau
                ],
            ],
            'labels' => [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
