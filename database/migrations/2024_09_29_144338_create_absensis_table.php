<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('absensi', function (Blueprint $table) {
        $table->id('id_absensi');
        $table->foreignId('id_absensi_kelas')->constrained('absensi_kelas', 'id_absensi_kelas')->onDelete('cascade');
        $table->foreignId('id_santri')->constrained('santri', 'id_santri')->onDelete('cascade');
        $table->integer('tanggal');
        $table->enum('status', ['H', 'S', 'I', 'A']);
        $table->string('keterangan')->nullable();
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('absensi');
    }
};
