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
                    <th>Tableau</th>
                    <th>Campagne liée</th>
                    <th>Impressions</th>
                    <th>Clics</th>
                    <th>Conversions</th>
                    <th>ROAS</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($tableaux as $tableau)
                    <tr>
                        <td>#{{ $tableau->id }}</td>

                        <td>
                            <div class="fw-bold">{{ $tableau->titre }}</div>
                            <div class="text-muted small">
                                @if($tableau->periode_debut || $tableau->periode_fin)
                                    Période :
                                    {{ $tableau->periode_debut ? $tableau->periode_debut->format('d/m/Y') : '—' }}
                                    →
                                    {{ $tableau->periode_fin ? $tableau->periode_fin->format('d/m/Y') : '—' }}
                                @else
                                    Aucune période définie
                                @endif
                            </div>
                        </td>

                        <td>{{ $tableau->campagne->titre ?? '—' }}</td>
                        <td>{{ number_format($tableau->impressions, 0, ',', ' ') }}</td>
                        <td>{{ number_format($tableau->clics, 0, ',', ' ') }}</td>
                        <td>{{ number_format($tableau->conversions, 0, ',', ' ') }}</td>
                        <td>{{ $tableau->roas !== null ? number_format($tableau->roas, 2, ',', ' ') : '—' }}</td>

                        <td>
                            @php
                                $couleurStatut = match ($tableau->statut) {
                                    'publie' => 'success',
                                    'archive' => 'dark',
                                    default => 'warning'
                                };
                            @endphp

                            <span class="badge rounded-pill text-bg-{{ $couleurStatut }}">
                                {{ ucfirst($tableau->statut) }}
                            </span>
                        </td>

                        <td class="text-end">
                            <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                <a href="{{ route('back.chambre-marketing.tableaux-performance.details', $tableau) }}"
                                    class="btn btn-sm btn-light rounded-pill px-3">
                                    Voir
                                </a>

                                <a href="{{ route('back.chambre-marketing.tableaux-performance.modifier', $tableau) }}"
                                    class="btn btn-sm btn-warning rounded-pill px-3">
                                    Modifier
                                </a>

                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                    data-bs-toggle="modal" data-bs-target="#modalActionsTableau{{ $tableau->id }}">
                                    Actions
                                </button>

                                <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                    data-bs-toggle="modal" data-bs-target="#modalSuppressionTableau{{ $tableau->id }}">
                                    Supprimer
                                </button>
                            </div>

                            @include('back.chambre-marketing.tableaux-performance._modales', ['tableau' => $tableau])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            Aucun tableau de performance trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $tableaux->links() }}
    </div>
</div>