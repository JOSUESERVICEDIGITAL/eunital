@extends('back.juridique.layouts.app')
@section('title', $engagement->reference)
@section('page_title', $engagement->reference)
@section('juridique-content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-info-circle"></i> Informations</h3></div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Référence</dt><dd class="col-sm-8"><code>{{ $engagement->reference }}</code></dd>
                    <dt class="col-sm-4">Type</dt><dd class="col-sm-8">@include('back.juridique.partials.status-badge', ['status' => $engagement->type_engagement])</dd>
                    <dt class="col-sm-4">Document</dt><dd class="col-sm-8"><a href="{{ route('back.juridique.documents.show', $engagement->document) }}">{{ $engagement->document->titre }}</a></dd>
                    <dt class="col-sm-4">Date adhésion</dt><dd class="col-sm-8">{{ $engagement->date_adhesion->format('d/m/Y') }}</dd>
                    <dt class="col-sm-4">Date fin</dt><dd class="col-sm-8">{{ $engagement->date_fin ? $engagement->date_fin->format('d/m/Y') : 'Indéterminée' }}</dd>
                    <dt class="col-sm-4">Public</dt><dd class="col-sm-8">{{ $engagement->est_public ? 'Oui' : 'Non' }}</dd>
                </dl>
                <hr><h6>Contenu</h6><p>{{ Str::limit($engagement->contenu, 200) }}</p>
            </div>
            <div class="card-footer"><a href="{{ route('back.juridique.engagements.edit', $engagement) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</a><a href="{{ route('back.juridique.engagements.pdf', $engagement) }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i> PDF</a><a href="{{ route('back.juridique.engagements.index') }}" class="btn btn-secondary">Retour</a></div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card"><div class="card-header"><h3 class="card-title"><i class="fas fa-file-alt"></i> Principes et obligations</h3></div><div class="card-body">
            @if($engagement->principes)<h6>Principes</h6><ul>@foreach($engagement->principes as $p)<li>{{ $p }}</li>@endforeach</ul>@endif
            @if($engagement->obligations)<h6>Obligations</h6><ul>@foreach($engagement->obligations as $o)<li>{{ $o }}</li>@endforeach</ul>@endif
        </div></div>
    </div>
</div>
@endsection