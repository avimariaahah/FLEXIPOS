<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_invoice_id');
            $table->unsignedBigInteger('product_id');
            $table->string('quantity_sold');
            $table->string('price');
            $table->string('discount');
            $table->string('tax_amount');
            $table->string('total');
            $table->timestamps();
        });

        Schema::table('sales_invoice_details', function (Blueprint $table) {
            $table->foreign('sales_invoice_id')->references('id')->on('sales_invoices')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_invoice_details');
    }
};
