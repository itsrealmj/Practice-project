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
        Schema::create('addedtocarts', function (Blueprint $table) {
            $table->id();
            $table->string('cart_product_name');
            $table->string('cart_product_desc');
            $table->integer('cart_product_qty');
            $table->string('cart_product_path');
            $table->float('cart_product_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addedtocarts');
    }
};