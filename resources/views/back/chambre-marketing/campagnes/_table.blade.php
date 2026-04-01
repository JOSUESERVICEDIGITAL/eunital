<div class="content-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $titreBloc }}</h4>
            <p class="text-muted mb-0">{{ $descriptionBloc }}</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Campagne</th>
                    <th>Réseau</th>
                    <th>Budget</th>
                    <th>Consommé</th>
                    <th>Statut</th>
                    <th>Responsable</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($campagnes as $campagne)
                    <tr>
                        <td>#{{ $campagne->id }}</td>

                        <td>
                            <div class="fw-bold">{{ $campagne->titre }}</div>
                            <div class="text-muted small">
                                {{ \Illuminate\Support\Str::limit($campagne->description, 65) }}</div>
                        </td>

                        <td>
                            <span class="badge rounded-pill text-bg-light border">
                                {{ str_replace('_', ' ', ucfirst($campagne->reseau)) }}
                            </span>
                        </td>

                        <td>{{ number_format($campagne->budget, 2, ',', ' ') }}</td>
                        <td>{{ number_format($campagne->budget_consomme, 2, ',', ' ') }}</td>

                        <td>
                            @php
                                $couleurStatut = match ($campagne->statut) {
                                    'active' => 'success',
                                    'en_pause' => 'warning',
                                    'terminee' => 'secondary',
                                    'archivee' => 'dark',
                                    default => 'light',
                                };
                            @endphp
                            <span class="badge rounded-pill text-bg-{{ $couleurStatut }}">
                                {{ str_replace('_', ' ', ucfirst($campagne->statut)) }}
                            </span>
                        </td>

                        <td>{{ $campagne->responsable->name ?? '—' }}</td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-marketing.campagnes.details', $campagne) }}"
                                    class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-marketing.campagnes.modifier', $campagne) }}"
                                    class="btn btn-sm btn-warning rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                    data-bs-toggle="modal" data-bs-target="#modalActionsCampagne{{ $campagne->id }}">
                                    Actions
                                </button>

                                <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalSuppressionCampagne{{ $campagne->id }}">
                                    Supprimer
                                </button>
                            </div>

                            @include('back.chambre-marketing.campagnes._modales', [
                                'campagne' => $campagne,
                            ])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            Aucune campagne marketing trouvée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $campagnes->links() }}
    </div>
</div>
