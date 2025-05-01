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

        <div class="d-flex justify-content-between mb-3">
            <div>
                <button type="button" class="btn btn-mgpap me-2" id="generateBordereau">
                    <i class="bi bi-file-earmark-pdf me-2"></i>
                    Générer Bordereau
                </button>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="select-all" onclick="selectAll()">
                <label class="form-check-label" for="select-all">
                    Sélectionner/Désélectionner tout
                </label>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Type</th>
                        <th>Nom Agent</th>
                        <th>Téléphone</th>
                        <th>Type Rattachement</th>
                        <th>Date réception</th>
                        <th width="120px">Actions</th>
                    </tr>
                </thead>
                <tbody id="demandesBody">
                    @foreach($demandes as $demande)
                    <tr data-id="{{ $demande->id }}">
                        <td>
                            <input type="checkbox" name="demandes[]" value="{{ $demande->id }}" class="form-check-input">
                        </td>
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
                        <td>{{ $demande->type_rattachement ?? 'Standard' }}</td>
                        <td>{{ $demande->date_reception ? date('d/m/Y', strtotime($demande->date_reception)) : '-' }}</td>
                        <td class="action-btns">
                            <div class="d-flex gap-2">
                                <a href="{{ route('demandes.show', $demande->id) }}" 
                                   class="btn btn-sm btn-info"
                                   title="Afficher">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-mgpap">
            <i class="bi bi-speedometer2 me-2"></i>
            Retour au dashboard
        </a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jsPDF pour la génération de PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    
    <script>
        document.getElementById('generateBordereau').addEventListener('click', function() {
            const selectedIds = Array.from(document.querySelectorAll('input[name="demandes[]"]:checked'))
                                   .map(checkbox => parseInt(checkbox.value));
            
            if (selectedIds.length === 0) {
                alert('Veuillez sélectionner au moins une demande pour générer le bordereau.');
                return;
            }
            
            // Récupérer les données des demandes sélectionnées
            const selectedDemandes = [];
            selectedIds.forEach(id => {
                const row = document.querySelector(`tr[data-id="${id}"]`);
                if (row) {
                    const cells = row.cells;
                    selectedDemandes.push({
                        id: id,
                        type: cells[1].textContent.trim(),
                        nom: cells[2].textContent.trim(),
                        telephone: cells[3].textContent.trim(),
                        type_rattachement: cells[4].textContent.trim(),
                        date_reception: cells[5].textContent.trim()
                    });
                }
            });
            
            // Générer le PDF
            generatePDF(selectedDemandes);
            
            // Envoyer les données sélectionnées au serveur pour archivage
            archiveDemandes(selectedDemandes);
        });
        
        function generatePDF(demandes) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            
            // Titre du document
            doc.setFontSize(18);
            doc.text('Bordereau des Demandes', 105, 15, { align: 'center' });
            doc.setFontSize(12);
            doc.text(`Date de génération: ${new Date().toLocaleDateString('fr-FR')}`, 105, 22, { align: 'center' });
            
            // Données du tableau
            const tableData = demandes.map(demande => [
                demande.nom,
                demande.telephone,
                demande.type_rattachement,
                demande.type,
                demande.date_reception
            ]);
            
            // Générer le tableau
            doc.autoTable({
                head: [['Nom', 'Téléphone', 'Rattachement', 'Type', 'Date réception']],
                body: tableData,
                startY: 30,
                theme: 'grid',
                headStyles: {
                    fillColor: [26, 95, 122],
                    textColor: 255
                }
            });
            
            // Sauvegarder le PDF
            doc.save(`bordereau-${new Date().toISOString().slice(0, 10)}.pdf`);
        }
        
        function archiveDemandes(demandes) {
            // Envoyer les données au serveur via AJAX
            fetch("{{ route('historique.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    demandes: demandes
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Supprimer les lignes sélectionnées de l'affichage
                    demandes.forEach(demande => {
                        const row = document.querySelector(`tr[data-id="${demande.id}"]`);
                        if (row) row.remove();
                    });
                    alert('Le bordereau a été généré et les demandes ont été archivées.');
                } else {
                    alert('Erreur lors de l\'archivage des demandes.');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors de l\'archivage.');
            });
        }
        
        function selectAll() {
            const checkboxes = document.querySelectorAll('input[name="demandes[]"]');
            const selectAllCheckbox = document.getElementById('select-all');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        }
    </script>
</body>
</html>