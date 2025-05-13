<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bordereau PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #000; padding: 6px; }
    </style>
</head>
<body>
    <h3>Bordereau N° {{ $bordereau->id }}</h3>

    <table>
        <thead>
            <tr>
                <th>Nom Agent</th>
                <th>Entité</th>
                <th>Description</th>
                <th>Téléphone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($demandes as $demande)
                <tr>
                    <td>{{ $demande->agent->nom ?? '' }} {{ $demande->agent->prenom ?? '' }}</td>
                    <td>{{ $demande->entite->nom ?? '' }}</td>
                    <td>{{ $demande->description }}</td>
                    <td>{{ $demande->agent->telephone ?? '' }}</td>
                    <td>{{ $demande->agent->email_professionnelle ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
