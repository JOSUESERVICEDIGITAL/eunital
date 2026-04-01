@extends('back.formation.layouts.app')

@section('title', 'Commentaires')
@section('page_title', 'Gestion des commentaires')
@section('page_subtitle', 'Modération et suivi des commentaires des cours')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-comments mr-2"></i>
            Tous les commentaires
        </h3>
        <div class="card-tools">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                <a href="{{ route('back.formation.commentaires.en-attente') }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-clock"></i> En attente
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    肇
                        <th style="width: 50px">#</th>
                        <th>Auteur</th>
                        <th>Commentaire</th>
                        <th>Cours</th>
                        <th>Date</th>
                        <th>Réponses</th>
                        <th>Likes</th>
                        <th>Statut</th>
                        <th style="width: 120px">Actions</th>
                    </thead>
                <tbody>
                    @forelse($commentaires as $commentaire)
                     <tr>
                         <td>{{ $commentaire->id }}</td>
                         <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle mr-2" style="width: 35px; height: 35px; font-size: 14px;">
                                    {{ substr($commentaire->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <strong>{{ $commentaire->user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $commentaire->user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong>{{ Str::limit($commentaire->contenu, 100) }}</strong>
                            <br>
                            <small class="text-muted">sur: {{ $commentaire->cour->titre }}</small>
                        </td>
                        <td>
                            <a href="{{ route('back.formation.cours.show', $commentaire->cour) }}" class="text-info">
                                {{ Str::limit($commentaire->cour->titre, 30) }}
                            </a>
                        </td>
                        <td>
                            {{ $commentaire->created_at->format('d/m/Y H:i') }}
                            <br>
                            <small class="text-muted">il y a {{ $commentaire->created_at->diffForHumans() }}</small>
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $commentaire->reponses_count }}</span>
                        </td>
                        <td>
                            <span class="badge badge-primary">{{ $commentaire->likes }} <i class="fas fa-thumbs-up"></i></span>
                        </td>
                        <td>
                            @if($commentaire->is_approved)
                                <span class="badge badge-success">Approuvé</span>
                            @else
                                <span class="badge badge-warning">En attente</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('back.formation.commentaires.show', $commentaire) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(!$commentaire->is_approved)
                                    <button type="button" class="btn btn-sm btn-success" onclick="approuverCommentaire({{ $commentaire->id }})">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                @endif
                                <a href="{{ route('back.formation.commentaires.edit', $commentaire) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('back.formation.commentaires.destroy', $commentaire) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">
                            <i class="fas fa-comments fa-3x text-muted mb-3 d-block"></i>
                            Aucun commentaire trouvé
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
                Affichage de {{ $commentaires->firstItem() ?? 0 }} à {{ $commentaires->lastItem() ?? 0 }} sur {{ $commentaires->total() }} commentaires
            </div>
            @include('back.formation.partials.pagination', ['items' => $commentaires])
        </div>
    </div>
</div>

<!-- Modal de filtres -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="GET" action="{{ route('back.formation.commentaires.index') }}">
                <div class="modal-header">
                    <h5 class="modal-title">Filtrer les commentaires</h5>
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
                        <label>Auteur</label>
                        <select name="user_id" class="form-control">
                            <option value="">Tous les auteurs</option>
                            @foreach($utilisateurs ?? [] as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Statut</label>
                        <select name="statut" class="form-control">
                            <option value="">Tous</option>
                            <option value="approuve" {{ request('statut') == 'approuve' ? 'selected' : '' }}>Approuvé</option>
                            <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('back.formation.commentaires.index') }}" class="btn btn-secondary">Réinitialiser</a>
                    <button type="submit" class="btn btn-primary">Appliquer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function approuverCommentaire(id) {
        Swal.fire({
            title: 'Approuver le commentaire',
            text: 'Ce commentaire sera visible par tous les utilisateurs.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, approuver',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/commentaires/' + id + '/approuver',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire('Approuvé!', 'Le commentaire a été approuvé', 'success');
                            location.reload();
                        }
                    }
                });
            }
        });
    }
</script>
@endpush