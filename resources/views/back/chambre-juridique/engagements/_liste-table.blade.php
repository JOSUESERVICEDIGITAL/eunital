<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">

        <div class="p-4 border-bottom bg-white">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h5 class="mb-1">Pipeline des engagements</h5>
                    <small class="text-muted">Suivi des demandes d’engagement, traitement RH, validation, rejet ou archivage.</small>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Personne</th>
                        <th>Type</th>
                        <th>Service / chambre</th>
                        <th>Client / utilisateur</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($engagements as $engagement)
                        <tr>
                            <td>#{{ $engagement->id }}</td>

                            <td>
                                <div class="fw-bold">{{ $engagement->nom_complet }}</div>
                                <div class="small text-muted">
                                    {{ $engagement->email ?? 'Sans email' }}
                                    @if($engagement->telephone)
                                        · {{ $engagement->telephone }}
                                    @endif
                                </div>
                            </td>

                            <td>
                                <span class="badge rounded-pill text-bg-light border">
                                    {{ ucfirst($engagement->type_engagement) }}
                                </span>
                            </td>

                            <td>
                                <div class="fw-semibold">{{ $engagement->service_concerne ?? '—' }}</div>
                                <div class="small text-muted">{{ $engagement->chambre_source ?? '—' }}</div>
                            </td>

                            <td>
                                <div class="fw-semibold">{{ $engagement->client->nom ?? $engagement->user->name ?? '—' }}</div>
                            </td>

                            <td>
                                @php
                                    $badge = match($engagement->statut) {
                                        'en_attente' => 'secondary',
                                        'en_etude' => 'warning',
                                        'valide' => 'success',
                                        'rejete' => 'danger',
                                        'archive' => 'dark',
                                        default => 'secondary'
                                    };
                                @endphp

                                <span class="badge text-bg-{{ $badge }}">
                                    {{ ucfirst(str_replace('_', ' ', $engagement->statut)) }}
                                </span>
                            </td>

                            <td class="text-end">
                                <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                    <a href="{{ route('back.chambre-juridique.engagements.details', $engagement) }}"
                                       class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                        Voir
                                    </a>

                                    <a href="{{ route('back.chambre-juridique.engagements.modifier', $engagement) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        Modifier
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalActionsEngagement{{ $engagement->id }}">
                                        Actions
                                    </button>
                                </div>

                                @include('back.chambre-juridique.engagements._modales', ['engagement' => $engagement])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                Aucun engagement trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3">
            {{ $engagements->links() }}
        </div>
    </div>
</div>
