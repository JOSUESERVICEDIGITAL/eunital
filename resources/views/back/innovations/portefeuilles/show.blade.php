@extends('back.layouts.principal')

@section('title', 'Fiche portefeuille')
@section('page_title', $portefeuille->nom)
@section('page_subtitle', 'Fiche stratégique du portefeuille innovation.')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="portfolio-hero">
            <div>
                <span class="badge rounded-pill bg-warning-subtle text-warning mb-2">{{ $portefeuille->type_portefeuille }}</span>
                <h2>{{ $portefeuille->nom }}</h2>
                <p>{{ $portefeuille->description ?? 'Aucune description.' }}</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.innovations.portefeuilles.edit', $portefeuille) }}" class="btn btn-warning rounded-pill px-4">
                    Modifier
                </a>
                <a href="{{ route('back.innovations.portefeuilles.budget', $portefeuille) }}" class="btn btn-outline-light rounded-pill px-4">
                    Budget
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card"><span>Innovations</span><strong>{{ $portefeuille->innovations->count() }}</strong></div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card"><span>Feuilles de route</span><strong>{{ $portefeuille->feuillesRoutes->count() }}</strong></div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card"><span>Alertes</span><strong>{{ $portefeuille->alertes->count() }}</strong></div>
    </div>

    <div class="col-md-3">
        <div class="mini-stat-card"><span>Statut</span><strong>{{ $portefeuille->statut }}</strong></div>
    </div>

    <div class="col-xl-4">
        <div class="content-card h-100">
            <h5 class="fw-bold mb-4">Informations</h5>
            <div class="info-line"><span>Code</span><strong>{{ $portefeuille->code }}</strong></div>
            <div class="info-line"><span>Responsable</span><strong>{{ optional($portefeuille->responsable)->name ?? '—' }}</strong></div>
            <div class="info-line"><span>Priorité</span><strong>{{ $portefeuille->niveau_priorite }}</strong></div>
            <div class="info-line"><span>Lancement</span><strong>{{ optional($portefeuille->date_lancement)->format('d/m/Y') ?? '—' }}</strong></div>
            <div class="info-line"><span>Fin prévue</span><strong>{{ optional($portefeuille->date_fin_previsionnelle)->format('d/m/Y') ?? '—' }}</strong></div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="content-card h-100">
            <div class="section-head">
                <div>
                    <h4>Innovations du portefeuille</h4>
                    <p>Initiatives rattachées à ce programme.</p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle hub-table">
                    <thead>
                        <tr>
                            <th>Innovation</th>
                            <th>Statut</th>
                            <th>Priorité</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($portefeuille->innovations as $innovation)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $innovation->titre }}</div>
                                    <div class="text-muted small">{{ $innovation->code }}</div>
                                </td>
                                <td>{{ $innovation->statut }}</td>
                                <td>{{ $innovation->niveau_priorite }}</td>
                                <td class="text-end">
                                    <a href="{{ route('back.innovations.innovations.show', $innovation) }}" class="btn btn-sm btn-light rounded-pill">
                                        Voir
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">Aucune innovation rattachée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@include('back.innovations.portefeuilles._styles')
@endsection
