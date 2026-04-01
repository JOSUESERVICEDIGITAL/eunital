<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">

        <div class="p-4 border-bottom bg-white">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h5 class="mb-1">Pipeline contractuel</h5>
                    <small class="text-muted">Validation, signature, archivage et liaison juridique des services du hub.</small>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Contrat</th>
                        <th>Partie liée</th>
                        <th>Projet</th>
                        <th>Type</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($contrats as $contrat)
                        <tr>
                            <td>#{{ $contrat->id }}</td>

                            <td>
                                <div class="fw-bold">{{ $contrat->titre }}</div>
                                <div class="small text-muted">
                                    Réf : {{ $contrat->reference }}
                                </div>
                            </td>

                            <td>
                                <div class="fw-semibold">{{ $contrat->client->nom ?? $contrat->user->name ?? '—' }}</div>
                                <div class="small text-muted">{{ ucfirst($contrat->partie_type) }}</div>
                            </td>

                            <td>{{ $contrat->projet->titre ?? '—' }}</td>

                            <td>
                                <span class="badge rounded-pill text-bg-light border">
                                    {{ ucfirst($contrat->type_contrat) }}
                                </span>
                            </td>

                            <td>
                                {{ $contrat->montant ? number_format($contrat->montant, 0, ',', ' ') . ' FCFA' : '—' }}
                            </td>

                            <td>
                                @php
                                    $badge = match($contrat->statut) {
                                        'brouillon' => 'secondary',
                                        'en_attente' => 'warning',
                                        'valide' => 'info',
                                        'signe' => 'success',
                                        'rejete' => 'danger',
                                        'archive' => 'dark',
                                        default => 'secondary'
                                    };
                                @endphp

                                <span class="badge text-bg-{{ $badge }}">
                                    {{ ucfirst(str_replace('_', ' ', $contrat->statut)) }}
                                </span>
                            </td>

                            <td class="text-end">
                                <div class="d-inline-flex flex-wrap gap-2 justify-content-end">
                                    <a href="{{ route('back.chambre-juridique.contrats.details', $contrat) }}"
                                       class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                        Voir
                                    </a>

                                    <a href="{{ route('back.chambre-juridique.contrats.modifier', $contrat) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        Modifier
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalActionsContrat{{ $contrat->id }}">
                                        Actions
                                    </button>
                                </div>

                                @include('back.chambre-juridique.contrats._modales', ['contrat' => $contrat])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                Aucun contrat trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3">
            {{ $contrats->links() }}
        </div>
    </div>
</div>
