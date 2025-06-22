<?php

namespace App\Filament\Widgets;

use App\Models\Gaji;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class GajiChart extends ChartWidget
{
    protected static ?string $heading = 'Pengeluaran Gaji per Bulan';

    protected function getData(): array
    {
        $data = [];

        foreach (range(1, 12) as $bulan) {
            $data[] = Gaji::whereMonth('periode', $bulan)
                ->whereYear('periode', Carbon::now()->year)
                ->sum('total_gaji');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Gaji',
                    'data' => $data,
                    'backgroundColor' => '#3b82f6',
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
