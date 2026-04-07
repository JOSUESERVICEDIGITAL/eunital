@extends('back.juridique.layouts.app')
@section('title', 'Documents brouillons')
@section('page_title', 'Documents en brouillon')
@section('page_subtitle', 'Documents en cours de rédaction')

@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-pencil-alt text-warning"></i> Brouillons</h3><div class="card-tools"><a href="{{ route('back.juridique.documents.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nouveau document</a></div></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr><th>#</th><th>Numéro</th><th>Titre</th><th>Type</th><th>Créé le</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($documents as $doc)
                    <tr><td>{{ $doc->id }}</td><td><code>{{ $doc->numero_unique }}</code></td><td><strong>{{ $doc->titre }}</strong></td><td>{{ $doc->typeDocument->nom ?? '-' }}</td><td>{{ $doc->created_at->format('d/m/Y') }}</td>
                    <td><a href="{{ route('back.juridique.documents.edit', $doc) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Continuer</a>
                        <a href="{{ route('back.juridique.documents.show', $doc) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a></td></tr>
                    @empty <tr><td colspan="6" class="text-center py-4">Aucun brouillon</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">@include('back.juridique.partials.pagination', ['items' => $documents])</div>
</div>
@endsection
