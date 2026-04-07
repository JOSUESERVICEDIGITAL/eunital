<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $contrat->reference }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 40px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .title { font-size: 18px; font-weight: bold; text-align: center; margin: 20px 0; text-transform: uppercase; }
        .signature-block { margin-top: 50px; page-break-inside: avoid; }
        .signature-line { margin-top: 30px; width: 250px; border-top: 1px solid #000; text-align: center; display: inline-block; margin-right: 50px; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #666; border-top: 1px solid #ccc; padding-top: 10px; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
        <p>Hub Digital International</p>
    </div>
    <div class="title">{{ $contrat->document->titre }}</div>
    <div class="content">
        <h3>Référence : {{ $contrat->reference }}</h3>
        <h3>Objet : {{ $contrat->objet }}</h3>
        <p>{{ $contrat->document->description }}</p>
        
        <h3>Informations contractuelles</h3>
        <table>
            <tr><th>Type</th><td>{{ $contrat->type_contrat_label }}</td></tr>
            <tr><th>Date de début</th><td>{{ $contrat->date_debut->format('d/m/Y') }}</td></tr>
            <tr><th>Date de fin</th><td>{{ $contrat->date_fin ? $contrat->date_fin->format('d/m/Y') : 'Indéterminée' }}</td></tr>
            @if($contrat->montant)<tr><th>Montant</th><td>{{ number_format($contrat->montant, 2) }} {{ $contrat->devise }}</td></tr>@endif
        </table>
        
        @if($contrat->conditions)
        <h3>Conditions</h3>
        <ul>@foreach($contrat->conditions as $condition)<li>{{ $condition }}</li>@endforeach</ul>
        @endif
        
        @if($contrat->clauses)
        <h3>Clauses</h3>
        <ul>@foreach($contrat->clauses as $clause)<li>{{ $clause }}</li>@endforeach</ul>
        @endif
        
        <div class="signature-block">
            <h3>Signatures</h3>
            @foreach($contrat->document->signatures as $signature)
            <div style="margin-bottom: 30px;">
                <div class="signature-line">
                    <strong>{{ $signature->user->name }}</strong><br>
                    <small>{{ $signature->type_signataire_label }}</small>
                    @if($signature->date_signature)<br><small>Signé le : {{ $signature->date_signature->format('d/m/Y H:i') }}</small>@endif
                </div>
                @if($signature->signature_base64)<div><img src="{{ $signature->signature_base64 }}" style="max-height: 60px;"></div>@endif
            </div>
            @endforeach
        </div>
    </div>
    <div class="footer">Document généré le {{ now()->format('d/m/Y H:i') }}</div>
</body>
</html>