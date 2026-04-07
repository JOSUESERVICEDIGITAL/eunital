@extends('back.juridique.layouts.app')
@section('title', 'Modèles actifs')
@section('page_title', 'Modèles actifs')
@section('page_subtitle', 'Modèles disponibles pour la génération')

@section('juridique-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-check-circle text-success"></i> Modèles actifs</h3>
        <div class="card-tools"><a href="{{ route('back.juridique.modeles.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nouveau modèle</a></div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr><th>Titre</th><th>Type</th><th>Version</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($modeles as $modele)
                    <tr><td><strong>{{ $modele->titre }}</strong></td><td>{{ $modele->typeDocument->nom ?? '-' }}</td><td>v{{ $modele->version }}</td>
                    <td><a href="{{ route('back.juridique.modeles.show', $modele) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('back.juridique.generation.create', ['modele' => $modele->id]) }}" class="btn btn-sm btn-success"><i class="fas fa-file-alt"></i></a></td></tr>
                    @empty <tr><td colspan="4" class="text-center">Aucun modèle actif</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">@include('back.juridique.partials.pagination', ['items' => $modeles])</div>
</div>
@endsection
