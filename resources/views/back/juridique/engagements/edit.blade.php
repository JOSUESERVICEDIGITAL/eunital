@extends('back.juridique.layouts.app')
@section('title', 'Modifier engagement')
@section('page_title', 'Modification')
@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-edit"></i> Modifier</h3></div>
            <form action="{{ route('back.juridique.engagements.update', $engagement) }}" method="POST">
                @csrf @method('PUT')
                <div class="card-body">@include('back.juridique.engagements.form')</div>
                <div class="card-footer"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Mettre à jour</button><a href="{{ route('back.juridique.engagements.show', $engagement) }}" class="btn btn-info">Voir</a><a href="{{ route('back.juridique.engagements.index') }}" class="btn btn-secondary">Retour</a></div>
            </form>
        </div>
    </div>
    <div class="col-md-4"><div class="card"><div class="card-header"><h3 class="card-title">Statistiques</h3></div><div class="card-body"><dl><dt>Document lié</dt><dd>{{ $engagement->document->titre }}</dd><dt>Créé le</dt><dd>{{ $engagement->created_at->format('d/m/Y') }}</dd></dl></div></div></div>
</div>
@endsection