<x-app-layout>
    <div class="container py-5">
        <div class="card shadow-sm rounded-3">
            <div class="card-body p-4">
                <h1 class="h4 fw-bold text-primary mb-4">
                    <i class="bi bi-person-circle me-2"></i>Bienvenue {{ Auth::user()->name }}
                </h1>

                <div class="d-grid gap-3">
                    <a href="{{ route('demande.create') }}" 
                       class="btn btn-success btn-lg py-2">
                        <i class="bi bi-plus-circle me-2"></i>
                        Créer une demande
                    </a>
                    
                    <a href="{{ route('demandes.index') }}" 
                       class="btn btn-outline-primary btn-lg py-2">
                        <i class="bi bi-list-check me-2"></i>
                        Liste des demandes
                    </a>

                    <a href="{{ route('bordereaux.index') }}" class="btn btn-info btn-lg py-2 text-white">
    <i class="bi bi-file-text me-2"></i>
    Bordereau
</a>
                    <a href="{{ route('bordereaux.afficher') }}" class="btn btn-outline-primary btn-lg py-2">
    <i class="bi bi-file-text me-2"></i>
    afficher Bordereau
</a>

</x-app-layout>
