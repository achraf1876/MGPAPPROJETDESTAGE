<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une Demande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-4">

    <div class="container">
        <h2 class="mb-4">Créer une nouvelle Demande</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('demandes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Type</label>
                <select name="type" class="form-select" required>
                    <option value="creation">Création</option>
                    <option value="modification">Modification</option>
                    <option value="blockage">Blocage</option>
                </select>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <input type="text" name="nom" class="form-control" placeholder="Nom" required>
                </div>
                <div class="col">
                    <input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
                </div>
            </div>

            <input type="text" name="telephone" class="form-control mb-3" placeholder="Téléphone" required>
            <input type="email" name="email_personnelle" class="form-control mb-3" placeholder="Email personnelle">
            <input type="email" name="email_professionnelle" class="form-control mb-3" placeholder="Email professionnelle">
            <input type="text" name="cin" class="form-control mb-3" placeholder="CIN">
            <input type="text" name="matricule" class="form-control mb-3" placeholder="Matricule">
            <input type="text" name="code_esquife" class="form-control mb-3" placeholder="Code Esquife">

            <div class="mb-3">
                <label class="form-label">Entité de rattachement</label>
                <select name="entite_id" class="form-select" required>
                    <option value="">-- Choisir une entité --</option>
                    {{-- Options dynamiques générées depuis la base de données --}}
                    @foreach($entites as $entite)
                        <option value="{{ $entite->id }}">
                            {{ $entite->nom }} - {{ $entite->ville }} - {{ $entite->code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Ville</label>
                <select name="ville" class="form-select">
                    <option value="rabat">Rabat</option>
                    <option value="fes">Fès</option>
                    <option value="casablanca">Casablanca</option>
                </select>
            </div>

            <textarea name="description" class="form-control mb-3" placeholder="Description"></textarea>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Date réception</label>
                    <input type="date" name="date_reception" class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">Date envoi</label>
                    <input type="date" name="date_envoi" class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">Date réponse</label>
                    <input type="date" name="date_reponse" class="form-control">
                </div>
            </div>

            <input type="text" name="reponse" class="form-control mb-3" placeholder="Réponse">
            <textarea name="observation" class="form-control mb-3" placeholder="Observation"></textarea>

            <div class="mb-3">
                <label class="form-label">Fichier (PDF, image…)</label>
                <input type="file" name="fichier" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Envoyer la demande</button>
        </form>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Retour</a>
    </div>

</body>
</html>
