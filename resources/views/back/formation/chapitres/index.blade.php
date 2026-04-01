@extends('back.formation.layouts.app')

@section('title', 'Chapitres')
@section('page_title', 'Gestion des chapitres')
@section('page_subtitle', 'Liste et organisation des chapitres par cours')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-layer-group mr-2"></i>
            Tous les chapitres
        </h3>
        <div class="card-tools">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                <a href="{{ route('back.formation.chapitres.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Nouveau chapitre
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 50px">#</th>
                        <th>Titre</th>
                        <th>Cours</th>
                        <th>Ordre</th>
                        <th style="width: 80px">Contenus</th>
                        <th style="width: 100px">Durée</th>
                        <th style="width: 80px">Gratuit</th>
                        <th style="width: 120px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($chapitres as $chapitre)
                    <tr>
                        <td>{{ $chapitre->id }}</td>
                        <td>
                            <strong>{{ $chapitre->titre }}</strong>
                            <br>
                            <small class="text-muted">{{ Str::limit($chapitre->description, 50) }}</small>
                        </td>
                        <td>
                            <a href="{{ route('back.formation.cours.show', $chapitre->cour) }}" class="text-info">
                                {{ $chapitre->cour->titre }}
                            </a>
                        </td>
                        <td>
                            <span class="badge badge-secondary">Chapitre {{ $chapitre->ordre + 1 }}</span>
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $chapitre->contenus_count }}</span>
                        </td>
                        <td>
                            @if($chapitre->duree_estimee)
                                <i class="fas fa-clock"></i> {{ $chapitre->duree_estimee }} min
                            @else
                                <span class="text-muted">Non défini</span>
                            @endif
                        </td>
                        <td>
                            @if($chapitre->is_free)
                                <span class="badge badge-success">Gratuit</span>
                            @else
                                <span class="badge badge-secondary">Payant</span>
                            @endif
                        </td>
                        <td>
                            @include('back.formation.partials.table-actions', [
                                'showRoute' => route('back.formation.chapitres.show', $chapitre),
                                'editRoute' => route('back.formation.chapitres.edit', $chapitre),
                                'deleteRoute' => route('back.formation.chapitres.destroy', $chapitre)
                            ])
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-layer-group fa-3x text-muted mb-3 d-block"></i>
                            Aucun chapitre trouvé
                            <br>
                            <a href="{{ route('back.formation.chapitres.create') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-plus"></i> Créer le premier chapitre
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                Affichage de {{ $chapitres->firstItem() ?? 0 }} à {{ $chapitres->lastItem() ?? 0 }} sur {{ $chapitres->total() }} chapitres
            </div>
            @include('back.formation.partials.pagination', ['items' => $chapitres])
        </div>
    </div>
</div>

<!-- Modal de filtres -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="GET" action="{{ route('back.formation.chapitres.index') }}">
                <div class="modal-header">
                    <h5 class="modal-title">Filtrer les chapitres</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Cours</label>
                        <select name="cour_id" class="form-control">
                            <option value="">Tous les cours</option>
                            @foreach($cours ?? [] as $cour)
                            <option value="{{ $cour->id }}" {{ request('cour_id') == $cour->id ? 'selected' : '' }}>
                                {{ $cour->titre }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gratuit</label>
                        <select name="is_free" class="form-control">
                            <option value="">Tous</option>
                            <option value="1" {{ request('is_free') == '1' ? 'selected' : '' }}>Gratuit</option>
                            <option value="0" {{ request('is_free') == '0' ? 'selected' : '' }}>Payant</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('back.formation.chapitres.index') }}" class="btn btn-secondary">Réinitialiser</a>
                    <button type="submit" class="btn btn-primary">Appliquer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection