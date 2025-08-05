<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id', 'type', 'transaction_id', 'paid_at', 'montant', 'statut'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}