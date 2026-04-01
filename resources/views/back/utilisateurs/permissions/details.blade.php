@extends('back.layouts.principal')

@section('title', 'Détails permission')
@section('page_title', 'Détails de la permission')
@section('page_subtitle', 'Vue complète de la permission et des rôles qui l’utilisent.')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
            <div>
                <h3 class="fw-bold mb-1">{{ $permission->nom }}</h3>
                <p class="text-muted mb-0">{{ $permission->description ?: 'Aucune description.' }}</p>
            </div>

            <a href="{{ route('back.permissions.modifier', $permission) }}" class="btn btn-warning rounded-pill px-4">Modifier</a>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">Slug</span>
                    <div class="fw-bold">{{ $permission->slug }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-tile">
                    <span class="text-muted small">Groupe</span>
                    <div class="fw-bold">{{ $permission->groupe ?: 'Sans groupe' }}</div>
                </div>
            </div>
        </div>

        <h5 class="fw-bold mb-3">Rôles liés</h5>
        <div class="vstack gap-3">
            @forelse($permission->roles as $role)
                <div class="linked-box">
                    <div class="fw-bold">{{ $role->nom }}</div>
                    <div class="text-muted small">{{ $role->slug }}</div>
                </div>
            @empty
                <div class="text-muted">Aucun rôle lié.</div>
            @endforelse
        </div>
    </div>

    <style>
        .info-tile{padding:18px;border-radius:18px;border:1px solid #e5e7eb;background:#f8fafc}
        .linked-box{padding:16px;border-radius:16px;border:1px solid #e5e7eb;background:#fff}
    </style>
@endsection
