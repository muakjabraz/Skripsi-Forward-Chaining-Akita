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
        Schema::create('aturans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gejala_id')->nullable();
            $table->unsignedBigInteger('kasus_id');
            $table->foreign('gejala_id')->references('id')->on('gejalas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kasus_id')->references('id')->on('kasuses')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aturans');
    }
};
