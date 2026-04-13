@extends('back.formation.layouts.app')

@section('title', 'Inscriptions en attente')
@section('page_title', 'Inscriptions en attente de validation')
@section('page_subtitle', 'Liste des inscriptions à traiter rapidement')

@section('formation-content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h3 class="card-title mb-1">
                <i class="fas fa-clock text-warning mr-2"></i>
                Inscriptions en attente
            </h3>
            <small class="text-muted">Valide, rejette ou consulte rapidement les nouvelles demandes.</small>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <span class="badge badge-warning badge-lg px-3 py-2">{{ $inscriptions->total() }} en attente</span>

            <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#bulkToolsModal">
                <i class="fas fa-bolt mr-1"></i> Actions
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 60px">#</th>
                        <th>Étudiant</th>
                        <th>Module</th>
                        <th>Demande</th>
                        <th style="width: 150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inscriptions as $inscription)
                        <tr>
                            <td class="text-muted font-weight-bold">#{{ $inscription->id }}</td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle mr-2" style="width: 38px; height: 38px; font-size: 15px;">
                                        {{ strtoupper(substr($inscription->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-weight-bold">{{ $inscription->user->name }}</div>
                                        <small class="text-muted">{{ $inscription->user->email }}</small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <a href="{{ route('back.formation.modules.show', $inscription->module) }}" class="text-info font-weight-bold">
                                    {{ $inscription->module->titre }}
                                </a>
                            </td>

                            <td>
                                <div>{{ $inscription->created_at->format('d/m/Y H:i') }}</div>
                                <small class="text-muted">{{ $inscription->created_at->diffForHumans() }}</small>
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-circle border" type="button" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                                        <button type="button" class="dropdown-item text-success" onclick="validerInscription({{ $inscription->id }})">
                                            <i class="fas fa-check-circle mr-2"></i> Valider
                                        </button>

                                        <button type="button" class="dropdown-item text-danger" onclick="rejeterInscription({{ $inscription->id }})">
                                            <i class="fas fa-times-circle mr-2"></i> Rejeter
                                        </button>

                                        <a href="{{ route('back.formation.inscriptions.show', $inscription) }}" class="dropdown-item">
                                            <i class="fas fa-eye text-info mr-2"></i> Voir
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fas fa-check-circle fa-3x text-success mb-3 d-block"></i>
                                <div class="font-weight-bold">Aucune inscription en attente</div>
                                <div class="text-muted">Toutes les inscriptions ont été traitées.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer bg-white">
        @include('back.formation.partials.pagination', ['items' => $inscriptions])
    </div>
</div>

<div class="modal fade" id="bulkToolsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title"><i class="fas fa-bolt mr-2"></i> Traitement rapide</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body text-center">
                <a href="{{ route('back.formation.inscriptions.index') }}" class="btn btn-primary m-1">
                    <i class="fas fa-list mr-1"></i> Toutes les inscriptions
                </a>
                <a href="{{ route('back.formation.inscriptions.create') }}" class="btn btn-success m-1">
                    <i class="fas fa-plus mr-1"></i> Nouvelle inscription
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function validerInscription(id) {
        Swal.fire({
            title: 'Valider l’inscription ?',
            text: 'L’étudiant pourra accéder au module.',
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
                    success: function() {
                        Swal.fire('Validé', 'L’inscription a été validée.', 'success')
                            .then(() => location.reload());
                    }
                });
            }
        });
    }

    function rejeterInscription(id) {
        Swal.fire({
            title: 'Rejeter l’inscription ?',
            text: 'Cette action supprimera la demande en attente.',
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
                    success: function() {
                        Swal.fire('Rejeté', 'L’inscription a été rejetée.', 'success')
                            .then(() => location.reload());
                    }
                });
            }
        });
    }
</script>
@endpush
