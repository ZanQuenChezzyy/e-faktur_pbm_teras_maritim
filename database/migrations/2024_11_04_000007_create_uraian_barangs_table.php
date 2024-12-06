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
        Schema::create('uraian_barangs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('barang_jasa_id')->constrained('barang_jasas', 'id');

            $table->string('nama', 100);
            $table->unsignedSmallInteger('kuantitas')->length(5);
            $table->unsignedBigInteger('harga_per_unit');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uraian_barangs');
    }
};
