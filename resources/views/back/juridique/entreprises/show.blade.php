@extends('back.juridique.layouts.app')
@section('title', $entreprise->nom)
@section('page_title', $entreprise->nom)
@section('juridique-content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Informations</h3></div>
            <div class="card-body">
                <dl><dt>Nom</dt><dd>{{ $entreprise->nom }}</dd>
                <dt>SIRET</dt><dd><code>{{ $entreprise->siret_formate }}</code></dd>
                <dt>SIREN</dt><dd>{{ $entreprise->siren }}</dd>
                <dt>Code APE</dt><dd>{{ $entreprise->ape }}</dd>
                <dt>Forme juridique</dt><dd>{{ $entreprise->forme_juridique_label }}</dd>
                <dt>Capital social</dt><dd>{{ $entreprise->capital_social }}</dd>
                <dt>Date création</dt><dd>{{ $entreprise->date_creation ? $entreprise->date_creation->format('d/m/Y') : '-' }}</dd>
                <dt>Adresse</dt><dd>{{ $entreprise->adresse_complete }}</dd>
                <dt>Téléphone</dt><dd>{{ $entreprise->telephone }}</dd>
                <dt>Email</dt><dd>{{ $entreprise->email }}</dd>
                <dt>Site web</dt><dd><a href="{{ $entreprise->site_web }}" target="_blank">{{ $entreprise->site_web }}</a></dd>
                </dl>
            </div>
            <div class="card-footer"><a href="{{ route('back.juridique.entreprises.edit', $entreprise) }}" class="btn btn-warning">Modifier</a><a href="{{ route('back.juridique.entreprises.index') }}" class="btn btn-secondary">Retour</a></div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card"><div class="card-header">Documents associés</div><div class="card-body p-0"><table class="table table-striped"><thead><tr><th>Titre</th><th>Type</th><th>Date</th><th>Actions</th></tr></thead><tbody>@forelse($entreprise->documents as $doc)<tr><td>{{ $doc->titre }}</td><td>{{ $doc->typeDocument->nom ?? '-' }}</td><td>{{ $doc->created_at->format('d/m/Y') }}</td><td><a href="{{ route('back.juridique.documents.show', $doc) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a></td></tr>@empty<tr><td colspan="4" class="text-center">Aucun document</td></tr>@endforelse</tbody></table></div></div>
        <div class="card mt-3"><div class="card-header">Évaluations de conformité</div><div class="card-body p-0"><table class="table table-striped"><thead><tr><th>Texte légal</th><th>Statut</th><th>Score</th><th>Date</th></thead><tbody>@forelse($entreprise->conformites as $c)<tr><td>{{ $c->legalite->titre }}</td><td>@include('back.juridique.partials.status-badge', ['status' => $c->statut])</td><td>{{ $c->score_conformite }}%</td><td>{{ $c->date_controle ? $c->date_controle->format('d/m/Y') : '-' }}</td></tr>@empty<tr><td colspan="4" class="text-center">Aucune évaluation</td></tr>@endforelse</tbody></table></div></div>
    </div>
</div>
@endsection