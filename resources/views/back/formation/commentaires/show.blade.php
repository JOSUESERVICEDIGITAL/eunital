@extends('back.formation.layouts.app')

@section('title', 'Détails du commentaire')
@section('page_title', 'Commentaire de ' . $commentaireCours->user->name)
@section('page_subtitle', $commentaireCours->cour->titre)

@section('formation-content')
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-comment mr-2"></i>
                    Commentaire original
                </h3>
            </div>
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="avatar-circle mr-3" style="width: 50px; height: 50px; font-size: 20px;">
                        {{ substr($commentaireCours->user->name, 0, 1) }}
                    </div>
                    <div>
                        <h5 class="mb-0">{{ $commentaireCours->user->name }}</h5>
                        <small class="text-muted">
                            <i class="fas fa-calendar-alt"></i> {{ $commentaireCours->created_at->format('d/m/Y H:i') }}
                            <br>
                            <i class="fas fa-book"></i> Cours: {{ $commentaireCours->cour->titre }}
                        </small>
                    </div>
                    <div class="ml-auto">
                        @if($commentaireCours->is_approved)
                            <span class="badge badge-success">Approuvé</span>
                        @else
                            <span class="badge badge-warning">En attente</span>
                        @endif
                    </div>
                </div>
                <div class="well well-sm bg-light p-3 rounded">
                    <p class="mb-0">{{ $commentaireCours->contenu }}</p>
                </div>
                <div class="mt-3">
                    <span class="text-muted">
                        <i class="fas fa-thumbs-up"></i> {{ $commentaireCours->likes }} personnes ont aimé ce commentaire
                    </span>
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-group">
                    @if(!$commentaireCours->is_approved)
                        <button type="button" class="btn btn-success" onclick="approuverCommentaire({{ $commentaireCours->id }})">
                            <i class="fas fa-check-circle"></i> Approuver
                        </button>
                    @endif
                    <a href="{{ route('back.formation.commentaires.edit', $commentaireCours) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <form action="{{ route('back.formation.commentaires.destroy', $commentaireCours) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn">
                            <i class="fas fa-trash"></i> Supprimer
                        </button>
                    </form>
                    <a href="{{ route('back.formation.commentaires.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-reply-all mr-2"></i>
                    Réponses ({{ $commentaireCours->reponses->count() }})
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#repondreModal">
                        <i class="fas fa-reply"></i> Répondre
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                @if($commentaireCours->reponses->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($commentaireCours->reponses as $reponse)
                        <div class="list-group-item">
                            <div class="d-flex">
                                <div class="avatar-circle mr-2" style="width: 35px; height: 35px; font-size: 14px;">
                                    {{ substr($reponse->user->name, 0, 1) }}
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ $reponse->user->name }}</strong>
                                        <small class="text-muted">{{ $reponse->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                    <p class="mb-0 mt-1">{{ $reponse->contenu }}</p>
                                    <div class="mt-1">
                                        <span class="text-muted small">
                                            <i class="fas fa-thumbs-up"></i> {{ $reponse->likes }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-2">
                                    <div class="btn-group">
                                        <a href="{{ route('back.formation.commentaires.edit', $reponse) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('back.formation.commentaires.destroy', $reponse) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-comment-dots fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Aucune réponse pour le moment</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                    Statistiques
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-7">Nombre de réponses</dt>
                    <dd class="col-sm-5">{{ $commentaireCours->reponses->count() }}</dd>
                    
                    <dt class="col-sm-7">Nombre de likes</dt>
                    <dd class="col-sm-5">{{ $commentaireCours->likes }}</dd>
                    
                    <dt class="col-sm-7">Créé le</dt>
                    <dd class="col-sm-5">{{ $commentaireCours->created_at->format('d/m/Y H:i') }}</dd>
                    
                    <dt class="col-sm-7">Dernière modification</dt>
                    <dd class="col-sm-5">{{ $commentaireCours->updated_at->format('d/m/Y H:i') }}</dd>
                </dl>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>
                    Informations du cours
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-5">Cours</dt>
                    <dd class="col-sm-7">
                        <a href="{{ route('back.formation.cours.show', $commentaireCours->cour) }}" class="text-info">
                            {{ $commentaireCours->cour->titre }}
                        </a>
                    </dd>
                    
                    <dt class="col-sm-5">Module</dt>
                    <dd class="col-sm-7">{{ $commentaireCours->cour->module->titre ?? 'N/A' }}</dd>
                    
                    <dt class="col-sm-5">Auteur du cours</dt>
                    <dd class="col-sm-7">{{ $commentaireCours->cour->createur->name ?? 'N/A' }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>

<!-- Modal Répondre -->
<div class="modal fade" id="repondreModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('back.formation.commentaires.repondre', $commentaireCours) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Répondre au commentaire</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Votre réponse</label>
                        <textarea name="contenu" rows="5" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Envoyer la réponse</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function approuverCommentaire(id) {
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
</script>
@endpush