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
        $table->id('id_order');
        $table->unsignedBigInteger('id_account');
        $table->foreign('id_account')->references('id_account')->on('account');
        $table->string('product');
        $table->double('value');
        $table->double('total');
        $table->integer('quantity');
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
