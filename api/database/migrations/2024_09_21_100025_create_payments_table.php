<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('branch_no')->nullable();
            $table->string('or_number')->nullable();
            $table->string('customer_id');
            $table->string('is_approved');
            $table->string('is_cancelled');
            $table->string('payment_date');
            $table->string('prepared_by_id');
            $table->string('cancelled_by_id');
            $table->string('approvedby');
            $table->boolean('remarks')->nullable();
            $table->timestamps();
        });

        // Schema::table('payments', function (Blueprint $table) {
        //     $table->foreign('branch_no')->references('id')->on('branch')->onUpdate('cascade')->onDelete('cascade');
        // });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
