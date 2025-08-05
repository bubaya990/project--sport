<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paiement;
use App\Models\User;

class PaiementSeeder extends Seeder
{
    public function run(): void
    {
        // Récupère tous les participants
        $participants = User::where('role', 'participant')->get();

        foreach ($participants as $participant) {
            Paiement::create([
                'user_id' => $participant->id,
                'type' => collect(['visa', 'carte_dor', 'poste'])->random(),
                'transaction_id' => strtoupper(uniqid('TRX_')),
                'paid_at' => now(),
                'montant' => 10000.00, // montant d'exemple
                'statut' => true,
            ]);
        }
    }
}