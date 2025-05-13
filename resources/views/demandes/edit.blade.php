<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la Demande - MGPAP</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --mgpap-primary: #1a5f7a;
            --mgpap-secondary: #57c5b6;
            --mgpap-light: #f8f9fa;
            --mgpap-dark: #212529;
        }
        
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--mgpap-light);
        }
        
        .mgpap-header {
            background-color: var(--mgpap-primary);
            color: white;
        }
        
        .form-card {
            border-radius: 8px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            border: 1px solid #dee2e6;
        }

        .section-title {
            border-bottom: 2px solid var(--mgpap-primary);
            padding-bottom: 8px;
            color: var(--mgpap-primary);
        }

        .detail-label {
            font-weight: 500;
            color: var(--mgpap-dark);
            min-width: 180px;
        }

        .btn-mgpap {
            background-color: var(--mgpap-primary);
            color: white;
            border: none;
        }

        .btn-mgpap:hover {
            background-color: #13455a;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="mgpap-header p-3 rounded-top mb-4">
            <h2 class="h4 mb-0">
                <i class="bi bi-pencil-square me-2"></i>
                Modifier la Demande #{{ $demande->id }}
            </h2>
        </div>

        <div class="form-card bg-white p-4 mb-4">
            <!-- Formulaire de modification de la demande -->
            <form action="{{ route('demandes.update', $demande->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Type -->
                <div class="form-group mb-3">
                    <label for="type">Type de demande</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="creation" {{ $demande->type == 'creation' ? 'selected' : '' }}>Création</option>
                        <option value="modification" {{ $demande->type == 'modification' ? 'selected' : '' }}>Modification</option>
                        <option value="block" {{ $demande->type == 'block' ? 'selected' : '' }}>Block</option>
                    </select>
                </div>

                <!-- Date de réception -->
                <div class="form-group mb-3">
                    <label for="date_reception">Date de réception</label>
                    <input type="date" class="form-control" id="date_reception" name="date_reception" value="{{ old('date_reception', $demande->date_reception) }}" required>
                </div>

                <!-- Date d'envoi -->
                <div class="form-group mb-3">
                    <label for="date_envoi">Date d'envoi</label>
                    <input type="date" class="form-control" id="date_envoi" name="date_envoi" value="{{ old('date_envoi', $demande->date_envoi) }}">
                </div>

                <!-- Date de réponse -->
                <div class="form-group mb-3">
                    <label for="date_reponse">Date de réponse</label>
                    <input type="date" class="form-control" id="date_reponse" name="date_reponse" value="{{ old('date_reponse', $demande->date_reponse) }}">
                </div>

                <!-- Description -->
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $demande->description) }}</textarea>
                </div>

                <!-- Réponse -->
                <div class="form-group mb-3">
                    <label for="reponse">Réponse</label>
                    <textarea class="form-control" id="reponse" name="reponse" rows="3">{{ old('reponse', $demande->reponse) }}</textarea>
                </div>

                <!-- Observation -->
                <div class="form-group mb-3">
                    <label for="observation">Observation</label>
                    <textarea class="form-control" id="observation" name="observation" rows="3">{{ old('observation', $demande->observation) }}</textarea>
                </div>

                <!-- Fichier -->
                <div class="form-group mb-3">
                    <label for="fichier">Fichier</label>
                    <input type="file" class="form-control-file" id="fichier" name="fichier">
                    @if ($demande->fichier)
                        <p>Fichier actuel : <a href="{{ Storage::url($demande->fichier) }}" target="_blank">Voir le fichier</a></p>
                    @endif
                </div>

                <!-- Informations de l'Agent -->
                <div class="section-title mb-4">
                    <h4>Informations de l'Agent</h4>
                </div>

                <div class="form-group mb-3">
                    <label for="agent_nom">Nom complet</label>
                    <input type="text" class="form-control" id="agent_nom" name="agent_nom" value="{{ old('agent_nom', $demande->agent->nom) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="agent_prenom">Prénom</label>
                    <input type="text" class="form-control" id="agent_prenom" name="agent_prenom" value="{{ old('agent_prenom', $demande->agent->prenom) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="agent_telephone">Téléphone</label>
                    <input type="text" class="form-control" id="agent_telephone" name="agent_telephone" value="{{ old('agent_telephone', $demande->agent->telephone) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="agent_email_pro">Email pro</label>
                    <input type="email" class="form-control" id="agent_email_pro" name="agent_email_pro" value="{{ old('agent_email_pro', $demande->agent->email_professionnelle) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="agent_email_perso">Email perso</label>
                    <input type="email" class="form-control" id="agent_email_perso" name="agent_email_perso" value="{{ old('agent_email_perso', $demande->agent->email_personnelle) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="agent_cin">CIN</label>
                    <input type="text" class="form-control" id="agent_cin" name="agent_cin" value="{{ old('agent_cin', $demande->agent->cin) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="agent_matricule">Matricule</label>
                    <input type="text" class="form-control" id="agent_matricule" name="agent_matricule" value="{{ old('agent_matricule', $demande->agent->matricule) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="agent_code_esquif">Code Esquif</label>
                    <input type="text" class="form-control" id="agent_code_esquif" name="agent_code_esquif" value="{{ old('agent_code_esquif', $demande->agent->code_esquif) }}">
                </div>

                <div class="col-md-6">
    <div class="mb-3">
        <label class="form-label fw-medium">Entité de rattachement <span class="text-danger">*</span></label>
        <select name="entite_id" class="form-select" required>
            <option value="">-- Choisir une entité --</option>
            @foreach($entites as $entite)
                <option value="{{ $entite->id }}" {{ $demande->entite_id == $entite->id ? 'selected' : '' }}>
                    {{ $entite->nom }} - {{ $entite->ville }} - {{ $entite->code }}
                </option>
            @endforeach
        </select>
    </div>
</div>


                <!-- Boutons -->
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-mgpap">
                        <i class="bi bi-check-circle me-2"></i> Enregistrer
                    </button>
                    <a href="{{ route('demandes.index') }}" class="btn btn-secondary ms-2">
                        <i class="bi bi-x-circle me-2"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
