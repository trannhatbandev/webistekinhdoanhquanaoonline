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
        Schema::create('momo', function (Blueprint $table) {
            $table->integerIncrements('momo_id');
            $table->string('partnerCode',255);
            $table->string('orderId',255);
            $table->double('amount');
            $table->string('orderInfo',100);
            $table->string('transId',255);
            $table->string('message',20);
            $table->string('payType',50);
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
        Schema::dropIfExists('momo');
    }
};
