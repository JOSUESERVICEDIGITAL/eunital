@extends('back.layouts.principal')

@section('title', 'Détails utilisateur')
@section('page_title', 'Détails de l’utilisateur')
@section('page_subtitle', 'Consultation complète du profil, des rôles et de l’état du compte.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="user-detail-avatar">
                            @if($utilisateur->photo)
                                <img src="{{ asset('storage/' . $utilisateur->photo) }}" alt="{{ $utilisateur->name }}">
                            @else
                                <div class="user-detail-avatar-placeholder">
                                    {{ strtoupper(substr($utilisateur->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        <div>
                            <h3 class="fw-bold mb-1">{{ $utilisateur->name }}</h3>
                            <p class="text-muted mb-0">{{ $utilisateur->email }}</p>
                        </div>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('back.utilisateurs.modifier', $utilisateur) }}" class="btn btn-warning rounded-pill px-4">
                            <i class="fa-solid fa-pen me-2"></i>Modifier
                        </a>

                        <a href="{{ route('back.attributions.utilisateur.roles', $utilisateur) }}" class="btn btn-outline-dark rounded-pill px-4">
                            <i class="fa-solid fa-user-gear me-2"></i>Gérer les rôles
                        </a>
                    </div>
                </div>

                @if($utilisateur->bio)
                    <div class="profile-bio-box mb-4">
                        {!! nl2br(e($utilisateur->bio)) !!}
                    </div>
                @endif

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-tile">
                            <span class="text-muted small">Téléphone</span>
                            <div class="fw-bold">{{ $utilisateur->telephone ?: 'Non renseigné' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-tile">
                            <span class="text-muted small">Dernier accès</span>
                            <div class="fw-bold">{{ $utilisateur->dernier_acces ? $utilisateur->dernier_acces->format('d/m/Y H:i') : 'Jamais' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-tile">
                            <span class="text-muted small">Statut du compte</span>
                            <div class="fw-bold">
                                @if($utilisateur->statut_compte === 'actif')
                                    <span class="badge rounded-pill text-bg-success">Actif</span>
                                @elseif($utilisateur->statut_compte === 'inactif')
                                    <span class="badge rounded-pill text-bg-warning">Inactif</span>
                                @else
                                    <span class="badge rounded-pill text-bg-danger">Suspendu</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-tile">
                            <span class="text-muted small">Activation</span>
                            <div class="fw-bold">
                                @if($utilisateur->est_actif)
                                    <span class="badge rounded-pill text-bg-primary">Activé</span>
                                @else
                                    <span class="badge rounded-pill text-bg-secondary">Désactivé</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="info-tile">
                            <span class="text-muted small">Rôles</span>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                @forelse($utilisateur->roles as $role)
                                    <span class="badge rounded-pill text-bg-light border">{{ $role->nom }}</span>
                                @empty
                                    <span class="text-muted">Aucun rôle attribué.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card mb-4">
                <h5 class="fw-bold mb-3">Actions rapides</h5>
                <div class="d-grid gap-2">
                    @if(!$utilisateur->est_actif)
                        <form method="POST" action="{{ route('back.utilisateurs.activer', $utilisateur) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-success rounded-pill">Activer le compte</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('back.utilisateurs.desactiver', $utilisateur) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-secondary rounded-pill">Désactiver le compte</button>
                        </form>
                    @endif

                    @if($utilisateur->statut_compte !== 'suspendu')
                        <form method="POST" action="{{ route('back.utilisateurs.suspendre', $utilisateur) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-danger rounded-pill">Suspendre</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('back.utilisateurs.retablir', $utilisateur) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-success rounded-pill">Rétablir</button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="content-card">
                <h5 class="fw-bold mb-3">Navigation rapide</h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('back.utilisateurs.tous') }}" class="btn btn-outline-dark rounded-pill">Tous les utilisateurs</a>
                    <a href="{{ route('back.utilisateurs.administrateurs') }}" class="btn btn-outline-primary rounded-pill">Administrateurs</a>
                    <a href="{{ route('back.utilisateurs.auteurs') }}" class="btn btn-outline-info rounded-pill">Auteurs</a>
                    <a href="{{ route('back.utilisateurs.responsables') }}" class="btn btn-outline-warning rounded-pill">Responsables</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .info-tile{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc}
        .profile-bio-box{padding:22px;border-radius:20px;background:#f8fafc;border:1px solid #e5e7eb;line-height:1.8;color:#334155}
        .user-detail-avatar{width:78px;height:78px;border-radius:22px;overflow:hidden;border:1px solid #e5e7eb;background:#f8fafc}
        .user-detail-avatar img{width:100%;height:100%;object-fit:cover}
        .user-detail-avatar-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:24px;color:#475569;background:#eef2ff}
    </style>
@endsection
