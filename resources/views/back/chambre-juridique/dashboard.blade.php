@extends('back.layouts.principal')

@section('content')
<div class="container-fluid">

    <div class="juridique-dashboard-hero mb-4">
        <div class="row g-4 align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="juridique-dashboard-hero-icon">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <div>
                        <h2 class="mb-1 text-white">Dashboard juridique</h2>
                        <p class="mb-0 text-white-50">
                            Centre de contrôle des contrats, engagements, modèles, documents, dossiers, archives et pièces jointes du hub.
                        </p>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('back.chambre-juridique.contrats.toutes') }}" class="btn btn-sm btn-light rounded-pill px-3 fw-semibold">
                        Contrats
                    </a>
                    <a href="{{ route('back.chambre-juridique.engagements.toutes') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Engagements
                    </a>
                    <a href="{{ route('back.chambre-juridique.modeles-documents.toutes') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Modèles
                    </a>
                    <a href="{{ route('back.chambre-juridique.documents.toutes') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Documents
                    </a>
                    <a href="{{ route('back.chambre-juridique.dossiers.toutes') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Dossiers
                    </a>
                    <a href="{{ route('back.chambre-juridique.archives-hub.toutes') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Archives
                    </a>
                    <a href="{{ route('back.chambre-juridique.pieces-jointes.toutes') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
                        Pièces jointes
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="juridique-dashboard-alert-card">
                    <div class="small text-uppercase fw-semibold text-white-50 mb-2">Pilotage global</div>
                    <div class="text-white fw-semibold fs-5">
                        La chambre juridique centralise les bases contractuelles, la conformité et la mémoire institutionnelle du hub.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="juridique-stat-card">
                <div class="juridique-stat-top">
                    <div>
                        <div class="juridique-stat-label">Contrats</div>
                        <div class="juridique-stat-value">{{ $stats['contrats'] ?? 0 }}</div>
                    </div>
                    <div class="juridique-stat-icon bg-primary-subtle text-primary">
                        <i class="fa-solid fa-file-contract"></i>
                    </div>
                </div>
                <div class="juridique-stat-subtext">Documents contractuels du hub</div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="juridique-stat-card">
                <div class="juridique-stat-top">
                    <div>
                        <div class="juridique-stat-label">Engagements</div>
                        <div class="juridique-stat-value">{{ $stats['engagements'] ?? 0 }}</div>
                    </div>
                    <div class="juridique-stat-icon bg-info-subtle text-info">
                        <i class="fa-solid fa-file-signature"></i>
                    </div>
                </div>
                <div class="juridique-stat-subtext">Dossiers de validation et d’engagement</div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="juridique-stat-card">
                <div class="juridique-stat-top">
                    <div>
                        <div class="juridique-stat-label">Modèles</div>
                        <div class="juridique-stat-value">{{ $stats['modeles'] ?? 0 }}</div>
                    </div>
                    <div class="juridique-stat-icon bg-warning-subtle text-warning">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                </div>
                <div class="juridique-stat-subtext">Bases documentaires réutilisables</div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="juridique-stat-card">
                <div class="juridique-stat-top">
                    <div>
                        <div class="juridique-stat-label">Documents</div>
                        <div class="juridique-stat-value">{{ $stats['documents'] ?? 0 }}</div>
                    </div>
                    <div class="juridique-stat-icon bg-secondary-subtle text-secondary">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                </div>
                <div class="juridique-stat-subtext">Chartes, procédures et textes officiels</div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="juridique-stat-card">
                <div class="juridique-stat-top">
                    <div>
                        <div class="juridique-stat-label">Dossiers</div>
                        <div class="juridique-stat-value">{{ $stats['dossiers'] ?? 0 }}</div>
                    </div>
                    <div class="juridique-stat-icon bg-danger-subtle text-danger">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                </div>
                <div class="juridique-stat-subtext">Litiges, réclamations, suivis sensibles</div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="juridique-stat-card">
                <div class="juridique-stat-top">
                    <div>
                        <div class="juridique-stat-label">Archives</div>
                        <div class="juridique-stat-value">{{ $stats['archives'] ?? 0 }}</div>
                    </div>
                    <div class="juridique-stat-icon bg-dark-subtle text-dark">
                        <i class="fa-solid fa-landmark"></i>
                    </div>
                </div>
                <div class="juridique-stat-subtext">Mémoire historique et institutionnelle</div>
            </div>
        </div>

        <div class="col-md-12 col-xl-4">
            <div class="juridique-stat-card">
                <div class="juridique-stat-top">
                    <div>
                        <div class="juridique-stat-label">Pièces jointes</div>
                        <div class="juridique-stat-value">{{ $stats['pieces_jointes'] ?? 0 }}</div>
                    </div>
                    <div class="juridique-stat-icon bg-success-subtle text-success">
                        <i class="fa-solid fa-paperclip"></i>
                    </div>
                </div>
                <div class="juridique-stat-subtext">Annexes, preuves et justificatifs liés</div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">

        <div class="col-xl-4">
            <div class="juridique-panel-card h-100">
                <div class="juridique-panel-head">
                    <div>
                        <h5 class="mb-1">Accès rapides</h5>
                        <small class="text-muted">Créer et consulter les principaux modules</small>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('back.chambre-juridique.contrats.creer') }}" class="btn btn-outline-dark rounded-pill text-start">
                        Nouveau contrat
                    </a>
                    <a href="{{ route('back.chambre-juridique.engagements.creer') }}" class="btn btn-outline-dark rounded-pill text-start">
                        Nouvel engagement
                    </a>
                    <a href="{{ route('back.chambre-juridique.modeles-documents.creer') }}" class="btn btn-outline-dark rounded-pill text-start">
                        Nouveau modèle
                    </a>
                    <a href="{{ route('back.chambre-juridique.documents.creer') }}" class="btn btn-outline-dark rounded-pill text-start">
                        Nouveau document
                    </a>
                    <a href="{{ route('back.chambre-juridique.dossiers.creer') }}" class="btn btn-outline-dark rounded-pill text-start">
                        Nouveau dossier
                    </a>
                    <a href="{{ route('back.chambre-juridique.archives-hub.creer') }}" class="btn btn-outline-dark rounded-pill text-start">
                        Nouvelle archive
                    </a>
                    <a href="{{ route('back.chambre-juridique.pieces-jointes.creer') }}" class="btn btn-outline-dark rounded-pill text-start">
                        Nouvelle pièce jointe
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="juridique-panel-card h-100">
                <div class="juridique-panel-head">
                    <div>
                        <h5 class="mb-1">Organisation hiérarchique</h5>
                        <small class="text-muted">Vision métier de la chambre juridique dans le hub</small>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="juridique-mini-card h-100">
                            <div class="juridique-mini-title">Contrats et services</div>
                            <div class="juridique-mini-text">
                                Tous les services importants du hub peuvent être couverts par un contrat, lié ensuite à une facture, un paiement ou un livrable.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="juridique-mini-card h-100">
                            <div class="juridique-mini-title">Engagements et RH</div>
                            <div class="juridique-mini-text">
                                Les engagements juridiques peuvent servir de base au circuit RH, aux validations hiérarchiques et à la génération des contrats.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="juridique-mini-card h-100">
                            <div class="juridique-mini-title">Conformité documentaire</div>
                            <div class="juridique-mini-text">
                                Les modèles et documents officiels garantissent une production cohérente, professionnelle et juridiquement uniforme.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="juridique-mini-card h-100">
                            <div class="juridique-mini-title">Mémoire du hub</div>
                            <div class="juridique-mini-text">
                                Les archives du hub protègent l’histoire institutionnelle, les fondations, les inaugurations et les pièces patrimoniales.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4">

        <div class="col-xl-4">
            <div class="juridique-panel-card h-100">
                <div class="juridique-panel-head">
                    <div>
                        <h5 class="mb-1">Derniers contrats</h5>
                        <small class="text-muted">Créations récentes</small>
                    </div>
                    <a href="{{ route('back.chambre-juridique.contrats.toutes') }}" class="btn btn-sm btn-light rounded-pill px-3">
                        Voir tout
                    </a>
                </div>

                <div class="d-flex flex-column gap-3">
                    @forelse($derniersContrats as $contrat)
                        <div class="juridique-list-card">
                            <div class="d-flex justify-content-between align-items-start gap-3">
                                <div>
                                    <div class="fw-bold">{{ $contrat->titre }}</div>
                                    <div class="small text-muted">
                                        {{ $contrat->reference }} · {{ $contrat->client->nom ?? $contrat->user->name ?? '—' }}
                                    </div>
                                </div>
                                <span class="badge text-bg-secondary">
                                    {{ ucfirst(str_replace('_', ' ', $contrat->statut)) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-muted">Aucun contrat récent.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="juridique-panel-card h-100">
                <div class="juridique-panel-head">
                    <div>
                        <h5 class="mb-1">Derniers engagements</h5>
                        <small class="text-muted">Dossiers récents</small>
                    </div>
                    <a href="{{ route('back.chambre-juridique.engagements.toutes') }}" class="btn btn-sm btn-light rounded-pill px-3">
                        Voir tout
                    </a>
                </div>

                <div class="d-flex flex-column gap-3">
                    @forelse($derniersEngagements as $engagement)
                        <div class="juridique-list-card">
                            <div class="d-flex justify-content-between align-items-start gap-3">
                                <div>
                                    <div class="fw-bold">{{ $engagement->nom_complet }}</div>
                                    <div class="small text-muted">
                                        {{ ucfirst($engagement->type_engagement) }} · {{ $engagement->service_concerne ?? '—' }}
                                    </div>
                                </div>
                                <span class="badge text-bg-secondary">
                                    {{ ucfirst(str_replace('_', ' ', $engagement->statut)) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-muted">Aucun engagement récent.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="juridique-panel-card h-100">
                <div class="juridique-panel-head">
                    <div>
                        <h5 class="mb-1">Derniers dossiers</h5>
                        <small class="text-muted">Traitements en suivi</small>
                    </div>
                    <a href="{{ route('back.chambre-juridique.dossiers.toutes') }}" class="btn btn-sm btn-light rounded-pill px-3">
                        Voir tout
                    </a>
                </div>

                <div class="d-flex flex-column gap-3">
                    @forelse($derniersDossiers as $dossier)
                        <div class="juridique-list-card">
                            <div class="d-flex justify-content-between align-items-start gap-3">
                                <div>
                                    <div class="fw-bold">{{ $dossier->titre }}</div>
                                    <div class="small text-muted">
                                        {{ ucfirst(str_replace('_', ' ', $dossier->type_dossier)) }} · {{ $dossier->client->nom ?? '—' }}
                                    </div>
                                </div>
                                <span class="badge text-bg-secondary">
                                    {{ ucfirst(str_replace('_', ' ', $dossier->statut)) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-muted">Aucun dossier récent.</div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</div>

<style>
    .juridique-dashboard-hero{
        background: linear-gradient(135deg, #111827 0%, #1f2937 45%, #374151 100%);
        border-radius: 28px;
        padding: 28px;
        box-shadow: 0 18px 45px rgba(15,23,42,.18);
    }

    .juridique-dashboard-hero-icon{
        width: 74px;
        height: 74px;
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,.12);
        color: #fff;
        font-size: 28px;
        border: 1px solid rgba(255,255,255,.15);
    }

    .juridique-dashboard-alert-card{
        background: rgba(255,255,255,.10);
        border: 1px solid rgba(255,255,255,.12);
        border-radius: 24px;
        padding: 20px;
        backdrop-filter: blur(8px);
    }

    .juridique-stat-card{
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 24px;
        padding: 20px;
        box-shadow: 0 12px 30px rgba(15,23,42,.05);
        height: 100%;
    }

    .juridique-stat-top{
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 14px;
    }

    .juridique-stat-label{
        color: #64748b;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .juridique-stat-value{
        font-size: 30px;
        font-weight: 800;
        line-height: 1;
        color: #0f172a;
    }

    .juridique-stat-subtext{
        margin-top: 12px;
        color: #64748b;
        font-size: 13px;
    }

    .juridique-stat-icon{
        width: 56px;
        height: 56px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .juridique-panel-card{
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 26px;
        padding: 22px;
        box-shadow: 0 12px 30px rgba(15,23,42,.05);
    }

    .juridique-panel-head{
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .juridique-mini-card{
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        padding: 18px;
        background: #f8fafc;
    }

    .juridique-mini-title{
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .juridique-mini-text{
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
    }

    .juridique-list-card{
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 14px 16px;
        background: #fff;
    }
</style>
@endsection