@extends('back.formation.layouts.app')

@section('title', $salle->titre)
@section('page_title', $salle->titre)
@section('page_subtitle', 'Grande salle pédagogique centrale')

@section('formation-content')
@php
    $p = $salle->parametres ?? [];
@endphp

<div class="card shadow-sm border-0 overflow-hidden mb-4">
    <div class="position-relative">
        @if($salle->image_couverture)
            <div style="height: 240px; background: url('{{ asset('storage/' . $salle->image_couverture) }}') center/cover no-repeat;"></div>
        @else
            <div class="bg-gradient-primary d-flex align-items-center justify-content-center text-white" style="height: 240px; background: linear-gradient(135deg, #0d6efd, #343a40);">
                <div class="text-center">
                    <i class="fas fa-school fa-4x mb-3"></i>
                    <h3 class="mb-0">{{ $salle->titre }}</h3>
                </div>
            </div>
        @endif

        <div class="position-absolute" style="top: 20px; right: 20px;">
            <span class="badge badge-{{ $salle->statut_class }} px-3 py-2 shadow-sm">
                {{ $salle->statut_label }}
            </span>
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
            <div class="mb-3 mb-lg-0">
                <h2 class="font-weight-bold mb-1">{{ $salle->titre }}</h2>
                <div class="text-muted mb-2">
                    {{ $salle->description ?: 'Aucune description fournie pour cette salle.' }}
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <span class="badge badge-info px-3 py-2">
                        <i class="fas fa-layer-group mr-1"></i>
                        {{ $salle->module->titre ?? 'Aucun module' }}
                    </span>

                    <span class="badge badge-primary px-3 py-2">
                        <i class="fas fa-book mr-1"></i>
                        {{ $salle->cour->titre ?? 'Aucun cours' }}
                    </span>

                    <span class="badge badge-dark px-3 py-2">
                        <i class="fas fa-tv mr-1"></i>
                        {{ ucfirst($salle->type_salle) }}
                    </span>
                </div>
            </div>

<div class="card mt-3">
    <div class="card-header">
        <h5><i class="fas fa-users"></i> Connectés ({{ $salle->accesSalle->nb_utilisateurs_actifs }})</h5>
    </div>
    <div class="card-body">
        @foreach($salle->accesSalle->utilisateursConnectes() as $user)
            <span class="badge badge-success m-1">
                <i class="fas fa-user-circle"></i> {{ $user->name }}
            </span>
        @endforeach
    </div>
