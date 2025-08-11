<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aboutus', function (Blueprint $table) {
            $table->id();
            
            // Section Description
            $table->string('company_name');
            $table->text('description');
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            
            // Images (chemins)
            $table->string('main_image')->nullable(); // Image principale
            $table->json('gallery')->nullable(); // Plusieurs images en JSON
            
            // Coordonnées
            $table->string('address');
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->string('email');
            $table->string('map_link')->nullable(); // Lien Google Maps
            
            // Réseaux sociaux
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            
            
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aboutus');
    }
};