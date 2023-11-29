<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_products', function (Blueprint $table) {
            $table->char('id', 30)->primary();
            $table->char('product_id', 30);
            $table->string('asal');
            $table->string('panen');
            $table->string('kelas');
            $table->string('db');
            $table->integer('sisa');
            $table->integer('produksi');
            $table->integer('masuk');
            $table->integer('keluar_komersial');
            $table->integer('keluar_nonkomersial');
            $table->string('tahun');
            $table->string('bulan');
            $table->string('slug');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_product');
    }
}
