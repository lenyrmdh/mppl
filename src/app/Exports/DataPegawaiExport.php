<?php

namespace App\Exports;

use App\Models\DataPegawai;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class DataPegawaiExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithTitle,
    WithColumnWidths,
    ShouldAutoSize,
    WithMapping
{
    protected $last6Months;

    public function __construct()
    {
        $this->last6Months = collect();
        $now = Carbon::now();

        for ($i = 5; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i);
            $this->last6Months->push([
                'month' => $date->month,
                'year' => $date->year,
                'label' => $date->format('F Y'),
            ]);
        }
    }

    public function collection()
    {
        return DataPegawai::with([
            'divisi',
            'jabatan',
            'absensis',
            'cutis',
            'gajis',
            'lemburs'
        ])->get();
    }

    public function map($pegawai): array
{
    $monthlySalaries = $this->last6Months->map(function ($item) use ($pegawai) {
        $monthlyTotal = $pegawai->gajis->filter(function ($gaji) use ($item) {
            $tanggal = Carbon::parse($gaji->periode); // ganti dari created_at ke periode
            return $tanggal->month === $item['month'] && $tanggal->year === $item['year'];
        })->sum('total_gaji');

        return number_format($monthlyTotal, 0, ',', '.');
    })->toArray();

    // Hitung total gaji 6 bulan terakhir (Jan–Jun 2025 saja)
    $totalGaji6Bulan = $pegawai->gajis->filter(function ($gaji) {
        $tanggal = Carbon::parse($gaji->periode);
        return $tanggal->year === 2025 && $tanggal->month >= 1 && $tanggal->month <= 6;
    })->sum('total_gaji');

    $totalLemburJam = $pegawai->lemburs->filter(function ($lembur) {
        return $lembur->jam_mulai && $lembur->jam_selesai;
    })->sum(function ($lembur) {
        $mulai = Carbon::parse($lembur->jam_mulai);
        $selesai = Carbon::parse($lembur->jam_selesai);
        return min($mulai, $selesai)->diffInHours(max($mulai, $selesai));
    });

    return array_merge([
        $pegawai->id,
        $pegawai->nama,
        $pegawai->email,
        $pegawai->divisi->nama ?? '-',
        $pegawai->jabatan->nama ?? '-',
        $pegawai->absensis->count(),
        $pegawai->cutis->count(),
    ], $monthlySalaries, [
        number_format($totalGaji6Bulan, 0, ',', '.'), // Fix di sini
        $totalLemburJam,
    ]);
}


    public function headings(): array
    {
        $monthHeadings = $this->last6Months->map(fn($m) => "Gaji {$m['label']} (Rp)")->toArray();

        return array_merge([
            'ID',
            'Nama',
            'Email',
            'Divisi',
            'Jabatan',
            'Total Absensi',
            'Total Cuti',
        ], $monthHeadings, [
            'Total Gaji (Rp)',
            'Total Lembur (Jam)',
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $sheet->getStyle("A1:{$highestColumn}1")->getFont()->setBold(true);
        $sheet->getStyle("A1:{$highestColumn}1")->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFBDD7EE');

        $sheet->getStyle("A2:{$highestColumn}{$highestRow}")->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFF2F2F2');

        $sheet->getStyle("A1:{$highestColumn}{$highestRow}")
            ->getBorders()->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [];
    }

    public function title(): string
    {
        return 'Data Pegawai';
    }

    public function columnWidths(): array
    {
        // Total kolom tetap menyesuaikan
        $totalColumns = 7 + $this->last6Months->count() + 2;
        $columns = range('A', chr(64 + $totalColumns));
        $widths = [];

        foreach ($columns as $col) {
            $widths[$col] = 18;
        }

        // Ukuran spesial untuk kolom awal
        $widths['A'] = 5;
        $widths['B'] = 25;
        $widths['C'] = 30;

        return $widths;
    }
}
