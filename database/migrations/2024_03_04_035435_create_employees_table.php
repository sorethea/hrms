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
            $table->string('code')->unique()->index();
            $table->string('name')->index();
            $table->string('position')->index();
            $table->date('date_of_birth');
            $table->date('hired_date');
            $table->string('type')->nullable();
            $table->date('last_working_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account')->nullable();
            $table->foreignId('user_id')->index()->nullable();
            $table->foreignId('report_to')->index()->nullable();
            $table->foreignId('ou_id')->index()->nullable();
            $table->json('properties')->nullable();
            $table->boolean('active');
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
