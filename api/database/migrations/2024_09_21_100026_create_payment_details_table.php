<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id');
            $table->string('payment_method_id');
            $table->string('bank_id');
            $table->string('cheque_number');
            $table->string('cheque_date');
            $table->string('amount');
            $table->string('sales_invoice_no');
            $table->timestamps();
        });

        Schema::table('payment_details', function (Blueprint $table) {
            $table->foreign('payment_id')->references('id')->on('payments')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
};
