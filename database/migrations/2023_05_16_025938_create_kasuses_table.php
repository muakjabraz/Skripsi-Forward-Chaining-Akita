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
        Schema::create('kasuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('penyakit_id');
            $table->foreign('pasien_id')->references('id')->on('pasiens')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('penyakit_id')->references('id')->on('penyakits')->onDelete('cascade')->onUpdate('cascade');
            $table->float('bobot');
            $table->text('catatan')->nullable();
            $table->enum('status', ['selesai', 'tunggu'])->default('selesai');
            $table->enum('type', ['aturan', 'riwayat'])->default('riwayat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasuses');
    }
};
