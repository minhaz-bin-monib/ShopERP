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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id('sales_id');
            $table->date('sales_date')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('customer_name', 150)->nullable();
            $table->string('customer_address', 250)->nullable();
            $table->string('customer_phone', 30)->nullable();
            $table->string('bill_no', 80)->nullable();
            $table->string('assistant_name', 150)->nullable();
            $table->string('sold_by', 200)->nullable();
            $table->string('reference', 120)->nullable();
            $table->double('special_discount_percent', 8, 2)->nullable();
            $table->string('offer', 120)->nullable();
            $table->double('gross_amount', 12, 2)->nullable();
            $table->double('loyalty', 12, 2)->nullable();
            $table->double('manual_discount_percent', 8, 2)->nullable();
            $table->double('net_amount', 12, 2)->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->string('payment_details', 250)->nullable();
            $table->string('bonus_card', 120)->nullable();
            $table->double('given_amount', 12, 2)->nullable();
            $table->double('paid_amount', 12, 2)->nullable();
            $table->double('new_paid_amount', 12, 2)->nullable();
            $table->double('payable_amount', 12, 2)->nullable();
            $table->string('status', 40)->nullable();
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
        Schema::dropIfExists('sales_orders');
    }
};
