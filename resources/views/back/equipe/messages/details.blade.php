@extends('back.layouts.principal')
@section('title', 'Détails message')
@section('page_title', 'Détails du message interne')
@section('page_subtitle', 'Consultation complète du contenu et des destinataires du message.')
@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $messageInterne->sujet }}</h3>
                <p class="text-muted mb-0">{{ $messageInterne->date_envoi ? $messageInterne->date_envoi->format('d/m/Y H:i') : '' }}</p>
            </div>
            <a href="{{ route('back.equipe.messages.modifier', $messageInterne) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Expéditeur</span><div class="fw-bold mt-2">{{ $messageInterne->expediteur?->nom }} {{ $messageInterne->expediteur?->prenom }}</div></div></div>
            <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Destinataire</span><div class="fw-bold mt-2">{{ $messageInterne->destinataire ? $messageInterne->destinataire->nom . ' ' . $messageInterne->destinataire->prenom : 'Aucun' }}</div></div></div>
            <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Département</span><div class="fw-bold mt-2">{{ $messageInterne->departement->nom ?? 'Aucun' }}</div></div></div>
            <div class="col-md-6"><div class="info-tile"><span class="text-muted small">Lecture</span><div class="fw-bold mt-2">{{ $messageInterne->est_lu ? 'Lu' : 'Non lu' }}</div></div></div>
        </div>

        <div class="profile-bio-box">
            {!! nl2br(e($messageInterne->contenu)) !!}
        </div>
    </div>

    <style>
        .info-tile{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc}
        .profile-bio-box{padding:22px;border-radius:20px;background:#f8fafc;border:1px solid #e5e7eb;line-height:1.8;color:#334155}
    </style>
@endsection