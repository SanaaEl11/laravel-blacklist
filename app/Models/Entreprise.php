<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // On hérite de Authenticatable
use Illuminate\Notifications\Notifiable;

class Entreprise extends Authenticatable // Héritage de Authenticatable
{
    use HasFactory, Notifiable;



    // const STATUS_ACCEPTE = 1;
    // const STATUS_EN_ATTENTE = 'en attende';
    // const STATUS_REFUSE = 3;
    const STATUS_ACCEPTED = 'Accepté';
    const STATUS_PENDING = 'en attente';
    const STATUS_REJECTED = 'Refusé';
    protected $guard = 'entreprise';
    
    protected $fillable = [
        'username',
        'email',
        'motdepasse',
        'rc',
        'ice',
        'id_secteur',
        'address',
        'status',
        'date_creation'
    ];

    protected $hidden = [
        'motdepasse',
        'remember_token',
    ];
    

    public function getAuthPassword()
    {
        return $this->motdepasse;
    }

    // Relations                  
    public function secteur()
    {
        return $this->belongsTo(Secteur::class, 'id_secteur');
    }                                     

    public function techniciens()
    {
        return $this->hasMany(Technicien::class, 'id_entreprise');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id_entreprise');
    }

    public function publications()
    {
        return $this->hasMany(Publication::class, 'id_entreprise');
    }

    public function observations()
    {
        return $this->hasMany(Observation::class, 'id_entreprise');
    }
    
}
