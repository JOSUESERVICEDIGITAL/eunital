<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $document->titre }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 40px; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .title { font-size: 18px; font-weight: bold; text-align: center; margin: 20px 0; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #666; border-top: 1px solid #ccc; padding-top: 10px; }
        .page-break { page-break-before: always; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
        <p>Hub Digital International - Chambre juridique</p>
    </div>
    <div class="title">{{ $document->titre }}</div>
    <div class="content">
        {!! $document->contenu['html'] ?? $document->contenu ?? '' !!}
    </div>
    <div class="footer">
        Document généré le {{ now()->format('d/m/Y H:i') }}<br>
        Numéro unique : {{ $document->numero_unique }} - Version {{ $document->version }}
    </div>
</body>
</html>