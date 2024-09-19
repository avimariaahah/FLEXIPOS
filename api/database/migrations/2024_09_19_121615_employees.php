<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employeeID'); // Primary key
            $table->string('userID'); // foreign key
            $table->string('firstname'); // column name
            $table->string('lastname'); // column name
            $table->string('telephone'); // column name
            $table->string('designation'); // column name
            $table->boolean('isactive')->default(true); // Optional description of the category
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('employees');
    }
};
