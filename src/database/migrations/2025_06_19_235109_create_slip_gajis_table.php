<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('slip_gajis', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pegawai_id')->constrained('data_pegawais')->onDelete('cascade');
    $table->string('periode'); // contoh: '2025-06'
    $table->integer('gaji_pokok');
    $table->integer('tunjangan');
    $table->integer('potongan');
    $table->integer('total_lembur');
    $table->integer('total_cuti');
    $table->integer('sisa_cuti');
    $table->integer('gaji_bersih');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slip_gajis');
    }
};
