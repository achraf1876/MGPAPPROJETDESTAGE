<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->text('description')->nullable();
            $table->date('date_reception')->nullable();
            $table->date('date_envoi')->nullable();
            $table->date('date_reponse')->nullable();
            $table->string('reponse')->nullable();
            $table->text('observation')->nullable();
            $table->string('fichier')->nullable(); // path du fichier
            $table->foreignId('agent_id')->constrained()->onDelete('cascade');
            $table->foreignId('entite_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // celui qui crée la demande
            $table->string('bordereau_id')->nullable(); // Ajout de la colonne bordereau_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
