<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Liste des Bordereaux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-4">
    <div class="container">
        <h1 class="mb-4">Liste des Bordereaux</h1>

        @foreach($bordereaux as $bordereau)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">📄 Bordereau N° {{ $bordereau->id }}</h5>
                    
                    <table class="table table-bordered mt-3">
                        <thead class="table-light">
                            <tr>
                                <th>Nom & Prénom de l'Agent</th>
                                <th>Téléphone</th>
                                <th>Type</th>
                                <th>Type de Rattachement</th>
                                <th>Date de Réception</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bordereau->demandes as $demande)
                                <tr>
                                    <td>{{ $demande->agent->nom }} {{ $demande->agent->prenom }}</td>
                                    <td>{{ $demande->agent->telephone ?? 'Non renseigné' }}</td>
                                    <td>{{ $demande->type }}</td>
                                    <td>{{ $demande->type_rattachement ?? 'Standard' }}</td>
                                    <td>{{ $demande->date_reception ? date('d/m/Y', strtotime($demande->date_reception)) : '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between mt-3">
                        <button class="btn btn-sm btn-success download-btn" data-bordereau-id="{{ $bordereau->id }}">
                            📥 Télécharger PDF
                        </button>

                        <form method="POST" action="{{ route('bordereaux.destroy', $bordereau->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bordereau ?')">
                                🗑️ Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-4 d-flex gap-3">
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Retour au dashboard
    </a>
</div>
    </div>
    

    <script>
        document.querySelectorAll('.download-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const bordereauId = button.getAttribute('data-bordereau-id');
                window.location.href = `/bordereau/download/${bordereauId}`;
            });
        });
    </script>
</body>
</html>
