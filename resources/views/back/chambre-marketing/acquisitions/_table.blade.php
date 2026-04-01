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
                    <th>Acquisition</th>
                    <th>Campagne liée</th>
                    <th>Source / Canal</th>
                    <th>Visiteurs</th>
                    <th>Leads</th>
                    <th>Coût</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($acquisitions as $acquisition)
                    <tr>
                        <td>#{{ $acquisition->id }}</td>

                        <td>
                            <div class="fw-bold">{{ $acquisition->titre }}</div>
                            <div class="text-muted small">
                                {{ $acquisition->auteur->name ?? '—' }}
                            </div>
                        </td>

                        <td>
                            {{ $acquisition->campagne->titre ?? '—' }}
                        </td>

                        <td>
                            <div class="fw-semibold">{{ $acquisition->source ?: '—' }}</div>
                            <div class="text-muted small">{{ $acquisition->canal ?: '—' }}</div>
                        </td>

                        <td>{{ number_format($acquisition->visiteurs, 0, ',', ' ') }}</td>
                        <td>{{ number_format($acquisition->leads, 0, ',', ' ') }}</td>
                        <td>{{ number_format($acquisition->cout_acquisition, 2, ',', ' ') }}</td>

                        <td>
                            @php
                                $couleurStatut = match($acquisition->statut) {
                                    'active' => 'success',
                                    'optimisation' => 'warning',
                                    'stoppee' => 'secondary',
                                    'archivee' => 'dark',
                                    default => 'light'
                                };
                            @endphp

                            <span class="badge rounded-pill text-bg-{{ $couleurStatut }}">
                                {{ ucfirst($acquisition->statut) }}
                            </span>
                        </td>

                       <td class="text-end">
    <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
        <a href="{{ route('back.chambre-marketing.acquisitions.details', $acquisition) }}"
           class="btn btn-sm btn-light rounded-pill px-3">
            Voir
        </a>

        <a href="{{ route('back.chambre-marketing.acquisitions.modifier', $acquisition) }}"
           class="btn btn-sm btn-warning rounded-pill px-3">
            Modifier
        </a>

        <button type="button"
            class="btn btn-sm btn-outline-primary rounded-pill px-3"
            data-bs-toggle="modal"
            data-bs-target="#modalActionsAcquisition{{ $acquisition->id }}">
            Actions
        </button>

        <button type="button"
            class="btn btn-sm btn-outline-danger rounded-pill px-3"
            data-bs-toggle="modal"
            data-bs-target="#modalSuppressionAcquisition{{ $acquisition->id }}">
            Supprimer
        </button>
    </div>

    @include('back.chambre-marketing.acquisitions._modales', ['acquisition' => $acquisition])
</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            Aucune acquisition marketing trouvée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $acquisitions->links() }}
    </div>
</div>
