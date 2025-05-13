<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Demandes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-4">
    <div class="container">
        <h1 class="mb-4">Liste des Demandes</h1>

        @if($demandes->isEmpty())
            <div class="alert alert-warning">Aucune demande trouvée.</div>
        @else
            <form id="bordereau-form">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach($demandes as $demande)
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="demandes[]" value="{{ $demande->id }}" id="demande-{{ $demande->id }}">
                                        <label class="form-check-label fw-bold" for="demande-{{ $demande->id }}">
                                            {{ $demande->nom }}
                                        </label>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Agent:</strong> {{ $demande->agent->nom }} {{ $demande->agent->prenom }}</li>
                                        <li class="list-group-item"><strong>Téléphone Agent:</strong> {{ $demande->agent->telephone ?? 'Non renseigné' }}</li>
                                        <li class="list-group-item"><strong>Type de Rattachement:</strong> {{ $demande->type_rattachement ?? 'Standard' }}</li>
                                        <li class="list-group-item"><strong>Date de Réception:</strong>
                                            {{ $demande->date_reception ? date('d/m/Y', strtotime($demande->date_reception)) : '-' }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 d-flex gap-3">
    <button type="button" class="btn btn-primary" id="generate-btn">
        <i class="bi bi-file-earmark-plus me-1"></i> Générer Bordereau
    </button>

    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Retour au dashboard
    </a>
</div>
  
                </form>
        @endif
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('generate-btn').addEventListener('click', function () {
            const selected = document.querySelectorAll('input[name="demandes[]"]:checked');

            if (selected.length === 0) {
                alert('من فضلك اختر على الأقل طلبًا واحدًا.');
                return;
            }

            if (!confirm('هل أنت متأكد أنك تريد توليد Bordereau لهذه الطلبات؟')) return;

            const demandesIds = Array.from(selected).map(el => el.value);

            fetch('/bordereau/generate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ demandes: demandesIds })
            })
            .then(response => {
                if (!response.ok) throw new Error('Erreur serveur');
                return response.json();
            })
            .then(data => {
                alert('تم توليد Bordereau بنجاح');
                location.reload();
            })
            .catch(err => {
                console.error(err);
                alert('حدث خطأ أثناء التوليد');
            });
        });
    </script>
</body>
</html>
