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
        Schema::create('hasil_topsis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kurir_id')->constrained()->onDelete('cascade');
            $table->integer('tahun');
            $table->tinyInteger('periode'); // 1 = Jan–Jun, 2 = Jul–Des
            $table->float('nilai_preferensi', 8, 4); // nilai V
            $table->integer('ranking');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_topses');
    }
};
