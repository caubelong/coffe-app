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
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('cate_id');
            $table->text('desc');
            $table->string('thumbnail')->default('empty.jpg');
            $table->decimal('price');
            $table->integer('discount')->default(0);
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
        });
        Schema::table('product',function (Blueprint $table){
            $table->foreign('cate_id')->references('id')->on('category')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('user')->onDelete('cascade');
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
