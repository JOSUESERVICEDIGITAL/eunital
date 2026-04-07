@extends('back.juridique.layouts.app')

@section('title', $document->titre)
@section('page_title', $document->titre)
@section('page_subtitle', 'Document ' . $document->numero_unique)

@section('juridique-content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-info-circle"></i> Informations</h3></div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Numéro</dt><dd class="col-sm-8"><code>{{ $document->numero_unique }}</code></dd>
                    <dt class="col-sm-4">Type</dt><dd class="col-sm-8"><span class="badge" style="background: {{ $document->typeDocument->couleur ?? '#6c757d' }}20; color: {{ $document->typeDocument->couleur ?? '#6c757d' }}"><i class="{{ $document->typeDocument->icon ?? 'fa-file' }}"></i> {{ $document->typeDocument->nom ?? '-' }}</span></dd>
                    <dt class="col-sm-4">Statut</dt><dd class="col-sm-8">@include('back.juridique.partials.status-badge', ['status' => $document->statut])</dd>
                    <dt class="col-sm-4">Version</dt><dd class="col-sm-8">v{{ $document->version }}</dd>
                    <dt class="col-sm-4">Date effet</dt><dd class="col-sm-8">{{ $document->date_effet ? $document->date_effet->format('d/m/Y') : 'Non définie' }}</dd>
                    <dt class="col-sm-4">Date expiration</dt><dd class="col-sm-8">{{ $document->date_expiration ? $document->date_expiration->format('d/m/Y') : 'Non définie' }}</dd>
                    <dt class="col-sm-4">Créé par</dt><dd class="col-sm-8">{{ $document->createur->name ?? '-' }}</dd>
                    <dt class="col-sm-4">Validé par</dt><dd class="col-sm-8">{{ $document->valideur->name ?? '-' }}</dd>
                </dl>
                <hr><h6>Description</h6><p>{{ $document->description ?? 'Aucune description' }}</p>
                @if($document->fichier_path)
                <hr><a href="{{ asset('storage/' . $document->fichier_path) }}" class="btn btn-danger btn-block" target="_blank"><i class="fas fa-file-pdf"></i> Télécharger PDF</a>
                @endif
            </div>
            <div class="card-footer">
                <div class="btn-group w-100">
                    <a href="{{ route('back.juridique.documents.edit', $document) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</a>
                    @if($document->statut === 'en_attente')
                    <button onclick="validerDocument({{ $document->id }})" class="btn btn-success"><i class="fas fa-check"></i> Valider</button>
                    @endif
                    <a href="{{ route('back.juridique.documents.generer-pdf', $document) }}" class="btn btn-danger" target="_blank"><i class="fas fa-file-pdf"></i> PDF</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-users"></i> Signatures</h3></div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($document->signatures as $signature)
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $signature->user->name }}</strong><br>
                                <small>{{ $signature->type_signataire_label }}</small>
                            </div>
                            <div>
                                @if($signature->statut === 'signe')
                                    <span class="badge badge-success">Signé le {{ $signature->date_signature->format('d/m/Y') }}</span>
                                @else
                                    <span class="badge badge-warning">En attente</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">Aucune signature requise</div>
                    @endforelse
                </div>
            </div>
        </div>
        @if($document->contrat)
        <div class="card mt-3">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-handshake"></i> Informations contrat</h3></div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Référence</dt><dd class="col-sm-9">{{ $document->contrat->reference }}</dd>
                    <dt class="col-sm-3">Type</dt><dd class="col-sm-9">{{ $document->contrat->type_contrat_label }}</dd>
                    <dt class="col-sm-3">Période</dt><dd class="col-sm-9">{{ $document->contrat->date_debut->format('d/m/Y') }} - {{ $document->contrat->date_fin ? $document->contrat->date_fin->format('d/m/Y') : 'Indéterminée' }}</dd>
                    @if($document->contrat->montant)<dt class="col-sm-3">Montant</dt><dd class="col-sm-9">{{ number_format($document->contrat->montant, 2) }} {{ $document->contrat->devise }}</dd>@endif
                </dl>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('juridique-scripts')
<script>
function validerDocument(id) {
    Swal.fire({ title: 'Valider le document', text: 'Confirmez-vous la validation de ce document ?', icon: 'question', showCancelButton: true, confirmButtonColor: '#28a745', confirmButtonText: 'Oui, valider' }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({ url: '/back/juridique/documents/' + id + '/valider', method: 'POST', data: { _token: '{{ csrf_token() }}', _method: 'PATCH' },
            success: function(r) { if(r.success) { Swal.fire('Validé!', 'Document validé', 'success'); location.reload(); } } });
        }
    });
}
</script>
@endpush
