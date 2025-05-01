<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bordereau MGPAP</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .subtitle { font-size: 14px; margin-top: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background-color: #f2f2f2; text-align: left; }
        .footer { margin-top: 30px; font-size: 12px; }
        .signature { margin-top: 50px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Ministère de la Fonction Publique</div>
        <div class="subtitle">Bordereau des Demandes</div>
        <div class="subtitle">Date de génération: {{ $dateGeneration }}</div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom & Prénom</th>
                <th>Entité</th>
                <th>Type</th>
                <th>Date Réception</th>
            </tr>
        </thead>
        <tbody>
            @foreach($demandes as $index => $demande)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $demande->agent->nom }} {{ $demande->agent->prenom }}</td>
                <td>{{ $demande->entite->name }}</td>
                <td>{{ ucfirst($demande->type) }}</td>
                <td>{{ $demande->date_reception ? date('d/m/Y', strtotime($demande->date_reception)) : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div class="signature">
            <div>Signature:</div>
            <div style="margin-top: 30px;">__________________________</div>
        </div>
    </div>
</body>
</html>