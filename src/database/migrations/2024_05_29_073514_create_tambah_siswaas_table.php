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
        Schema::create('tambah_siswaas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nis')->nullable();
            $table->string('nama_siswaa')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('kelas')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('nama_orangtua')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tambah_siswaas');
    }
};
