<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agent;
use App\Models\Demande;

class Entite extends Model
{
    use HasFactory;

    protected $fillable = ['nom','type_rattachement', 'ville'];

    // Relation avec Agent
    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

    // Relation avec Demande
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}
