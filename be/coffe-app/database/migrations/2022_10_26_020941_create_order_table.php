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
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_name');
            $table->string('phone');
            $table->string('address');
            $table->string('note');
            $table->unsignedBigInteger('status');
            $table->decimal('total_money');
            $table->timestamps();
        });
        Schema::table('order',function (Blueprint $table){
           $table->foreign('status')->references('id')->on('status_order')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
};
