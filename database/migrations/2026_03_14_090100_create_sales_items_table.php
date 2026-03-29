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
        Schema::create('sales_items', function (Blueprint $table) {
            $table->id('item_id');
            $table->integer('sales_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('product_name', 150)->nullable();
            $table->double('qty', 12, 2)->nullable();
            $table->double('price', 12, 2)->nullable();
            $table->double('total', 12, 2)->nullable();
            $table->string('remarks', 250)->nullable();
            $table->string('action_type', 50)->nullable();
            $table->string('user_id', 200)->nullable();
            $table->date('action_date')->nullable();
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
        Schema::dropIfExists('sales_items');
    }
};
