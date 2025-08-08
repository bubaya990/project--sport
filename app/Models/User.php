<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
     protected $fillable = [
        'name', 'email', 'password', 'role',
        'telephone', 'adresse', 'date_naissance', 'ville', 'profession'
    ];

    protected $hidden = ['password', 'remember_token'];
public function isAdmin()
    {
        // Assuming you have an 'is_admin' column in your users table
        return $this->is_admin === true;
        
      
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}