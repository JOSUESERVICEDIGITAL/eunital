@extends('back.juridique.layouts.app')
@section('title', 'Modifier la signature')
@section('page_title', 'Modification de la signature')
@section('page_subtitle', $signature->user->name)

@section('juridique-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-edit"></i> Modifier</h3></div>
            <form action="{{ route('back.juridique.signatures.update', $signature) }}" method="POST">
                @csrf @method('PUT')
                <div class="card-body">
                    @include('back.juridique.signatures.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Mettre à jour</button>
                    <a href="{{ route('back.juridique.signatures.show', $signature) }}" class="btn btn-info"><i class="fas fa-eye"></i> Voir</a>
                    <a href="{{ route('back.juridique.signatures.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card"><div class="card-header"><h3 class="card-title">Statistiques</h3></div><div class="card-body">
            <dl><dt>Document</dt><dd>{{ $signature->document->titre }}</dd>
            <dt>Statut actuel</dt><dd>@include('back.juridique.partials.status-badge', ['status' => $signature->statut])</dd>
            <dt>Créé le</dt><dd>{{ $signature->created_at->format('d/m/Y H:i') }}</dd></dl>
        </div></div>
    </div>
</div>
@endsection
