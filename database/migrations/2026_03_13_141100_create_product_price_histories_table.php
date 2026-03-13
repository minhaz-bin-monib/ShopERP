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
        Schema::create('product_price_histories', function (Blueprint $table) {
            $table->id('history_id');
            $table->integer('product_id')->nullable();
            $table->double('old_price', 12, 2)->nullable();
            $table->double('new_price', 12, 2)->nullable();
            $table->string('source', 40)->nullable();
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
        Schema::dropIfExists('product_price_histories');
    }
};
