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
        Schema::create('installations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id');
            $table->foreign('package_id')->references('id')->on('packages');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('tanggal_pemasangan');
            $table->string('alamat_pemasangan');
            $table->enum('status_pemasangan', ['Belum Terpasang', 'Dalam Proses', 'Terpasang'])->default('Belum Terpasang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installations');
    }
};
