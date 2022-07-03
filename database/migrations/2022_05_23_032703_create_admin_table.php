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
        Schema::create('admin', function (Blueprint $table) {
            $table->integerIncrements('admin_id');
            $table->string('admin_email',100);
            $table->string('admin_password',255);
            $table->string('admin_full_name',255);
            $table->string('admin_phone',12);
            $table->string('admin_address',255);
            $table->string('admin_token',255);
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
        Schema::dropIfExists('admin');
    }
};