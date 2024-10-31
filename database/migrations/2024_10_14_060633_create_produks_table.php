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
        Schema::create('products', function (Blueprint $table) {
            $table->char('p_id', 3)->primary();
            $table->string('p_nama');
            $table->string('p_gambar');
            $table->integer('p_harga');
            $table->integer('p_stok');
            $table->string('p_deskripsi');
            $table->string('p_kategori');
            $table->dateTime('p_tgldibuat')->default(now());
            $table->dateTime('p_tglupdate')->default(now());
            $table->integer('p_berat');
            $table->bigInteger('penjual_p_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
