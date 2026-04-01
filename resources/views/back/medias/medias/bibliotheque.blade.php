@extends('back.layouts.principal')

@section('title', 'Bibliothèque média')
@section('page_title', 'Bibliothèque média')
@section('page_subtitle', 'Gestion centralisée des images, vidéos, documents et ressources numériques du hub.')

@section('content')
    <div class="row g-4">

        <div class="col-12">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mini-label">Total médias</div>
                                <h3 class="stat-number">{{ $medias->total() }}</h3>
                            </div>
                            <div class="stat-icon bg-danger-subtle text-danger">
                                <i class="fa-solid fa-photo-film"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="mini-label">Publics</div>
                        <h3 class="stat-number">{{ $medias->where('est_public', true)->count() }}</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="mini-label">En avant</div>
                        <h3 class="stat-number">{{ $medias->where('est_en_avant', true)->count() }}</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="content-card h-100">
                        <div class="mini-label">Liens externes</div>
                        <h3 class="stat-number">{{ $medias->filter(fn($media) => !empty($media->url_externe))->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="mb-1 fw-bold">Centre médias</h4>
                        <p class="text-muted mb-0">Bibliothèque globale des ressources numériques utilisées dans le hub et sur le front.</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('back.medias.fichiers.bibliotheque') }}" class="btn btn-outline-dark rounded-pill px-4">Bibliothèque</a>
                        <a href="{{ route('back.medias.fichiers.images') }}" class="btn btn-outline-primary rounded-pill px-4">Images</a>
                        <a href="{{ route('back.medias.fichiers.videos') }}" class="btn btn-outline-danger rounded-pill px-4">Vidéos</a>
                        <a href="{{ route('back.medias.fichiers.documents') }}" class="btn btn-outline-info rounded-pill px-4">Documents</a>
                        <a href="{{ route('back.medias.fichiers.en_avant') }}" class="btn btn-outline-warning rounded-pill px-4">En avant</a>
                        <a href="{{ route('back.medias.fichiers.creer') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-plus me-2"></i>Ajouter un média
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="content-card">
                <div class="table-head-custom mb-4">
                    <div>
                        <h5 class="mb-1 fw-bold">Bibliothèque</h5>
                        <p class="text-muted mb-0">Vue complète des fichiers et liens médias.</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Média</th>
                                <th>Type</th>
                                <th>Catégorie</th>
                                <th>Visibilité</th>
                                <th>Mise en avant</th>
                                <th>Auteur</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($medias as $media)
                                <tr>
                                    <td>{{ $media->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="media-thumb-box">
                                                @if($media->miniature)
                                                    <img src="{{ asset('storage/' . $media->miniature) }}" alt="{{ $media->titre }}">
                                                @elseif($media->fichier && $media->type_media === 'image')
                                                    <img src="{{ asset('storage/' . $media->fichier) }}" alt="{{ $media->titre }}">
                                                @else
                                                    <div class="media-thumb-placeholder">
                                                        <i class="fa-solid fa-file"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $media->titre }}</div>
                                                <div class="text-muted small">{{ $media->extension ?: 'sans extension' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill text-bg-light border">{{ ucfirst($media->type_media) }}</span>
                                    </td>
                                    <td>{{ $media->categorie->nom ?? 'Sans catégorie' }}</td>
                                    <td>
                                        @if($media->est_public)
                                            <span class="badge rounded-pill text-bg-success">Public</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-secondary">Privé</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($media->est_en_avant)
                                            <span class="badge rounded-pill text-bg-warning">Oui</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-dark">Non</span>
                                        @endif
                                    </td>
                                    <td>{{ $media->utilisateur->name ?? 'Système' }}</td>
                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                            <a href="{{ route('back.medias.fichiers.details', $media) }}" class="btn btn-sm btn-light rounded-pill px-3">Voir</a>
                                            <a href="{{ route('back.medias.fichiers.modifier', $media) }}" class="btn btn-sm btn-warning rounded-pill px-3">Modifier</a>

                                            @if(!$media->est_en_avant)
                                                <form method="POST" action="{{ route('back.medias.fichiers.mettre_en_avant', $media) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-warning rounded-pill px-3">Mettre en avant</button>
                                                </form>
                                            @endif

                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalSuppressionMedia{{ $media->id }}">
                                                Supprimer
                                            </button>
                                        </div>

                                        @include('back.medias.medias._modales', ['media' => $media])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">Aucun média trouvé.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $medias->links() }}
                </div>
            </div>
        </div>
    </div>

    <style>
        .mini-label{font-size:13px;color:#64748b;font-weight:700;margin-bottom:8px}
        .stat-number{font-size:32px;font-weight:800;margin:0}
        .stat-icon{width:58px;height:58px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:22px}
        .table-head-custom{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
        .custom-table thead th{font-size:13px;text-transform:uppercase;letter-spacing:.5px;color:#64748b;border-bottom:1px solid #e5e7eb}
        .custom-table tbody td{border-bottom:1px solid #f1f5f9}
        .media-thumb-box{width:58px;height:58px;border-radius:16px;overflow:hidden;flex-shrink:0;border:1px solid #e5e7eb;background:#f8fafc}
        .media-thumb-box img{width:100%;height:100%;object-fit:cover}
        .media-thumb-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#64748b;font-size:20px}
    </style>
@endsection