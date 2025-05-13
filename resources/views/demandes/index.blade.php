<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Liste des Demandes - MGPAP</title>
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
        }

        .btn-mgpap:hover {
            background-color: #13455a;
            color: white;
        }

        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        }

        .table thead {
            background-color: var(--mgpap-primary);
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(26, 95, 122, 0.05);
        }

        .action-btns .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        /* Style pour les lignes sélectionnées */
        .selected-row {
            background-color: rgba(87, 197, 182, 0.2) !important;
        }

        .alert-dismissible {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="mgpap-header p-3 rounded-top mb-3">
            <h1 class="h3 mb-0">
                <i class="bi bi-list-check me-2"></i>
                Liste des Demandes
            </h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Nom Agent</th>
                        <th>Téléphone</th>
                        <th>Type Rattachement</th>
                        <th>Nom Agence/Direction</th>
                        <th>Date réception</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($demandes as $demande)
                        <tr data-id="{{ $demande->id }}" class="{{ $demande->bordereau_id ? 'table-secondary' : '' }}">
                            <td>
                                <span class="badge 
                                    @if($demande->type == 'creation') bg-success
                                    @elseif($demande->type == 'modification') bg-primary
                                    @else bg-warning text-dark
                                    @endif">
                                    {{ ucfirst($demande->type) }}
                                </span>
                            </td>
                            <td>{{ $demande->agent->nom }} {{ $demande->agent->prenom }}</td>
                            <td>{{ $demande->agent->telephone ?? 'Non renseigné' }}</td>
                            <td>{{ $demande->entite->type_rattachement ?? 'Standard' }}</td>
                            <td>{{ $demande->entite->nom ?? 'Standard' }}</td>
                            <td>{{ $demande->date_reception ? date('d/m/Y', strtotime($demande->date_reception)) : '-' }}</td>
                            <td class="action-btns">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('demandes.show', $demande->id) }}" 
                                       class="btn btn-sm btn-info"
                                       title="Afficher">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <!-- Bouton pour supprimer une demande -->
                                    <form action="{{ route('demandes.destroy', $demande->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete();">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Aucune demande disponible</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($demandes->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $demandes->links() }}
        </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-mgpap">
                <i class="bi bi-speedometer2 me-2"></i>
                Retour au dashboard
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fonction de confirmation de suppression
        function confirmDelete() {
            return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?');
        }
        
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.demande-checkbox');
            
            // Handle "select all" checkbox logic
            selectAllCheckbox.addEventListener('change', function () {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                    toggleRowSelection(checkbox);  // Add or remove row selection
                });
            });
        });
    </script>
</body>
</html>
