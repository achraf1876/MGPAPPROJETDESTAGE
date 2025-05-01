<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Demande - MGPAP</title>
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
        
        .detail-card {
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
                <i class="bi bi-file-earmark-text me-2"></i>
                Détails de la Demande #{{ $demande->id }}
            </h2>
        </div>

        <div class="detail-card bg-white p-4 mb-4">
            <h3 class="section-title mb-4">
                <i class="bi bi-info-circle me-2"></i>
                Informations principales
            </h3>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="d-flex mb-2">
                        <span class="detail-label">Type :</span>
                        <span class="badge 
                            @if($demande->type == 'creation') bg-success
                            @elseif($demande->type == 'modification') bg-primary
                            @else bg-warning text-dark
                            @endif">
                            {{ ucfirst($demande->type) }}
                        </span>
                    </div>
                    
                    <div class="d-flex mb-2">
                        <span class="detail-label">Date réception :</span>
                        <span>{{ $demande->date_reception ? date('d/m/Y', strtotime($demande->date_reception)) : '-' }}</span>
                    </div>
                    
                    <div class="d-flex mb-2">
                        <span class="detail-label">Date envoi :</span>
                        <span>{{ $demande->date_envoi ? date('d/m/Y', strtotime($demande->date_envoi)) : '-' }}</span>
                    </div>
                    
                    <div class="d-flex mb-2">
                        <span class="detail-label">Date réponse :</span>
                        <span>{{ $demande->date_reponse ? date('d/m/Y', strtotime($demande->date_reponse)) : '-' }}</span>
                    </div>
                </div>
                
                <div class="col-md-6">
                    @if($demande->fichier)
                    <div class="d-flex mb-2">
                        <span class="detail-label">Fichier joint :</span>
                        <a href="{{ asset('storage/' . $demande->fichier) }}" target="_blank" class="text-primary">
                            <i class="bi bi-file-earmark-arrow-down me-1"></i>
                            Voir le fichier
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="mb-3">
                <div class="d-flex mb-2">
                    <span class="detail-label">Description :</span>
                </div>
                <div class="p-3 bg-light rounded">
                    {{ $demande->description ?: 'Aucune description fournie' }}
                </div>
            </div>
            
            <div class="mb-3">
                <div class="d-flex mb-2">
                    <span class="detail-label">Réponse :</span>
                </div>
                <div class="p-3 bg-light rounded">
                    {{ $demande->reponse ?: 'Aucune réponse enregistrée' }}
                </div>
            </div>
            
            <div class="mb-3">
                <div class="d-flex mb-2">
                    <span class="detail-label">Observation :</span>
                </div>
                <div class="p-3 bg-light rounded">
                    {{ $demande->observation ?: 'Aucune observation' }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="detail-card bg-white p-4 mb-4 h-100">
                    <h3 class="section-title mb-4">
                        <i class="bi bi-person-badge me-2"></i>
                        Informations de l'Agent
                    </h3>
                    
                    <div class="d-flex mb-2">
                        <span class="detail-label">Nom complet :</span>
                        <span>{{ $demande->agent->nom }} {{ $demande->agent->prenom }}</span>
                    </div>
                    
                    <div class="d-flex mb-2">
                        <span class="detail-label">Téléphone :</span>
                        <span>{{ $demande->agent->telephone ?: '-' }}</span>
                    </div>
                    
                    <div class="d-flex mb-2">
                        <span class="detail-label">Email pro :</span>
                        <span>{{ $demande->agent->email_professionnelle ?: '-' }}</span>
                    </div>
                    
                    <div class="d-flex mb-2">
                        <span class="detail-label">Email perso :</span>
                        <span>{{ $demande->agent->email_personnelle ?: '-' }}</span>
                    </div>
                    
                    <div class="d-flex mb-2">
                        <span class="detail-label">CIN :</span>
                        <span>{{ $demande->agent->cin ?: '-' }}</span>
                    </div>
                    
                    <div class="d-flex mb-2">
                        <span class="detail-label">Matricule :</span>
                        <span>{{ $demande->agent->matricule ?: '-' }}</span>
                    </div>
                    
                    <div class="d-flex mb-2">
                        <span class="detail-label">Code Esquif :</span>
                        <span>{{ $demande->agent->code_esquif ?: '-' }}</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="detail-card bg-white p-4 mb-4 h-100">
                    <h3 class="section-title mb-4">
                        <i class="bi bi-building me-2"></i>
                        Entité de rattachement
                    </h3>
                    
                    <div class="d-flex mb-2">
                        <span class="detail-label">Type :</span>
                        <span>{{ $demande->entite->nom ?? 'Non défini' }}</span>
                    </div>
                    
                    <h3 class="section-title mt-4 mb-4">
                        <i class="bi bi-person-circle me-2"></i>
                        Utilisateur créateur
                    </h3>
                    
                    <div class="d-flex mb-2">
                        <span class="detail-label">Nom :</span>
                        <span>{{ $demande->user->name ?? 'Non défini' }}</span>
                    </div>
                    
                    <div class="d-flex mb-2">
                        <span class="detail-label">Email :</span>
                        <span>{{ $demande->user->email ?? 'Non défini' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('demandes.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>
                Retour à la liste
            </a>
            <a href="{{ route('dashboard') }}" class="btn btn-mgpap">
                <i class="bi bi-speedometer2 me-2"></i>
                Retour au dashboard
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>