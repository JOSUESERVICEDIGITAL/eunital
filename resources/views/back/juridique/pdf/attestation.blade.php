<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Attestation</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; margin: 60px; }
        .certificate { border: 2px solid #333; padding: 40px; text-align: center; }
        .title { font-size: 24px; font-weight: bold; margin: 30px 0; text-transform: uppercase; }
        .content { margin: 40px 0; text-align: left; }
        .signature { margin-top: 60px; text-align: right; }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="title">ATTESTATION</div>
        <div class="content">
            {!! $contenu !!}
        </div>
        <div class="signature">
            Fait à {{ $ville ?? 'Paris' }}, le {{ now()->format('d/m/Y') }}<br><br>
            <strong>{{ $signataire ?? 'Le Responsable Juridique' }}</strong>
        </div>
    </div>
</body>
</html>