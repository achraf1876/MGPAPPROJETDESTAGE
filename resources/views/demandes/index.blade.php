@extends('layouts.app')

@section('content')
    <h1>Liste des demandes</h1>
    
    <!-- Bouton Historique -->
    @foreach ($demandes as $demande)
    <a href="{{ route('bordereau.historique', ['id' => $demande->id]) }}">Voir Historique</a>
    @endforeach

    <!-- Formulaire pour sélectionner les demandes -->
    <form action="{{ route('bordereau.generer') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th> Sélectionner</th>
                    <th>Type</th>
                    <th>Nom Agent</th>
                    <th>Entité</th>
                    <th>Date réception</th>
                    <th>Date envoi</th>
                    <th>Date réponse</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($demandes as $demande)
                    <tr>
                        <td><input type="checkbox" name="demandes[]" value="{{ $demande->id }}"></td>
                        <td>{{ $demande->type }}</td>
                        <td>{{ $demande->agent->nom }} {{ $demande->agent->prenom }}</td>
                        <td>{{ $demande->entite->name }}</td>
                        <td>{{ $demande->date_reception }}</td>
                        <td>{{ $demande->date_envoi }}</td>
                        <td>{{ $demande->date_reponse }}</td>
                        <td>
                            <a href="{{ route('demandes.show', $demande->id) }}" class="btn btn-info">Afficher</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Bouton pour générer le bordereau -->
        <button type="submit" class="btn btn-primary">Générer Bordereau</button>
    </form>
@endsection

@section('scripts')
    <script>
        // Fonction pour sélectionner/désélectionner toutes les cases à cocher
        function selectAll() {
            var checkboxes = document.querySelectorAll('input[name="demandes[]"]');
            var selectAllCheckbox = document.getElementById('select-all');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        }
    </script>
@endsection
