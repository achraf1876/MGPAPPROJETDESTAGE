<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();

            // Relation avec bordereaux (UUID)
            $table->uuid('bordereau_id')->nullable(); // Utilisation de uuid pour la clé étrangère
            $table->foreign('bordereau_id')->references('id')->on('bordereaux')->onDelete('set null');

            $table->string('type');
            $table->text('description')->nullable();
            $table->date('date_reception')->nullable();
            $table->date('date_envoi')->nullable();
            $table->date('date_reponse')->nullable();
            $table->string('reponse')->nullable();
            $table->text('observation')->nullable();
            $table->string('fichier')->nullable();

            // Autres relations
            $table->foreignId('agent_id')->constrained('agents')->onDelete('cascade');
            $table->foreignId('entite_id')->constrained('entites')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
