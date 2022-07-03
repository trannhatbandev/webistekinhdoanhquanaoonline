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
        Schema::create('product', function (Blueprint $table) {
            $table->integerIncrements('product_id');
            $table->string('product_name',255);
            $table->string('product_slug',255);
            $table->text('product_description');
            $table->double('product_price');
            $table->double('product_price_sale');
            $table->string('product_image',255);
            $table->integer('product_status');
            $table->integer('category_id');
            $table->integer('brand_id');
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
        Schema::dropIfExists('product');
    }
};
