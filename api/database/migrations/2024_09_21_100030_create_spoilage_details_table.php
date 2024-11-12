<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spoilage_details', function (Blueprint $table) {
            $table->unsignedBigInteger('branch_no');              
            $table->unsignedBigInteger('prepared_by_id');        
            $table->date('damaged_date');                         
            $table->string('remarks')->nullable();               
            $table->unsignedBigInteger('approved_by_id')->nullable(); 
            $table->boolean('is_cancelled')->default(false);      
            $table->unsignedBigInteger('cancelled_by')->nullable();   
            

            $table->timestamps();

            
        });

        Schema::table('spoilage_details', function (Blueprint $table) {
            $table->foreign('spoilage_id')->references('id')->on('spoilages')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('prepared_by_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('approved_by_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('cancelled_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('branch_no')->references('id')->on('branches')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spoilage_details');
    }
};
