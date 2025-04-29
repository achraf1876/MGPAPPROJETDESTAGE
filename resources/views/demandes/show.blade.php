<h2>Détails de la demande</h2>

<p><strong>Type :</strong> {{ $demande->type }}</p>
<p><strong>Description :</strong> {{ $demande->description }}</p>
<p><strong>Date réception :</strong> {{ $demande->date_reception }}</p>
<p><strong>Date envoi :</strong> {{ $demande->date_envoi }}</p>
<p><strong>Date réponse :</strong> {{ $demande->date_reponse }}</p>
<p><strong>Réponse :</strong> {{ $demande->reponse }}</p>
<p><strong>Observation :</strong> {{ $demande->observation }}</p>

<h3>Agent</h3>
<p><strong>Nom :</strong> {{ $demande->agent->nom }}</p>
<p><strong>Prénom :</strong> {{ $demande->agent->prenom }}</p>
<p><strong>Téléphone :</strong> {{ $demande->agent->telephone }}</p>
<p><strong>Email personnelle :</strong> {{ $demande->agent->email_personnelle }}</p>
<p><strong>Email professionnelle :</strong> {{ $demande->agent->email_professionnelle }}</p>
<p><strong>CIN :</strong> {{ $demande->agent->cin }}</p>
<p><strong>Matricule :</strong> {{ $demande->agent->matricule }}</p>
<p><strong>Code Esquif :</strong> {{ $demande->agent->code_esquif }}</p>

<h3>Entité</h3>
<p><strong>Nom de l'entité :</strong> {{ $demande->entite->nom ?? 'Non défini' }}</p>

<h3>Utilisateur</h3>
<p><strong>Nom d'utilisateur :</strong> {{ $demande->user->name ?? 'Non défini' }}</p>
<p><strong>Email :</strong> {{ $demande->user->email ?? 'Non défini' }}</p>

@if($demande->fichier)
    <p><strong>Fichier :</strong> <a href="{{ asset('storage/' . $demande->fichier) }}" target="_blank">Voir le fichier</a>
    </p>
@endif
<a href="{{ route('demandes.index') }}">Go to Demande Index</a>

<a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Retour dashboard</a>

