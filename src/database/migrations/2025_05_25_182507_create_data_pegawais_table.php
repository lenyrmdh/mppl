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
        Schema::create('data_pegawais', function (Blueprint $table) {
    $table->id();
    $table->string('nip')->unique();
    $table->string('nama');
    $table->string('password');
    $table->enum('role', ['admin', 'pegawai'])->default('pegawai');
    $table->enum('jenis_kelamin', ['L', 'P']);
    $table->date('tanggal_lahir');
    $table->string('alamat');
    $table->string('no_hp');
    $table->foreignId('jabatan_id')->constrained()->onDelete('cascade');
    $table->foreignId('divisi_id')->constrained()->onDelete('cascade');
    $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pegawais');
    }
};
