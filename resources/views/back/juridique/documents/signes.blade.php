@extends('back.juridique.layouts.app')
@section('title', 'Documents signés')
@section('page_title', 'Documents signés')
@section('page_subtitle', 'Documents avec signatures complètes')

@section('juridique-content')
<div class="card">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-check-circle text-success"></i> Documents signés</h3></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr><th>#</th><th>Numéro</th><th>Titre</th><th>Type</th><th>Date signature</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($documents as $doc)
                    <tr><td>{{ $doc->id }}</td><td><code>{{ $doc->numero_unique }}</code></td><td><strong>{{ $doc->titre }}</strong></td><td>{{ $doc->typeDocument->nom ?? '-' }}</td><td>{{ $doc->date_signature ? $doc->date_signature->format('d/m/Y') : '-' }}</td>
                    <td><a href="{{ route('back.juridique.documents.show', $doc) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('back.juridique.documents.generer-pdf', $doc) }}" class="btn btn-sm btn-danger" target="_blank"><i class="fas fa-file-pdf"></i></a></td></tr>
                    @empty <tr><td colspan="6" class="text-center py-4">Aucun document signé</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">@include('back.juridique.partials.pagination', ['items' => $documents])</div>
</div>
@endsection
