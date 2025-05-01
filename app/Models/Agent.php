<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $fillable = [
        'nom', 'prenom', 'telephone', 'email_personnelle', 'email_professionnelle', 'cin',
        'matricule', 'code_esquif', 'entite_id', 'id_users'
    ];

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    public function entite()
    {
        return $this->belongsTo(Entite::class);
    }
}