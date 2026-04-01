@extends('back.formation.layouts.app')

@section('title', 'Commentaires en attente')
@section('page_title', 'Commentaires en attente de modération')
@section('page_subtitle', 'Liste des commentaires à approuver')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-clock text-warning mr-2"></i>
            Commentaires en attente
        </h3>
        <div class="card-tools">
            <span class="badge badge-warning badge-lg">{{ $commentaires->total() }} en attente</span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            @forelse($commentaires as $commentaire)
            <div class="list-group-item">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar-circle mr-2" style="width: 40px; height: 40px;">
                                {{ substr($commentaire->user->name, 0, 1) }}
                            </div>
                            <div>
                                <strong>{{ $commentaire->user->name }}</strong>
                                <br>
                                <small class="text-muted">{{ $commentaire->user->email }}</small>
                            </div>
                            <span class="ml-3 badge badge-secondary">sur {{ $commentaire->cour->titre }}</span>
                            <span class="ml-2 badge badge-light">{{ $commentaire->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <p class="mb-2">{{ $commentaire->contenu }}</p>
                        <div class="d-flex">
                            <span class="text-muted small mr-3">
                                <i class="fas fa-thumbs-up"></i> {{ $commentaire->likes }} likes
                            </span>
                        </div>
                    </div>
                    <div class="ml-3">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-success" onclick="approuverCommentaire({{ $commentaire->id }})">
                                <i class="fas fa-check-circle"></i> Approuver
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="rejeterCommentaire({{ $commentaire->id }})">
                                <i class="fas fa-times-circle"></i> Rejeter
                            </button>
                            <a href="{{ route('back.formation.commentaires.show', $commentaire) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Détails
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                <h5 class="text-success">Aucun commentaire en attente</h5>
                <p class="text-muted">Tous les commentaires ont été modérés</p>
                <a href="{{ route('back.formation.commentaires.index') }}" class="btn btn-primary mt-2">
                    <i class="fas fa-arrow-left"></i> Voir tous les commentaires
                </a>
            </div>
            @endforelse
        </div>
    </div>
    <div class="card-footer">
        @include('back.formation.partials.pagination', ['items' => $commentaires])
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
    
    function rejeterCommentaire(id) {
        Swal.fire({
            title: 'Rejeter le commentaire',
            text: 'Cette action est irréversible. Le commentaire sera supprimé.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, rejeter',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/commentaires/' + id + '/rejeter',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire('Rejeté!', 'Le commentaire a été supprimé', 'success');
                            location.reload();
                        }
                    }
                });
            }
        });
    }
</script>
@endpush