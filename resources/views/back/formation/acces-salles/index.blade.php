@extends('back.formation.layouts.app')

@section('title', 'Accès salles')
@section('page_title', 'Gestion des accès aux salles')
@section('page_subtitle', 'Codes d’accès, QR codes et ouverture des salles pédagogiques')

@section('formation-content')

<div class="row mb-3">
    <div class="col-md-3 col-6">
        <div class="small-box bg-primary shadow-sm">
            <div class="inner">
                <h3>{{ $acces->total() ?? 0 }}</h3>
                <p>Codes générés</p>
            </div>
            <div class="icon">
                <i class="fas fa-key"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="small-box bg-success shadow-sm">
            <div class="inner">
                <h3>{{ collect($acces->items())->filter(fn($item) => $item->is_active && (!$item->expires_at || $item->expires_at > now()))->count() }}</h3>
                <p>Accès actifs</p>
            </div>
            <div class="icon">
                <i class="fas fa-door-open"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="small-box bg-warning shadow-sm">
            <div class="inner">
                <h3>{{ collect($acces->items())->sum(fn($item) => count($item->utilisateurs_actifs ?? [])) }}</h3>
                <p>Utilisateurs connectés</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-6">
        <div class="small-box bg-danger shadow-sm">
            <div class="inner">
                <h3>{{ collect($acces->items())->filter(fn($item) => $item->expires_at && $item->expires_at < now())->count() }}</h3>
                <p>Codes expirés</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h3 class="card-title mb-1">
                <i class="fas fa-door-open mr-2 text-primary"></i>
                Codes d’accès générés
            </h3>
            <small class="text-muted">
                Ouvrez, gérez et surveillez l’accès aux salles pédagogiques liées aux cours.
            </small>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#quickActionsModal">
                <i class="fas fa-bolt mr-1"></i> Actions rapides
            </button>

            <button type="button" class="btn btn-light btn-sm border" data-toggle="modal" data-target="#filterModal">
                <i class="fas fa-filter mr-1"></i> Filtrer
            </button>

            <a href="{{ route('back.formation.acces-salles.create') }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="fas fa-plus mr-1"></i> Générer un code
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 60px">#</th>
                        <th>Cours / Salle</th>
                        <th>Code d’accès</th>
                        <th>QR / Accès</th>
                        <th>Généré le</th>
                        <th>Expiration</th>
                        <th>Actifs</th>
                        <th>Statut</th>
                        <th style="width: 140px">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($acces as $accesSalle)
                        @php
                            $nbActifs = count($accesSalle->utilisateurs_actifs ?? []);
                            $estActif = $accesSalle->is_active && (!$accesSalle->expires_at || $accesSalle->expires_at > now());
                        @endphp

                        <tr>
                            <td class="font-weight-bold text-muted">#{{ $accesSalle->id }}</td>

                            <td>
                                <div class="font-weight-bold">
                                    <a href="{{ route('back.formation.cours.show', $accesSalle->cour) }}" class="text-info">
                                        {{ $accesSalle->cour->titre }}
                                    </a>
                                </div>

                                <div class="small text-muted">
                                    {{ $accesSalle->cour->module->titre ?? 'N/A' }}
                                </div>

                                <div class="mt-1 d-flex flex-wrap gap-2 small">
                                    <a href="{{ route('back.formation.presences.index') }}?cour_id={{ $accesSalle->cour->id }}" class="text-success">
                                        <i class="fas fa-user-check mr-1"></i>Présences
                                    </a>
                                    <a href="{{ route('back.formation.devoirs.index') }}?cour_id={{ $accesSalle->cour->id }}" class="text-warning">
                                        <i class="fas fa-tasks mr-1"></i>Devoirs
                                    </a>
                                </div>
                            </td>

                            <td>
                                <button type="button"
                                        class="btn btn-light btn-sm border text-monospace"
                                        onclick="copyToClipboard('{{ $accesSalle->code_acces }}')">
                                    {{ $accesSalle->code_acces }}
                                    <i class="fas fa-copy ml-2"></i>
                                </button>
                            </td>

                            <td>
                                <div class="d-flex flex-column">
                                    <button type="button"
                                            class="btn btn-outline-dark btn-sm mb-1"
                                            data-toggle="modal"
                                            data-target="#qrModal{{ $accesSalle->id }}">
                                        <i class="fas fa-qrcode mr-1"></i> QR Code
                                    </button>

                                    <a href="{{ route('back.formation.acces-salles.show', $accesSalle) }}"
                                       class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-door-open mr-1"></i> Ouvrir
                                    </a>
                                </div>
                            </td>

                            <td>
                                <div>{{ \Carbon\Carbon::parse($accesSalle->generated_at)->format('d/m/Y') }}</div>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($accesSalle->generated_at)->format('H:i') }}
                                </small>
                            </td>

                            <td>
                                @if($accesSalle->expires_at)
                                    <div>{{ \Carbon\Carbon::parse($accesSalle->expires_at)->format('d/m/Y') }}</div>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($accesSalle->expires_at)->format('H:i') }}
                                    </small>

                                    @if($accesSalle->expires_at < now())
                                        <div class="mt-1">
                                            <span class="badge badge-danger">Expiré</span>
                                        </div>
                                    @endif
                                @else
                                    <span class="text-muted">Jamais</span>
                                @endif
                            </td>

                            <td>
                                <span class="badge badge-{{ $nbActifs > 0 ? 'success' : 'secondary' }}">
                                    {{ $nbActifs }} / {{ $accesSalle->max_utilisateurs ?? '∞' }}
                                </span>
                            </td>

                            <td>
                                @if($estActif)
                                    <span class="badge badge-success">Actif</span>
                                @elseif(!$accesSalle->is_active)
                                    <span class="badge badge-secondary">Désactivé</span>
                                @else
                                    <span class="badge badge-danger">Expiré</span>
                                @endif
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-circle border" type="button" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                                        <a class="dropdown-item" href="{{ route('back.formation.acces-salles.show', $accesSalle) }}">
                                            <i class="fas fa-eye text-info mr-2"></i> Voir
                                        </a>

                                        <a class="dropdown-item" href="{{ route('back.formation.acces-salles.edit', $accesSalle) }}">
                                            <i class="fas fa-edit text-warning mr-2"></i> Modifier
                                        </a>

                                        <a class="dropdown-item" href="{{ route('back.formation.cours.show', $accesSalle->cour) }}">
                                            <i class="fas fa-book text-primary mr-2"></i> Voir le cours
                                        </a>

                                        <button type="button"
                                                class="dropdown-item"
                                                onclick="copyToClipboard('{{ $accesSalle->code_acces }}')">
                                            <i class="fas fa-copy text-secondary mr-2"></i> Copier le code
                                        </button>

                                        <button type="button"
                                                class="dropdown-item"
                                                data-toggle="modal"
                                                data-target="#qrModal{{ $accesSalle->id }}">
                                            <i class="fas fa-qrcode text-dark mr-2"></i> Voir QR code
                                        </button>

                                        @if($estActif)
                                            <button type="button"
                                                    class="dropdown-item text-secondary"
                                                    onclick="desactiverAcces({{ $accesSalle->id }})">
                                                <i class="fas fa-ban mr-2"></i> Désactiver
                                            </button>
                                        @else
                                            <button type="button"
                                                    class="dropdown-item text-success"
                                                    onclick="activerAcces({{ $accesSalle->id }})">
                                                <i class="fas fa-check-circle mr-2"></i> Réactiver
                                            </button>
                                        @endif

                                        <div class="dropdown-divider"></div>

                                        <button type="button"
                                                class="dropdown-item text-danger"
                                                data-toggle="modal"
                                                data-target="#deleteModal{{ $accesSalle->id }}">
                                            <i class="fas fa-trash mr-2"></i> Supprimer
                                        </button>
                                    </div>
                                </div>

                                {{-- Modal QR --}}
                                <div class="modal fade" id="qrModal{{ $accesSalle->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-dark text-white">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-qrcode mr-2"></i> QR Code d’accès
                                                </h5>
                                                <button type="button" class="close text-white" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body text-center">
                                                <p class="mb-2 font-weight-bold">{{ $accesSalle->cour->titre }}</p>
                                                <p class="small text-muted">Code : {{ $accesSalle->code_acces }}</p>

                                                <div class="border rounded p-4 bg-light">
                                                    <i class="fas fa-qrcode fa-6x text-dark"></i>
                                                    <div class="small text-muted mt-2">
                                                        Remplace ce bloc par une vraie image QR générée côté serveur.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal suppression --}}
                                <div class="modal fade" id="deleteModal{{ $accesSalle->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-exclamation-triangle mr-2"></i> Supprimer le code
                                                </h5>
                                                <button type="button" class="close text-white" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                Voulez-vous vraiment supprimer le code <strong>{{ $accesSalle->code_acces }}</strong> ?
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
                                                <form action="{{ route('back.formation.acces-salles.destroy', $accesSalle) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash mr-1"></i> Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <i class="fas fa-door-open fa-3x text-muted mb-3 d-block"></i>
                                <div class="font-weight-bold">Aucun code d’accès généré</div>
                                <div class="text-muted mb-3">Commence par créer un premier accès à une salle pédagogique.</div>
                                <a href="{{ route('back.formation.acces-salles.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus mr-1"></i> Générer un premier code
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer bg-white d-flex flex-wrap justify-content-between align-items-center">
        <div class="text-muted small">
            Affichage de {{ $acces->firstItem() ?? 0 }} à {{ $acces->lastItem() ?? 0 }} sur {{ $acces->total() }} codes
        </div>
        @include('back.formation.partials.pagination', ['items' => $acces])
    </div>
