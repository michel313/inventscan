<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RememberedSuppliers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remembered_suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku');
            $table->string('title');
            $table->string('unit');
            $table->string('content');
            $table->string('price');
            $table->string('ean_code');
            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')
                ->references('id')->on('suppliers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::drop('remembered_suppliers');
    }
}
