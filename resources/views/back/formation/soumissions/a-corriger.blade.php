@extends('back.formation.layouts.app')

@section('title', 'Soumissions à corriger')
@section('page_title', 'Soumissions en attente de correction')
@section('page_subtitle', 'Liste des devoirs à corriger')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-check-double text-warning mr-2"></i>
            Soumissions à corriger
        </h3>
        <div class="card-tools">
            <span class="badge badge-warning badge-lg">{{ $soumissions->total() }} à corriger</span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 50px">#</th>
                        <th>Étudiant</th>
                        <th>Devoir</th>
                        <th>Cours</th>
                        <th>Soumis le</th>
                        <th>En retard</th>
                        <th style="width: 120px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($soumissions as $soumission)
                    <tr class="{{ $soumission->est_en_retard ? 'table-danger' : '' }}">
                        <td>{{ $soumission->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle mr-2" style="width: 35px; height: 35px; font-size: 14px;">
                                    {{ substr($soumission->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <strong>{{ $soumission->user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $soumission->user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong>{{ $soumission->devoir->titre }}</strong>
                            <br>
                            <small class="text-muted">{{ $soumission->devoir->type }}</small>
                        </td>
                        <td>
                            <a href="{{ route('back.formation.cours.show', $soumission->devoir->cour) }}" class="text-info">
                                {{ $soumission->devoir->cour->titre }}
                            </a>
                        </td>
                        <td>
                            {{ $soumission->soumis_le->format('d/m/Y H:i') }}
                            <br>
                            <small class="text-muted">il y a {{ $soumission->soumis_le->diffForHumans() }}</small>
                        </td>
                        <td>
                            @if($soumission->est_en_retard)
                                <span class="badge badge-danger">En retard</span>
                            @else
                                <span class="badge badge-success">À l'heure</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('back.formation.soumissions.show', $soumission) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                <a href="{{ route('back.formation.soumissions.show', $soumission) }}#correction" class="btn btn-sm btn-warning">
                                    <i class="fas fa-check-double"></i> Corriger
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-check-circle fa-3x text-success mb-3 d-block"></i>
                            <h5 class="text-success">Toutes les soumissions sont corrigées !</h5>
                            <p class="text-muted">Aucune soumission en attente de correction</p>
                            <a href="{{ route('back.formation.soumissions.index') }}" class="btn btn-primary mt-2">
                                <i class="fas fa-arrow-left"></i> Voir toutes les soumissions
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        @include('back.formation.partials.pagination', ['items' => $soumissions])
    </div>
</div>
@endsection