</div>

{{-- Modal actions rapides --}}
<div class="modal fade" id="quickActionsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-bolt mr-2"></i> Actions rapides
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body text-center">
                <a href="{{ route('back.formation.acces-salles.create') }}" class="btn btn-primary m-1">
                    <i class="fas fa-plus mr-1"></i> Générer un code
                </a>

                <a href="{{ route('back.formation.cours.index') }}" class="btn btn-info m-1">
                    <i class="fas fa-book mr-1"></i> Voir les cours
                </a>

                <a href="{{ route('back.formation.presences.index') }}" class="btn btn-success m-1">
                    <i class="fas fa-user-check mr-1"></i> Voir les présences
                </a>

                <a href="{{ route('back.formation.devoirs.index') }}" class="btn btn-warning m-1">
                    <i class="fas fa-tasks mr-1"></i> Voir les devoirs
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Modal filtre --}}
<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <form method="GET" action="{{ route('back.formation.acces-salles.index') }}">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-filter mr-2"></i> Filtrer les accès
                    </h5>
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

                    <div class="form-group mb-0">
                        <label>Statut</label>
                        <select name="statut" class="form-control">
                            <option value="">Tous</option>
                            <option value="actif" {{ request('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
                            <option value="desactive" {{ request('statut') == 'desactive' ? 'selected' : '' }}>Désactivé</option>
                            <option value="expire" {{ request('statut') == 'expire' ? 'selected' : '' }}>Expiré</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="{{ route('back.formation.acces-salles.index') }}" class="btn btn-light">Réinitialiser</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check mr-1"></i> Appliquer
                    </button>
                </div>
            </form>
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
            timer: 1800,
            showConfirmButton: false
        });
    }

    function desactiverAcces(id) {
        Swal.fire({
            title: 'Désactiver cet accès ?',
            text: 'Les utilisateurs ne pourront plus entrer dans la salle avec ce code.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, désactiver',
            cancelButtonText: 'Annuler',
            confirmButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/acces-salles/' + id + '/desactiver',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    success: function() {
                        Swal.fire('Désactivé', 'Le code a été désactivé.', 'success')
                            .then(() => location.reload());
                    },
                    error: function() {
                        Swal.fire('Erreur', 'Impossible de désactiver ce code.', 'error');
                    }
                });
            }
        });
    }

    function activerAcces(id) {
        Swal.fire({
            title: 'Réactiver cet accès ?',
            text: 'Le code redeviendra utilisable si non expiré.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Oui, réactiver',
            cancelButtonText: 'Annuler',
            confirmButtonColor: '#28a745'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/back/formation/acces-salles/' + id + '/activer',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PATCH'
                    },
                    success: function() {
                        Swal.fire('Réactivé', 'Le code a été réactivé.', 'success')
                            .then(() => location.reload());
                    },
                    error: function() {
                        Swal.fire('Erreur', 'Impossible de réactiver ce code.', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
