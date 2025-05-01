<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une Demande - MGPAP</title>
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
        
        .btn-mgpap {
            background-color: var(--mgpap-primary);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
        }
        
        .btn-mgpap:hover {
            background-color: #13455a;
            color: white;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--mgpap-primary);
            box-shadow: 0 0 0 0.25rem rgba(26, 95, 122, 0.25);
        }
        
        .demande-card {
            border-radius: 10px;
            border: 1px solid #dee2e6;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>
    <div class="mgpap-header py-3 mb-4">
        <div class="container">
            <h2 class="mb-0 text-white">
                <i class="bi bi-file-earmark-plus me-2"></i>
                Créer une nouvelle Demande
            </h2>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="demande-card bg-white p-4 mb-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('demandes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-3">
                            <!-- Section Type et Information de Base -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Type de demande <span class="text-danger">*</span></label>
                                    <select name="type" class="form-select" required>
                                        <option value="creation">Création</option>
                                        <option value="modification">Modification</option>
                                        <option value="blockage">Blocage</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Entité de rattachement <span class="text-danger">*</span></label>
                                    <select name="entite_id" class="form-select" required>
                                        <option value="">-- Choisir une entité --</option>
                                        @foreach($entites as $entite)
                                            <option value="{{ $entite->id }}">
                                                {{ $entite->nom }} - {{ $entite->ville }} - {{ $entite->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Ville</label>
                                    <select name="ville" class="form-select">
                                        <option value="rabat">Rabat</option>
                                        <option value="fes">Fès</option>
                                        <option value="casablanca">Casablanca</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Section Informations Personnelles -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Nom <span class="text-danger">*</span></label>
                                    <input type="text" name="nom" class="form-control" placeholder="Votre nom" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Prénom <span class="text-danger">*</span></label>
                                    <input type="text" name="prenom" class="form-control" placeholder="Votre prénom" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Téléphone <span class="text-danger">*</span></label>
                                    <input type="text" name="telephone" class="form-control" placeholder="06XXXXXXXX" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Email personnelle</label>
                                    <input type="email" name="email_personnelle" class="form-control" placeholder="email@exemple.com">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Email professionnelle</label>
                                    <input type="email" name="email_professionnelle" class="form-control" placeholder="email@professionnel.com">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">CIN</label>
                                    <input type="text" name="cin" class="form-control" placeholder="Numéro CIN">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Matricule</label>
                                    <input type="text" name="matricule" class="form-control" placeholder="Votre matricule">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Code Esquife</label>
                                    <input type="text" name="code_esquife" class="form-control" placeholder="Code Esquife">
                                </div>
                            </div>
                            
                            <!-- Section Description et Fichiers -->
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Description</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Décrivez votre demande..."></textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Date réception</label>
                                    <input type="date" name="date_reception" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Date envoi</label>
                                    <input type="date" name="date_envoi" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Date réponse</label>
                                    <input type="date" name="date_reponse" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Réponse</label>
                                    <input type="text" name="reponse" class="form-control" placeholder="Réponse à la demande">
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Observation</label>
                                    <textarea name="observation" class="form-control" rows="2" placeholder="Observations..."></textarea>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="mb-4">
                                    <label class="form-label fw-medium">Fichier joint (PDF, image…)</label>
                                    <input type="file" name="fichier" class="form-control">
                                    <div class="form-text">Taille maximale : 5MB. Formats acceptés : PDF, JPG, PNG</div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-mgpap">
                                        <i class="bi bi-send-fill me-2"></i>
                                        Envoyer la demande
                                    </button>
                                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>
                                        Retour
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>