<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_products', function (Blueprint $table) {

            $table->increments('id');
            $table->string('sku');
            $table->string('title');
            $table->string('unit');
            $table->string('content');
            $table->string('price');
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
        Schema::drop('child_products');
    }
}
