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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id('supplier_id'); // Primary key with custom name
            $table->date(column: 'registration_date')->nullable();
            $table->string('supplier_name', 150)->nullable();
            $table->string('proprietor_name', 150)->nullable();
            $table->date('supplier_dob')->nullable();
            $table->string('supplier_phone', 15)->nullable();
            $table->string('supplier_nid', 25)->nullable();
            $table->string('supplier_remark', 150)->nullable();
            $table->string('supplier_address', 250)->nullable();
            $table->string('supplier_reminder', 150)->nullable();
            $table->string('supplier_note', 250)->nullable();
            $table->string('supplier_status', 30)->nullable();
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
        Schema::dropIfExists('suppliers');
    }
};
