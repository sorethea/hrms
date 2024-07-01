<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->foreignId("make_id");
            $table->string("model");
            $table->integer("year");
            $table->string("vin")->nullable();
            $table->string("transmission")->nullable();
            $table->string("style")->nullable();
            $table->integer("mileage")->nullable();
            $table->integer("doors")->nullable();
            $table->integer("seaters")->nullable();
            $table->double("cost")->nullable();
            $table->text("description")->nullable();
            $table->string("photos")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
