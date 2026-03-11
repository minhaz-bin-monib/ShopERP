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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_name', 150);
            $table->string('unit_type', 50)->nullable();
            $table->string('product_code', 100)->nullable();
            $table->double('purchase_price', 10, 2)->nullable();
            $table->double('selling_price', 10, 2)->nullable();
            $table->double('reminder_high', 10, 2)->nullable();
            $table->double('reminder_low', 10, 2)->nullable();
            $table->integer('company')->nullable();
            $table->integer('department')->nullable();
            $table->integer('supplier')->nullable();
            $table->integer('color')->nullable();
            $table->integer('size')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('material')->nullable();
            $table->integer('brands')->nullable();
            $table->integer('category')->nullable();
            $table->string('product_status', 50)->nullable();
            $table->string('action_type',50)->nullable();
            $table->string('user_id',200)->nullable();
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
        Schema::dropIfExists('products');
    }
};
