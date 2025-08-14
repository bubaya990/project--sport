<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

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

    /**
     * Check if the user is an admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is a guest
     *
     * @return bool
     */
    public function isGuest()
    {
        return !$this->isAdmin();
    }
    

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}