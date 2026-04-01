@extends('back.formation.layouts.app')

@section('title', 'Soumissions corrigées')
@section('page_title', 'Soumissions corrigées')
@section('page_subtitle', 'Historique des corrections')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-check-circle text-success mr-2"></i>
            Soumissions corrigées
        </h3>
        <div class="card-tools">
            <span class="badge badge-success badge-lg">{{ $soumissions->total() }} corrigées</span>
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
                        <th>Note</th>
                        <th>Corrigé le</th>
                        <th>Commentaire</th>
                        <th style="width: 100px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($soumissions as $soumission)
                    <tr>
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
                            <span class="badge badge-{{ $soumission->note >= ($soumission->devoir->note_maximale * 0.6) ? 'success' : 'warning' }} badge-lg">
                                {{ $soumission->note }}/{{ $soumission->devoir->note_maximale }}
                            </span>
                            <br>
                            <small class="text-muted">{{ round($soumission->note_sur_20, 1) }}/20</small>
                        </td>
                        <td>
                            {{ $soumission->note_le->format('d/m/Y H:i') }}
                            <br>
                            <small class="text-muted">il y a {{ $soumission->note_le->diffForHumans() }}</small>
                        </td>
                        <td>
                            @if($soumission->commentaire_enseignant)
                                <span class="text-muted" title="{{ $soumission->commentaire_enseignant }}">
                                    {{ Str::limit($soumission->commentaire_enseignant, 30) }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('back.formation.soumissions.show', $soumission) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3 d-block"></i>
                            Aucune soumission corrigée trouvée
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