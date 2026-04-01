@extends('back.formation.layouts.app')

@section('title', 'Détails du code d\'accès')
@section('page_title', 'Code d\'accès')
@section('page_subtitle', 'Détails du code d\'accès généré')

@section('formation-content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-qrcode mr-2"></i>
                    Code d'accès
                </h3>
            </div>
            <div class="card-body text-center">
                <div class="code-display-display mb-3">
                    <code class="display-4" style="font-size: 2rem; letter-spacing: 4px;">
                        {{ $accesSalle->code_acces }}
                    </code>
                </div>
                <button class="btn btn-info" onclick="copyToClipboard('{{ $accesSalle->code_acces }}')">
                    <i class="fas fa-copy"></i> Copier le code
                </button>
                
                <div class="mt-4">
                    @php
                        $qrData = url('/acces-salle/verifier') . '?code=' . $accesSalle->code_acces . '&cour=' . $accesSalle->cour_id;
                    @endphp
                    <div id="qrcode" class="d-inline-block p-3 bg-white rounded"></div>
                    <br>
                    <small class="text-muted">Scannez ce QR code pour un accès rapide</small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>
                    Informations
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Cours</dt>
                    <dd class="col-sm-8">
                        <a href="{{ route('back.formation.cours.show', $accesSalle->cour) }}" class="text-info">
                            {{ $accesSalle->cour->titre }}
                        </a>
                    </dd>
                    
                    <dt class="col-sm-4">Module</dt>
                    <dd class="col-sm-8">{{ $accesSalle->cour->module->titre ?? 'N/A' }}</dd>
                    
                    <dt class="col-sm-4">Généré le</dt>
                    <dd class="col-sm-8">{{ \Carbon\Carbon::parse($accesSalle->generated_at)->format('d/m/Y H:i:s') }}</dd>
                    
                    <dt class="col-sm-4">Expire le</dt>
                    <dd class="col-sm-8">
                        @if($accesSalle->expires_at)
                            {{ \Carbon\Carbon::parse($accesSalle->expires_at)->format('d/m/Y H:i:s') }}
                            @if($accesSalle->expires_at > now())
                                <span class="badge badge-success ml-2">Encore {{ \Carbon\Carbon::parse($accesSalle->expires_at)->diffForHumans() }}</span>
                            @else
                                <span class="badge badge-danger ml-2">Expiré</span>
                            @endif
                        @else
                            <span class="text-muted">Jamais</span>
                        @endif
                    </dd>
                    
                    <dt class="col-sm-4">Statut</dt>
                    <dd class="col-sm-8">
                        @if($accesSalle->is_active && (!$accesSalle->expires_at || $accesSalle->expires_at > now()))
                            <span class="badge badge-success badge-lg">Actif</span>
                        @elseif(!$accesSalle->is_active)
                            <span class="badge badge-secondary badge-lg">Désactivé</span>
                        @else
                            <span class="badge badge-danger badge-lg">Expiré</span>
                        @endif
                    </dd>
                    
                    <dt class="col-sm-4">Limite utilisateurs</dt>
                    <dd class="col-sm-8">
                        @if($accesSalle->max_utilisateurs)
                            {{ $accesSalle->max_utilisateurs }} utilisateurs maximum
                        @else
                            <span class="text-muted">Illimitée</span>
                        @endif
                    </dd>
                </dl>
            </div>
            <div class="card-footer">
                <div class="btn-group w-100">
                    <a href="{{ route('back.formation.acces-salles.edit', $accesSalle) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <a href="{{ route('back.formation.acces-salles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i>
                    Utilisateurs connectés
                </h3>
                <div class="card-tools">
                    <span class="badge badge-info">{{ count($accesSalle->utilisateurs_actifs ?? []) }} connectés</span>
                </div>
            </div>
            <div class="card-body p-0">
                @php $utilisateurs = $accesSalle->utilisateurs_actifs ?? []; @endphp
                @if(count($utilisateurs) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                 <tr>
                                    <th>Utilisateur</th>
                                    <th>Email</th>
                                    <th>Connecté depuis</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($utilisateurs as $userId)
                                    @php 
                                        $user = \App\Models\User::find($userId);
                                        $connexionTime = $accesSalle->utilisateurs_connexion[$userId] ?? null;
                                    @endphp
                                    @if($user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle mr-2" style="width: 35px; height: 35px; font-size: 14px;">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                                <strong>{{ $user->name }}</strong>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($connexionTime)
                                                {{ \Carbon\Carbon::parse($connexionTime)->format('d/m/Y H:i:s') }}
                                                <br>
                                                <small class="text-muted">depuis {{ \Carbon\Carbon::parse($connexionTime)->diffForHumans() }}</small>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="deconnecterUtilisateur({{ $accesSalle->id }}, {{ $userId }})">
                                                <i class="fas fa-sign-out-alt"></i> Déconnecter
                                            </button>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Aucun utilisateur connecté avec ce code</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .code-display-display {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 2rem;
        border-radius: 1rem;
        font-family: monospace;
        letter-spacing: 4px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/qrcodejs2@0.0.2/qrcode.min.js"></script>
<script>
    $(document).ready(function() {
        // Générer le QR code
        new QRCode(document.getElementById("qrcode"), {
            text: "{{ $qrData }}",
            width: 200,
            height: 200,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    });
    
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text);
        Swal.fire({
            icon: 'success',
            title: 'Copié !',
            text: 'Le code a été copié dans le presse-papier',
            timer: 2000,
            showConfirmButton: false
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
</script>
@endpush