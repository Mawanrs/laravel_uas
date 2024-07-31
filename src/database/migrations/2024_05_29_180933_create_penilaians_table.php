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
    Schema::create('penilaians', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('tambah_siswaa_id')->nullable();
        $table->string('prestasi')->nullable();
        $table->bigInteger('nilai_displin')->nullable();
        $table->bigInteger('nilai_absensi')->nullable();
        $table->bigInteger('nilai_mpe')->nullable();
        $table->string('keterangan')->nullable();
        $table->timestamps();
        $table->softDeletes();

        // Add the foreign key constraint
        $table->foreign('tambah_siswaa_id')->references('id')->on('tambah_siswaas')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
