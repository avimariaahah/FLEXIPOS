<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('sales_order_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('processed_by_id');
            $table->string('cancel_type');
            $table->string('cancel_id');
            $table->string('approve_type');
            $table->string('approve_id');
            $table->string('document_no');
            $table->string('date');
            $table->boolean('is_approved');
            $table->boolean('is_cancelled');
            $table->timestamps();
        });

        Schema::table('sales_invoices', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('branches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sales_order_id')->references('id')->on('sales_orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('processed_by_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_invoices');
    }
};
