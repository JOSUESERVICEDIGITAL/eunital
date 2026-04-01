@extends('back.layouts.principal')

@section('title', 'Détails commentaire')
@section('page_title', 'Détails du commentaire')
@section('page_subtitle', 'Consultation complète du commentaire, de son auteur, de son article et de ses réponses.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">Commentaire #{{ $commentaire->id }}</h3>
                        <p class="text-muted mb-0">Suivi détaillé du contenu et de son état de modération.</p>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        @if($commentaire->statut !== 'valide')
                            <form method="POST" action="{{ route('back.commentaires.valider', $commentaire) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-success rounded-pill px-4">Valider</button>
                            </form>
                        @endif

                        @if($commentaire->statut !== 'rejete')
                            <form method="POST" action="{{ route('back.commentaires.rejeter', $commentaire) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-danger rounded-pill px-4">Rejeter</button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="comment-detail-box">
                    {!! nl2br(e($commentaire->contenu)) !!}
                </div>

                @if($commentaire->reponses->count() > 0)
                    <div class="mt-4">
                        <h5 class="fw-bold mb-3">Réponses associées</h5>

                        <div class="vstack gap-3">
                            @foreach($commentaire->reponses as $reponse)
                                <div class="response-box">
                                    <div class="fw-bold mb-1">{{ $reponse->auteur->name ?? $reponse->nom ?? 'Visiteur' }}</div>
                                    <div class="text-muted small mb-2">{{ $reponse->created_at->format('d/m/Y H:i') }}</div>
                                    <div>{{ $reponse->contenu }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card mb-4">
                <h5 class="fw-bold mb-3">Informations</h5>

                <div class="vstack gap-3">
                    <div class="info-tile">
                        <span class="text-muted small">Auteur</span>
                        <div class="fw-bold">{{ $commentaire->auteur->name ?? $commentaire->nom ?? 'Visiteur' }}</div>
                    </div>

                    <div class="info-tile">
                        <span class="text-muted small">Email</span>
                        <div class="fw-bold">{{ $commentaire->email ?? 'Aucun email' }}</div>
                    </div>

                    <div class="info-tile">
                        <span class="text-muted small">Article</span>
                        <div class="fw-bold">{{ $commentaire->article->titre ?? 'Article introuvable' }}</div>
                    </div>

                    <div class="info-tile">
                        <span class="text-muted small">Type</span>
                        <div class="fw-bold">{{ $commentaire->parent ? 'Réponse' : 'Commentaire principal' }}</div>
                    </div>

                    <div class="info-tile">
                        <span class="text-muted small">Statut</span>
                        <div class="fw-bold">
                            @if($commentaire->statut === 'valide')
                                <span class="badge rounded-pill text-bg-success">Validé</span>
                            @elseif($commentaire->statut === 'rejete')
                                <span class="badge rounded-pill text-bg-danger">Rejeté</span>
                            @else
                                <span class="badge rounded-pill text-bg-warning">En attente</span>
                            @endif
                        </div>
                    </div>

                    <div class="info-tile">
                        <span class="text-muted small">Date</span>
                        <div class="fw-bold">{{ $commentaire->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>

            <div class="content-card">
                <h5 class="fw-bold mb-3">Actions rapides</h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('back.commentaires.tous') }}" class="btn btn-outline-dark rounded-pill">Tous les commentaires</a>
                    <a href="{{ route('back.commentaires.en_attente') }}" class="btn btn-outline-warning rounded-pill">En attente</a>
                    <a href="{{ route('back.commentaires.valides') }}" class="btn btn-outline-success rounded-pill">Validés</a>
                    <a href="{{ route('back.commentaires.rejetes') }}" class="btn btn-outline-danger rounded-pill">Rejetés</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .info-tile{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc}
        .comment-detail-box{padding:22px;border-radius:20px;background:#f8fafc;border:1px solid #e5e7eb;line-height:1.9;color:#334155}
        .response-box{padding:16px;border-radius:16px;border:1px solid #e5e7eb;background:#fff}
    </style>
@endsection