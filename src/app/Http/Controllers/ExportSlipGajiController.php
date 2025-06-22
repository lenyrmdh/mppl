<?php

namespace App\Http\Controllers;

use App\Models\SlipGaji;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ExportSlipGajiController extends Controller
{
    

        public function export(SlipGaji $slipGaji)
    {
        return view('exports.slip-gaji', compact('slipGaji'));
    }

}
