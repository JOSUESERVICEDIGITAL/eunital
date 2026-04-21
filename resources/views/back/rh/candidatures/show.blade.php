@extends('back.layouts.principal')

@section('title', 'Détail de la candidature')
@section('page_title', 'Détail de la candidature')
@section('page_subtitle', 'Vue candidat 360° avec données de contact, recrutement lié, documents et actions rapides de décision RH.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="content-card hero-card">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="hero-icon bg-primary-subtle text-primary">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">{{ $candidature->nom }} {{ $candidature->prenom }}</h3>
                            <div class="text-muted mb-2">
                                {{ optional($candidature->recrutement)->titre ?? 'Recrutement non défini' }}
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                @php
                                    $statusClass = match($candidature->statut) {
                                        'recu' => 'text-bg-light border',
                                        'en_etude' => 'text-bg-info',
                                        'entretien' => 'text-bg-warning',
                                        'retenu' => 'text-bg-success',
                                        'rejete' => 'text-bg-danger',
                                        default => 'text-bg-light'
                                    };
                                @endphp
                                <span class="badge rounded-pill {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $candidature->statut)) }}
                                </span>
                                <span class="badge rounded-pill text-bg-light border">
                                    {{ $candidature->date_candidature?->format('d/m/Y') ?? 'Date non définie' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('rh.candidatures.edit', $candidature) }}" class="btn btn-warning rounded-pill px-4">
                            <i class="fa-solid fa-pen me-2"></i>Modifier
                        </a>

                        <form method="POST" action="{{ route('rh.candidatures.retenir', $candidature) }}">
                            @csrf
                            <button type="submit" class="btn btn-success rounded-pill px-4">
                                <i class="fa-solid fa-check me-2"></i>Retenir
                            </button>
                        </form>

                        <form method="POST" action="{{ route('rh.candidatures.rejeter', $candidature) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger rounded-pill px-4">
                                <i class="fa-solid fa-xmark me-2"></i>Rejeter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="content-card h-100">
                <h5 class="fw-bold mb-4">Informations candidat</h5>

                <div class="info-list">
                    <div class="info-row">
                        <span class="info-label">Nom complet</span>
                        <span class="info-value">{{ $candidature->nom }} {{ $candidature->prenom }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $candidature->email ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Téléphone</span>
                        <span class="info-value">{{ $candidature->telephone ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Date candidature</span>
                        <span class="info-value">{{ $candidature->date_candidature?->format('d/m/Y') ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Recrutement</span>
                        <span class="info-value">{{ optional($candidature->recrutement)->titre ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Département</span>
                        <span class="info-value">{{ optional(optional($candidature->recrutement)->departement)->nom ?? '—' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="content-card h-100">
                        <h5 class="fw-bold mb-3">Observation RH</h5>
                        <div class="note-box">
                            {{ $candidature->observation ?: 'Aucune observation RH renseignée.' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="content-card h-100">
                        <h5 class="fw-bold mb-3">Documents</h5>

                        <div class="doc-list">
                            <div class="doc-item">
                                <div>
                                    <div class="fw-bold">CV</div>
                                    <div class="text-muted small">{{ $candidature->cv ?: 'Aucune référence' }}</div>
                                </div>
                                @if($candidature->cv)
                                    <a href="{{ route('rh.candidatures.telecharger-cv', $candidature) }}" class="btn btn-sm btn-light rounded-pill px-3">
                                        Ouvrir
                                    </a>
                                @endif
                            </div>

                            <div class="doc-item">
                                <div>
                                    <div class="fw-bold">Lettre de motivation</div>
                                    <div class="text-muted small">{{ $candidature->lettre_motivation ?: 'Aucune référence' }}</div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex flex-wrap gap-2">
                            <form method="POST" action="{{ route('rh.candidatures.changer-statut', $candidature) }}">
                                @csrf
                                <input type="hidden" name="statut" value="en_etude">
                                <button type="submit" class="btn btn-outline-info rounded-pill px-4">En étude</button>
                            </form>

                            <form method="POST" action="{{ route('rh.candidatures.changer-statut', $candidature) }}">
                                @csrf
                                <input type="hidden" name="statut" value="entretien">
                                <button type="submit" class="btn btn-outline-warning rounded-pill px-4">Entretien</button>
                            </form>

                            <a href="{{ route('rh.candidatures.historique', $candidature) }}" class="btn btn-outline-secondary rounded-pill px-4">
                                Historique
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="content-card">
                        <div class="d-flex flex-wrap gap-2">
                            @if($candidature->recrutement)
                                <a href="{{ route('rh.recrutements.show', $candidature->recrutement) }}" class="btn btn-outline-primary rounded-pill px-4">
                                    <i class="fa-solid fa-briefcase me-2"></i>Voir le recrutement
                                </a>

                                <a href="{{ route('rh.candidatures.par-recrutement', $candidature->recrutement) }}" class="btn btn-outline-info rounded-pill px-4">
                                    <i class="fa-solid fa-users-viewfinder me-2"></i>Autres candidatures
                                </a>
                            @endif

                            <a href="{{ route('rh.candidatures.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fa-solid fa-arrow-left me-2"></i>Retour à la liste
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <style>
        .hero-card{background:linear-gradient(135deg, rgba(59,130,246,.06), rgba(17,177,173,.04))}
        .hero-icon{width:86px;height:86px;border-radius:24px;display:flex;align-items:center;justify-content:center;font-size:30px}
        .info-list{display:flex;flex-direction:column;gap:14px}
        .info-row{display:flex;justify-content:space-between;gap:16px;padding-bottom:12px;border-bottom:1px solid #f1f5f9}
        .info-label{font-size:14px;color:#64748b;font-weight:700}
        .info-value{font-size:14px;color:#0f172a;text-align:right;font-weight:600}
        .note-box{background:#f8fafc;border:1px solid #e5e7eb;border-radius:18px;padding:18px;line-height:1.7;color:#334155}
        .doc-list{display:flex;flex-direction:column;gap:12px}
        .doc-item{display:flex;justify-content:space-between;align-items:center;gap:16px;padding:14px;border:1px solid #eef2f7;border-radius:16px}
    </style>
@endsection