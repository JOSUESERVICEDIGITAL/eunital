@extends('back.layouts.principal')

@section('title', 'Détails rôle')
@section('page_title', 'Détails du rôle')
@section('page_subtitle', 'Vue complète du rôle, de ses permissions et des utilisateurs liés.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">{{ $role->nom }}</h3>
                        <p class="text-muted mb-0">{{ $role->description ?: 'Aucune description.' }}</p>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('back.roles.modifier', $role) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
                        <a href="{{ route('back.attributions.role.permissions', $role) }}" class="btn btn-outline-dark rounded-pill px-4">Gérer les permissions</a>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-tile">
                            <span class="text-muted small">Slug</span>
                            <div class="fw-bold">{{ $role->slug }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-tile">
                            <span class="text-muted small">Statut</span>
                            <div class="fw-bold">
                                @if($role->est_actif)
                                    <span class="badge rounded-pill text-bg-success">Actif</span>
                                @else
                                    <span class="badge rounded-pill text-bg-danger">Inactif</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="fw-bold mb-3">Permissions</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @forelse($role->permissions as $permission)
                            <span class="badge rounded-pill text-bg-info">{{ $permission->nom }}</span>
                        @empty
                            <span class="text-muted">Aucune permission.</span>
                        @endforelse
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="fw-bold mb-3">Utilisateurs liés</h5>
                    <div class="vstack gap-3">
                        @forelse($role->utilisateurs as $utilisateur)
                            <div class="linked-box">
                                <div class="fw-bold">{{ $utilisateur->name }}</div>
                                <div class="text-muted small">{{ $utilisateur->email }}</div>
                            </div>
                        @empty
                            <div class="text-muted">Aucun utilisateur lié.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .info-tile{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc}
        .linked-box{padding:16px;border-radius:16px;border:1px solid #e5e7eb;background:#fff}
    </style>
@endsection
