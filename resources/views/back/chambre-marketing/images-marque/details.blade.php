@extends('back.layouts.principal')

@section('title', 'Détails image de marque')
@section('page_title', 'Chambre marketing · Détails image de marque')
@section('page_subtitle', 'Vue détaillée de l’identité, du ton, du slogan, du langage et de la cohérence visuelle.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $imageMarque->nom_marque }}</h3>
                <p class="text-muted mb-0">
                    {{ $imageMarque->slogan ?: 'Aucun slogan renseigné.' }}
                </p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.chambre-marketing.images-marque.modifier', $imageMarque) }}"
                    class="btn btn-warning rounded-pill px-4">
                    Modifier
                </a>

                @if($imageMarque->statut !== 'active')
                    <form method="POST" action="{{ route('back.chambre-marketing.images-marque.activer', $imageMarque) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success rounded-pill px-4">
                            Activer
                        </button>
                    </form>
                @endif

                @if($imageMarque->statut !== 'obsolete')
                    <form method="POST"
                        action="{{ route('back.chambre-marketing.images-marque.marquer_obsolete', $imageMarque) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-outline-warning rounded-pill px-4">
                            Marquer obsolète
                        </button>
                    </form>
                @endif

                <form method="POST" action="{{ route('back.chambre-marketing.images-marque.archiver', $imageMarque) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-outline-secondary rounded-pill px-4">
                        Archiver
                    </button>
                </form>

                <form method="POST" action="{{ route('back.chambre-marketing.images-marque.supprimer', $imageMarque) }}"
                    onsubmit="return confirm('Supprimer cette image de marque ?')">
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
                    <span class="text-muted small">Ton de marque</span>
                    <div class="fw-bold mt-2">{{ $imageMarque->ton_marque ?: '—' }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Logo</span>
                    <div class="fw-bold mt-2">{{ $imageMarque->logo ?: '—' }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">
                    <span class="text-muted small">Statut</span>
                    <div class="fw-bold mt-2">{{ ucfirst($imageMarque->statut) }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-zone">
                    <strong>Identité visuelle</strong><br>
                    {{ $imageMarque->identite_visuelle ?: 'Non renseignée.' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-zone">
                    <strong>Palette couleurs</strong><br>
                    {{ $imageMarque->palette_couleurs ?: 'Non renseignée.' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-zone">
                    <strong>Éléments de langage</strong><br>
                    {{ $imageMarque->elements_langage ?: 'Non renseignés.' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-zone">
                    <strong>Ligne éditoriale</strong><br>
                    {{ $imageMarque->ligne_editoriale ?: 'Non renseignée.' }}
                </div>
            </div>

            <div class="col-12">
                <div class="detail-zone">
                    <strong>Charte graphique</strong><br>
                    {{ $imageMarque->charte_graphique ?: 'Non renseignée.' }}
                </div>
            </div>
        </div>
    </div>

    <style>
        .info-tile,
        .detail-zone {
            padding: 18px;
            border-radius: 18px;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            white-space: pre-line;
        }
    </style>
@endsection