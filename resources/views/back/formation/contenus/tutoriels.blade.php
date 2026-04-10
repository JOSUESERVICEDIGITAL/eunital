@extends('back.formation.layouts.app')

@section('title', 'Tutoriels')
@section('page_title', 'Tutoriels et guides')
@section('page_subtitle', 'Liste des tutoriels pas-à-pas')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-chalkboard text-purple mr-2"></i>
            Tutoriels
        </h3>
        <div class="card-tools">
            <a href="{{ route('back.formation.contenus.create', ['type' => 'tutoriel']) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Ajouter un tutoriel
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="row p-3">
            @forelse($contenus as $contenu)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    {{-- Aperçu vidéo --}}
                    <div class="position-relative">
                        @if($contenu->video_url)
                            @php
                                $embedUrl = '';
                                if(strpos($contenu->video_url, 'youtube.com') !== false || strpos($contenu->video_url, 'youtu.be') !== false) {
                                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $contenu->video_url, $matches);
                                    $videoId = $matches[1] ?? null;
                                    $embedUrl = $videoId ? "https://www.youtube.com/embed/{$videoId}" : null;
                                } elseif(strpos($contenu->video_url, 'vimeo.com') !== false) {
                                    preg_match('/vimeo\.com\/(\d+)/', $contenu->video_url, $matches);
                                    $videoId = $matches[1] ?? null;
                                    $embedUrl = $videoId ? "https://player.vimeo.com/video/{$videoId}" : null;
                                }
                            @endphp
                            @if($embedUrl)
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{{ $embedUrl }}" allowfullscreen></iframe>
                            </div>
                            @else
                            <div class="embed-responsive embed-responsive-16by9 bg-dark text-center">
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <i class="fas fa-video fa-3x text-white-50"></i>
                                </div>
                            </div>
                            @endif
                        @elseif($contenu->fichier && in_array(pathinfo($contenu->fichier, PATHINFO_EXTENSION), ['mp4', 'webm', 'ogg']))
                            <video class="card-img-top" style="height: 180px; object-fit: cover;" controls>
                                <source src="{{ asset('storage/' . $contenu->fichier) }}" type="video/mp4">
                            </video>
                        @else
                            <div class="bg-dark text-center py-5" style="height: 180px;">
                                <i class="fas fa-chalkboard fa-4x text-white-50"></i>
                            </div>
                        @endif

                        {{-- Badge de statut en overlay --}}
                        <div class="position-absolute top-0 right-0 p-2">
                            @if($contenu->is_visible)
                                <span class="badge badge-success">Visible</span>
                            @else
                                <span class="badge badge-secondary">Masqué</span>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('back.formation.contenus.show', $contenu) }}" class="text-dark">
                                {{ $contenu->titre }}
                            </a>
                        </h5>
                        <p class="card-text text-muted small">
                            {{ Str::limit($contenu->contenu, 100) }}
                        </p>
                        <div class="mt-2">
                            <span class="badge badge-info">
                                <i class="fas fa-book"></i> {{ $contenu->chapitre->cour->titre ?? 'N/A' }}
                            </span>
                            <span class="badge badge-secondary">
                                <i class="fas fa-layer-group"></i> {{ $contenu->chapitre->titre }}
                            </span>
                        </div>
                        @if($contenu->duree_video)
                        <div class="mt-2">
                            <small class="text-muted">
                                <i class="fas fa-clock"></i> Durée: {{ gmdate("i:s", $contenu->duree_video) }}
                            </small>
                        </div>
                        @endif
                    </div>

                    <div class="card-footer bg-transparent">
                        {{-- Dropdown d'actions --}}
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle w-100" type="button" data-toggle="dropdown">
                                <i class="fas fa-cog"></i> Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('back.formation.contenus.show', $contenu) }}">
                                    <i class="fas fa-eye text-info"></i> Voir le tutoriel
                                </a>
                                <a class="dropdown-item" href="{{ route('back.formation.contenus.edit', $contenu) }}">
                                    <i class="fas fa-edit text-warning"></i> Modifier
                                </a>
                                <div class="dropdown-divider"></div>
                                <button type="button" class="dropdown-item" onclick="toggleVisibility({{ $contenu->id }}, {{ $contenu->is_visible ? 'false' : 'true' }})">
                                    @if($contenu->is_visible)
                                        <i class="fas fa-eye-slash text-warning"></i> Masquer
                                    @else
                                        <i class="fas fa-eye text-success"></i> Afficher
                                    @endif
                                </button>
                                @if($contenu->telechargeable && $contenu->fichier)
                                <a class="dropdown-item" href="{{ route('back.formation.contenus.download', $contenu) }}">
                                    <i class="fas fa-download text-success"></i> Télécharger
                                </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <button type="button" class="dropdown-item text-danger" onclick="confirmDelete({{ $contenu->id }})">
                                    <i class="fas fa-trash text-danger"></i> Supprimer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-chalkboard fa-4x text-muted mb-3"></i>
                <p class="text-muted">Aucun tutoriel trouvé</p>
                <a href="{{ route('back.formation.contenus.create', ['type' => 'tutoriel']) }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajouter un tutoriel
                </a>
            </div>
            @endforelse
        </div>
    </div>
    <div class="card-footer">
        @include('back.formation.partials.pagination', ['items' => $contenus])
    </div>
