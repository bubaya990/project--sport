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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('participant');



             // Infos personnelles du participant
             $table->string('telephone')->nullable();
             $table->string('adresse')->nullable();
             $table->date('date_naissance')->nullable();
             $table->string('ville')->nullable();
             $table->string('profession')->nullable();
             $table->rememberToken();
             $table->timestamps();

        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};