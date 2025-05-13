<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Demande;

class Bordereau extends Model
{
    use HasFactory;

    protected $table = 'bordereaux';

    // 👇 إذا كنت تستعمل UUID
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['user_id', 'bordereau_id', 'fichier']; 

    // ✅ إنشاء UUID تلقائيًا عند إنشاء bordereau
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // ✅ العلاقة: bordereau لديه plusieurs demandes
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    // ✅ العلاقة: bordereau appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
