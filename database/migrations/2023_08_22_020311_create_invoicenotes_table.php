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
        Schema::create('invoicenotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('installation_id');
            $table->foreign('installation_id')->references('id')->on('installations');
            $table->string('mulai_bulan');
            $table->string('sampai_bulan');
            $table->string('mulai_tahun');
            $table->string('sampai_tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoicenotes');
    }
};
