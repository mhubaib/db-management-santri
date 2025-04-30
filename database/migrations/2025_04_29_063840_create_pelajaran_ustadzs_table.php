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
        Schema::create('pelajaran_ustadzs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ustadz_id')->constrained('ustadzs')->onDelete('cascade');
            $table->foreignId('pelajaran_id')->constrained('pelajarans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelajaran_ustadzs');
    }
};
