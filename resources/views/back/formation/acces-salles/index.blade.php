@extends('back.formation.layouts.app')

@section('title', 'Accès salles')
@section('page_title', 'Gestion des accès aux salles')
@section('page_subtitle', 'Codes d\'accès temporaires pour les cours en présentiel ou à distance')

@section('formation-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-door-open mr-2"></i>
            Codes d'accès générés
        </h3>
        <div class="card-tools">
            <a href="{{ route('back.formation.acces-salles.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Générer un code
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    肇
                        <th style="width: 50px">#</th>
                        <th>Cours</th>
                        <th>Code d'accès</th>
                        <th>Généré le</th>
                        <th>Expire le</th>
                        <th>Utilisateurs actifs</th>
                        <th>Statut</th>
                        <th style="width: 120px">Actions</th>
                    </thead>
                <tbody>
                    @forelse($acces as $accesSalle)
                    <tr>
                        <td>{{ $accesSalle->id }}</td>
                        <td>
                            <a href="{{ route('back.formation.cours.show', $accesSalle->cour) }}" class="text-info">
                                {{ $accesSalle->cour->titre }}
                            </a>
                            <br>
                            <small class="text-muted">{{ $accesSalle->cour->module->titre ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <code class="code-display" onclick="copyToClipboard('{{ $accesSalle->code_acces }}')">
                                {{ $accesSalle->code_acces }}
                                <i class="fas fa-copy ml-2"></i>
                            </code>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($accesSalle->generated_at)->format('d/m/Y H:i') }}
                            <br>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($accesSalle->generated_at)->diffForHumans() }}</small>
                        </td>
                        <td>
                            @if($accesSalle->expires_at)
                                {{ \Carbon\Carbon::parse($accesSalle->expires_at)->format('d/m/Y H:i') }}
                                @if($accesSalle->expires_at < now())
                                    <span class="badge badge-danger">Expiré</span>
                                @else
                                    <br>
                                    <small class="text-muted">dans {{ \Carbon\Carbon::parse($accesSalle->expires_at)->diffForHumans() }}</small>
                                @endif
                            @else
                                <span class="text-muted">Jamais</span>
                            @endif
                        </td>
                        <td>
                            @php $nbActifs = count($accesSalle->utilisateurs_actifs ?? []); @endphp
                            <span class="badge badge-{{ $nbActifs > 0 ? 'success' : 'secondary' }}">
                                {{ $nbActifs }} / {{ $accesSalle->max_utilisateurs ?? '∞' }}
                            </span>
                        </td>
                        <td>
                            @if($accesSalle->is_active && (!$accesSalle->expires_at || $accesSalle->expires_at > now()))
                                <span class="badge badge-success">Actif</span>
                            @elseif(!$accesSalle->is_active)
                                <span class="badge badge-secondary">Désactivé</span>
                            @else
                                <span class="badge badge-danger">Expiré</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('back.formation.acces-salles.show', $accesSalle) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('back.formation.acces-salles.edit', $accesSalle) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($accesSalle->is_active && (!$accesSalle->expires_at || $accesSalle->expires_at > now()))
                                    <button type="button" class="btn btn-sm btn-secondary" onclick="desactiverAcces({{ $accesSalle->id }})">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                @endif
                                <form action="{{ route('back.formation.acces-salles.destroy', $accesSalle) }}" method="POST" class="d-inline">
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
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-door-open fa-3x text-muted mb-3 d-block"></i>
                            Aucun code d'accès généré
                            <br>
                            <a href="{{ route('back.formation.acces-salles.create') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-plus"></i> Générer un premier code
                            </a>
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
                Affichage de {{ $acces->firstItem() ?? 0 }} à {{ $acces->lastItem() ?? 0 }} sur {{ $acces->total() }} codes
            </div>
            @include('back.formation.partials.pagination', ['items' => $acces])
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
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
    
    function desactiverAcces(id) {
        Swal.fire({
            title: 'Désactiver l\'accès',
            text: 'Êtes-vous sûr de vouloir désactiver ce code d\'accès ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6c757d',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Oui, désactiver',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
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
        });
    }
</script>
@endpush