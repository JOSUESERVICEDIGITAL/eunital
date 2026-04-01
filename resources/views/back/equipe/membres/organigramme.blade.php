@extends('back.layouts.principal')

@section('title', 'Organigramme')
@section('page_title', 'Organigramme')
@section('page_subtitle', 'Vue hiérarchique simplifiée des membres visibles dans l’organigramme.')

@section('content')
    <div class="content-card">
        <div class="mb-4">
            <h4 class="fw-bold mb-1">Organigramme du hub</h4>
            <p class="text-muted mb-0">Visualisation structurée des membres et de leurs rattachements.</p>
        </div>

        <div class="row g-4">
            @forelse($membres as $membre)
                <div class="col-md-6 col-xl-4">
                    <div class="orga-card">
                        <div class="orga-name">{{ $membre->nom }} {{ $membre->prenom }}</div>
                        <div class="orga-poste">{{ $membre->poste->nom ?? 'Sans poste' }}</div>
                        <div class="orga-departement">{{ $membre->departement->nom ?? 'Sans département' }}</div>
                        <div class="orga-responsable mt-2">
                            Responsable :
                            <strong>{{ $membre->responsable ? $membre->responsable->nom . ' ' . $membre->responsable->prenom : 'Aucun' }}</strong>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-muted">Aucun membre visible dans l’organigramme.</div>
            @endforelse
        </div>
    </div>

    <style>
        .orga-card{padding:22px;border-radius:22px;border:1px solid #e5e7eb;background:#fff;box-shadow:0 8px 24px rgba(15,23,42,.04)}
        .orga-name{font-size:18px;font-weight:800;color:#0f172a}
        .orga-poste{font-size:14px;color:#f59e0b;font-weight:700;margin-top:6px}
        .orga-departement{font-size:14px;color:#64748b;margin-top:4px}
        .orga-responsable{font-size:13px;color:#334155}
    </style>
@endsection