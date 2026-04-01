@extends('back.formation.layouts.app')

@section('title', 'Modifier l\'inscription')
@section('page_title', 'Modification de l\'inscription')
@section('page_subtitle', 'Modifier les informations de l\'inscription de ' . $inscription->user->name)

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Informations de l'inscription
                </h3>
            </div>
            <form action="{{ route('back.formation.inscriptions.update', $inscription) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('back.formation.inscriptions.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('back.formation.inscriptions.show', $inscription) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Voir l'inscription
                    </a>
                    <a href="{{ route('back.formation.inscriptions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                    Statistiques
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-7">Progression actuelle</dt>
                    <dd class="col-sm-5">
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-primary" style="width: {{ $inscription->progression }}%">
                                {{ $inscription->progression }}%
                            </div>
                        </div>
                    </dd>
                    
                    <dt class="col-sm-7">Cours suivis</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-info">{{ $coursSuivis ?? 0 }}/{{ $totalCours ?? 0 }}</span>
                    </dd>
                    
                    <dt class="col-sm-7">Taux de présence</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-success">{{ round($inscription->taux_presence, 1) }}%</span>
                    </dd>
                    
                    <dt class="col-sm-7">Inscrit le</dt>
                    <dd class="col-sm-5">{{ $inscription->created_at->format('d/m/Y') }}</dd>
                    
                    @if($inscription->date_debut)
                    <dt class="col-sm-7">Débuté le</dt>
                    <dd class="col-sm-5">{{ \Carbon\Carbon::parse($inscription->date_debut)->format('d/m/Y') }}</dd>
                    @endif
                    
                    @if($inscription->date_fin)
                    <dt class="col-sm-7">Terminé le</dt>
                    <dd class="col-sm-5">{{ \Carbon\Carbon::parse($inscription->date_fin)->format('d/m/Y') }}</dd>
                    @endif
                </dl>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Actions rapides
                </h3>
            </div>
            <div class="card-body">
                <div class="btn-group-vertical w-100">
                    @if($inscription->statut == 'en_attente')
                    <button type="button" class="btn btn-success mb-2" onclick="validerInscription({{ $inscription->id }})">
                        <i class="fas fa-check-circle"></i> Valider l'inscription
                    </button>
                    @endif
                    
                    @if($inscription->statut == 'valide')
                    <button type="button" class="btn btn-info mb-2" onclick="terminerInscription({{ $inscription->id }})">
                        <i class="fas fa-flag-checkered"></i> Marquer comme terminé
                    </button>
                    @endif
                    
                    @if(in_array($inscription->statut, ['en_attente', 'valide']))
                    <button type="button" class="btn btn-danger mb-2" onclick="abandonnerInscription({{ $inscription->id }})">
                        <i class="fas fa-times-circle"></i> Marquer comme abandonné
                    </button>
                    @endif
                    
                    <form action="{{ route('back.formation.inscriptions.destroy', $inscription) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn w-100">
                            <i class="fas fa-trash"></i> Supprimer l'inscription
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function validerInscription(id) {
        $.ajax({
            url: '/back/formation/inscriptions/' + id + '/valider',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'PATCH'
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire('Validé!', 'L\'inscription a été validée', 'success');
                    location.reload();
                }
            }
        });
    }
    
    function terminerInscription(id) {
        Swal.fire({
            title: 'Terminer l\'inscription',
            text: 'Confirmez-vous que l\'étudiant a terminé le module ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#17a2b8',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, terminer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/inscriptions/' + id + '/terminer',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire('Terminé!', 'L\'inscription a été marquée comme terminée', 'success');
                            location.reload();
                        }
                    }
                });
            }
        });
    }
    
    function abandonnerInscription(id) {
        Swal.fire({
            title: 'Abandonner l\'inscription',
            text: 'Êtes-vous sûr de vouloir marquer cette inscription comme abandonnée ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, abandonner',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/inscriptions/' + id + '/abandonner',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire('Abandonné!', 'L\'inscription a été marquée comme abandonnée', 'warning');
                            location.reload();
                        }
                    }
                });
            }
        });
    }
</script>
@endpush