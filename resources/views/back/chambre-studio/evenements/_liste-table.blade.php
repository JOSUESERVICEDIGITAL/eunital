<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Client</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Lieu</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($evenements as $evenement)
                        <tr>
                            <td>#{{ $evenement->id }}</td>

                            <td>
                                <div class="fw-semibold">{{ $evenement->titre }}</div>
                                <div class="small text-muted">
                                    {{ $evenement->captations->count() }} captation(s)
                                </div>
                            </td>

                            <td>
                                <div class="fw-semibold">{{ $evenement->client->nom ?? '—' }}</div>
                                <div class="small text-muted">{{ $evenement->client->telephone ?? '' }}</div>
                            </td>

                            <td>{{ $evenement->type ?: '—' }}</td>

                            <td>
                                {{ $evenement->date ? $evenement->date->format('d/m/Y') : '—' }}
                            </td>

                            <td>{{ $evenement->lieu ?: '—' }}</td>

                            <td>
                                @php
                                    $badge = match($evenement->statut) {
                                        'planifie' => 'primary',
                                        'realise' => 'success',
                                        'annule' => 'danger',
                                        default => 'secondary'
                                    };
                                @endphp

                                <span class="badge text-bg-{{ $badge }}">
                                    {{ ucfirst($evenement->statut) }}
                                </span>
                            </td>

                            <td class="text-end">
                                <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                    <a href="{{ route('back.chambre-studio.evenements.details', $evenement) }}"
                                       class="btn btn-sm btn-outline-dark">
                                        Voir
                                    </a>

                                    <a href="{{ route('back.chambre-studio.evenements.modifier', $evenement) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Modifier
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalActionsEvenement{{ $evenement->id }}">
                                        Actions
                                    </button>
                                </div>

                                @include('back.chambre-studio.evenements._modales', ['evenement' => $evenement])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                Aucun événement trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $evenements->links() }}
        </div>

    </div>
</div>