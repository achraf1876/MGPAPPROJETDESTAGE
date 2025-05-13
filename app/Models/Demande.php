<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'description', 'date_reception', 'date_envoi', 
        'date_reponse', 'reponse', 'observation', 'agent_id', 
        'entite_id', 'user_id', 'fichier', 'bordereau_id'
    ];

    // Relation avec Agent
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    // Relation avec Entite
    public function entite()
    {
        return $this->belongsTo(Entite::class);
    }

    // Relation avec Bordereau
    public function bordereau()
    {
        return $this->belongsTo(Bordereau::class);
    }

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
