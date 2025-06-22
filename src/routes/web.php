<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Livewire\ShowHomePage;
use App\Exports\DataPegawaiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ExportSlipGajiController;


/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', ShowHomePage::class)->name('home');


Route::get('/data-pegawai/export', function () {
    return Excel::download(new DataPegawaiExport, 'rekap-data-pegawai.xlsx');
})->name('data-pegawai.export');

Route::get('/slip-gaji/{slipGaji}/export-pdf', [ExportSlipGajiController::class, 'export'])
    ->name('slip-gaji.export.pdf');


