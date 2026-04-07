@extends('back.juridique.layouts.app')
@section('title', $demarcheAdministrative->titre)
@section('page_title', $demarcheAdministrative->titre)
@section('juridique-content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-info-circle"></i> Informations</h3></div>
            <div class="card-body">
                <dl>
                    <dt>Catégorie</dt><dd><span class="badge badge-info">{{ $demarcheAdministrative->categorie_label }}</span></dd>
                    <dt>Délai estimé</dt><dd>{{ $demarcheAdministrative->delai_formate }}</dd>
                    <dt>Coût estimé</dt><dd>{{ $demarcheAdministrative->cout_estime ? number_format($demarcheAdministrative->cout_estime, 2) . ' €' : 'Non défini' }}</dd>
                    <dt>Statut</dt><dd>@include('back.juridique.partials.status-badge', ['status' => $demarcheAdministrative->is_active ? 'actif' : 'inactif'])</dd>
                    <dt>URL officielle</dt><dd><a href="{{ $demarcheAdministrative->url_officielle }}" target="_blank">{{ $demarcheAdministrative->url_officielle ?? '-' }}</a></dd>
                </dl>
                <hr><h6>Description</h6><p>{{ $demarcheAdministrative->description }}</p>
            </div>
            <div class="card-footer"><a href="{{ route('back.juridique.demarches.edit', $demarcheAdministrative) }}" class="btn btn-warning">Modifier</a><a href="{{ route('back.juridique.demarches.index') }}" class="btn btn-secondary">Retour</a></div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card"><div class="card-header"><i class="fas fa-list-ol"></i> Étapes</div><div class="card-body">
            @if($demarcheAdministrative->etapes)
                <ol>
                @foreach($demarcheAdministrative->etapes as $etape)
                    <li><strong>{{ $etape['titre'] ?? '' }}</strong><br>{{ $etape['description'] ?? '' }}@if(isset($etape['delai']))<br><small class="text-muted">Délai: {{ $etape['delai'] }} jours</small>@endif</li>
                @endforeach
                </ol>
            @else
                <div class="text-muted">Aucune étape définie</div>
            @endif
        </div></div>
        <div class="card mt-3"><div class="card-header"><i class="fas fa-file-alt"></i> Documents requis</div><div class="card-body">
            @if($demarcheAdministrative->documents_requis)
                <ul>@foreach($demarcheAdministrative->documents_requis as $doc)<li>{{ $doc }}</li>@endforeach</ul>
            @else<div class="text-muted">Aucun document requis</div>@endif
        </div></div>
        <div class="card mt-3"><div class="card-header"><i class="fas fa-building"></i> Organismes concernés</div><div class="card-body">
            @if($demarcheAdministrative->organismes)
                <ul>@foreach($demarcheAdministrative->organismes as $org)<li>{{ $org }}</li>@endforeach</ul>
            @else<div class="text-muted">Aucun organisme</div>@endif
        </div></div>
    </div>
</div>
@endsection