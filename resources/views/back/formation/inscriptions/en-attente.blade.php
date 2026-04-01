@extends('back.formation.layouts.app')

@section('title', 'Inscriptions en attente')
@section('page_title', 'Inscriptions en attente de validation')
@section('page_subtitle', 'Liste des inscriptions à valider')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-clock text-warning mr-2"></i>
            Inscriptions en attente
        </h3>
        <div class="card-tools">
            <span class="badge badge-warning badge-lg">{{ $inscriptions->total() }} en attente</span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 50px">#</th>
                        <th>Étudiant</th>
                        <th>Module</th>
                        <th>Date demande</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inscriptions as $inscription)
                    <tr>
                        <td>{{ $inscription->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle mr-2" style="width: 35px; height: 35px; font-size: 14px;">
                                    {{ substr($inscription->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <strong>{{ $inscription->user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $inscription->user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('back.formation.modules.show', $inscription->module) }}" class="text-info">
                                {{ $inscription->module->titre }}
                            </a>
                        </td>
                        <td>
                            {{ $inscription->created_at->format('d/m/Y H:i') }}
                            <br>
                            <small class="text-muted">Il y a {{ $inscription->created_at->diffForHumans() }}</small>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-success" onclick="validerInscription({{ $inscription->id }})">
                                    <i class="fas fa-check-circle"></i> Valider
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="rejeterInscription({{ $inscription->id }})">
                                    <i class="fas fa-times-circle"></i> Rejeter
                                </button>
                                <a href="{{ route('back.formation.inscriptions.show', $inscription) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <i class="fas fa-check-circle fa-3x text-success mb-3 d-block"></i>
                            Aucune inscription en attente
                            <br>
                            <span class="text-muted">Toutes les inscriptions ont été traitées</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        @include('back.formation.partials.pagination', ['items' => $inscriptions])
    </div>
</div>
@endsection

@push('scripts')
<script>
    function validerInscription(id) {
        Swal.fire({
            title: 'Valider l\'inscription',
            text: 'L\'étudiant pourra accéder au module une fois validé.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Valider',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
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
        });
    }
    
    function rejeterInscription(id) {
        Swal.fire({
            title: 'Rejeter l\'inscription',
            text: 'Cette action est irréversible. L\'étudiant sera notifié.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Rejeter',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/inscriptions/' + id + '/rejeter',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire('Rejeté!', 'L\'inscription a été rejetée', 'error');
                            location.reload();
                        }
                    }
                });
            }
        });
    }
</script>
@endpush