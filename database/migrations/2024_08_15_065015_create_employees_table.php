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
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing unsigned big integer primary key
            $table->unsignedBigInteger('company_id'); // Foreign key to the companies table
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique(); // Ensure email is unique
            $table->string('phone')->nullable(); // Phone is optional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
