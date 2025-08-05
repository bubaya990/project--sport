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
       Schema::create('paiements', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->enum('type', ['visa', 'carte_dor', 'poste']);
    $table->string('transaction_id')->nullable();
    $table->timestamp('paid_at')->nullable();
    $table->decimal('montant', 8, 2);
    $table->boolean('statut')->default(false);
    $table->timestamps();
});
    }
};