@extends('back.layouts.principal')

@section('title', 'Permissions du rôle')
@section('page_title', 'Gestion des permissions du rôle')
@section('page_subtitle', 'Attribue, retire et supervise les permissions liées à ce rôle dans le hub.')

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $role->nom }}</h4>
                        <p class="text-muted mb-0">
                            {{ $role->description ?: 'Aucune description disponible pour ce rôle.' }}
                        </p>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('back.roles.details', $role) }}" class="btn btn-outline-dark rounded-pill px-4">
                            <i class="fa-solid fa-arrow-left me-2"></i>Retour au rôle
                        </a>
                    </div>
                </div>

                <form method="POST" action="{{ route('back.attributions.role.attribuer_permissions', $role) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="permissions" class="form-label fw-semibold">Sélectionner les permissions</label>
                        <select name="permissions[]" id="permissions" multiple
                                class="form-select rounded-4 @error('permissions') is-invalid @enderror"
                                size="12">
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}"
                                    @selected(old('permissions', $role->permissions->pluck('id')->toArray()) && in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())))>
                                    {{ $permission->nom }}
                                    @if($permission->groupe)
                                        — {{ $permission->groupe }}
                                    @endif
                                </option>
                            @endforeach
                        </select>

                        @error('permissions')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Mettre à jour les permissions
                        </button>

                        <a href="{{ route('back.permissions.toutes') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            Voir toutes les permissions
                        </a>
                    </div>
                </form>

                <hr class="my-4">

                <div>
                    <h5 class="fw-bold mb-3">Permissions actuellement attribuées</h5>

                    <div class="d-flex flex-wrap gap-2">
                        @forelse($role->permissions as $permission)
                            <div class="permission-chip">
                                <div>
                                    <div class="permission-name">{{ $permission->nom }}</div>
                                    <div class="permission-group">{{ $permission->groupe ?: 'Sans groupe' }}</div>
                                </div>

                                <form method="POST" action="{{ route('back.attributions.role.retirer_permission', [$role, $permission]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="permission-remove-btn" title="Retirer">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="text-muted">Aucune permission n’est encore attribuée à ce rôle.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card mb-4">
                <h5 class="fw-bold mb-3">Résumé du rôle</h5>

                <div class="vstack gap-3">
                    <div class="info-tile">
                        <span class="text-muted small">Nom</span>
                        <div class="fw-bold">{{ $role->nom }}</div>
                    </div>

                    <div class="info-tile">
                        <span class="text-muted small">Slug</span>
                        <div class="fw-bold">{{ $role->slug }}</div>
                    </div>

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

                    <div class="info-tile">
                        <span class="text-muted small">Nombre de permissions</span>
                        <div class="fw-bold">{{ $role->permissions->count() }}</div>
                    </div>
                </div>
            </div>

            <div class="content-card">
                <h5 class="fw-bold mb-3">Actions rapides</h5>

                <div class="d-grid gap-2">
                    <a href="{{ route('back.roles.details', $role) }}" class="btn btn-outline-dark rounded-pill">
                        Détails du rôle
                    </a>

                    <a href="{{ route('back.roles.modifier', $role) }}" class="btn btn-outline-warning rounded-pill">
                        Modifier le rôle
                    </a>

                    <a href="{{ route('back.permissions.toutes') }}" class="btn btn-outline-primary rounded-pill">
                        Liste des permissions
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .info-tile{
            padding:18px;
            border-radius:18px;
            border:1px solid #e5e7eb;
            background:#f8fafc;
        }

        .permission-chip{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:14px;
            padding:14px 16px;
            border:1px solid #e5e7eb;
            border-radius:18px;
            background:#ffffff;
            min-width:280px;
        }

        .permission-name{
            font-weight:700;
            color:#0f172a;
            line-height:1.2;
        }

        .permission-group{
            font-size:12px;
            color:#64748b;
            margin-top:4px;
        }

        .permission-remove-btn{
            width:34px;
            height:34px;
            border:none;
            border-radius:50%;
            background:#fef2f2;
            color:#dc2626;
            display:flex;
            align-items:center;
            justify-content:center;
            transition:.2s ease;
        }

        .permission-remove-btn:hover{
            background:#fee2e2;
        }
    </style>
@endsection
