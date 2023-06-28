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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('installation_id');
            $table->foreign('installation_id')->references('id')->on('installations');
            $table->date('tanggal_tagihan');
            $table->double('total_tagihan', 15, 2);
            $table->enum('status_tagihan', ['Belum Dibayar', 'Dalam Proses','Lunas'])->default('Belum Dibayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
