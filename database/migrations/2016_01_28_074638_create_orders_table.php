<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('sum')->unsigned();
            $table->string('address');
            $table->integer('status')->default(0)->unsigned();
            $table->timestamps();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->timestamps();
        });

        Schema::create('unit_cats', function (Blueprint $table) {
            $table->integer('cat_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->timestamps();
            $table->foreign('cat_id')
                  ->references('id')->on('cats')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('unit_id')
                  ->references('id')->on('units')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
        Schema::drop('units');
        Schema::drop('unit_cats');
    }
}