</div>


            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('back.formation.salles.edit', $salle) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit mr-1"></i> Modifier
                </a>

                @if(!$salle->is_open && $salle->is_active)
                    <form action="{{ route('back.formation.salles.ouvrir', $salle) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-unlock mr-1"></i> Ouvrir
                        </button>
                    </form>
                @endif

                @if($salle->is_open)
                    <form action="{{ route('back.formation.salles.fermer', $salle) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-secondary btn-sm">
                            <i class="fas fa-lock mr-1"></i> Fermer
                        </button>
                    </form>
                @endif

                <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#quickToolsModal">
                    <i class="fas fa-bolt mr-1"></i> Outils
                </button>

                <a href="{{ route('back.formation.salles.index') }}" class="btn btn-light btn-sm border">
                    <i class="fas fa-arrow-left mr-1"></i> Retour
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Colonne gauche --}}
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-header bg-white border-0">
                <h3 class="card-title mb-0">
                    <i class="fas fa-key mr-2 text-dark"></i>
                    Accès à la salle
                </h3>
            </div>

            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-5">Code</dt>
                    <dd class="col-sm-7">
                        @if($salle->accesSalle)
                            <button type="button" class="btn btn-light btn-sm border text-monospace"
                                    onclick="copyToClipboard('{{ $salle->accesSalle->code_acces }}')">
                                {{ $salle->accesSalle->code_acces }}
                                <i class="fas fa-copy ml-2"></i>
                            </button>
                        @else
                            <span class="text-muted">Aucun code lié</span>
                        @endif
                    </dd>

                    <dt class="col-sm-5">Slug</dt>
                    <dd class="col-sm-7">{{ $salle->slug }}</dd>

                    <dt class="col-sm-5">Créée par</dt>
                    <dd class="col-sm-7">{{ $salle->createur->name ?? 'N/A' }}</dd>

                    <dt class="col-sm-5">État</dt>
                    <dd class="col-sm-7">
                        <span class="badge badge-{{ $salle->statut_class }}">{{ $salle->statut_label }}</span>
                    </dd>
                </dl>

                <hr>

                <div class="row text-center">
                    <div class="col-6 mb-2">
                        <button type="button" class="btn btn-outline-dark btn-block" data-toggle="modal" data-target="#qrModal">
                            <i class="fas fa-qrcode d-block mb-1"></i> QR code
                        </button>
                    </div>

                    <div class="col-6 mb-2">
                        <a href="{{ route('back.formation.salles.acceder-form') }}" class="btn btn-outline-primary btn-block">
                            <i class="fas fa-door-open d-block mb-1"></i> Entrer
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-header bg-white border-0">
                <h3 class="card-title mb-0">
                    <i class="fas fa-sliders-h mr-2 text-primary"></i>
                    Modules actifs de la salle
                </h3>
            </div>

            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        Chat
                        <span class="badge badge-{{ !empty($p['chat_active']) ? 'success' : 'secondary' }}">
                            {{ !empty($p['chat_active']) ? 'Actif' : 'Off' }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Documents
                        <span class="badge badge-{{ !empty($p['documents_visibles']) ? 'success' : 'secondary' }}">
                            {{ !empty($p['documents_visibles']) ? 'Visible' : 'Masqué' }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Vidéos
                        <span class="badge badge-{{ !empty($p['videos_visibles']) ? 'success' : 'secondary' }}">
                            {{ !empty($p['videos_visibles']) ? 'Visible' : 'Masqué' }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Devoirs
                        <span class="badge badge-{{ !empty($p['devoirs_visibles']) ? 'success' : 'secondary' }}">
                            {{ !empty($p['devoirs_visibles']) ? 'Visible' : 'Masqué' }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Tutoriels
                        <span class="badge badge-{{ !empty($p['tutoriels_visibles']) ? 'success' : 'secondary' }}">
                            {{ !empty($p['tutoriels_visibles']) ? 'Visible' : 'Masqué' }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Téléchargement
                        <span class="badge badge-{{ !empty($p['telechargement_autorise']) ? 'success' : 'secondary' }}">
                            {{ !empty($p['telechargement_autorise']) ? 'Autorisé' : 'Bloqué' }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Colonne droite --}}
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-header bg-white border-0">
                <h3 class="card-title mb-0">
                    <i class="fas fa-th-large mr-2 text-primary"></i>
                    Hub central de navigation
                </h3>
            </div>

            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 col-6 mb-3">
                        <a href="{{ $salle->cour ? route('back.formation.cours.show', $salle->cour) : '#' }}"
                           class="btn btn-outline-info btn-block {{ !$salle->cour ? 'disabled' : '' }}">
                            <i class="fas fa-book d-block mb-2"></i>
                            Cours
                        </a>
                    </div>

                    <div class="col-md-3 col-6 mb-3">
                        <a href="{{ route('back.formation.devoirs.index') }}?cour_id={{ $salle->cour_id }}"
                           class="btn btn-outline-warning btn-block">
                            <i class="fas fa-tasks d-block mb-2"></i>
                            Devoirs
                        </a>
                    </div>

                    <div class="col-md-3 col-6 mb-3">
                        <a href="{{ route('back.formation.contenus.videos') }}?cour_id={{ $salle->cour_id }}"
                           class="btn btn-outline-danger btn-block">
                            <i class="fas fa-video d-block mb-2"></i>
                            Vidéos
                        </a>
                    </div>

                    <div class="col-md-3 col-6 mb-3">
                        <a href="{{ route('back.formation.contenus.tutoriels') }}?cour_id={{ $salle->cour_id }}"
                           class="btn btn-outline-primary btn-block">
                            <i class="fas fa-chalkboard-user d-block mb-2"></i>
                            Tutoriels
                        </a>
                    </div>

                    <div class="col-md-3 col-6 mb-3">
                        <a href="{{ route('back.formation.contenus.documents') }}?cour_id={{ $salle->cour_id }}"
                           class="btn btn-outline-secondary btn-block">
                            <i class="fas fa-file-alt d-block mb-2"></i>
                            Documents
                        </a>
                    </div>

                    <div class="col-md-3 col-6 mb-3">
                        <a href="{{ route('back.formation.presences.index') }}?cour_id={{ $salle->cour_id }}"
                           class="btn btn-outline-success btn-block">
                            <i class="fas fa-user-check d-block mb-2"></i>
                            Présences
                        </a>
                    </div>

                    <div class="col-md-3 col-6 mb-3">
                        <a href="{{ route('back.formation.acces-salles.index') }}?cour_id={{ $salle->cour_id }}"
                           class="btn btn-outline-dark btn-block">
                            <i class="fas fa-door-open d-block mb-2"></i>
                            Accès
                        </a>
                    </div>

                    <div class="col-md-3 col-6 mb-3">
                        <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#quickToolsModal">
                            <i class="fas fa-bolt d-block mb-2"></i>
                            Popups
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    <i class="fas fa-compass mr-2 text-dark"></i>
                    Vue premium de la grande salle
                </h3>

                <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#orientationModal">
                    <i class="fas fa-map-signs mr-1"></i> Orientation
                </button>
            </div>

            <div class="card-body">
                <div class="alert alert-light border">
                    Cette salle sert de point d’entrée unique vers les cours, devoirs, vidéos, tutoriels, documents,
                    présences et accès. Elle est pensée comme un cockpit pédagogique complet.
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card border shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="font-weight-bold">
                                    <i class="fas fa-route mr-2 text-primary"></i>
                                    Navigation fluide
                                </h5>
                                <p class="text-muted small mb-0">
                                    Les boutons rapides et modals servent à faire circuler l’utilisateur entre
                                    les sections principales sans casser le flux.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="card border shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="font-weight-bold">
                                    <i class="fas fa-layer-group mr-2 text-success"></i>
                                    Regroupement central
                                </h5>
                                <p class="text-muted small mb-0">
                                    Cette salle pourra ensuite afficher directement les widgets de cours, devoirs,
                                    vidéos, docs et tutoriels.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="card border shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="font-weight-bold">
                                    <i class="fas fa-qrcode mr-2 text-dark"></i>
                                    Accès QR / code
                                </h5>
                                <p class="text-muted small mb-0">
                                    L’accès peut être ouvert par QR code ou par code d’accès lié à la salle.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="card border shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="font-weight-bold">
                                    <i class="fas fa-magic mr-2 text-warning"></i>
                                    Expérience enrichie
                                </h5>
                                <p class="text-muted small mb-0">
                                    On pourra encore ajouter chat, annonces, notifications, timeline et barre
                                    de progression de salle.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal QR --}}
<div class="modal fade" id="qrModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">
                    <i class="fas fa-qrcode mr-2"></i> QR Code de la salle
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p class="font-weight-bold mb-2">{{ $salle->titre }}</p>
                <p class="small text-muted">
                    Code : {{ $salle->accesSalle->code_acces ?? 'Aucun code' }}
                </p>

                <div class="border rounded p-4 bg-light">
                    <i class="fas fa-qrcode fa-6x text-dark"></i>
                    <div class="small text-muted mt-2">
                        Remplace ensuite ce bloc par un vrai QR code généré.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal outils --}}
