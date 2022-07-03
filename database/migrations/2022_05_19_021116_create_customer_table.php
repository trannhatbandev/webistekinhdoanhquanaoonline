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
        Schema::create('customer', function (Blueprint $table) {
            $table->integerIncrements('customer_id');
            $table->string('customer_email',100);
            $table->string('customer_password',255);
            $table->string('customer_full_name',255);
            $table->string('customer_phone',12);
            $table->string('customer_address',255);
            $table->integer('customer_vip');
            $table->string('customer_token',255);
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
        Schema::dropIfExists('customer');
    }
};
