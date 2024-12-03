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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama');
            $table->string('email')->nullable(true);
            $table->string('soc_website')->default('Tidak Ada/Belum Diatur');
            $table->string('soc_github')->default('Tidak Ada/Belum Diatur');
            $table->string('soc_x')->default('Tidak Ada/Belum Diatur');
            $table->string('soc_ig')->default('Tidak Ada/Belum Diatur');
            $table->string('soc_fb')->default('Tidak Ada/Belum Diatur');
            $table->string('alamat')->default('Tidak Ada/Belum Diatur');
            $table->string('notelp')->default('Tidak Ada/Belum Diatur');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('foto_profil')->nullable(true);
            $table->enum('role', ['admin', 'pengurus']);
            $table->enum('status', ['aktif', 'pending', 'nonaktif'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
