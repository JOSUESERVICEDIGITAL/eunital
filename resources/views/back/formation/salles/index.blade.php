@extends('back.formation.layouts.app')

@section('title', 'Salles')
@section('page_title', 'Gestion des salles')
@section('page_subtitle', 'Créer, ouvrir, fermer et piloter les salles pédagogiques')

@section('formation-content')
<div class="row mb-3">
    <div class="col-md-3 col-6">
        <div class="small-box bg-primary shadow-sm">
            <div class="inner">
                <h3>{{ $stats['total'] ?? 0 }}</h3>
                <p>Total salles</p>
            </div>
            <div class="icon"><i class="fas fa-door-open"></i></div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="small-box bg-success shadow-sm">
            <div class="inner">
                <h3>{{ $stats['ouvertes'] ?? 0 }}</h3>
                <p>Ouvertes</p>
            </div>
            <div class="icon"><i class="fas fa-unlock"></i></div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="small-box bg-warning shadow-sm">
            <div class="inner">
                <h3>{{ $stats['fermees'] ?? 0 }}</h3>
                <p>Fermées</p>
            </div>
            <div class="icon"><i class="fas fa-lock"></i></div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="small-box bg-secondary shadow-sm">
            <div class="inner">
                <h3>{{ $stats['inactives'] ?? 0 }}</h3>
                <p>Inactives</p>
            </div>
            <div class="icon"><i class="fas fa-ban"></i></div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h3 class="card-title mb-1">
                <i class="fas fa-school mr-2 text-primary"></i>
                Toutes les salles
            </h3>
            <small class="text-muted">Espaces centraux contenant cours, devoirs, vidéos, tutoriels et fichiers</small>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('back.formation.salles.acceder-form') }}" class="btn btn-outline-dark btn-sm">
                <i class="fas fa-key mr-1"></i> Accéder par code
            </a>

            <a href="{{ route('back.formation.salles.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus mr-1"></i> Nouvelle salle
            </a>
        </div>
    </div>

    

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>Salle</th>
                        <th>Cours / Module</th>
                        <th>Code d’accès</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th>Créée par</th>
                        <th style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($salles as $salle)
                        <tr>
                            <td>#{{ $salle->id }}</td>

                            <td>
                                <div class="font-weight-bold">{{ $salle->titre }}</div>
                                <small class="text-muted">{{ $salle->slug }}</small>
                            </td>

                            <td>
                                <div>{{ $salle->cour->titre ?? 'Aucun cours' }}</div>
                                <small class="text-muted">{{ $salle->module->titre ?? 'Aucun module' }}</small>
                            </td>

                            <td>
                                @if($salle->accesSalle)
                                    <code>{{ $salle->accesSalle->code_acces }}</code>
                                @else
                                    <span class="text-muted">Aucun</span>
                                @endif
                            </td>

                            <td>
                                <span class="badge badge-info">{{ ucfirst($salle->type_salle) }}</span>
                            </td>

                            <td>
                                <span class="badge badge-{{ $salle->statut_class }}">
                                    {{ $salle->statut_label }}
                                </span>
                            </td>

                            <td>
                                {{ $salle->createur->name ?? 'N/A' }}
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-circle border" type="button" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                                        <a class="dropdown-item" href="{{ route('back.formation.salles.show', $salle) }}">
                                            <i class="fas fa-eye text-info mr-2"></i> Voir
                                        </a>

                                        <a class="dropdown-item" href="{{ route('back.formation.salles.edit', $salle) }}">
                                            <i class="fas fa-edit text-warning mr-2"></i> Modifier
                                        </a>

                                        @if(!$salle->is_open && $salle->is_active)
                                            <form action="{{ route('back.formation.salles.ouvrir', $salle) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="dropdown-item text-success">
                                                    <i class="fas fa-unlock mr-2"></i> Ouvrir
                                                </button>
                                            </form>
                                        @endif

                                        @if($salle->is_open)
                                            <form action="{{ route('back.formation.salles.fermer', $salle) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="dropdown-item text-secondary">
                                                    <i class="fas fa-lock mr-2"></i> Fermer
                                                </button>
                                            </form>
                                        @endif

                                        @if(!$salle->is_active)
                                            <form action="{{ route('back.formation.salles.activer', $salle) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="dropdown-item text-success">
                                                    <i class="fas fa-check-circle mr-2"></i> Activer
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('back.formation.salles.desactiver', $salle) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="dropdown-item text-warning">
                                                    <i class="fas fa-ban mr-2"></i> Désactiver
                                                </button>
                                            </form>
                                        @endif

                                        <div class="dropdown-divider"></div>

                                        <form action="{{ route('back.formation.salles.destroy', $salle) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-trash mr-2"></i> Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="fas fa-school fa-3x text-muted mb-3 d-block"></i>
                                <div class="font-weight-bold">Aucune salle trouvée</div>
                                <div class="text-muted mb-3">Crée ta première grande salle pédagogique.</div>
                                <a href="{{ route('back.formation.salles.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus mr-1"></i> Créer une salle
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer">
        @include('back.formation.partials.pagination', ['items' => $salles])
    </div>
</div>
@endsection
