<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contrat - {{ $contrat->reference }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; margin: 40px; }
        .header { text-align: center; margin-bottom: 30px; }
        .title { font-size: 16px; font-weight: bold; text-align: center; margin: 20px 0; }
        .clause { margin: 15px 0; }
        .signature-block { margin-top: 50px; }
        .signature-line { margin-top: 30px; width: 250px; border-top: 1px solid #000; display: inline-block; margin-right: 50px; text-align: center; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 9px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ config('app.name') }}</h2>
        <p>Hub Digital International</p>
    </div>
    <div class="title">CONTRAT</div>
    <div class="content">
        <p><strong>Référence :</strong> {{ $contrat->reference }}</p>
        <p><strong>Objet :</strong> {{ $contrat->objet }}</p>
        <p><strong>Date de début :</strong> {{ $contrat->date_debut->format('d/m/Y') }}</p>
        @if($contrat->date_fin)<p><strong>Date de fin :</strong> {{ $contrat->date_fin->format('d/m/Y') }}</p>@endif
        @if($contrat->montant)<p><strong>Montant :</strong> {{ number_format($contrat->montant, 2) }} {{ $contrat->devise }}</p>@endif
        
        @if($contrat->conditions)
        <h4>Conditions</h4>
        @foreach($contrat->conditions as $condition)<div class="clause">• {{ $condition }}</div>@endforeach
        @endif
        
        @if($contrat->clauses)
        <h4>Clauses</h4>
        @foreach($contrat->clauses as $clause)<div class="clause">• {{ $clause }}</div>@endforeach
        @endif
        
        <div class="signature-block">
            <h4>Signatures</h4>
            @foreach($contrat->document->signatures as $signature)
            <div style="margin-bottom: 20px;">
                <div class="signature-line">
                    {{ $signature->user->name }}<br>
                    <small>{{ $signature->type_signataire_label }}</small>
                    @if($signature->date_signature)<br><small>Signé le {{ $signature->date_signature->format('d/m/Y') }}</small>@endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="footer">Document valable sous réserve de signature(s)</div>
</body>
</html>