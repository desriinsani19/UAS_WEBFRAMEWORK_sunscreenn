<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_penilaian_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->enum('produk_sunscreen', ['Wardah', 'Skintific', 'Emina', 'The Originote', 'G2G']);
            $table->decimal('harga', 10, 2);
            $table->integer('kemasan');
            $table->integer('kandungan');
            $table->integer('ketahanan');
            $table->string('usia');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaian');
    }
};