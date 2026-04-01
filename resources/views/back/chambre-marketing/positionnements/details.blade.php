@extends('back.layouts.principal')

@section('title', 'Détails positionnement')
@section('page_title', 'Chambre marketing · Détails positionnement')
@section('page_subtitle', 'Vue détaillée de la cible, du message, de la promesse et de la différenciation.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $positionnementMarketing->titre }}</h3>
                <p class="text-muted mb-0">
                    {{ $positionnementMarketing->message_central ?: 'Aucun message central renseigné.' }}
                </p>
            </div>

           <div class="d-flex flex-wrap gap-2">
    <a href="{{ route('back.chambre-marketing.positionnements.modifier', $positionnementMarketing) }}"
       class="btn btn-warning rounded-pill px-4">
        Modifier
    </a>

    @if($positionnementMarketing->statut !== 'actif')
        <form method="POST" action="{{ route('back.chambre-marketing.positionnements.activer', $positionnementMarketing) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success rounded-pill px-4">
                Activer
            </button>
        </form>
    @endif

    @if($positionnementMarketing->statut !== 'a_revoir')
        <form method="POST" action="{{ route('back.chambre-marketing.positionnements.marquer_a_revoir', $positionnementMarketing) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-outline-warning rounded-pill px-4">
                À revoir
            </button>
        </form>
    @endif

    <form method="POST" action="{{ route('back.chambre-marketing.positionnements.archiver', $positionnementMarketing) }}">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-outline-secondary rounded-pill px-4">
            Archiver
        </button>
    </form>

    <form method="POST" action="{{ route('back.chambre-marketing.positionnements.supprimer', $positionnementMarketing) }}"
          onsubmit="return confirm('Supprimer ce positionnement ?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger rounded-pill px-4">
            Supprimer
        </button>
    </form>
</div>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Segment cible</span>
                    <div class="fw-bold mt-2">{{ $positionnementMarketing->segment_cible ?: '—' }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Canal principal</span>
                    <div class="fw-bold mt-2">{{ $positionnementMarketing->canal_principal ?: '—' }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Statut</span>
                    <div class="fw-bold mt-2">{{ str_replace('_', ' ', ucfirst($positionnementMarketing->statut)) }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-zone">
                    <strong>Problème adressé</strong><br>
                    {{ $positionnementMarketing->probleme_adresse ?: 'Non renseigné.' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-zone">
                    <strong>Promesse</strong><br>
                    {{ $positionnementMarketing->promesse ?: 'Non renseignée.' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-zone">
                    <strong>Différenciation</strong><br>
                    {{ $positionnementMarketing->differenciation ?: 'Non renseignée.' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-zone">
                    <strong>Message central</strong><br>
                    {{ $positionnementMarketing->message_central ?: 'Non renseigné.' }}
                </div>
            </div>
        </div>
    </div>

    <style>
        .info-tile,.detail-zone{
            padding:18px;
            border-radius:18px;
            border:1px solid #e5e7eb;
            background:#f8fafc;
            white-space:pre-line;
        }
    </style>
@endsection