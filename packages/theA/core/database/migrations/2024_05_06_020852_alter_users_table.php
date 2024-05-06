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
        Schema::table("users",function (Blueprint $table){
            //$table->dropUnique('*email');
            $table->string("email")->unique()->nullable()->change();
            $table->string("phone_number")->unique()->nullable();
            $table->string("avatar_url")->nullable();
        });
    }

    /**
     *
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("users",function (Blueprint $table){
            $table->string("email")->unique()->nullable()->change();
            $table->dropColumn("phone_number");
            $table->dropColumn("avatar_url");
        });
    }
};
