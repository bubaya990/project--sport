<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 'description', 'date', 'end_date', 'status', 'images',
    ];

    protected $casts = [
        'date' => 'datetime',
        'end_date' => 'datetime',
        'images' => 'array',
    ];
}