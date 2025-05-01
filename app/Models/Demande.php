<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    protected $fillable = [
        'type', 'description', 'date_reception', 'date_envoi', 'date_reponse', 'reponse', 
        'observation', 'fichier', 'agent_id', 'entite_id', 'user_id'
    ];
    


    // Relations
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function entite()
    {
        return $this->belongsTo(Entite::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bordereau()
{
    return $this->belongsTo(Bordereau::class);
}

}