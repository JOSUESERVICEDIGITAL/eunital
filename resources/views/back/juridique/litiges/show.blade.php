@extends('back.juridique.layouts.app')
@section('title', $litige->reference)
@section('page_title', $litige->reference)
@section('juridique-content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Informations</h3></div>
            <div class="card-body">
                <dl><dt>Référence</dt><dd><code>{{ $litige->reference }}</code></dd>
                <dt>Titre</dt><dd>{{ $litige->titre }}</dd>
                <dt>Type</dt><dd>@include('back.juridique.partials.status-badge', ['status' => $litige->type])</dd>
                <dt>Statut</dt><dd>@include('back.juridique.partials.status-badge', ['status' => $litige->statut])</dd>
                <dt>Date ouverture</dt><dd>{{ $litige->date_ouverture->format('d/m/Y') }}</dd>
                @if($litige->date_cloture)<dt>Date clôture</dt><dd>{{ $litige->date_cloture->format('d/m/Y') }}</dd>@endif
                <dt>Montant en jeu</dt><dd>{{ $litige->montant_en_jeu ? number_format($litige->montant_en_jeu, 2) . ' €' : '-' }}</dd>
                <dt>Coût total</dt><dd>{{ $litige->cout_total ? number_format($litige->cout_total, 2) . ' €' : '-' }}</dd></dl>
            </div>
            <div class="card-footer"><a href="{{ route('back.juridique.litiges.edit', $litige) }}" class="btn btn-warning">Modifier</a><a href="{{ route('back.juridique.litiges.index') }}" class="btn btn-secondary">Retour</a></div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card"><div class="card-header">Description</div><div class="card-body">{{ $litige->description }}</div></div>
        @if($litige->conclusion)<div class="card mt-3"><div class="card-header">Conclusion</div><div class="card-body">{{ $litige->conclusion }}</div></div>@endif
        <div class="card mt-3"><div class="card-header">Historique</div><div class="card-body"><div class="timeline">@foreach($litige->historique ?? [] as $h)<div><i class="fas fa-circle bg-primary"></i><div class="timeline-item"><span class="time">{{ \Carbon\Carbon::parse($h['date'])->format('d/m/Y H:i') }}</span><div class="timeline-body"><strong>{{ $h['action'] }}</strong><br>{{ $h['commentaire'] ?? '' }}</div></div></div>@endforeach</div></div></div>
    </div>
</div>
@endsection