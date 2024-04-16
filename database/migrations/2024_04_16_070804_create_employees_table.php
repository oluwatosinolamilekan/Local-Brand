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
            $table->id();
            $table->string('employee_id')->unique();
            $table->string('user_name');
            $table->string('name_prefix')->nullable();
            $table->string('first_name');
            $table->string('middle_initial')->nullable();
            $table->string('last_name');
            $table->string('gender'); 
            $table->string('email')->unique();
            $table->string('date_of_birth');
            $table->string('time_of_birth')->nullable();
            $table->string('age_in_years');
            $table->string('date_of_joining');
            $table->string('age_in_company_years');
            $table->string('phone_no')->nullable();
            $table->string('place_name');
            $table->string('county');
            $table->string('city');
            $table->string('zip');
            $table->string('region');
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
