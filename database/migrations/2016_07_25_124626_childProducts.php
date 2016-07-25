<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChildProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childProducts', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('sku');
            $table->string('title');
            $table->string('unit');
            $table->string('content');
            $table->decimal('mainPrice', 8, 2);
            $table->decimal('secondaryPrice', 8, 2);
            $table->string('ean_code');
            $table->integer('supplier_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('subcategory_id')->unsigned()->index();
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
        Schema::drop('childProducts');
    }
}
