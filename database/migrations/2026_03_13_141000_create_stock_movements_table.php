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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id('movement_id');
            $table->integer('product_id')->nullable();
            $table->string('movement_type', 40)->nullable();
            $table->double('qty', 12, 2)->nullable();
            $table->double('unit_cost', 12, 2)->nullable();
            $table->double('selling_price', 12, 2)->nullable();
            $table->string('ref_type', 40)->nullable();
            $table->integer('ref_id')->nullable();
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
        Schema::dropIfExists('stock_movements');
    }
};
