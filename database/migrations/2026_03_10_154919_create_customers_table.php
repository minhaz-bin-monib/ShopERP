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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id'); // Primary key with custom name
            $table->date(column: 'registration_date');
            $table->string('customer_name', 150);
            $table->string('customer_code', 150)->nullable();
            $table->string('proprietor_name', 150)->nullable();
            $table->string('profession', 150)->nullable();
            $table->string('organization_name', 150)->nullable();
            $table->string('customer_fathers_name', 150)->nullable();
            $table->string('customer_type', 50)->nullable();
            $table->double('customer_discount', 10, 2)->nullable();
            $table->date('customer_dob')->nullable();
            $table->string('customer_phone', 15)->nullable();
            $table->string('customer_nid', 25)->nullable();
            $table->string('customer_zone', 150)->nullable();
            $table->string('customer_reminder', 150)->nullable();
            $table->string('customer_address', 150)->nullable();
            $table->string('customer_note', 250)->nullable();
            $table->string('customer_status', 30)->nullable();
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
        Schema::dropIfExists('customers');
    }
};
