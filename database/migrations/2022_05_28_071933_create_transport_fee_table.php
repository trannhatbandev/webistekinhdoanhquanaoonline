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
        Schema::create('transport_fee', function (Blueprint $table) {
            $table->integerIncrements('transport_fee_id');
            $table->integer('matp');
            $table->integer('maqh');
            $table->integer('maxptt');
            $table->double('transport_fee_freeship');
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
        Schema::dropIfExists('transport_fee');
    }
};
