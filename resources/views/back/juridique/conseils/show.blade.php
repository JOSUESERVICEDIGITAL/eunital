@extends('back.juridique.layouts.app')
@section('title', $conseilJuridique->titre)
@section('page_title', $conseilJuridique->titre)
@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Contenu</div>
            <div class="card-body">{!! nl2br(e($conseilJuridique->contenu)) !!}</div>
        </div>
        @if($conseilJuridique->faq)<div class="card mt-3"><div class="card-header">FAQ</div><div class="card-body">@foreach($conseilJuridique->faq as $q)<div class="mb-3"><strong>{{ $q['question'] ?? '' }}</strong><p>{{ $q['reponse'] ?? '' }}</p></div>@endforeach</div></div>@endif
        @if($conseilJuridique->exemples)<div class="card mt-3"><div class="card-header">Exemples</div><div class="card-body"><ul>@foreach($conseilJuridique->exemples as $e)<li>{{ $e }}</li>@endforeach</ul></div></div>@endif
    </div>
    <div class="col-md-4">
        <div class="card"><div class="card-header">Informations</div><div class="card-body"><dl><dt>Catégorie</dt><dd>{{ $conseilJuridique->categorie_label }}</dd><dt>Statut</dt><dd>@include('back.juridique.partials.status-badge', ['status' => $conseilJuridique->is_published ? 'actif' : 'inactif'])</dd><dt>Vues</dt><dd>{{ $conseilJuridique->vues }}</dd><dt>Tags</dt><dd>@foreach($conseilJuridique->tags ?? [] as $tag)<span class="badge badge-secondary mr-1">{{ $tag }}</span>@endforeach</dd></dl></div><div class="card-footer"><a href="{{ route('back.juridique.conseils.edit', $conseilJuridique) }}" class="btn btn-warning">Modifier</a><a href="{{ route('back.juridique.conseils.index') }}" class="btn btn-secondary">Retour</a></div></div>
    </div>
</div>
@endsection