</div>

{{-- Modal de confirmation pour la suppression --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle"></i> Confirmation de suppression
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer ce tutoriel ?</p>
                <p class="text-danger mb-0">Cette action est irréversible et supprimera également le fichier associé.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Annuler
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="fas fa-trash"></i> Supprimer définitivement
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal pour masquer/afficher --}}
<div class="modal fade" id="visibilityModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="visibilityModalTitle">
                    <i class="fas fa-eye-slash"></i> Changer la visibilité
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="visibilityModalBody">
                <!-- Contenu dynamique -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Annuler
                </button>
                <button type="button" class="btn btn-primary" id="confirmVisibilityBtn">
                    <i class="fas fa-check"></i> Confirmer
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal pour l'aperçu vidéo --}}
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="videoModalTitle">
                    <i class="fas fa-video"></i> Aperçu vidéo
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="embed-responsive embed-responsive-16by9" id="videoModalContainer">
                    <!-- Contenu vidéo dynamique -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentContenuId = null;
    let currentAction = null;

    function toggleVisibility(id, show) {
        currentContenuId = id;
        currentAction = show ? 'show' : 'hide';

        const modalTitle = show ? 'Afficher le tutoriel' : 'Masquer le tutoriel';
        const modalMessage = show ?
            'Ce tutoriel sera visible par tous les utilisateurs. Confirmez-vous ?' :
            'Ce tutoriel ne sera plus visible par les utilisateurs. Confirmez-vous ?';
        const modalIcon = show ? 'fa-eye text-success' : 'fa-eye-slash text-warning';

        $('#visibilityModalTitle').html('<i class="fas ' + modalIcon + '"></i> ' + modalTitle);
        $('#visibilityModalBody').html('<p>' + modalMessage + '</p>');
        $('#visibilityModal').modal('show');
    }

    $('#confirmVisibilityBtn').on('click', function() {
        if (currentContenuId !== null) {
            $.ajax({
                url: '/back/formation/contenus/' + currentContenuId + '/toggle-visibility',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'PATCH'
                },
                success: function(response) {
                    if(response.success) {
                        $('#visibilityModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Succès !',
                            text: currentAction === 'show' ? 'Le tutoriel est maintenant visible.' : 'Le tutoriel a été masqué.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        setTimeout(() => { location.reload(); }, 2000);
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur est survenue. Veuillez réessayer.'
                    });
                }
            });
        }
    });

    function confirmDelete(id) {
        currentContenuId = id;
        $('#deleteModal').modal('show');
    }

    $('#confirmDeleteBtn').on('click', function() {
        if (currentContenuId !== null) {
            $.ajax({
                url: '/back/formation/contenus/' + currentContenuId,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Supprimé !',
                        text: 'Le tutoriel a été supprimé avec succès.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(() => { location.reload(); }, 2000);
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Impossible de supprimer ce tutoriel.'
                    });
                }
            });
        }
    });

    function showVideoPreview(url, title) {
        let embedUrl = url;

        // YouTube
        if (url.includes('youtube.com') || url.includes('youtu.be')) {
            const videoId = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
            if (videoId) {
                embedUrl = 'https://www.youtube.com/embed/' + videoId[1];
            }
        }
        // Vimeo
        else if (url.includes('vimeo.com')) {
            const videoId = url.match(/vimeo\.com\/(\d+)/);
            if (videoId) {
                embedUrl = 'https://player.vimeo.com/video/' + videoId[1];
            }
        }

        $('#videoModalTitle').html('<i class="fas fa-video"></i> ' + title);
        $('#videoModalContainer').html('<iframe class="embed-responsive-item" src="' + embedUrl + '" allowfullscreen></iframe>');
        $('#videoModal').modal('show');
    }
</script>
@endpush

@push('styles')
<style>
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .embed-responsive-16by9 {
        border-radius: 4px 4px 0 0;
        overflow: hidden;
    }
    .position-absolute.top-0.right-0 {
        top: 0;
        right: 0;
    }
    .dropdown-menu {
        min-width: 200px;
    }
    .dropdown-item i {
        width: 20px;
        margin-right: 8px;
    }
    .text-purple {
        color: #6f42c1;
    }
    .bg-purple {
        background-color: #6f42c1;
    }
    .badge-purple {
        background-color: #6f42c1;
        color: white;
    }
    .card-footer .dropdown-toggle {
        font-size: 0.75rem;
    }
</style>
@endpush
