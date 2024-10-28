<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id('id_absensi');
            $table->unsignedBigInteger('santri_id');
            $table->unsignedBigInteger('absensi_kelas');
            $table->string('1')->default('H');
            $table->string('2')->default('H');
            $table->string('3')->default('H');
            $table->string('4')->default('H');
            $table->string('5')->default('H');
            $table->string('6')->default('H');
            $table->string('7')->default('H');
            $table->string('8')->default('H');
            $table->string('9')->default('H');
            $table->string('10')->default('H');
            $table->string('11')->default('H');
            $table->string('12')->default('H');
            $table->string('13')->default('H');
            $table->string('14')->default('H');
            $table->string('15')->default('H');
            $table->string('16')->default('H');
            $table->string('17')->default('H');
            $table->string('18')->default('H');
            $table->string('19')->default('H');
            $table->string('20')->default('H');
            $table->string('21')->default('H');
            $table->string('22')->default('H');
            $table->string('23')->default('H');
            $table->string('24')->default('H');
            $table->string('25')->default('H');
            $table->string('26')->default('H');
            $table->string('27')->default('H');
            $table->string('28')->default('H');
            $table->string('29')->default('H');
            $table->string('30')->default('H');
            $table->string('31')->default('H');
            $table->foreign('santri_id')
                ->references('id_santri')
                ->on('santri')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('absensi_kelas')
                ->references('id_absensi_kelas')
                ->on('absensi_kelas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
