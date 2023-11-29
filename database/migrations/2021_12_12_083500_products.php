<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->char('id', 30)->primary();
            $table->char('category_id', 30);
            $table->string('name');
            $table->string('image');
            $table->text('description');
            $table->string('unit');
            $table->integer('price');
            $table->string('slug');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
