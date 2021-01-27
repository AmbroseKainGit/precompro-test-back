<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('order', function (Blueprint $table) {
        $table->increments('id');
        $table->unsignedBigInteger('id_account');
        $table->foreign('id_account')->references('id')->on('account');
        $table->string('product');
        $table->double('value');
        $table->double('total');
        $table->integer('quantity');
        $table->timestamps();
        $table->softDeletes();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('order');
    }
}
