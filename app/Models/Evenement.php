<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 'description', 'date', 'images',
    ];

    protected $casts = [
        'images' => 'array', // Laravel va convertir JSON <-> array automatiquement
    ];
}