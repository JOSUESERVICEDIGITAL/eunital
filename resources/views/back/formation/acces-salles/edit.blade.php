@extends('back.formation.layouts.app')

@section('title', 'Modifier le code d\'accès')
@section('page_title', 'Modification du code d\'accès')
@section('page_subtitle', 'Modifier les paramètres du code d\'accès')

@section('formation-content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Paramètres du code d'accès
                </h3>
            </div>
            <form action="{{ route('back.formation.acces-salles.update', $accesSalle) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @include('back.formation.acces-salles.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('back.formation.acces-salles.show', $accesSalle) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Voir
                    </a>
                    <a href="{{ route('back.formation.acces-salles.index') }}" class="btn btn-secondary">
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
                    <dt class="col-sm-7">Utilisateurs actifs</dt>
                    <dd class="col-sm-5">
                        <span class="badge badge-info">{{ count($accesSalle->utilisateurs_actifs ?? []) }}</span>
                        @if($accesSalle->max_utilisateurs)
                            / {{ $accesSalle->max_utilisateurs }}
                        @endif
                    </dd>
                    
                    <dt class="col-sm-7">Généré le</dt>
                    <dd class="col-sm-5">{{ \Carbon\Carbon::parse($accesSalle->generated_at)->format('d/m/Y H:i') }}</dd>
                    
                    <dt class="col-sm-7">Expire le</dt>
                    <dd class="col-sm-5">
                        @if($accesSalle->expires_at)
                            {{ \Carbon\Carbon::parse($accesSalle->expires_at)->format('d/m/Y H:i') }}
                        @else
                            Jamais
                        @endif
                    </dd>
                    
                    <dt class="col-sm-7">Âge du code</dt>
                    <dd class="col-sm-5">{{ \Carbon\Carbon::parse($accesSalle->generated_at)->diffForHumans() }}</dd>
                </dl>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i>
                    Utilisateurs connectés
                </h3>
            </div>
            <div class="card-body p-0">
                @php $utilisateurs = $accesSalle->utilisateurs_actifs ?? []; @endphp
                @if(count($utilisateurs) > 0)
                    <div class="list-group list-group-flush">
                        @foreach($utilisateurs as $userId)
                            @php $user = \App\Models\User::find($userId); @endphp
                            @if($user)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle mr-2" style="width: 30px; height: 30px; font-size: 12px;">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <strong>{{ $user->name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $user->email }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deconnecterUtilisateur({{ $accesSalle->id }}, {{ $userId }})">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </button>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-user-slash fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Aucun utilisateur connecté</p>
                    </div>
                @endif
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
                    @if($accesSalle->is_active && (!$accesSalle->expires_at || $accesSalle->expires_at > now()))
                        <button type="button" class="btn btn-secondary mb-2" onclick="desactiverAcces({{ $accesSalle->id }})">
                            <i class="fas fa-ban"></i> Désactiver le code
                        </button>
                    @elseif(!$accesSalle->is_active)
                        <button type="button" class="btn btn-success mb-2" onclick="activerAcces({{ $accesSalle->id }})">
                            <i class="fas fa-check-circle"></i> Réactiver le code
                        </button>
                    @endif
                    
                    <button type="button" class="btn btn-info mb-2" onclick="genererNouveauCode({{ $accesSalle->cour_id }})">
                        <i class="fas fa-sync-alt"></i> Générer un nouveau code
                    </button>
                    
                    <form action="{{ route('back.formation.acces-salles.destroy', $accesSalle) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn w-100">
                            <i class="fas fa-trash"></i> Supprimer définitivement
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
    function desactiverAcces(id) {
        $.ajax({
            url: '/back/formation/acces-salles/' + id + '/desactiver',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'PATCH'
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire('Désactivé!', 'Le code d\'accès a été désactivé', 'success');
                    location.reload();
                }
            }
        });
    }
    
    function activerAcces(id) {
        $.ajax({
            url: '/back/formation/acces-salles/' + id + '/activer',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'PATCH'
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire('Activé!', 'Le code d\'accès a été réactivé', 'success');
                    location.reload();
                }
            }
        });
    }
    
    function deconnecterUtilisateur(accesId, userId) {
        Swal.fire({
            title: 'Déconnecter l\'utilisateur',
            text: 'Êtes-vous sûr de vouloir déconnecter cet utilisateur ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, déconnecter',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/acces-salles/' + accesId + '/deconnecter/' + userId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire('Déconnecté!', 'L\'utilisateur a été déconnecté', 'success');
                            location.reload();
                        }
                    }
                });
            }
        });
    }
    
    function genererNouveauCode(courId) {
        $.ajax({
            url: '/back/formation/cours/' + courId + '/generer-code',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Code généré',
                        html: 'Nouveau code: <strong>' + response.code + '</strong><br>Expire le: ' + new Date(response.expires_at).toLocaleString(),
                        timer: 5000,
                        showConfirmButton: true
                    });
                    location.reload();
                }
            }
        });
    }
</script>
@endpush