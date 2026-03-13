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
        Schema::create('purchase_histories', function (Blueprint $table) {
            $table->id('history_id');
            $table->integer('purchase_id')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('chalan_no', 120)->nullable();
            $table->double('update_stock', 12, 2)->nullable();
            $table->integer('product')->nullable();
            $table->double('quantity', 12, 2)->nullable();
            $table->double('unit_price', 12, 2)->nullable();
            $table->double('profit_percent', 8, 2)->nullable();
            $table->double('selling_price', 12, 2)->nullable();
            $table->double('total_price', 12, 2)->nullable();
            $table->string('batch_no', 120)->nullable();
            $table->date('production_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->double('adjustment_cost', 12, 2)->nullable();
            $table->integer('supplier')->nullable();
            $table->string('receiver_name', 150)->nullable();
            $table->integer('color')->nullable();
            $table->integer('size')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('material')->nullable();
            $table->integer('brands')->nullable();
            $table->integer('category')->nullable();
            $table->string('availability', 40)->nullable();
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
        Schema::dropIfExists('purchase_histories');
    }
};
