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
            Schema::create('gajis', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('pegawai_id');
        $table->foreign('pegawai_id')->references('id')->on('data_pegawais')->onDelete('cascade');
        $table->date('periode');
        $table->decimal('gaji_pokok', 12, 2);
        $table->integer('lembur')->default(0);
        $table->decimal('tunjangan', 12, 2)->default(0);
        $table->decimal('potongan', 12, 2)->default(0);
        $table->decimal('total_gaji', 12, 2);
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gajis');
    }
};
