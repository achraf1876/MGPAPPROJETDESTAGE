<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBordereauxTable extends Migration
{
    public function up(): void
    {
        Schema::create('bordereaux', function (Blueprint $table) {
            // Utilisation d'un UUID comme clé primaire
            $table->uuid('id')->primary();

            // Relation avec l'utilisateur
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Colonne fichier (nullable)
            $table->string('fichier')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bordereaux');
    }
}
