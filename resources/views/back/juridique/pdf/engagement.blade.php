<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Engagement - {{ $engagement->reference }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; margin: 40px; }
        .title { font-size: 18px; font-weight: bold; text-align: center; margin: 30px 0; }
        .content { margin: 30px 0; line-height: 1.6; }
        .signature { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>
    <div class="title">{{ $engagement->document->titre }}</div>
    <div class="content">
        {!! $engagement->contenu !!}
    </div>
    <div class="signature">
        Fait le {{ now()->format('d/m/Y') }}<br>
        <strong>{{ $signataire ?? 'Le signataire' }}</strong>
    </div>
</body>
</html>