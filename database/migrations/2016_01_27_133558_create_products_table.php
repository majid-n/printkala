<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('des', 300);
            $table->integer('cat_id')->unsigned();
            $table->string('size', 20);
            $table->integer('weight')->unsigned();
            $table->string('pic', 100);
            $table->boolean('active')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->index('name');
            $table->index('des');
            // $table->foreign('cat_id')
            //       ->references('id')->on('cats')
            //       ->onDelete('cascade')
            //       ->onUpdate('cascade');
        });

        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->integer('price')->unsigned();
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
        Schema::drop('products');
        Schema::drop('prices');
    }
}
