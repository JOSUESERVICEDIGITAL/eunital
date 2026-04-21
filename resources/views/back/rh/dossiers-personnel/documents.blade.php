@extends('back.layouts.principal')

@section('title', 'Documents du personnel')
@section('page_title', 'Documents du personnel')
@section('page_subtitle', 'Pièces RH, pièces administratives et références documentaires liées au collaborateur.')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">
                            {{ optional($dossier->membreEquipe)->nom }} {{ optional($dossier->membreEquipe)->prenom }}
                        </h4>
                        <p class="text-muted mb-0">Gestion documentaire du dossier RH.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.dossiers-personnel.show', $dossier) }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fa-solid fa-eye me-2"></i>Fiche
                        </a>
                        <a href="{{ route('rh.dossiers-personnel.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Retour
                        </a>
                    </div>
                </div>

                @if(!empty($documents) && count($documents))
                    <div class="row g-4">
                        @foreach($documents as $index => $document)
                            <div class="col-md-6 col-xl-4">
                                <div class="content-card h-100 doc-card">
                                    <div class="doc-icon bg-primary-subtle text-primary">
                                        <i class="fa-solid fa-file-lines"></i>
                                    </div>
                                    <h6 class="fw-bold mb-2">{{ $document['nom'] ?? 'Document RH #' . ($index + 1) }}</h6>
                                    <p class="text-muted small mb-3">
                                        {{ $document['description'] ?? 'Document rattaché au dossier du personnel.' }}
                                    </p>
                                    @if(!empty($document['url']))
                                        <a href="{{ $document['url'] }}" target="_blank" class="btn btn-sm btn-primary rounded-pill px-3">
                                            Ouvrir
                                        </a>
                                    @else
                                        <span class="badge text-bg-light border">Référence enregistrée</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fa-solid fa-folder-open empty-state-icon"></i>
                        <h5 class="mt-3">Aucun document enregistré</h5>
                        <p class="text-muted">Les documents RH de cet employé apparaîtront ici.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .doc-card{transition:all .25s ease}
        .doc-card:hover{transform:translateY(-4px);box-shadow:0 14px 34px rgba(15,23,42,.06)}
        .doc-icon{width:54px;height:54px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:16px}
        .empty-state{text-align:center;padding:30px}
        .empty-state-icon{font-size:42px;color:#94a3b8}
    </style>
@endsection
