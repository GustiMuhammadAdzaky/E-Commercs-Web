<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_produk', function (Blueprint $table) {
            $table->id('id_pembelian_produk');
            $table->integer('id_pembelian');
            $table->integer('id_produk');
            $table->string('jumlah');
            $table->string('nama');
            $table->string('harga');
            $table->string('berat');
            $table->string('subberat');
            $table->string('subharga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pembelian_produk');
    }
};
