<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('absensi_kelas', function (Blueprint $table) {
            $table->id('id_absensi_kelas'); // Sesuaikan dengan konvensi penamaan
            $table->foreignId('id_kelas')->constrained('kelas', 'id_kelas')->onDelete('cascade');
            $table->string('bulan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensi_kelas');
    }
};
