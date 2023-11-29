<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->char('id', 30)->primary();
            $table->foreignId('user_id');
            $table->integer('paid_total');
            $table->string('status');
            $table->string('alamat');
            $table->string('zip_code');
            $table->string('kabupaten_kota');
            $table->string('provinsi');
            $table->string('no_hp');
            $table->string('nama_penerima');
            $table->string('bukti_transfer_produk')->nullable();
            $table->string('bukti_transfer_ongkir')->nullable();
            $table->integer('total_produk');
            $table->integer('total_ongkir');
            $table->string('order_notes');
            $table->text('coordinate_map');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
