<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bordereau extends Model
{
    public $incrementing = false; // حيت ماشي auto-increment
    protected $keyType = 'string'; // حيت id من نوع string
    protected $fillable = ['id', 'user_id', 'date_reception', 'date_depot'];

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}