<div class="modal fade" id="quickToolsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-bolt mr-2"></i> Outils rapides de la salle
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body text-center">
                <a href="{{ route('back.formation.devoirs.create') }}" class="btn btn-warning m-1">
                    <i class="fas fa-plus mr-1"></i> Devoir
                </a>
                <a href="{{ route('back.formation.contenus.create', ['type' => 'video']) }}" class="btn btn-danger m-1">
                    <i class="fas fa-video mr-1"></i> Vidéo
                </a>
                <a href="{{ route('back.formation.contenus.create', ['type' => 'document']) }}" class="btn btn-secondary m-1">
                    <i class="fas fa-file-alt mr-1"></i> Document
                </a>
                <a href="{{ route('back.formation.presences.create') }}" class="btn btn-success m-1">
                    <i class="fas fa-user-check mr-1"></i> Présence
                </a>
                <a href="{{ route('back.formation.acces-salles.create') }}" class="btn btn-dark m-1">
                    <i class="fas fa-key mr-1"></i> Code d’accès
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Modal orientation --}}
<div class="modal fade" id="orientationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-map-signs mr-2"></i> Orientation rapide
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <ul class="mb-0">
                    <li>Va dans <strong>Cours</strong> pour le contenu central.</li>
                    <li>Va dans <strong>Devoirs</strong> pour les dépôts et corrections.</li>
                    <li>Va dans <strong>Vidéos</strong> pour les contenus visuels.</li>
                    <li>Va dans <strong>Tutoriels</strong> pour les reproductions guidées.</li>
                    <li>Va dans <strong>Documents</strong> pour les supports téléchargeables.</li>
                    <li>Va dans <strong>Présences</strong> pour le suivi de participation.</li>
                    <li>Va dans <strong>Accès</strong> pour gérer les codes et QR.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script></script>
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text);
        Swal.fire({
            icon: 'success',
            title: 'Copié !',
            text: 'Le code a été copié dans le presse-papier',
            timer: 1800,
            showConfirmButton: false
        });
    }
</script>
@endpush
